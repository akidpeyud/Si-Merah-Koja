<?php

namespace App\Http\Controllers;

use App\Models\LaporanPenyelamatan;
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
 * Export laporan ke Excel, per tahun dan per jenis laporan.
 *
 * URL: /internal/damtan/export-excel?tahun=2026&kategori=kebakaran
 *      /internal/damtan/export-excel?tahun=2026&kategori=non-kebakaran
 *
 * - kategori=kebakaran      -> "Laporan Kebakaran" (format Laporan_Kebakaran__2024.xlsx)
 * - kategori=non-kebakaran  -> "Laporan Non-Kebakaran" (tanpa kolom khusus kebakaran:
 *                              penyebab, jumlah air, jumlah kerugian)
 * Jika kategori kosong / tidak dikenal, otomatis dianggap "kebakaran".
 */
class LaporanExcelController extends Controller
{
    private const F_PELAPOR   = 'nama_pelapor';      // Nama Pemilik/Pelapor
    private const F_KORBAN    = 'korban';            // daftar nama korban
    private const F_KERUGIAN  = 'jumlah_kerugian';   // Jumlah Kerugian (angka rupiah)
    private const F_KEPUASAN  = 'tingkat_kepuasan';  // Tingkat Kepuasan
    private const F_REGU      = 'regu_petugas';      // Ket (regu / pos yang bertugas)

    private array $mapPenyebab = [
        'arus_pendek'       => 'Arus pendek listrik',
        'kebocoran_gas'     => 'Kebocoran gas',
        'sambaran_petir'    => 'Sambaran petir',
        'kelalaian_manusia' => 'Kelalaian manusia',
        'faktor_alam'       => 'Faktor alam',
    ];

    public function __invoke(Request $request)
    {
        $tahun = (int) $request->query('tahun', date('Y'));
        if ($tahun < 2000 || $tahun > (int) date('Y') + 1) {
            $tahun = (int) date('Y');
        }

        $kategori = strtolower((string) $request->query('kategori', 'kebakaran'));
        if (!in_array($kategori, ['kebakaran', 'non-kebakaran'], true)) {
            $kategori = 'kebakaran';
        }
        $isKebakaran = $kategori === 'kebakaran';

        /* ---------- 1. Ambil & susun data ---------- */
        $items = LaporanPenyelamatan::query()->get()
            ->map(fn ($row) => $this->susunBaris($row))
            ->filter(fn ($d) => $d['kebakaran'] === $isKebakaran && $d['tgl'] && $d['tgl']->year === $tahun)
            ->sortBy('urut')
            ->values();

        /* ---------- 2. Tentukan kolom sesuai jenis laporan ---------- */
        $kolom = $this->kolom($kategori);

        // Beri huruf kolom (A, B, C, ...) secara otomatis
        $idx  = 1;
        $peta = [];
        foreach ($kolom as &$k) {
            $k['huruf'] = Coordinate::stringFromColumnIndex($idx);
            if (($k['span'] ?? 1) === 2) {
                $k['huruf2'] = Coordinate::stringFromColumnIndex($idx + 1);
                $idx += 2;
            } else {
                $idx += 1;
            }
            $peta[$k['key']] = $k['huruf'];
        }
        unset($k);

        $kolTerakhir = Coordinate::stringFromColumnIndex($idx - 1);

        /* ---------- 3. Buat workbook ---------- */
        $ss = new Spreadsheet();
        $ss->getDefaultStyle()->getFont()->setName('Arial')->setSize(12);
        $ws = $ss->getActiveSheet();
        $ws->setTitle('TAHUNAN');

        // Lebar kolom
        foreach ($kolom as $k) {
            if (($k['span'] ?? 1) === 2) {
                $ws->getColumnDimension($k['huruf'])->setWidth($k['w'][0]);
                $ws->getColumnDimension($k['huruf2'])->setWidth($k['w'][1]);
            } else {
                $ws->getColumnDimension($k['huruf'])->setWidth($k['w']);
            }
        }

        // Judul
        $ws->mergeCells("A1:{$kolTerakhir}2");
        $ws->setCellValue('A1', $isKebakaran ? 'LAPORAN KEBAKARAN' : 'LAPORAN NON-KEBAKARAN');
        $ws->mergeCells("A3:{$kolTerakhir}3");
        $ws->setCellValue('A3', 'JANUARI - DESEMBER ' . $tahun);
        $ws->getStyle("A1:{$kolTerakhir}3")->applyFromArray([
            'font'      => ['name' => 'Arial', 'bold' => true, 'size' => 18],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_CENTER,
            ],
        ]);
        $ws->getRowDimension(3)->setRowHeight(23.25);

        // Header tabel (baris 5)
        foreach ($kolom as $k) {
            $ws->setCellValue($k['huruf'] . '5', $k['head']);
            if (!empty($k['huruf2'])) {
                $ws->mergeCells("{$k['huruf']}5:{$k['huruf2']}5");
            }
        }
        $ws->getStyle("A5:{$kolTerakhir}5")->applyFromArray([
            'font'      => ['name' => 'Arial', 'bold' => true, 'size' => 14],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_CENTER,
                'wrapText'   => true,
            ],
        ]);
        $ws->getRowDimension(5)->setRowHeight(40);

        /* ---------- 4. Isi data ---------- */
        $r        = 6;   // baris data pertama
        $no       = 1;   // nomor urut laporan
        $noKorban = 1;   // nomor urut korban (berlanjut antar laporan)

        foreach ($items as $d) {
            $jmlBaris = max(1, count($d['korban']));
            $akhir    = $r + $jmlBaris - 1;

            foreach ($kolom as $k) {
                $h = $k['huruf'];
                switch ($k['key']) {
                    case 'no':
                        $ws->setCellValue("{$h}{$r}", $no++);
                        break;

                    case 'jam':
                        $ws->setCellValueExplicit("{$h}{$r}", $d['jam'], DataType::TYPE_STRING);
                        break;

                    case 'respon':
                        $ws->setCellValue("{$h}{$r}", $d['respon']);
                        $ws->setCellValue("{$k['huruf2']}{$r}", $d['respon'] === '-' ? '' : 'Menit');
                        break;

                    case 'no_korban':
                    case 'korban':
                        // diisi terpisah di bawah (satu korban per baris)
                        break;

                    default:
                        $ws->setCellValue("{$h}{$r}", $d[$k['key']] ?? '-');
                }
            }

            // Korban: satu nama per baris, nomor berlanjut
            $hNo   = $peta['no_korban'];
            $hNama = $peta['korban'];
            if (count($d['korban']) === 0) {
                $ws->setCellValue("{$hNama}{$r}", '-');
            } else {
                foreach ($d['korban'] as $i => $namaKorban) {
                    $ws->setCellValue($hNo . ($r + $i), $noKorban++);
                    $ws->setCellValue($hNama . ($r + $i), $namaKorban);
                }
            }

            // Gabungkan sel (merge) ke bawah bila korban lebih dari satu
            if ($jmlBaris > 1) {
                foreach ($kolom as $k) {
                    if (($k['gabung'] ?? true) === false) {
                        continue;
                    }
                    $ws->mergeCells("{$k['huruf']}{$r}:{$k['huruf']}{$akhir}");
                    if (!empty($k['huruf2'])) {
                        $ws->mergeCells("{$k['huruf2']}{$r}:{$k['huruf2']}{$akhir}");
                    }
                }
            }

            $r = $akhir + 1;
        }

        $terakhir = max(6, $r - 1);

        if ($items->isEmpty()) {
            $ws->mergeCells("A6:{$kolTerakhir}6");
            $ws->setCellValue(
                'A6',
                'Belum ada data laporan ' . ($isKebakaran ? 'kebakaran' : 'non-kebakaran') . ' pada tahun ' . $tahun . '.'
            );
        }

        /* ---------- 5. Gaya sel data ---------- */
        $rentang = "A6:{$kolTerakhir}{$terakhir}";

        $ws->getStyle("A5:{$kolTerakhir}{$terakhir}")->getBorders()->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        // "Respon Time" + "Menit" tampil seperti satu sel (tanpa garis di antaranya)
        if (isset($peta['respon'])) {
            foreach ($kolom as $k) {
                if ($k['key'] === 'respon') {
                    $ws->getStyle("{$k['huruf']}6:{$k['huruf']}{$terakhir}")
                        ->getBorders()->getRight()->setBorderStyle(Border::BORDER_NONE);
                    $ws->getStyle("{$k['huruf2']}6:{$k['huruf2']}{$terakhir}")
                        ->getBorders()->getLeft()->setBorderStyle(Border::BORDER_NONE);
                }
            }
        }

        $ws->getStyle($rentang)->applyFromArray([
            'font'      => ['name' => 'Arial', 'size' => 12],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_CENTER,
                'wrapText'   => true,
            ],
        ]);

        // Kolom teks panjang rata kiri
        foreach ($kolom as $k) {
            if (($k['al'] ?? 'c') === 'l') {
                $ws->getStyle("{$k['huruf']}6:{$k['huruf']}{$terakhir}")->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_LEFT);
            }
        }

        /* ---------- 6. Pengaturan cetak ---------- */
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

        /* ---------- 7. Kirim sebagai download ---------- */
        $namaFile = ($isKebakaran ? 'Laporan_Kebakaran_' : 'Laporan_Non_Kebakaran_') . $tahun . '.xlsx';

        return response()->streamDownload(function () use ($ss) {
            (new Xlsx($ss))->save('php://output');
        }, $namaFile, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }

    /**
     * Daftar kolom per jenis laporan.
     *
     * key    : nama kunci data (lihat susunBaris)
     * head   : judul kolom
     * w      : lebar kolom (array [a, b] jika span = 2)
     * al     : 'l' = rata kiri, selain itu rata tengah
     * gabung : false = sel TIDAK digabung ke bawah (khusus kolom korban)
     * span   : 2 = memakai dua kolom (Respon Time + "Menit")
     */
    private function kolom(string $kategori): array
    {
        if ($kategori === 'kebakaran') {
            return [
                ['key' => 'no',        'head' => 'No',                   'w' => 5.1],
                ['key' => 'tanggal',   'head' => 'Tanggal Kejadian',     'w' => 24.6],
                ['key' => 'jam',       'head' => 'Jam',                  'w' => 13],
                ['key' => 'jenis',     'head' => 'Jenis yang terbakar',  'w' => 31.3],
                ['key' => 'penyebab',  'head' => 'Penyebab',             'w' => 25.9, 'al' => 'l'],
                ['key' => 'lokasi',    'head' => 'Lokasi Kejadian',      'w' => 26.9, 'al' => 'l'],
                ['key' => 'pelapor',   'head' => 'Nama Pemilik/Pelapor', 'w' => 25.9],
                ['key' => 'no_korban', 'head' => 'NO',                   'w' => 7.7,  'gabung' => false],
                ['key' => 'korban',    'head' => 'Nama Korban',          'w' => 29.3, 'al' => 'l', 'gabung' => false],
                ['key' => 'armada',    'head' => 'Armada',               'w' => 21.4],
                ['key' => 'air',       'head' => 'Jumlah Air',           'w' => 19.6],
                ['key' => 'kerugian',  'head' => 'Jumlah Kerugian',      'w' => 17.4],
                ['key' => 'respon',    'head' => 'Respon Time',          'w' => [9.7, 13.9], 'span' => 2],
                ['key' => 'kepuasan',  'head' => 'Tingkat Kepuasan',     'w' => 16.6],
                ['key' => 'regu',      'head' => 'Ket',                  'w' => 18.6, 'al' => 'l'],
            ];
        }

        // Non-kebakaran: tanpa penyebab, jumlah air, dan jumlah kerugian
        return [
            ['key' => 'no',        'head' => 'No',                   'w' => 5.1],
            ['key' => 'tanggal',   'head' => 'Tanggal Kejadian',     'w' => 24.6],
            ['key' => 'jam',       'head' => 'Jam',                  'w' => 13],
            ['key' => 'jenis',     'head' => 'Jenis Kejadian',       'w' => 31.3],
            ['key' => 'lokasi',    'head' => 'Lokasi Kejadian',      'w' => 32, 'al' => 'l'],
            ['key' => 'pelapor',   'head' => 'Nama Pemilik/Pelapor', 'w' => 25.9],
            ['key' => 'no_korban', 'head' => 'NO',                   'w' => 7.7,  'gabung' => false],
            ['key' => 'korban',    'head' => 'Nama Korban',          'w' => 29.3, 'al' => 'l', 'gabung' => false],
            ['key' => 'armada',    'head' => 'Armada',               'w' => 21.4],
            ['key' => 'respon',    'head' => 'Respon Time',          'w' => [9.7, 13.9], 'span' => 2],
            ['key' => 'kepuasan',  'head' => 'Tingkat Kepuasan',     'w' => 16.6],
            ['key' => 'regu',      'head' => 'Ket',                  'w' => 18.6, 'al' => 'l'],
        ];
    }

    /**
     * Ubah satu laporan menjadi array siap tulis ke Excel.
     * Memakai atribut mentah supaya aman walau ada kolom yang belum dibuat.
     */
    private function susunBaris($row): array
    {
        $a = $row->getAttributes();

        $kebakaran = strtolower($a['kategori_kejadian'] ?? '') === 'kebakaran';

        $tglRaw = $a['tanggal_kejadian'] ?? $a['waktu_kejadian'] ?? null;
        $jamRaw = $a['waktu_kejadian'] ?? $a['waktu_terima'] ?? null;
        $tgl    = $tglRaw ? Carbon::parse($tglRaw) : null;
        $jam    = $jamRaw ? Carbon::parse($jamRaw) : null;

        // Jenis: kebakaran -> yang terbakar; non-kebakaran -> jenis kejadiannya
        if ($kebakaran) {
            $jenisMentah = $a['kategori_kebakaran'] ?? null;
        } else {
            $jenisMentah = !empty($a['kategori_non_kebakaran'])
                ? $a['kategori_non_kebakaran']
                : ($a['kategori_kejadian'] ?? null);
        }
        $jenis = !empty($jenisMentah) ? ucwords(str_replace(['_', '-'], ' ', $jenisMentah)) : '-';

        // Penyebab
        $p = $a['dugaan_penyebab'] ?? null;
        if ($p === 'lainnya') {
            $penyebab = $a['dugaan_penyebab_lainnya'] ?? '-';
        } elseif ($p) {
            $penyebab = $this->mapPenyebab[$p] ?? ucwords(str_replace('_', ' ', $p));
        } else {
            $penyebab = '-';
        }

        // Armada: daftar unit (JSON) atau jumlah
        $unit   = $this->daftar($a['armada'] ?? null);
        $armada = count($unit)
            ? implode(', ', $unit)
            : (($a['jumlah_armada'] ?? '') !== '' ? (string) $a['jumlah_armada'] : '-');

        // Jumlah air
        $air   = $a['liter_air'] ?? null;
        $airTx = (is_numeric($air) && $air > 0) ? number_format($air, 0, ',', '.') . ' Liter' : '-';

        // Respon time (accessor di model)
        $rt     = $row->respon_time;
        $respon = (!is_null($rt) && $rt >= 0) ? (int) $rt : '-';

        // Jumlah kerugian
        $rugi   = $a[self::F_KERUGIAN] ?? null;
        $rugiTx = (is_numeric($rugi) && $rugi > 0)
            ? number_format($rugi, 0, ',', '.')
            : ((is_string($rugi) && trim($rugi) !== '') ? trim($rugi) : '-');

        return [
            'kebakaran' => $kebakaran,
            'tgl'       => $tgl,
            'urut'      => ($tgl ? $tgl->format('Y-m-d') : '') . ' ' . ($jam ? $jam->format('H:i') : ''),
            'tanggal'   => $tgl ? $tgl->copy()->locale('id')->translatedFormat('d F Y') : '-',
            'jam'       => $jam ? $jam->format('H.i') : '-',
            'jenis'     => $jenis,
            'penyebab'  => $penyebab,
            'lokasi'    => !empty($a['alamat']) ? $a['alamat'] : '-',
            'pelapor'   => !empty($a[self::F_PELAPOR]) ? $a[self::F_PELAPOR] : '-',
            'korban'    => $this->daftar($a[self::F_KORBAN] ?? null),
            'armada'    => $armada,
            'air'       => $airTx,
            'kerugian'  => $rugiTx,
            'respon'    => $respon,
            'kepuasan'  => !empty($a[self::F_KEPUASAN]) ? $a[self::F_KEPUASAN] : 'Terlayani',
            'regu'      => !empty($a[self::F_REGU]) ? $a[self::F_REGU] : '-',
        ];
    }

    /**
     * Ubah nilai kolom (JSON / JSON ter-encode dua kali / teks per baris) menjadi array nama.
     */
    private function daftar($nilai): array
    {
        for ($i = 0; $i < 2 && is_string($nilai); $i++) {
            $d = json_decode($nilai, true);
            if ($d === null) {
                break;
            }
            $nilai = $d;
        }

        if (is_string($nilai)) {
            $nilai = preg_split('/\r\n|\r|\n/', $nilai);
        }
        if (!is_array($nilai)) {
            return [];
        }

        $hasil = [];
        foreach ($nilai as $n) {
            if (is_array($n)) {
                $n = $n['nama'] ?? $n['name'] ?? null;
            }
            $n = trim((string) $n);
            if ($n !== '' && $n !== '-') {
                $hasil[] = $n;
            }
        }

        return $hasil;
    }
}