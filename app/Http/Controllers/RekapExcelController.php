<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
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

        $kategoriMap = $isObjek ? $this->kategoriObjek : $this->kategoriLayanan;
        $keys = array_keys($kategoriMap);

        $query = DB::table('rekap_layanan')
            ->whereIn('kategori', $keys)
            ->orderBy('tanggal', 'desc')
            ->orderBy('id', 'desc');

        if ($tahun) {
            $query->whereYear('tanggal', $tahun);
        }

        $data = $query->get();

        $titleJudul = $isObjek
            ? 'REKAPITULASI OBJEK KEBAKARAN'
            : 'REKAPITULASI LAYANAN & PENYELAMATAN';

        $sheetTitle = $isObjek ? 'Rekap Objek Kebakaran' : 'Rekap Layanan';
        $colLabel = $isObjek ? 'Objek Terbakar' : 'Jenis Layanan';

        $spreadsheet = new Spreadsheet;
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle(substr($sheetTitle, 0, 31));

        // Header Instansi
        $sheet->mergeCells('A1:G1');
        $sheet->setCellValue('A1', 'PEMERINTAH KOTA JAMBI');
        $sheet->mergeCells('A2:G2');
        $sheet->setCellValue('A2', 'DINAS PEMADAM KEBAKARAN DAN PENYELAMATAN');
        $sheet->mergeCells('A3:G3');
        $sheet->setCellValue('A3', 'Jl. Hos. Cokroaminoto No. 113 Telp. 0741-41171 Kota Jambi');

        $sheet->mergeCells('A5:G5');
        $judulLengkap = $titleJudul.($tahun ? " TAHUN {$tahun}" : ' (SEMUA TAHUN)');
        $sheet->setCellValue('A5', $judulLengkap);

        $sheet->getStyle('A1:A3')->getFont()->setBold(true)->setSize(11);
        $sheet->getStyle('A2')->getFont()->setSize(13);
        $sheet->getStyle('A5')->getFont()->setBold(true)->setSize(12);
        $sheet->getStyle('A1:G5')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Header Tabel
        $headers = ['No', 'Tanggal Kejadian', $colLabel, 'Jumlah Kejadian', 'Kecamatan', 'Lokasi / Alamat', 'Keterangan'];
        $cols = ['A', 'B', 'C', 'D', 'E', 'F', 'G'];

        $rowIdx = 7;
        foreach ($headers as $i => $h) {
            $sheet->setCellValue($cols[$i].$rowIdx, $h);
        }

        $sheet->getStyle('A7:G7')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '163A63'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);
        $sheet->getRowDimension(7)->setRowHeight(26);

        // Data Rows
        $rowIdx = 8;
        $totalKejadian = 0;
        foreach ($data as $idx => $r) {
            $sheet->setCellValue('A'.$rowIdx, $idx + 1);
            $sheet->setCellValue('B'.$rowIdx, Carbon::parse($r->tanggal)->translatedFormat('d M Y'));
            $sheet->setCellValue('C'.$rowIdx, $kategoriMap[$r->kategori] ?? $r->kategori);
            $sheet->setCellValue('D'.$rowIdx, $r->jumlah);
            $sheet->setCellValue('E'.$rowIdx, $r->kecamatan ?: '-');
            $sheet->setCellValue('F'.$rowIdx, $r->lokasi ?: '-');
            $sheet->setCellValue('G'.$rowIdx, $r->keterangan ?: '-');

            $totalKejadian += (int) $r->jumlah;

            // Zebra color
            if ($idx % 2 === 1) {
                $sheet->getStyle("A{$rowIdx}:G{$rowIdx}")->getFill()->applyFromArray([
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F1F5F9'],
                ]);
            }

            $rowIdx++;
        }

        // Baris Total
        $sheet->mergeCells("A{$rowIdx}:C{$rowIdx}");
        $sheet->setCellValue("A{$rowIdx}", 'TOTAL KEJADIAN');
        $sheet->setCellValue("D{$rowIdx}", $totalKejadian);
        $sheet->setCellValue("E{$rowIdx}", '');
        $sheet->setCellValue("F{$rowIdx}", '');
        $sheet->setCellValue("G{$rowIdx}", '');

        $sheet->getStyle("A{$rowIdx}:G{$rowIdx}")->applyFromArray([
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'E2E8F0'],
            ],
        ]);
        $sheet->getStyle("A{$rowIdx}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle("D{$rowIdx}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Borders & Alignments
        $lastRow = $rowIdx;
        $sheet->getStyle("A7:G{$lastRow}")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'CBD5E1'],
                ],
            ],
        ]);

        $sheet->getStyle("A8:B{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("D8:D{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("E8:E{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Auto width
        foreach ($cols as $c) {
            $sheet->getColumnDimension($c)->setAutoSize(true);
        }

        $namaFile = $isObjek ? 'Rekap_Objek_Kebakaran' : 'Rekap_Layanan_Penyelamatan';
        if ($tahun) {
            $namaFile .= "_{$tahun}";
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
