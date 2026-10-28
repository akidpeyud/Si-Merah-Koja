<?php

namespace App\Http\Controllers;

use App\Models\IzinKeramaian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 * Cetak Excel: Rekapitulasi Permohonan Izin Keramaian.
 *
 * URL: /internal/damtan/kelola-izin-keramaian/export-excel
 *      /internal/damtan/kelola-izin-keramaian/export-excel?tahun=2026
 *
 * Filter tahun mengikuti kolom "Tgl Acara" (tgl_pelaksanaan).
 */
class IzinKeramaianExcelController extends Controller
{
    private array $jenisLabel = [
        'hiburan' => 'Hiburan',
        'non_hiburan' => 'Non-Hiburan',
    ];

    public function __invoke(Request $request)
    {
        // Tahun opsional (?tahun=2026). Nilai selain 4 digit angka diabaikan = semua tahun.
        $tahun = $request->query('tahun');
        $tahun = (is_numeric($tahun) && strlen((string) $tahun) === 4) ? (int) $tahun : null;

        $query = IzinKeramaian::orderBy('created_at', 'desc');
        if ($tahun) {
            $query->whereYear('tgl_pelaksanaan', $tahun);
        }
        $data = $query->get();

        /* ---------- Definisi kolom ---------- */
        // key: kunci data | head: judul kolom | w: lebar | al: 'l' = rata kiri | teks: paksa tipe teks
        $kolom = [
            ['key' => 'no',              'head' => 'No',                 'w' => 5],
            ['key' => 'nama',            'head' => 'Nama Pemohon',       'w' => 24, 'al' => 'l'],
            ['key' => 'nik',             'head' => 'NIK',                'w' => 20, 'teks' => true],
            ['key' => 'no_hp',           'head' => 'No. HP / WA',        'w' => 17, 'teks' => true],
            ['key' => 'alamat',          'head' => 'Alamat',             'w' => 32, 'al' => 'l'],
            ['key' => 'nama_direktur',   'head' => 'Nama Direktur',      'w' => 22, 'al' => 'l'],
            ['key' => 'nama_usaha',      'head' => 'Usaha / Instansi',   'w' => 26, 'al' => 'l'],
            ['key' => 'no_izin_usaha',   'head' => 'No. Izin Usaha',     'w' => 22, 'teks' => true],
            ['key' => 'nama_acara',      'head' => 'Nama Acara',         'w' => 28, 'al' => 'l'],
            ['key' => 'jenis_event',     'head' => 'Jenis Event',        'w' => 15],
            ['key' => 'lokasi_acara',    'head' => 'Lokasi Acara',       'w' => 30, 'al' => 'l'],
            ['key' => 'tanggal',         'head' => 'Tanggal Acara',      'w' => 18],
            ['key' => 'waktu',           'head' => 'Waktu',              'w' => 16, 'teks' => true],
            ['key' => 'jumlah_penonton', 'head' => 'Jumlah Penonton',    'w' => 14],
            ['key' => 'jumlah_apar',     'head' => 'Jumlah APAR',        'w' => 12],
            ['key' => 'jumlah_staff',    'head' => 'Jumlah Staff',       'w' => 12],
            ['key' => 'status',          'head' => 'Status',             'w' => 14],
            ['key' => 'diajukan',        'head' => 'Tgl Pengajuan',      'w' => 18],
        ];

        foreach ($kolom as $i => &$k) {
            $k['huruf'] = Coordinate::stringFromColumnIndex($i + 1);
        }
        unset($k);
        $kolTerakhir = Coordinate::stringFromColumnIndex(count($kolom));

        /* ---------- Workbook ---------- */
        $ss = new Spreadsheet;
        $ss->getDefaultStyle()->getFont()->setName('Arial')->setSize(11);
        $ws = $ss->getActiveSheet();
        $ws->setTitle('IZIN KERAMAIAN');

        foreach ($kolom as $k) {
            $ws->getColumnDimension($k['huruf'])->setWidth($k['w']);
        }

        // Judul
        $ws->mergeCells("A1:{$kolTerakhir}2");
        $ws->setCellValue('A1', 'REKAPITULASI PERMOHONAN IZIN KERAMAIAN'.($tahun ? ' TAHUN '.$tahun : ''));
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
            $nilai = [
                'no' => $i + 1,
                'nama' => $row->nama,
                'nik' => $row->nik,
                'no_hp' => $row->no_hp,
                'alamat' => $row->alamat,
                'nama_direktur' => $row->nama_direktur,
                'nama_usaha' => $row->nama_usaha,
                'no_izin_usaha' => $row->no_izin_usaha,
                'nama_acara' => $row->nama_acara,
                'jenis_event' => $this->jenisLabel[$row->jenis_event]
                                        ?? ($row->jenis_event ? ucfirst(str_replace('_', ' ', $row->jenis_event)) : '-'),
                'lokasi_acara' => $row->lokasi_acara,
                'tanggal' => $row->tgl_pelaksanaan
                                        ? Carbon::parse($row->tgl_pelaksanaan)->locale('id')->translatedFormat('d F Y')
                                        : '-',
                'waktu' => substr((string) $row->waktu_mulai, 0, 5).' - '.substr((string) $row->waktu_selesai, 0, 5),
                'jumlah_penonton' => $row->jumlah_penonton,
                'jumlah_apar' => $row->jumlah_apar,
                'jumlah_staff' => $row->jumlah_staff,
                'status' => $row->status_permohonan ?: 'Pending',
                'diajukan' => $row->created_at
                                        ? $row->created_at->copy()->locale('id')->translatedFormat('d F Y')
                                        : '-',
            ];

            foreach ($kolom as $k) {
                $sel = $k['huruf'].$r;
                $v = $nilai[$k['key']] ?? '-';

                if (! empty($k['teks'])) {
                    // NIK, No HP, dsb. disimpan sebagai teks agar angka 0 di depan tidak hilang
                    $ws->setCellValueExplicit($sel, (string) $v, DataType::TYPE_STRING);
                } else {
                    $ws->setCellValue($sel, $v);
                }
            }
            $r++;
        }

        $terakhir = max(6, $r - 1);

        if ($data->isEmpty()) {
            $ws->mergeCells("A6:{$kolTerakhir}6");
            $ws->setCellValue('A6', $tahun
                ? 'Belum ada data pengajuan Izin Keramaian pada tahun '.$tahun.'.'
                : 'Belum ada data pengajuan Izin Keramaian.');
        }

        /* ---------- Gaya sel data ---------- */
        $ws->getStyle("A5:{$kolTerakhir}{$terakhir}")->getBorders()->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $ws->getStyle("A6:{$kolTerakhir}{$terakhir}")->applyFromArray([
            'font' => ['name' => 'Arial', 'size' => 11],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
        ]);

        foreach ($kolom as $k) {
            if (($k['al'] ?? 'c') === 'l') {
                $ws->getStyle("{$k['huruf']}6:{$k['huruf']}{$terakhir}")->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_LEFT);
            }
        }

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
        $namaFile = 'Rekap_Izin_Keramaian_'.($tahun ? $tahun.'_' : '').date('Ymd').'.xlsx';

        return response()->streamDownload(function () use ($ss) {
            (new Xlsx($ss))->save('php://output');
        }, $namaFile, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }
}
