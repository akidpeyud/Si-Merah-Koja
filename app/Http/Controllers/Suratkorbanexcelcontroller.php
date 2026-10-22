<?php

namespace App\Http\Controllers;

use App\Models\SuratKorban;
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
 * Cetak Excel: Rekapitulasi Surat Keterangan Kejadian (Surat Korban).
 *
 * URL: /internal/surat-korban/export-excel
 *      /internal/surat-korban/export-excel?tahun=2026
 *
 * Kolom dibaca otomatis dari tabel, jadi tidak perlu menyesuaikan nama field.
 * Filter tahun mengikuti "Tanggal Diterbitkan" (created_at).
 */
class SuratKorbanExcelController extends Controller
{
    /** Kolom tabel yang tidak ikut dicetak */
    private array $sembunyi = ['id', 'updated_at', 'deleted_at'];

    /** Kolom yang namanya mengandung kata ini dianggap berkas/foto dan tidak dicetak */
    private array $kataBerkas = [
        'foto', 'ktp', 'lampiran', 'berkas', 'file', 'gambar', 'upload', 'scan', 'path', 'dokumen',
    ];

    /** Judul kolom yang dibuat manual (sama dengan judul di tabel halaman) */
    private array $judulKolom = [
        'nomor_surat' => 'Nomor Surat',
        'nama_korban' => 'Nama Korban / Instansi',
        'created_at'  => 'Tanggal Diterbitkan',
    ];

    /** Lebar kolom khusus */
    private array $lebarKolom = [
        'nomor_surat' => 34,
        'nama_korban' => 30,
        'created_at'  => 22,
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

        $model = new SuratKorban();

        $query = SuratKorban::orderBy('created_at', 'desc');
        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }
        $data = $query->get();

        $kolomDb = array_values(array_diff(
            Schema::getColumnListing($model->getTable()),
            $this->sembunyi
        ));

        // Buang kolom berkas/foto
        $kolomDb = array_values(array_filter($kolomDb, function ($nama) use ($data) {
            return !$this->kolomBerkas($nama, $data);
        }));

        // Buang kolom ID (mis. user_id, id_korban)
        $kolomDb = array_values(array_filter($kolomDb, function ($nama) {
            return !preg_match('/(^id_|_id$)/i', $nama);
        }));

        // Urutan: nomor surat & nama korban di depan, tanggal diterbitkan di belakang
        $depan  = array_values(array_intersect(['nomor_surat', 'nama_korban'], $kolomDb));
        $akhir  = in_array('created_at', $kolomDb, true) ? ['created_at'] : [];
        $tengah = array_values(array_diff($kolomDb, $depan, $akhir));
        $kolomDb = array_merge($depan, $tengah, $akhir);

        /* ---------- Definisi kolom ---------- */
        $kolom = [['key' => 'no', 'head' => 'No', 'w' => 6]];
        foreach ($kolomDb as $nama) {
            $kolom[] = [
                'key'  => $nama,
                'head' => $this->judulKolom[$nama] ?? Str::headline($nama),
                'w'    => $this->lebarKolom[$nama] ?? 24,
            ];
        }

        foreach ($kolom as $i => &$k) {
            $k['huruf'] = Coordinate::stringFromColumnIndex($i + 1);
        }
        unset($k);
        $kolTerakhir = Coordinate::stringFromColumnIndex(count($kolom));

        /* ---------- Workbook ---------- */
        $ss = new Spreadsheet();
        $ss->getDefaultStyle()->getFont()->setName('Arial')->setSize(11);
        $ws = $ss->getActiveSheet();
        $ws->setTitle('SURAT KORBAN');

        foreach ($kolom as $k) {
            $ws->getColumnDimension($k['huruf'])->setWidth($k['w']);
        }

        // Judul
        $ws->mergeCells("A1:{$kolTerakhir}2");
        $ws->setCellValue('A1', 'REKAPITULASI SURAT KETERANGAN KEJADIAN' . ($tahun ? ' TAHUN ' . $tahun : ''));
        $ws->mergeCells("A3:{$kolTerakhir}3");
        $ws->setCellValue('A3', 'Dicetak pada: ' . Carbon::now()->locale('id')->translatedFormat('d F Y'));
        $ws->getStyle("A1:{$kolTerakhir}3")->applyFromArray([
            'font'      => ['name' => 'Arial', 'bold' => true, 'size' => 16],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_CENTER,
            ],
        ]);
        $ws->getStyle('A3')->getFont()->setSize(11)->setBold(false);

        // Header tabel (baris 5)
        foreach ($kolom as $k) {
            $ws->setCellValue($k['huruf'] . '5', $k['head']);
        }
        $ws->getStyle("A5:{$kolTerakhir}5")->applyFromArray([
            'font'      => ['name' => 'Arial', 'bold' => true, 'size' => 12, 'color' => ['argb' => 'FFFFFFFF']],
            'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FFB91C1C']],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_CENTER,
                'wrapText'   => true,
            ],
        ]);
        $ws->getRowDimension(5)->setRowHeight(32);

        /* ---------- Isi data ---------- */
        $r = 6;
        foreach ($data as $i => $row) {
            foreach ($kolom as $k) {
                $sel = $k['huruf'] . $r;

                if ($k['key'] === 'no') {
                    $ws->setCellValue($sel, $i + 1);
                    continue;
                }

                $v = $row->{$k['key']};

                if ($v instanceof \DateTimeInterface) {
                    $v = Carbon::instance($v)->locale('id')->translatedFormat('d F Y');
                } elseif (is_array($v) || is_object($v)) {
                    $v = json_encode($v, JSON_UNESCAPED_UNICODE);
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
                ? 'Belum ada surat keterangan korban pada tahun ' . $tahun . '.'
                : 'Belum ada surat keterangan korban yang diterbitkan.');
        }

        /* ---------- Gaya sel data ---------- */
        $ws->getStyle("A5:{$kolTerakhir}{$terakhir}")->getBorders()->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $ws->getStyle("A6:{$kolTerakhir}{$terakhir}")->applyFromArray([
            'font'      => ['name' => 'Arial', 'size' => 11],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical'   => Alignment::VERTICAL_CENTER,
                'wrapText'   => true,
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
        $namaFile = 'Rekap_Surat_Korban_' . ($tahun ? $tahun . '_' : '') . date('Ymd') . '.xlsx';

        return response()->streamDownload(function () use ($ss) {
            (new Xlsx($ss))->save('php://output');
        }, $namaFile, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }
}