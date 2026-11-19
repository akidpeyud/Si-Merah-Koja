<?php

namespace App\Http\Controllers;

use App\Models\SuratKorban;
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
 * Cetak Excel: Rekapitulasi Surat Keterangan Kejadian (Surat Korban).
 * Menyesuaikan kolom resmi tabel Kelola Surat Korban di Bidang Pemadaman.
 *
 * URL: /internal/surat-korban/export-excel
 *      /internal/surat-korban/export-excel?tahun=2026&bulan=10
 */
class SuratKorbanExcelController extends Controller
{
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

        $query = SuratKorban::orderByRaw('COALESCE(tanggal_surat, created_at) ASC')->orderBy('id', 'asc');
        if ($tahun && $bulan) {
            $awal = Carbon::create($tahun, $bulan, 1)->startOfMonth();
            $akhir = Carbon::create($tahun, $bulan, 1)->endOfMonth();

            $query->where(function ($q) use ($awal, $akhir) {
                $q->whereBetween('tanggal_surat', [$awal, $akhir])
                    ->orWhere(function ($q2) use ($awal, $akhir) {
                        $q2->whereNull('tanggal_surat')->whereBetween('created_at', [$awal, $akhir]);
                    });
            });
        } elseif ($tahun) {
            $awal = Carbon::create($tahun, 1, 1)->startOfDay();
            $akhir = Carbon::create($tahun, 12, 31)->endOfDay();

            $query->where(function ($q) use ($awal, $akhir) {
                $q->whereBetween('tanggal_surat', [$awal, $akhir])
                    ->orWhere(function ($q2) use ($awal, $akhir) {
                        $q2->whereNull('tanggal_surat')->whereBetween('created_at', [$awal, $akhir]);
                    });
            });
        } elseif ($bulan) {
            $query->where(function ($q) use ($bulan) {
                $q->whereMonth('tanggal_surat', $bulan)
                    ->orWhere(function ($q2) use ($bulan) {
                        $q2->whereNull('tanggal_surat')->whereMonth('created_at', $bulan);
                    });
            });
        }
        $data = $query->get();

        /* ---------- 1. Kolom Resmi Sesuai Tabel Kelola Surat Korban ---------- */
        $kolom = [
            ['key' => 'no',                   'head' => 'No',                    'w' => 6,   'al' => 'c'],
            ['key' => 'nomor_surat',          'head' => 'No Surat',              'w' => 26,  'al' => 'c', 'teks' => true],
            ['key' => 'tanggal_surat',        'head' => 'Tgl. Surat',            'w' => 18,  'al' => 'c'],
            ['key' => 'nama_korban',          'head' => 'Nama',                  'w' => 26,  'al' => 'l'],
            ['key' => 'ttl',                  'head' => 'Tempat Tgl Lahir',      'w' => 25,  'al' => 'l'],
            ['key' => 'nik',                  'head' => 'NIK',                   'w' => 20,  'al' => 'c', 'teks' => true],
            ['key' => 'alamat',               'head' => 'Alamat',                'w' => 32,  'al' => 'l'],
            ['key' => 'status_kepemilikan',   'head' => 'Status Kepemilikan',    'w' => 20,  'al' => 'c'],
            ['key' => 'status_perkawinan',    'head' => 'Status Perkawinan',     'w' => 18,  'al' => 'c'],
            ['key' => 'pekerjaan',            'head' => 'Pekerjaan',             'w' => 22,  'al' => 'l'],
            ['key' => 'tanggal_kejadian',     'head' => 'Tgl Kejadian',          'w' => 24,  'al' => 'c'],
            ['key' => 'lokasi_kejadian',      'head' => 'Lokasi Kejadian',       'w' => 30,  'al' => 'l'],
            ['key' => 'satuan_tugas_operasi', 'head' => 'Satuan Tugas Operasi',  'w' => 26,  'al' => 'l'],
        ];

        foreach ($kolom as $i => &$k) {
            $k['huruf'] = Coordinate::stringFromColumnIndex($i + 1);
        }
        unset($k);
        $kolTerakhir = Coordinate::stringFromColumnIndex(count($kolom));

        /* ---------- 2. Buat Spreadsheet ---------- */
        $ss = new Spreadsheet;
        $ss->getDefaultStyle()->getFont()->setName('Arial')->setSize(10);
        $ws = $ss->getActiveSheet();
        $ws->setTitle('SURAT KORBAN');

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
        $ws->setCellValue('A3', 'REKAPITULASI SURAT KETERANGAN KEJADIAN KEBAKARAN');
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
            $ws->setCellValue('A7', 'Belum ada data surat keterangan korban '.$periodeTeks.'.');
            $ws->getStyle("A7:{$kolTerakhir}7")->applyFromArray([
                'font' => ['name' => 'Arial', 'italic' => true, 'size' => 10],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => '000000']]],
            ]);
            $ws->getRowDimension(7)->setRowHeight(28);
            $terakhir = 7;
        } else {
            foreach ($data as $i => $row) {
                $tglSuratRaw = ! empty($row->tanggal_surat) ? $row->tanggal_surat : $row->created_at;
                $tglSuratTampil = $tglSuratRaw ? Carbon::parse($tglSuratRaw)->locale('id')->translatedFormat('d F Y') : '-';

                $ttl = trim(($row->tempat_lahir ?? '').(! empty($row->tanggal_lahir) ? ', '.Carbon::parse($row->tanggal_lahir)->locale('id')->translatedFormat('d F Y') : '')) ?: '-';

                $tglKejadianTampil = trim((! empty($row->hari_kejadian) ? $row->hari_kejadian.', ' : '').(! empty($row->tanggal_kejadian) ? Carbon::parse($row->tanggal_kejadian)->locale('id')->translatedFormat('d F Y') : '')) ?: '-';

                $lokasiKejadianTampil = $row->alamat ?? ($row->objek_terbakar ?? '-');
                $satgasTampil = $row->satuan_tugas_operasi ?? ($row->satuan_tugas ?? '-');

                $barisData = [
                    'no' => $i + 1,
                    'nomor_surat' => $row->nomor_surat ?? '-',
                    'tanggal_surat' => $tglSuratTampil,
                    'nama_korban' => $row->nama_korban ?? '-',
                    'ttl' => $ttl,
                    'nik' => $row->nik ?? '-',
                    'alamat' => $row->alamat ?? '-',
                    'status_kepemilikan' => ucwords(strtolower($row->status_kepemilikan ?? '-')),
                    'status_perkawinan' => ucwords(strtolower($row->status_perkawinan ?? '-')),
                    'pekerjaan' => ucwords(strtolower($row->pekerjaan ?? '-')),
                    'tanggal_kejadian' => $tglKejadianTampil,
                    'lokasi_kejadian' => $lokasiKejadianTampil,
                    'satuan_tugas_operasi' => $satgasTampil,
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
        $namaFile = 'Rekap_Surat_Korban_'.($tahun ? $tahun.'_' : '').$bulanPart.date('Ymd').'.xlsx';

        return response()->streamDownload(function () use ($ss) {
            (new Xlsx($ss))->save('php://output');
        }, $namaFile, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }
}
