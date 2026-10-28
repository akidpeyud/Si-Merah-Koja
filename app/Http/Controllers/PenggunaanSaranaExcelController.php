<?php

namespace App\Http\Controllers;

use App\Models\PenggunaanSarana;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 * Cetak Excel: Rekapitulasi Permohonan Penggunaan Sarana.
 *
 * URL: /internal/damtan/kelola-penggunaan-sarana/export-excel
 *      /internal/damtan/kelola-penggunaan-sarana/export-excel?tahun=2026
 *
 * Kolom dibaca otomatis dari tabel, jadi tidak perlu menyesuaikan nama field.
 * Filter tahun mengikuti kolom "Tgl Kegiatan" (tgl_pelaksanaan).
 */
class PenggunaanSaranaExcelController extends Controller
{
    /** Kolom tabel yang tidak ikut dicetak */
    private array $sembunyi = ['id', 'updated_at', 'deleted_at'];

    /**
     * Kolom yang namanya mengandung kata-kata ini dianggap berkas/foto
     * (surat pemohon, fotocopy KTP, sketsa denah lokasi, dsb.) dan TIDAK ikut dicetak.
     */
    private array $kataBerkas = [
        'surat', 'ktp', 'fotocopy', 'foto', 'sket', 'denah', 'lampiran',
        'dokumen', 'berkas', 'file', 'gambar', 'upload', 'scan', 'path',
    ];

    /** True jika kolom berisi berkas/foto (dilihat dari nama kolom atau isi datanya) */
    private function kolomBerkas(string $nama, $data): bool
    {
        $lower = strtolower($nama);
        foreach ($this->kataBerkas as $kata) {
            if (str_contains($lower, $kata)) {
                return true;
            }
        }

        // Cadangan: jika isi kolom berupa nama/path file gambar, PDF, atau dokumen
        foreach ($data as $row) {
            $v = $row->{$nama};
            if (is_string($v) && preg_match('/\.(jpe?g|png|gif|webp|bmp|pdf|docx?)$/i', trim($v))) {
                return true;
            }
        }

        return false;
    }

    public function __invoke(Request $request)
    {
        // Tahun opsional (?tahun=2026). Nilai selain 4 digit angka diabaikan = semua tahun.
        $tahun = $request->query('tahun');
        $tahun = (is_numeric($tahun) && strlen((string) $tahun) === 4) ? (int) $tahun : null;

        $model = new PenggunaanSarana;

        $query = PenggunaanSarana::orderBy('created_at', 'desc');
        if ($tahun) {
            $query->whereYear('tgl_pelaksanaan', $tahun);
        }
        $data = $query->get();

        $kolomDb = array_values(array_diff(
            Schema::getColumnListing($model->getTable()),
            $this->sembunyi
        ));

        // Buang kolom berkas/foto (surat pemohon, fotocopy KTP, sketsa denah lokasi, dsb.)
        $kolomDb = array_values(array_filter($kolomDb, function ($nama) use ($data) {
            return ! $this->kolomBerkas($nama, $data);
        }));

        // Buang kolom ID (mis. pemohon_id, id_pemohon, user_id)
        $kolomDb = array_values(array_filter($kolomDb, function ($nama) {
            return ! preg_match('/(^id_|_id$)/i', $nama);
        }));

        /* ---------- Definisi kolom ---------- */
        $kolom = [['key' => 'no', 'head' => 'No', 'w' => 6]];
        foreach ($kolomDb as $nama) {
            $kolom[] = [
                'key' => $nama,
                'head' => Str::headline($nama),
                'w' => 24,
            ];
        }

        foreach ($kolom as $i => &$k) {
            $k['huruf'] = Coordinate::stringFromColumnIndex($i + 1);
        }
        unset($k);
        $kolTerakhir = Coordinate::stringFromColumnIndex(count($kolom));

        /* ---------- Workbook ---------- */
        $ss = new Spreadsheet;
        $ss->getDefaultStyle()->getFont()->setName('Arial')->setSize(11);
        $ws = $ss->getActiveSheet();
        $ws->setTitle('PENGGUNAAN SARANA');

        foreach ($kolom as $k) {
            $ws->getColumnDimension($k['huruf'])->setWidth($k['w']);
        }

        // Judul
        $ws->mergeCells("A1:{$kolTerakhir}2");
        $ws->setCellValue('A1', 'REKAPITULASI PERMOHONAN PENGGUNAAN SARANA'.($tahun ? ' TAHUN '.$tahun : ''));
        $ws->mergeCells("A3:{$kolTerakhir}3");
        $ws->setCellValue('A3', 'Dicetak pada: '.Carbon::now()->locale('id')->translatedFormat('d F Y'));
        $ws->getStyle("A1:{$kolTerakhir}3")->applyFromArray([
            'font' => ['name' => 'Arial', 'bold' => true, 'size' => 16],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);
        $ws->getStyle('A3')->getFont()->setSize(11)->setBold(false);

        // Header tabel (baris 5)
        foreach ($kolom as $k) {
            $ws->setCellValue($k['huruf'].'5', $k['head']);
        }
        $ws->getStyle("A5:{$kolTerakhir}5")->applyFromArray([
            'font' => ['name' => 'Arial', 'bold' => true, 'size' => 12, 'color' => ['argb' => 'FFFFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FFB91C1C']],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
        ]);
        $ws->getRowDimension(5)->setRowHeight(32);

        /* ---------- Isi data ---------- */
        $r = 6;
        foreach ($data as $i => $row) {
            foreach ($kolom as $k) {
                $sel = $k['huruf'].$r;

                if ($k['key'] === 'no') {
                    $ws->setCellValue($sel, $i + 1);

                    continue;
                }

                $v = $row->{$k['key']};

                if ($v instanceof \DateTimeInterface) {
                    $v = Carbon::instance($v)->locale('id')->translatedFormat(
                        $k['key'] === 'created_at' ? 'd F Y' : 'd F Y'
                    );
                } elseif (is_array($v) || is_object($v)) {
                    $v = json_encode($v, JSON_UNESCAPED_UNICODE);
                } elseif ($k['key'] === 'status_permohonan' && ($v === null || $v === '')) {
                    $v = 'Pending';
                } elseif ($k['key'] === 'jenis_event' || Str::startsWith($k['key'], 'jenis')) {
                    $v = $v ? ucfirst(str_replace('_', ' ', (string) $v)) : '-';
                }

                if ($v === null || $v === '') {
                    $v = '-';
                }

                // Semua disimpan sebagai teks agar angka 0 di depan (NIK, No HP, dsb.) tidak hilang
                $ws->setCellValueExplicit($sel, (string) $v, DataType::TYPE_STRING);
            }
            $r++;
        }

        $terakhir = max(6, $r - 1);

        if ($data->isEmpty()) {
            $ws->mergeCells("A6:{$kolTerakhir}6");
            $ws->setCellValue('A6', $tahun
                ? 'Belum ada data pengajuan Penggunaan Sarana pada tahun '.$tahun.'.'
                : 'Belum ada data pengajuan Penggunaan Sarana.');
        }

        /* ---------- Gaya sel data ---------- */
        $ws->getStyle("A5:{$kolTerakhir}{$terakhir}")->getBorders()->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $ws->getStyle("A6:{$kolTerakhir}{$terakhir}")->applyFromArray([
            'font' => ['name' => 'Arial', 'size' => 11],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
        ]);

        // Kolom No rata tengah
        $ws->getStyle("A6:A{$terakhir}")->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Header tetap terlihat saat scroll
        $ws->freezePane('A6');

        /* ---------- Pengaturan cetak ---------- */
        $ws->getPageSetup()
            ->setOrientation(PageSetup::ORIENTATION_LANDSCAPE)
            ->setPaperSize(PageSetup::PAPERSIZE_FOLIO)
            ->setFitToPage(true)
            ->setFitToWidth(1)
            ->setFitToHeight(0)
            ->setHorizontalCentered(true)
            ->setRowsToRepeatAtTopByStartAndEnd(5, 5)
            ->setPrintArea("A1:{$kolTerakhir}{$terakhir}");
        $ws->getPageMargins()->setLeft(0.25)->setRight(0.25)->setTop(0.5)->setBottom(0.5);

        /* ---------- Download ---------- */
        $namaFile = 'Rekap_Penggunaan_Sarana_'.($tahun ? $tahun.'_' : '').date('Ymd').'.xlsx';

        return response()->streamDownload(function () use ($ss) {
            (new Xlsx($ss))->save('php://output');
        }, $namaFile, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }
}
