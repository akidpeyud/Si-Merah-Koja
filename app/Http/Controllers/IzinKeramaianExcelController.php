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
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 * Cetak Excel: Rekapitulasi Permohonan Izin Keramaian (Pengamanan Event).
 * Menyesuaikan kolom resmi tabel Kelola Izin Keramaian di Bidang Pemadaman.
 *
 * URL: /internal/damtan/kelola-izin-keramaian/export-excel
 *      /internal/damtan/kelola-izin-keramaian/export-excel?tahun=2026&bulan=1
 */
class IzinKeramaianExcelController extends Controller
{
    private array $jenisLabel = [
        'hiburan' => 'Hiburan',
        'non_hiburan' => 'Non-Hiburan',
    ];

    public function __invoke(Request $request)
    {
        $tahun = $request->query('tahun');
        $tahun = (is_numeric($tahun) && strlen((string) $tahun) === 4) ? (int) $tahun : null;

        $bulan = $request->query('bulan');
        $bulan = (is_numeric($bulan) && (int) $bulan >= 1 && (int) $bulan <= 12) ? (int) $bulan : null;

        $daftarNamaBulan = [
            1 => 'JANUARI', 2 => 'FEBRUARI', 3 => 'MARET', 4 => 'APRIL',
            5 => 'MEI', 6 => 'JUNI', 7 => 'JULI', 8 => 'AGUSTUS',
            9 => 'SEPTEMBER', 10 => 'OKTOBER', 11 => 'NOVEMBER', 12 => 'DESEMBER',
        ];

        $query = IzinKeramaian::orderByRaw('COALESCE(tgl_pelaksanaan, created_at) ASC')->orderBy('id', 'asc');
        if ($tahun) {
            $query->whereYear('tgl_pelaksanaan', $tahun);
        }
        if ($bulan) {
            $query->whereMonth('tgl_pelaksanaan', $bulan);
        }
        $data = $query->get();

        /* ---------- 1. Definisi Kolom Resmi Sesuai Tabel Kelola Izin Keramaian ---------- */
        $kolom = [
            ['key' => 'no',                 'head' => 'No',                            'w' => 6,   'al' => 'c'],
            ['key' => 'nama',               'head' => 'Nama Pemohon',                  'w' => 24,  'al' => 'l'],
            ['key' => 'nik',                'head' => 'NIK',                           'w' => 20,  'al' => 'c', 'teks' => true],
            ['key' => 'no_hp',              'head' => 'No HP/WA',                      'w' => 18,  'al' => 'c', 'teks' => true],
            ['key' => 'alamat',             'head' => 'Alamat Lengkap',                'w' => 32,  'al' => 'l'],
            ['key' => 'nama_penanggung',    'head' => 'Nama Penanggung Jawab',         'w' => 24,  'al' => 'l'],
            ['key' => 'nama_usaha',         'head' => 'Nama Usaha / Instansi',         'w' => 26,  'al' => 'l'],
            ['key' => 'no_izin_usaha',      'head' => 'No. Izin Usaha / Surat Tugas',  'w' => 26,  'al' => 'c', 'teks' => true],
            ['key' => 'nama_acara',         'head' => 'Nama Acara',                    'w' => 28,  'al' => 'l'],
            ['key' => 'jenis_event',        'head' => 'Jenis Event',                   'w' => 16,  'al' => 'c'],
            ['key' => 'lokasi_acara',       'head' => 'Lokasi Acara',                  'w' => 30,  'al' => 'l'],
            ['key' => 'tgl_pelaksanaan',    'head' => 'Tanggal Pelaksanaan',           'w' => 20,  'al' => 'c'],
            ['key' => 'waktu_pelaksanaan',  'head' => 'Waktu Pelaksanaan',             'w' => 20,  'al' => 'c', 'teks' => true],
            ['key' => 'estimasi_penonton',  'head' => 'Estimasi Penonton',             'w' => 18,  'al' => 'c'],
            ['key' => 'status',             'head' => 'Status',                        'w' => 16,  'al' => 'c'],
        ];

        foreach ($kolom as $i => &$k) {
            $k['huruf'] = Coordinate::stringFromColumnIndex($i + 1);
        }
        unset($k);
        $kolTerakhir = Coordinate::stringFromColumnIndex(count($kolom));

        /* ---------- 2. Buat Workbook ---------- */
        $ss = new Spreadsheet;
        $ss->getDefaultStyle()->getFont()->setName('Arial')->setSize(10);
        $ws = $ss->getActiveSheet();
        $ws->setTitle('IZIN KERAMAIAN');

        foreach ($kolom as $k) {
            $ws->getColumnDimension($k['huruf'])->setWidth($k['w']);
        }

        // Kop Header
        $ws->mergeCells("A1:{$kolTerakhir}1");
        $ws->setCellValue('A1', 'PEMERINTAH KOTA JAMBI');
        $ws->getStyle('A1')->applyFromArray([
            'font' => ['name' => 'Arial', 'bold' => true, 'size' => 12],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
        ]);

        $ws->mergeCells("A2:{$kolTerakhir}2");
        $ws->setCellValue('A2', 'DINAS PEMADAM KEBAKARAN DAN PENYELAMATAN');
        $ws->getStyle('A2')->applyFromArray([
            'font' => ['name' => 'Arial', 'bold' => true, 'size' => 14],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
        ]);

        $ws->mergeCells("A3:{$kolTerakhir}3");
        $ws->setCellValue('A3', 'REKAPITULASI PERMOHONAN IZIN KERAMAIAN (PENGAMANAN EVENT)');
        $ws->getStyle('A3')->applyFromArray([
            'font' => ['name' => 'Arial', 'bold' => true, 'size' => 12],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
        ]);

        $ws->mergeCells("A4:{$kolTerakhir}4");
        $periodeJudul = ($bulan ? ('BULAN '.$daftarNamaBulan[$bulan].' ') : '').($tahun ? ('TAHUN '.$tahun) : 'SEMUA DATA');
        $ws->setCellValue('A4', 'PERIODE: '.$periodeJudul);
        $ws->getStyle('A4')->applyFromArray([
            'font' => ['name' => 'Arial', 'bold' => true, 'italic' => true, 'size' => 11],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
        ]);

        $ws->getRowDimension(1)->setRowHeight(20);
        $ws->getRowDimension(2)->setRowHeight(24);
        $ws->getRowDimension(3)->setRowHeight(22);
        $ws->getRowDimension(4)->setRowHeight(20);
        $ws->getRowDimension(5)->setRowHeight(10); // jeda kosong

        // Header Tabel (Baris 6) - Tanpa Warna Latar
        foreach ($kolom as $k) {
            $ws->setCellValue($k['huruf'].'6', $k['head']);
        }
        $ws->getStyle("A6:{$kolTerakhir}6")->applyFromArray([
            'font' => ['name' => 'Arial', 'bold' => true, 'size' => 10],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => '000000']],
            ],
        ]);
        $ws->getRowDimension(6)->setRowHeight(36);

        /* ---------- 3. Isi Data (Baris 7 ke Bawah) ---------- */
        $baris = 7;
        if ($data->isEmpty()) {
            $ws->mergeCells("A7:{$kolTerakhir}7");
            $periodeTeks = $bulan ? ('bulan '.$daftarNamaBulan[$bulan].' '.$tahun) : ($tahun ? ('pada tahun '.$tahun) : '');
            $ws->setCellValue('A7', 'Belum ada data permohonan izin keramaian '.$periodeTeks.'.');
            $ws->getStyle("A7:{$kolTerakhir}7")->applyFromArray([
                'font' => ['name' => 'Arial', 'italic' => true, 'size' => 10],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => '000000']]],
            ]);
            $ws->getRowDimension(7)->setRowHeight(28);
            $terakhir = 7;
        } else {
            foreach ($data as $i => $row) {
                $jenisEvent = $this->jenisLabel[$row->jenis_event] ?? ($row->jenis_event ? ucfirst(str_replace('_', ' ', $row->jenis_event)) : '-');

                $tglPelaksanaan = $row->tgl_pelaksanaan
                    ? Carbon::parse($row->tgl_pelaksanaan)->locale('id')->translatedFormat('d F Y')
                    : '-';

                $waktu = (! empty($row->waktu_mulai))
                    ? (substr((string) $row->waktu_mulai, 0, 5).' - '.substr((string) $row->waktu_selesai, 0, 5).' WIB')
                    : '-';

                $penonton = ($row->jumlah_penonton !== null && $row->jumlah_penonton !== '')
                    ? (number_format((float) $row->jumlah_penonton, 0, ',', '.').' Orang')
                    : '-';

                $barisData = [
                    'no' => $i + 1,
                    'nama' => $row->nama ?? '-',
                    'nik' => $row->nik ?? '-',
                    'no_hp' => $row->no_hp ?? '-',
                    'alamat' => $row->alamat ?? '-',
                    'nama_penanggung' => $row->nama_direktur ?? '-',
                    'nama_usaha' => $row->nama_usaha ?? '-',
                    'no_izin_usaha' => $row->no_izin_usaha ?? '-',
                    'nama_acara' => $row->nama_acara ?? '-',
                    'jenis_event' => $jenisEvent,
                    'lokasi_acara' => $row->lokasi_acara ?? '-',
                    'tgl_pelaksanaan' => $tglPelaksanaan,
                    'waktu_pelaksanaan' => $waktu,
                    'estimasi_penonton' => $penonton,
                    'status' => ucfirst($row->status_permohonan ?: 'Pending'),
                ];

                foreach ($kolom as $k) {
                    $sel = $k['huruf'].$baris;
                    $val = $barisData[$k['key']] ?? '-';

                    if (! empty($k['teks'])) {
                        $ws->setCellValueExplicit($sel, (string) $val, DataType::TYPE_STRING);
                    } else {
                        $ws->setCellValue($sel, $val);
                    }
                }

                $ws->getRowDimension($baris)->setRowHeight(-1);
                $baris++;
            }
            $terakhir = $baris - 1;

            // Border & Style Semua Sel Data
            $rentangData = "A7:{$kolTerakhir}{$terakhir}";
            $ws->getStyle($rentangData)->applyFromArray([
                'font' => ['name' => 'Arial', 'size' => 10],
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true,
                ],
                'borders' => [
                    'allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => '000000']],
                ],
            ]);

            // Set Alignment Rata Kiri atau Rata Tengah per Kolom
            foreach ($kolom as $k) {
                $align = ($k['al'] ?? 'c') === 'l' ? Alignment::HORIZONTAL_LEFT : Alignment::HORIZONTAL_CENTER;
                $ws->getStyle("{$k['huruf']}7:{$k['huruf']}{$terakhir}")->getAlignment()->setHorizontal($align);
            }
        }

        /* ---------- 4. Pengaturan Cetak ---------- */
        $ws->getPageSetup()
            ->setOrientation(PageSetup::ORIENTATION_LANDSCAPE)
            ->setPaperSize(PageSetup::PAPERSIZE_FOLIO)
            ->setFitToPage(true)
            ->setFitToWidth(1)
            ->setFitToHeight(0)
            ->setHorizontalCentered(true)
            ->setRowsToRepeatAtTopByStartAndEnd(6, 6)
            ->setPrintArea("A1:{$kolTerakhir}{$terakhir}");
        $ws->getPageMargins()->setLeft(0.25)->setRight(0.25)->setTop(0.4)->setBottom(0.4);

        /* ---------- 5. Download ---------- */
        $bulanPart = $bulan ? sprintf('%02d_', $bulan) : '';
        $namaFile = 'Rekap_Izin_Keramaian_'.($tahun ? $tahun.'_' : '').$bulanPart.date('Ymd').'.xlsx';

        return response()->streamDownload(function () use ($ss) {
            (new Xlsx($ss))->save('php://output');
        }, $namaFile, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }
}
