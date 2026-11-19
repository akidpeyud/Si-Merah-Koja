<?php

namespace App\Http\Controllers;

use App\Models\LaporanPenyelamatan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 * Controller untuk mengekspor Laporan Operasional Kebakaran & Non-Kebakaran ke format Excel (.xlsx)
 * Menyesuaikan 22 kolom tabel resmi yang ada di Data Laporan (Bidang Pemadaman).
 *
 * URL: /internal/damtan/export-excel?tahun=2026&bulan=10&kategori=kebakaran
 *      /internal/damtan/export-excel?tahun=2026&kategori=non-kebakaran
 */
class LaporanExcelController extends Controller
{
    private array $mapMedia = [
        'call_center_112' => 'Call Center 112',
        'operator_layanan' => 'Operator Layanan Damkar',
        'telepon' => 'Telfon Damkar',
        'dijemput' => 'Dijemput',
        'whatsapp' => 'WhatsApp Damkar',
        'langsung' => 'Datang Langsung',
        'instansi_lain' => 'Instansi Lain',
    ];

    private array $mapPenyebab = [
        'arus_pendek' => 'Arus pendek listrik',
        'kebocoran_gas' => 'Kebocoran gas',
        'sambaran_petir' => 'Sambaran petir',
        'kelalaian_manusia' => 'Kelalaian manusia',
        'faktor_alam' => 'Faktor alam',
    ];

    public function __invoke(Request $request)
    {
        $tahun = (int) $request->query('tahun', date('Y'));
        if ($tahun < 2000 || $tahun > (int) date('Y') + 1) {
            $tahun = (int) date('Y');
        }

        $bulan = $request->query('bulan');
        $bulan = (is_numeric($bulan) && (int) $bulan >= 1 && (int) $bulan <= 12) ? (int) $bulan : null;

        $daftarNamaBulan = [
            1 => 'JANUARI', 2 => 'FEBRUARI', 3 => 'MARET', 4 => 'APRIL',
            5 => 'MEI', 6 => 'JUNI', 7 => 'JULI', 8 => 'AGUSTUS',
            9 => 'SEPTEMBER', 10 => 'OKTOBER', 11 => 'NOVEMBER', 12 => 'DESEMBER',
        ];

        $kategori = strtolower((string) $request->query('kategori', 'kebakaran'));
        if (! in_array($kategori, ['kebakaran', 'non-kebakaran'], true)) {
            $kategori = 'kebakaran';
        }
        $isKebakaran = $kategori === 'kebakaran';

        /* ---------- 1. Ambil Data dari Database (Lengkap dengan Relasi Teknis & Dokumentasi) ---------- */
        $query = LaporanPenyelamatan::leftJoin('lp_teknis_logistiks', 'laporan_penyelamatans.id', '=', 'lp_teknis_logistiks.laporan_id')
            ->leftJoin('lp_dokumentasis', 'laporan_penyelamatans.id', '=', 'lp_dokumentasis.laporan_id')
            ->leftJoin('lp_kategori_khusus', 'laporan_penyelamatans.id', '=', 'lp_kategori_khusus.laporan_id')
            ->select(
                'laporan_penyelamatans.*',
                DB::raw('COALESCE(lp_teknis_logistiks.nama_korban, laporan_penyelamatans.nama_korban) as nama_korban'),
                DB::raw('COALESCE(lp_teknis_logistiks.jumlah_jiwa, laporan_penyelamatans.jumlah_jiwa, 0) as jumlah_jiwa'),
                DB::raw('COALESCE(lp_teknis_logistiks.warga_terdampak, laporan_penyelamatans.warga_terdampak, 0) as warga_terdampak'),
                DB::raw('COALESCE(lp_teknis_logistiks.korban_meninggal, laporan_penyelamatans.korban_meninggal, 0) as korban_meninggal'),
                DB::raw('COALESCE(lp_teknis_logistiks.korban_berat, laporan_penyelamatans.korban_berat, 0) as korban_berat'),
                DB::raw('COALESCE(lp_teknis_logistiks.korban_ringan, laporan_penyelamatans.korban_ringan, 0) as korban_ringan'),
                DB::raw('COALESCE(lp_teknis_logistiks.hambatan_lapangan, laporan_penyelamatans.hambatan_lapangan) as hambatan_lapangan'),
                DB::raw('COALESCE(lp_teknis_logistiks.armada, laporan_penyelamatans.armada) as armada'),
                DB::raw('COALESCE(lp_teknis_logistiks.liter_air, laporan_penyelamatans.liter_air, 0) as liter_air'),
                DB::raw('COALESCE(lp_teknis_logistiks.liter_foam, laporan_penyelamatans.liter_foam, 0) as liter_foam'),
                DB::raw('COALESCE(lp_teknis_logistiks.jumlah_personel, laporan_penyelamatans.jumlah_personel, 0) as jumlah_personel'),
                DB::raw('COALESCE(lp_dokumentasis.dugaan_penyebab, laporan_penyelamatans.dugaan_penyebab) as dugaan_penyebab'),
                DB::raw('COALESCE(lp_dokumentasis.dugaan_penyebab_lainnya, laporan_penyelamatans.dugaan_penyebab_lainnya) as dugaan_penyebab_lainnya'),
                DB::raw('COALESCE(lp_dokumentasis.kronologi_lengkap, laporan_penyelamatans.kronologi_lengkap) as kronologi_lengkap'),
                'lp_teknis_logistiks.pimpinan_operasi',
                'lp_teknis_logistiks.pendamping_operasi',
                'lp_teknis_logistiks.satuan_tugas',
                'lp_teknis_logistiks.tim_respontime',
                'lp_teknis_logistiks.peralatan',
                'lp_teknis_logistiks.peralatan_lain',
                'lp_dokumentasis.instansi_pendukung',
                'lp_dokumentasis.tindakan_instansi'
            );

        if ($isKebakaran) {
            $query->where('laporan_penyelamatans.kategori_kejadian', 'kebakaran');
        } else {
            $query->where('laporan_penyelamatans.kategori_kejadian', '!=', 'kebakaran');
        }

        if ($tahun) {
            $query->whereYear(DB::raw('COALESCE(laporan_penyelamatans.tanggal_kejadian, laporan_penyelamatans.created_at)'), $tahun);
        }
        if ($bulan) {
            $query->whereMonth(DB::raw('COALESCE(laporan_penyelamatans.tanggal_kejadian, laporan_penyelamatans.created_at)'), $bulan);
        }

        $items = $query->orderBy(DB::raw('COALESCE(laporan_penyelamatans.tanggal_kejadian, laporan_penyelamatans.created_at)'), 'asc')
            ->orderBy(DB::raw('COALESCE(laporan_penyelamatans.waktu_terima, laporan_penyelamatans.waktu_kejadian)'), 'asc')
            ->orderBy('laporan_penyelamatans.id', 'asc')
            ->get();

        /* ---------- 2. Susun 22 Kolom Sesuai Tabel Data Laporan ---------- */
        $kolom = $this->kolom($isKebakaran);
        $totalKolom = count($kolom);
        $kolTerakhir = Coordinate::stringFromColumnIndex($totalKolom);

        /* ---------- 3. Buat Workbook Spreadsheet ---------- */
        $ss = new Spreadsheet;
        $ss->getDefaultStyle()->getFont()->setName('Arial')->setSize(10);
        $ws = $ss->getActiveSheet();
        $ws->setTitle($isKebakaran ? 'KEBAKARAN' : 'NON_KEBAKARAN');

        // Set lebar kolom
        foreach ($kolom as $idx => $k) {
            $huruf = Coordinate::stringFromColumnIndex($idx + 1);
            $ws->getColumnDimension($huruf)->setWidth($k['w']);
        }

        // Kop Header Laporan
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
        $ws->setCellValue('A3', $isKebakaran ? 'REKAPITULASI LAPORAN KEJADIAN KEBAKARAN' : 'REKAPITULASI LAPORAN OPERASI PENYELAMATAN & NON-KEBAKARAN');
        $ws->getStyle('A3')->applyFromArray([
            'font' => ['name' => 'Arial', 'bold' => true, 'size' => 12],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
        ]);

        $ws->mergeCells("A4:{$kolTerakhir}4");
        $teksPeriode = $bulan ? ('BULAN '.$daftarNamaBulan[$bulan].' TAHUN '.$tahun) : ('PERIODE TAHUN '.$tahun);
        $ws->setCellValue('A4', $teksPeriode);
        $ws->getStyle('A4')->applyFromArray([
            'font' => ['name' => 'Arial', 'bold' => true, 'italic' => true, 'size' => 11],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
        ]);

        $ws->getRowDimension(1)->setRowHeight(20);
        $ws->getRowDimension(2)->setRowHeight(24);
        $ws->getRowDimension(3)->setRowHeight(22);
        $ws->getRowDimension(4)->setRowHeight(20);
        $ws->getRowDimension(5)->setRowHeight(10); // baris jeda kosong

        // Header Tabel (Baris 6)
        foreach ($kolom as $idx => $k) {
            $huruf = Coordinate::stringFromColumnIndex($idx + 1);
            $ws->setCellValue("{$huruf}6", $k['head']);
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
        $ws->getRowDimension(6)->setRowHeight(38);

        /* ---------- 4. Tulis Data (Baris 7 ke Bawah) ---------- */
        $baris = 7;
        $no = 1;

        if ($items->isEmpty()) {
            $ws->mergeCells("A7:{$kolTerakhir}7");
            $periodeTeks = $bulan ? ('bulan '.$daftarNamaBulan[$bulan].' '.$tahun) : ('pada tahun '.$tahun);
            $ws->setCellValue('A7', 'Belum ada data laporan '.($isKebakaran ? 'kebakaran' : 'penyelamatan/non-kebakaran').' '.$periodeTeks.'.');
            $ws->getStyle("A7:{$kolTerakhir}7")->applyFromArray([
                'font' => ['name' => 'Arial', 'italic' => true, 'size' => 11],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
            ]);
            $ws->getRowDimension(7)->setRowHeight(30);
            $terakhir = 7;
        } else {
            foreach ($items as $row) {
                $dataBaris = $this->ekstrakBaris($row, $no++, $isKebakaran);

                foreach ($kolom as $idx => $k) {
                    $huruf = Coordinate::stringFromColumnIndex($idx + 1);
                    $val = $dataBaris[$k['key']] ?? '-';

                    if (in_array($k['key'], ['waktu_terima', 'waktu_tiba', 'telepon'], true)) {
                        $ws->setCellValueExplicit("{$huruf}{$baris}", (string) $val, DataType::TYPE_STRING);
                    } else {
                        $ws->setCellValue("{$huruf}{$baris}", $val);
                    }
                }

                $ws->getRowDimension($baris)->setRowHeight(-1); // auto-fit tinggi baris
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
            foreach ($kolom as $idx => $k) {
                $huruf = Coordinate::stringFromColumnIndex($idx + 1);
                $align = ($k['al'] ?? 'c') === 'l' ? Alignment::HORIZONTAL_LEFT : Alignment::HORIZONTAL_CENTER;
                $ws->getStyle("{$huruf}7:{$huruf}{$terakhir}")->getAlignment()->setHorizontal($align);
            }
        }

        /* ---------- 5. Pengaturan Cetak Halaman (Page Setup) ---------- */
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

        /* ---------- 6. Download File Excel ---------- */
        $bulanPart = $bulan ? ($daftarNamaBulan[$bulan].'_') : '';
        $namaFile = ($isKebakaran ? 'Laporan_Kebakaran_' : 'Laporan_Non_Kebakaran_').$bulanPart.$tahun.'.xlsx';

        return response()->streamDownload(function () use ($ss) {
            (new Xlsx($ss))->save('php://output');
        }, $namaFile, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }

    /**
     * Definisi 22 Kolom Resmi Sesuai Tampilan Tabel Web Data Laporan
     */
    private function kolom(bool $isKebakaran): array
    {
        return [
            ['key' => 'no',            'head' => 'No',                                                                  'w' => 6,   'al' => 'c'],
            ['key' => 'hari_tanggal',  'head' => 'Hari dan Tanggal',                                                    'w' => 26,  'al' => 'c'],
            ['key' => 'media',         'head' => 'Laporan Diterima Melalui',                                            'w' => 24,  'al' => 'c'],
            ['key' => 'waktu_terima',  'head' => 'Waktu Laporan Diterima',                                              'w' => 18,  'al' => 'c'],
            ['key' => 'waktu_tiba',    'head' => 'Waktu Tiba di Lokasi',                                                'w' => 18,  'al' => 'c'],
            ['key' => 'jarak',         'head' => 'Jarak Tempuh',                                                        'w' => 14,  'al' => 'c'],
            ['key' => 'respon',        'head' => 'Respon Time',                                                         'w' => 14,  'al' => 'c'],
            ['key' => 'pelapor',       'head' => 'Nama Pelapor',                                                        'w' => 24,  'al' => 'l'],
            ['key' => 'telepon',       'head' => 'No. Tlp Pelapor',                                                     'w' => 18,  'al' => 'c'],
            ['key' => 'objek',         'head' => $isKebakaran ? 'Objek Kebakaran' : 'Objek Penyelamatan',               'w' => 26,  'al' => 'l'],
            ['key' => 'lokasi',        'head' => 'Lokasi Kejadian',                                                     'w' => 32,  'al' => 'l'],
            ['key' => 'nama_korban',   'head' => 'Nama Korban / KK',                                                    'w' => 24,  'al' => 'l'],
            ['key' => 'jiwa',          'head' => 'Jumlah yang Terdampak (Jiwa)',                                        'w' => 18,  'al' => 'c'],
            ['key' => 'korban_status', 'head' => "Petugas atau Warga\n(Meninggal atau Cidera)",                         'w' => 22,  'al' => 'c'],
            ['key' => 'pimpinan',      'head' => 'Pimpinan Operasi',                                                    'w' => 24,  'al' => 'l'],
            ['key' => 'satgas',        'head' => 'Satuan Tugas',                                                        'w' => 26,  'al' => 'l'],
            ['key' => 'personil',      'head' => 'Jumlah Personil',                                                     'w' => 16,  'al' => 'c'],
            ['key' => 'lama_operasi',  'head' => 'Lama Operasi',                                                        'w' => 18,  'al' => 'c'],
            ['key' => 'uraian',        'head' => $isKebakaran ? 'Penyebab Kebakaran' : 'Kronologi Penyelamatan',       'w' => 35,  'al' => 'l'],
            ['key' => 'hambatan',      'head' => 'Hambatan',                                                            'w' => 22,  'al' => 'l'],
            ['key' => 'sarana',        'head' => 'Sarana yang Digunakan',                                               'w' => 28,  'al' => 'l'],
            ['key' => 'tim_quick',     'head' => "Tim Quick Respon\nPemadam Kebakaran",                                 'w' => 26,  'al' => 'l'],
        ];
    }

    /**
     * Ekstrak data model menjadi 22 kolom siap cetak.
     */
    private function ekstrakBaris($row, int $no, bool $isKebakaran): array
    {
        $a = $row->getAttributes();

        // 2. Hari dan Tanggal
        $tglRaw = $a['tanggal_kejadian'] ?? $a['created_at'] ?? null;
        $hariTxt = ! empty($a['hari_kejadian']) ? ucfirst($a['hari_kejadian']) : ($tglRaw ? Carbon::parse($tglRaw)->locale('id')->isoFormat('dddd') : '-');
        $tglTxt = $tglRaw ? Carbon::parse($tglRaw)->locale('id')->translatedFormat('d F Y') : '-';
        $hariTanggalTampil = ($hariTxt !== '-' && $tglTxt !== '-') ? $hariTxt.', '.$tglTxt : ($tglTxt !== '-' ? $tglTxt : '-');

        // 3. Media Pelaporan
        $mediaRaw = $a['media_pelaporan'] ?? '';
        $mediaPelaporanTampil = $this->mapMedia[$mediaRaw] ?? ($mediaRaw ? ucwords(str_replace('_', ' ', $mediaRaw)) : '-');

        // 4. Waktu Laporan Diterima
        $waktuTerimaRaw = $a['waktu_terima'] ?? $a['waktu_kejadian'] ?? null;
        $waktuTerimaTampil = $waktuTerimaRaw ? Carbon::parse($waktuTerimaRaw)->format('H.i').' WIB' : '-';

        // 5. Waktu Tiba di Lokasi
        $waktuTibaRaw = $a['waktu_tiba'] ?? null;
        $waktuTibaTampil = $waktuTibaRaw ? Carbon::parse($waktuTibaRaw)->format('H.i').' WIB' : '-';

        // 6. Jarak Tempuh
        $jarakRaw = $a['jarak_tempuh'] ?? null;
        $jarakTampil = '-';
        if ($jarakRaw !== null && $jarakRaw !== '' && $jarakRaw !== '-' && ! preg_match('/(orang|personel|personil|jiwa|m2|persegi)/i', (string) $jarakRaw)) {
            $jClean = trim(preg_replace('/^[:\s±~]+/', '', (string) $jarakRaw));
            $jClean = rtrim($jClean, " .\t\n\r\0\x0B");
            $jClean = str_replace(',', '.', $jClean);
            if (preg_match('/^(\d+(?:\.\d+)?)\s*(?:meter|m)$/i', $jClean, $jm)) {
                $val = (float) $jm[1];
                $jarakTampil = (str_contains($jm[1], '.') || $val < 20) ? ((float) $val).' Km' : (round($val / 1000, 3)).' Km';
            } elseif (preg_match('/^(\d+(?:\.\d+)?)\s*km$/i', $jClean, $jm)) {
                $jarakTampil = ((float) $jm[1]).' Km';
            } elseif (is_numeric($jClean)) {
                $jarakTampil = ((float) $jClean).' Km';
            } elseif (preg_match('/(\d+(?:\.\d+)?)/', $jClean, $jm)) {
                $val = (float) $jm[1];
                $jarakTampil = (preg_match('/meter/i', $jClean)) ? (round($val / 1000, 3)).' Km' : ((float) $val).' Km';
            }
        }

        // 7. Respon Time
        $rt = $row->respon_time;
        $responTampil = (! is_null($rt) && $rt >= 0) ? $rt.' Menit' : '-';

        // 8. Nama Pelapor
        $pelaporTampil = ! empty($a['nama_pelapor']) ? $a['nama_pelapor'] : '-';

        // 9. No. Tlp Pelapor
        $teleponPelaporTampil = ! empty($a['telepon_pelapor']) ? $a['telepon_pelapor'] : '-';

        // 10. Objek Kejadian
        if ($isKebakaran) {
            $objekTampil = ! empty($a['kategori_kebakaran']) ? ucwords(str_replace('_', ' ', $a['kategori_kebakaran'])) : '-';
            if (! empty($a['keterangan_objek_kebakaran'])) {
                $objekTampil .= "\n(".$a['keterangan_objek_kebakaran'].')';
            }
        } else {
            $objekTampil = ! empty($a['kategori_non_kebakaran'])
                ? ucwords(str_replace('_', ' ', $a['kategori_non_kebakaran']))
                : (! empty($a['kategori_kejadian']) ? ucwords(str_replace('_', ' ', $a['kategori_kejadian'])) : '-');
            $rincian = ! empty($a['rincian_kategori_non_kebakaran']) ? $a['rincian_kategori_non_kebakaran'] : (! empty($a['jenis_hewan']) ? $a['jenis_hewan'] : '');
            if (! empty($rincian)) {
                $objekTampil .= "\n(".$rincian.')';
            }
        }

        // 11. Lokasi Kejadian
        $lokasiTampil = ! empty($a['alamat']) ? $a['alamat'] : '-';

        // 12. Nama Korban / KK
        $korbanRaw = trim((string) ($a['nama_korban'] ?? ''));
        $namaKorbanTampil = ($korbanRaw !== '' && strtolower($korbanRaw) !== 'nihil') ? $korbanRaw : 'Nihil';

        // 13. Jumlah yang Terdampak (Jiwa)
        $jiwaCount = (int) ($a['jumlah_jiwa'] ?? 0);
        $jiwaTampil = $jiwaCount > 0 ? $jiwaCount.' Jiwa' : '0';

        // 14. Petugas atau Warga (Meninggal atau Cidera)
        $meninggal = (int) ($a['korban_meninggal'] ?? 0);
        $cidera = (int) (($a['korban_berat'] ?? 0) + ($a['korban_ringan'] ?? 0));
        if ($meninggal === 0 && $cidera === 0) {
            $korbanStatusTampil = 'Nihil';
        } else {
            $kList = [];
            if ($meninggal > 0) {
                $kList[] = "Meninggal: {$meninggal}";
            }
            if ($cidera > 0) {
                $kList[] = "Cidera: {$cidera}";
            }
            $korbanStatusTampil = implode(', ', $kList);
        }

        // 15. Pimpinan Operasi
        $pimpinanTampil = ! empty($a['pimpinan_operasi']) ? $a['pimpinan_operasi'] : '-';

        // 16. Satuan Tugas
        $satgasTampil = ! empty($a['satuan_tugas']) ? $a['satuan_tugas'] : '-';

        // 17. Jumlah Personil
        $jmlPersonel = (int) ($a['jumlah_personel'] ?? 0);
        $personilTampil = $jmlPersonel > 0 ? $jmlPersonel.' Orang' : '-';

        // 18. Lama Operasi
        $lamaOperasiTampil = '-';
        if (! empty($a['waktu_tiba']) && ! empty($a['waktu_selesai'])) {
            $wt = Carbon::parse($a['waktu_tiba']);
            $ws = Carbon::parse($a['waktu_selesai']);
            $diffMnt = $wt->diffInMinutes($ws);
            if ($diffMnt >= 60) {
                $j = floor($diffMnt / 60);
                $s = $diffMnt % 60;
                $lamaOperasiTampil = $j.' Jam'.($s > 0 ? ' '.$s.' Menit' : '');
            } else {
                $lamaOperasiTampil = $diffMnt.' Menit';
            }
        }

        // 19. Penyebab Kebakaran (Kebakaran) atau Kronologi Penyelamatan (Non-Kebakaran)
        if ($isKebakaran) {
            $p = $a['dugaan_penyebab'] ?? null;
            if ($p === 'lainnya') {
                $uraianTampil = $a['dugaan_penyebab_lainnya'] ?? '-';
            } elseif ($p) {
                $uraianTampil = $this->mapPenyebab[$p] ?? ucwords(str_replace('_', ' ', $p));
            } else {
                $uraianTampil = '-';
            }
        } else {
            $uraianTampil = ! empty($a['kronologi_lengkap']) ? $a['kronologi_lengkap'] : '-';
        }

        // 20. Hambatan
        $hambatanRaw = trim((string) ($a['hambatan_lapangan'] ?? ''));
        $hambatanTampil = ($hambatanRaw !== '' && strtolower($hambatanRaw) !== 'nihil') ? $hambatanRaw : 'Nihil';

        // 21. Sarana yang Digunakan (Air, Armada, Foam, Peralatan)
        $air = (int) ($a['liter_air'] ?? 0);
        $foam = (int) ($a['liter_foam'] ?? 0);
        $jmlArmada = $a['jumlah_armada'] ?? null;
        $armadaTxt = '-';
        if ($jmlArmada !== null && $jmlArmada !== '') {
            $armadaTxt = $jmlArmada.' Unit';
        } elseif (! empty($a['armada'])) {
            $arm = $a['armada'];
            for ($i = 0; $i < 2 && is_string($arm); $i++) {
                $d = json_decode($arm, true);
                if ($d === null) {
                    break;
                }
                $arm = $d;
            }
            $armadaTxt = is_array($arm) ? (count($arm) ? implode(', ', array_map('ucfirst', $arm)) : '-') : $arm;
        }

        $peralatanTxt = '';
        if (! empty($a['peralatan'])) {
            $per = $a['peralatan'];
            for ($i = 0; $i < 2 && is_string($per); $i++) {
                $d = json_decode($per, true);
                if ($d === null) {
                    break;
                }
                $per = $d;
            }
            $peralatanTxt = is_array($per) ? implode(', ', $per) : $per;
        }
        if (! empty($a['peralatan_lain'])) {
            $peralatanTxt .= ($peralatanTxt ? ', ' : '').$a['peralatan_lain'];
        }

        $saranaParts = [];
        if ($isKebakaran) {
            if ($air > 0) {
                $saranaParts[] = 'Air: '.number_format($air, 0, ',', '.').' L';
            }
            if ($armadaTxt !== '-' && $armadaTxt !== '') {
                $saranaParts[] = 'Armada: '.$armadaTxt;
            }
            if ($foam > 0) {
                $saranaParts[] = 'Foam: '.number_format($foam, 0, ',', '.').' L';
            }
            if ($peralatanTxt !== '') {
                $saranaParts[] = 'Alat: '.$peralatanTxt;
            }
        } else {
            if ($armadaTxt !== '-' && $armadaTxt !== '') {
                $saranaParts[] = 'Armada: '.$armadaTxt;
            }
            if ($peralatanTxt !== '') {
                $saranaParts[] = 'Alat: '.$peralatanTxt;
            }
            if ($air > 0) {
                $saranaParts[] = 'Air: '.number_format($air, 0, ',', '.').' L';
            }
        }
        $saranaTampil = count($saranaParts) ? implode("\n", $saranaParts) : '-';

        // 22. Tim Quick Respon Pemadam Kebakaran / Instansi Pendukung
        $timQuickRaw = $a['instansi_pendukung'] ?? null;
        $timQuickTxt = '';
        if (! empty($timQuickRaw)) {
            for ($i = 0; $i < 2 && is_string($timQuickRaw); $i++) {
                $d = json_decode($timQuickRaw, true);
                if ($d === null) {
                    break;
                }
                $timQuickRaw = $d;
            }
            if (is_array($timQuickRaw)) {
                $timQuickTxt = implode(', ', array_filter($timQuickRaw));
            } else {
                $timQuickTxt = trim((string) $timQuickRaw);
            }
        }

        if (empty($timQuickTxt) || $timQuickTxt === '-') {
            if (! empty($a['tindakan_instansi']) && $a['tindakan_instansi'] !== '-') {
                $timQuickTxt = $a['tindakan_instansi'];
            } elseif (! empty($a['tim_respontime']) && ! preg_match('/\bmenit\b/i', trim($a['tim_respontime'])) && $a['tim_respontime'] !== '-') {
                $timQuickTxt = $a['tim_respontime'];
            } else {
                $timQuickTxt = '-';
            }
        }

        return [
            'no' => $no,
            'hari_tanggal' => $hariTanggalTampil,
            'media' => $mediaPelaporanTampil,
            'waktu_terima' => $waktuTerimaTampil,
            'waktu_tiba' => $waktuTibaTampil,
            'jarak' => $jarakTampil,
            'respon' => $responTampil,
            'pelapor' => $pelaporTampil,
            'telepon' => $teleponPelaporTampil,
            'objek' => $objekTampil,
            'lokasi' => $lokasiTampil,
            'nama_korban' => $namaKorbanTampil,
            'jiwa' => $jiwaTampil,
            'korban_status' => $korbanStatusTampil,
            'pimpinan' => $pimpinanTampil,
            'satgas' => $satgasTampil,
            'personil' => $personilTampil,
            'lama_operasi' => $lamaOperasiTampil,
            'uraian' => $uraianTampil,
            'hambatan' => $hambatanTampil,
            'sarana' => $saranaTampil,
            'tim_quick' => $timQuickTxt,
        ];
    }
}
