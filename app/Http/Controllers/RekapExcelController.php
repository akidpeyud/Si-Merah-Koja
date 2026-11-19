<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

class RekapExcelController extends Controller
{
    private array $kategoriObjek = [
        'objek_rumah' => 'Rumah',
        'objek_gudang' => 'Gudang',
        'objek_ruko' => 'Ruko',
        'objek_kantor' => 'Kantor',
        'objek_sekolah' => 'Sekolah',
        'objek_rumah_ibadah' => 'Rumah Ibadah',
        'objek_pasar' => 'Pasar / Tempat Usaha',
        'objek_kendaraan' => 'Kendaraan Bermotor',
        'objek_vital' => 'Objek Vital',
        'objek_sarana_kesehatan' => 'Sarana Kesehatan',
        'objek_lahan_pohon' => 'Lahan, Pohon',
        'objek_gardu_listrik' => 'Gardu Listrik',
        'objek_tpa_sampah' => 'Tempat Pembuangan Sampah',
    ];

    private array $kategoriLayanan = [
        'kebakaran' => 'Kebakaran',
        'evakuasi_hewan' => 'Evakuasi Hewan',
        'sarang_tawon' => 'Evakuasi Sarang Tawon',
        'evakuasi_manusia' => 'Evakuasi / Pertolongan',
        'pohon_tumbang' => 'Pohon Tumbang',
        'pencarian_air' => 'Pencarian di Perairan',
        'pelepasan_cincin' => 'Pelepasan Cincin',
        'layanan_lainnya' => 'Layanan Lainnya',
    ];

    public function export(Request $request): StreamedResponse
    {
        $type = $request->query('type', 'objek');
        $isObjek = $type === 'objek';
        $tahun = $request->filled('tahun') ? (int) $request->tahun : null;
        $bulan = ($request->filled('bulan') && (int) $request->bulan >= 1 && (int) $request->bulan <= 12) ? (int) $request->bulan : null;

        $daftarNamaBulan = [
            1 => 'JANUARI', 2 => 'FEBRUARI', 3 => 'MARET', 4 => 'APRIL',
            5 => 'MEI', 6 => 'JUNI', 7 => 'JULI', 8 => 'AGUSTUS',
            9 => 'SEPTEMBER', 10 => 'OKTOBER', 11 => 'NOVEMBER', 12 => 'DESEMBER',
        ];

        $kategoriMap = $isObjek ? $this->kategoriObjek : $this->kategoriLayanan;
        $keys = array_keys($kategoriMap);

        $query = DB::table('rekap_layanan')
            ->whereIn('kategori', $keys)
            ->orderBy('tanggal', 'asc')
            ->orderBy('id', 'asc');

        if ($tahun) {
            $query->whereYear('tanggal', $tahun);
        }
        if ($bulan) {
            $query->whereMonth('tanggal', $bulan);
        }

        $data = $query->get();

        $titleJudul = $isObjek
            ? 'REKAPITULASI OBJEK KEBAKARAN'
            : 'REKAPITULASI LAYANAN & PENYELAMATAN';

        $sheetTitle = $isObjek ? 'Rekap Objek Kebakaran' : 'Rekap Layanan';
        $colLabel = $isObjek ? 'Objek Terbakar' : 'Jenis Layanan';

        $spreadsheet = new Spreadsheet;
        $spreadsheet->getDefaultStyle()->getFont()->setName('Arial')->setSize(10);
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle(substr($sheetTitle, 0, 31));

        // Header Instansi (Kop)
        $sheet->mergeCells('A1:G1');
        $sheet->setCellValue('A1', 'PEMERINTAH KOTA JAMBI');
        $sheet->getStyle('A1')->applyFromArray([
            'font' => ['name' => 'Arial', 'bold' => true, 'size' => 12],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
        ]);

        $sheet->mergeCells('A2:G2');
        $sheet->setCellValue('A2', 'DINAS PEMADAM KEBAKARAN DAN PENYELAMATAN');
        $sheet->getStyle('A2')->applyFromArray([
            'font' => ['name' => 'Arial', 'bold' => true, 'size' => 14],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
        ]);

        $sheet->mergeCells('A3:G3');
        $sheet->setCellValue('A3', $titleJudul);
        $sheet->getStyle('A3')->applyFromArray([
            'font' => ['name' => 'Arial', 'bold' => true, 'size' => 12],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
        ]);

        $sheet->mergeCells('A4:G4');
        $periodeJudul = ($bulan ? ('BULAN '.$daftarNamaBulan[$bulan].' ') : '').($tahun ? ('TAHUN '.$tahun) : 'SEMUA DATA');
        $sheet->setCellValue('A4', 'PERIODE: '.$periodeJudul);
        $sheet->getStyle('A4')->applyFromArray([
            'font' => ['name' => 'Arial', 'bold' => true, 'italic' => true, 'size' => 11],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
        ]);

        $sheet->getRowDimension(1)->setRowHeight(20);
        $sheet->getRowDimension(2)->setRowHeight(24);
        $sheet->getRowDimension(3)->setRowHeight(22);
        $sheet->getRowDimension(4)->setRowHeight(20);
        $sheet->getRowDimension(5)->setRowHeight(10); // jeda kosong

        // Header Tabel (Baris 6) - Sesuai Kolom Tabel CRUD Web & Tanpa Warna Latar
        $headers = [
            ['key' => 'no',        'head' => 'No',             'w' => 6],
            ['key' => 'bulan',     'head' => 'Bulan',          'w' => 18],
            ['key' => 'kategori',  'head' => $colLabel,        'w' => 26],
            ['key' => 'jumlah',    'head' => 'Jumlah',         'w' => 12],
            ['key' => 'kecamatan', 'head' => 'Kecamatan',      'w' => 20],
            ['key' => 'lokasi',    'head' => 'Lokasi / Alamat', 'w' => 32],
            ['key' => 'keterangan', 'head' => 'Keterangan',     'w' => 30],
        ];
        $cols = ['A', 'B', 'C', 'D', 'E', 'F', 'G'];

        $rowIdx = 6;
        foreach ($headers as $i => $h) {
            $colLetter = $cols[$i];
            $sheet->setCellValue($colLetter.$rowIdx, $h['head']);
            $sheet->getColumnDimension($colLetter)->setWidth($h['w']);
        }

        $sheet->getStyle('A6:G6')->applyFromArray([
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
        $sheet->getRowDimension(6)->setRowHeight(36);

        // Data Rows (Baris 7 ke Bawah) - Tanpa Warna Latar
        $rowIdx = 7;
        $totalKejadian = 0;

        if ($data->isEmpty()) {
            $sheet->mergeCells('A7:G7');
            $periodeTeks = $bulan ? ('bulan '.$daftarNamaBulan[$bulan].' '.$tahun) : ($tahun ? ('pada tahun '.$tahun) : '');
            $sheet->setCellValue('A7', 'Belum ada data rekap '.$periodeTeks.'.');
            $sheet->getStyle('A7:G7')->applyFromArray([
                'font' => ['name' => 'Arial', 'italic' => true, 'size' => 10],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => '000000']]],
            ]);
            $sheet->getRowDimension(7)->setRowHeight(28);
            $lastRow = 7;
        } else {
            foreach ($data as $idx => $r) {
                $bulanStr = $r->tanggal ? Carbon::parse($r->tanggal)->locale('id')->translatedFormat('F Y') : '-';
                $sheet->setCellValue('A'.$rowIdx, $idx + 1);
                $sheet->setCellValue('B'.$rowIdx, $bulanStr);
                $sheet->setCellValue('C'.$rowIdx, $kategoriMap[$r->kategori] ?? $r->kategori);
                $sheet->setCellValue('D'.$rowIdx, (int) $r->jumlah);
                $sheet->setCellValue('E'.$rowIdx, $r->kecamatan ?: '-');
                $sheet->setCellValue('F'.$rowIdx, $r->lokasi ?: '-');
                $sheet->setCellValue('G'.$rowIdx, $r->keterangan ?: '-');

                $totalKejadian += (int) $r->jumlah;
                $sheet->getRowDimension($rowIdx)->setRowHeight(-1);
                $rowIdx++;
            }

            // Baris Total - Tanpa Warna Latar
            $sheet->mergeCells("A{$rowIdx}:C{$rowIdx}");
            $sheet->setCellValue("A{$rowIdx}", 'TOTAL KEJADIAN');
            $sheet->setCellValue("D{$rowIdx}", $totalKejadian);
            $sheet->setCellValue("E{$rowIdx}", '');
            $sheet->setCellValue("F{$rowIdx}", '');
            $sheet->setCellValue("G{$rowIdx}", '');

            $sheet->getStyle("A{$rowIdx}:G{$rowIdx}")->applyFromArray([
                'font' => ['name' => 'Arial', 'bold' => true, 'size' => 10],
                'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => '000000']]],
            ]);
            $sheet->getStyle("A{$rowIdx}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
            $sheet->getStyle("D{$rowIdx}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

            $lastRow = $rowIdx;

            // Borders & Alignments
            $sheet->getStyle("A7:G{$lastRow}")->applyFromArray([
                'font' => ['name' => 'Arial', 'size' => 10],
                'alignment' => ['vertical' => Alignment::VERTICAL_CENTER, 'wrapText' => true],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'],
                    ],
                ],
            ]);

            $sheet->getStyle("A7:B{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle("C7:C{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
            $sheet->getStyle("D7:E{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle("F7:G{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        }

        // Pengaturan Cetak
        $sheet->getPageSetup()
            ->setOrientation(PageSetup::ORIENTATION_LANDSCAPE)
            ->setPaperSize(PageSetup::PAPERSIZE_FOLIO)
            ->setFitToPage(true)
            ->setFitToWidth(1)
            ->setFitToHeight(0)
            ->setHorizontalCentered(true)
            ->setRowsToRepeatAtTopByStartAndEnd(6, 6)
            ->setPrintArea("A1:G{$lastRow}");
        $sheet->getPageMargins()->setLeft(0.25)->setRight(0.25)->setTop(0.4)->setBottom(0.4);

        $namaFile = $isObjek ? 'Rekap_Objek_Kebakaran' : 'Rekap_Layanan_Penyelamatan';
        if ($tahun) {
            $namaFile .= "_{$tahun}";
        }
        if ($bulan) {
            $namaFile .= sprintf('_%02d', $bulan);
        }
        $namaFile .= '.xlsx';

        return response()->streamDownload(function () use ($spreadsheet) {
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }, $namaFile, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Cache-Control' => 'max-age=0',
        ]);
    }
}
