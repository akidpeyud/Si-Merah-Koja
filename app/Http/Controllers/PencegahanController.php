<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\DiklatF1;
use App\Models\DiklatF2;
use App\Models\DiklatInspektur;
use App\Models\DiklatMfr;
use App\Models\DiklatRescue;
use App\Models\DiklatOperator;
use App\Models\DiklatPpl;
use App\Models\InspeksiBangunan;
use App\Models\FireDrill;
use App\Models\PelatihanKeluarga;
use App\Models\KunjunganSekolah; 
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PencegahanController extends Controller
{
    // ==========================================
    // BAGIAN PENINGKATAN KAPASITAS (DIKLAT)
    // ==========================================

    /**
     * Padanan jenis diklat (slug URL) dengan nama tabelnya.
     *
     * @var array<string, string>
     */
    private const TABEL_DIKLAT = [
        'diksar'           => 'tbl_diksar',
        'diklat-f1'        => 'tbl_diklat_f1',
        'diklat-f2'        => 'tbl_diklat_f2',
        'diklat-rescue'    => 'tbl_diklat_rescue',
        'diklat-mfr'       => 'tbl_diklat_mfr',
        'diklat-operator'  => 'tbl_diklat_operator',
        'diklat-inspektur' => 'tbl_diklat_inspektur',
        'diklat-ppl'       => 'tbl_diklat_ppl',
    ];

    /**
     * Nama tabel untuk sebuah jenis diklat. Jenis yang tidak dikenal menghasilkan 404.
     */
    private function tabelDiklat(string $jenis): string
    {
        return self::TABEL_DIKLAT[strtolower($jenis)] ?? abort(404);
    }

    /**
     * Aturan validasi form Peningkatan Kapasitas Aparatur (tambah & edit).
     *
     * @return array<string, mixed>
     */
    private function aturanDiklat(Request $request): array
    {
        $aturanSelesai = ['nullable', 'date'];
        if ($request->filled('tanggal_pelaksanaan')) {
            $aturanSelesai[] = 'after_or_equal:tanggal_pelaksanaan';
        }

        return [
            'nama'                        => ['required', 'string', 'max:255'],
            'nip'                         => ['nullable', 'string', 'max:100'],
            'tempat_lahir'                => ['nullable', 'string', 'max:255'],
            'tgl_lahir'                   => ['nullable', 'date'],
            'pangkat_golongan'            => ['nullable', 'string', 'max:255'],
            'jabatan'                     => ['nullable', 'string', 'max:255'],
            'kualifikasi'                 => ['nullable', 'string', 'max:255'],
            'tempat_pelaksanaan'          => ['nullable', 'string', 'max:255'],
            'tanggal_pelaksanaan'         => ['nullable', 'date'],
            'tanggal_selesai_pelaksanaan' => $aturanSelesai,
            'jumlah_jam_pelajaran'        => ['nullable', 'integer', 'min:0'],
            'no_sttp'                     => ['nullable', 'string', 'max:255'],
            'tanggal_sttp'                => ['nullable', 'date'],
            'ditandatangani_oleh'         => ['nullable', 'string', 'max:255'],
            'file_sertifikat'             => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
        ];
    }

    public function indexDiksar()
    {
        $data_diklat = DB::table('tbl_diksar')->orderBy('id', 'desc')->get();
        $judul_diklat = "DIKSAR";
        
        return view('internal.pencegahan.diklat_f1', compact('data_diklat', 'judul_diklat'));
    }
    
    public function indexDiklatF1()
    {
        $data_diklat = DB::table('tbl_diklat_f1')->orderBy('id', 'desc')->get();
        $judul_diklat = "DIKLAT F1";
        return view('internal.pencegahan.diklat_f1', compact('data_diklat', 'judul_diklat'));
    }

    public function indexDiklatF2()
    {
        $data_diklat = DB::table('tbl_diklat_f2')->orderBy('id', 'desc')->get();
        $judul_diklat = "DIKLAT F2";
        return view('internal.pencegahan.diklat_f1', compact('data_diklat', 'judul_diklat'));
    }

    public function indexDiklatInspektur()
    {
        $data_diklat = DB::table('tbl_diklat_inspektur')->orderBy('id', 'desc')->get();
        $judul_diklat = "DIKLAT INSPEKTUR";
        return view('internal.pencegahan.diklat_f1', compact('data_diklat', 'judul_diklat'));
    }

    public function indexDiklatMfr()
    {
        $data_diklat = DB::table('tbl_diklat_mfr')->orderBy('id', 'desc')->get();
        $judul_diklat = "DIKLAT MFR";
        return view('internal.pencegahan.diklat_f1', compact('data_diklat', 'judul_diklat'));
    }

    public function indexDiklatRescue()
    {
        $data_diklat = DB::table('tbl_diklat_rescue')->orderBy('id', 'desc')->get();
        $judul_diklat = "DIKLAT RESCUE";
        return view('internal.pencegahan.diklat_f1', compact('data_diklat', 'judul_diklat'));
    }

    public function indexDiklatOperator()
    {
        $data_diklat = DB::table('tbl_diklat_operator')->orderBy('id', 'desc')->get();
        $judul_diklat = "DIKLAT OPERATOR";
        return view('internal.pencegahan.diklat_f1', compact('data_diklat', 'judul_diklat'));
    }

    public function indexDiklatPpl()
    {
        $data_diklat = DB::table('tbl_diklat_ppl')->orderBy('id', 'desc')->get();
        $judul_diklat = "DIKLAT PPL";
        return view('internal.pencegahan.diklat_f1', compact('data_diklat', 'judul_diklat'));
    }
    
    public function indexPeningkatanKapasitas()
    {
        $dataDiksar    = \Illuminate\Support\Facades\Schema::hasTable('tbl_diksar') ? DB::table('tbl_diksar')->orderBy('id', 'desc')->get() : [];
        $dataF1        = \Illuminate\Support\Facades\Schema::hasTable('tbl_diklat_f1') ? DB::table('tbl_diklat_f1')->orderBy('id', 'desc')->get() : [];
        $dataF2        = \Illuminate\Support\Facades\Schema::hasTable('tbl_diklat_f2') ? DB::table('tbl_diklat_f2')->orderBy('id', 'desc')->get() : [];
        $dataInspektur = \Illuminate\Support\Facades\Schema::hasTable('tbl_diklat_inspektur') ? DB::table('tbl_diklat_inspektur')->orderBy('id', 'desc')->get() : [];
        $dataMfr       = \Illuminate\Support\Facades\Schema::hasTable('tbl_diklat_mfr') ? DB::table('tbl_diklat_mfr')->orderBy('id', 'desc')->get() : [];
        $dataRescue    = \Illuminate\Support\Facades\Schema::hasTable('tbl_diklat_rescue') ? DB::table('tbl_diklat_rescue')->orderBy('id', 'desc')->get() : [];
        $dataOperator  = \Illuminate\Support\Facades\Schema::hasTable('tbl_diklat_operator') ? DB::table('tbl_diklat_operator')->orderBy('id', 'desc')->get() : [];
        $dataPpl       = \Illuminate\Support\Facades\Schema::hasTable('tbl_diklat_ppl') ? DB::table('tbl_diklat_ppl')->orderBy('id', 'desc')->get() : [];

        return view('internal.pencegahan.peningkatan_kapasitas', compact(
            'dataDiksar', 'dataF1', 'dataF2', 'dataInspektur', 'dataMfr', 'dataRescue', 'dataOperator', 'dataPpl'
        ));
    }

    public function createDiklat(Request $request)
    {
        $jenis = strtolower(str_replace(' ', '-', (string) $request->query('jenis')));

        return view('internal.pencegahan.tambah_diklat', compact('jenis'));
    }

    public function storeDiklat(Request $request)
    {
        $validated = $request->validate(array_merge(
            ['jenis_diklat' => ['required', Rule::in(array_keys(self::TABEL_DIKLAT))]],
            $this->aturanDiklat($request)
        ));

        $tabel = $this->tabelDiklat($validated['jenis_diklat']);
        $data = Arr::except($validated, ['jenis_diklat', 'file_sertifikat']);

        if ($request->hasFile('file_sertifikat')) {
            $data['file_sertifikat'] = $request->file('file_sertifikat')->store('sertifikat_diklat', 'public');
        }

        $data['created_at'] = now();
        $data['updated_at'] = now();

        DB::table($tabel)->insert($data);

        return redirect('/internal/pencegahan/peningkatan-kapasitas')->with('success', 'Data Peningkatan Kapasitas berhasil ditambahkan!');
    }

    public function editDiklat(string $jenis, int $id)
    {
        $data = DB::table($this->tabelDiklat($jenis))->where('id', $id)->first();

        if (! $data) {
            return redirect('/internal/pencegahan/peningkatan-kapasitas')->with('error', 'Gagal Edit: Data tidak ada di database!');
        }

        return view('internal.pencegahan.edit_peningkatan', compact('data', 'jenis'));
    }

    public function updateDiklat(Request $request, string $jenis, int $id)
    {
        $tabel = $this->tabelDiklat($jenis);
        $dataLama = DB::table($tabel)->where('id', $id)->first();

        if (! $dataLama) {
            return redirect('/internal/pencegahan/peningkatan-kapasitas')->with('error', 'Gagal Edit: Data tidak ada di database!');
        }

        $validated = $request->validate($this->aturanDiklat($request));
        $data = Arr::except($validated, ['file_sertifikat']);

        if ($request->hasFile('file_sertifikat')) {
            $this->hapusFileSertifikat($dataLama->file_sertifikat ?? null);
            $data['file_sertifikat'] = $request->file('file_sertifikat')->store('sertifikat_diklat', 'public');
        }

        $data['updated_at'] = now();

        DB::table($tabel)->where('id', $id)->update($data);

        return redirect('/internal/pencegahan/peningkatan-kapasitas')->with('success', 'Data Peningkatan Kapasitas berhasil diperbarui!');
    }

    public function destroyDiklat(string $jenis, int $id)
    {
        $tabel = $this->tabelDiklat($jenis);
        $dataLama = DB::table($tabel)->where('id', $id)->first();

        if ($dataLama) {
            $this->hapusFileSertifikat($dataLama->file_sertifikat ?? null);
            DB::table($tabel)->where('id', $id)->delete();
        }

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }

    /**
     * Hapus berkas sertifikat dari storage publik jika ada.
     */
    private function hapusFileSertifikat(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    public function cetakExcel($jenis = 'semua')
    {
        $map = [
            'diksar'           => ['tabel' => 'tbl_diksar',           'sheet' => 'DIKSAR',           'judul' => 'DIKSAR'],
            'diklat-f1'        => ['tabel' => 'tbl_diklat_f1',        'sheet' => 'DIKLAT F1',        'judul' => 'DIKLAT F1'],
            'diklat-f2'        => ['tabel' => 'tbl_diklat_f2',        'sheet' => 'DIKLAT F2',        'judul' => 'DIKLAT F2'],
            'diklat-rescue'    => ['tabel' => 'tbl_diklat_rescue',    'sheet' => 'DIKLAT RESCUE',    'judul' => 'DIKLAT RESCUE'],
            'diklat-mfr'       => ['tabel' => 'tbl_diklat_mfr',       'sheet' => 'DIKLAT MFR',       'judul' => 'DIKLAT MFR'],
            'diklat-operator'  => ['tabel' => 'tbl_diklat_operator',  'sheet' => 'DIKLAT OPERATOR',  'judul' => 'DIKLAT OPERATOR'],
            'diklat-inspektur' => ['tabel' => 'tbl_diklat_inspektur', 'sheet' => 'DIKLAT INSPEKTUR', 'judul' => 'DIKLAT INSPEKTUR'],
            'diklat-ppl'       => ['tabel' => 'tbl_diklat_ppl',       'sheet' => 'DIKLAT PPL',       'judul' => 'DIKLAT PPL'],
        ];

        $jenisKey = strtolower($jenis);

        $targetDiklat = ($jenisKey !== 'semua' && isset($map[$jenisKey]))
            ? [$jenisKey => $map[$jenisKey]]
            : $map;

        $sheetsData = [];
        foreach ($targetDiklat as $key => $info) {
            $sheetsData[$key] = [
                'sheet' => $info['sheet'],
                'judul' => $info['judul'],
                'data'  => \Illuminate\Support\Facades\Schema::hasTable($info['tabel'])
                    ? DB::table($info['tabel'])->orderBy('id', 'asc')->get()
                    : collect([]),
            ];
        }

        $labelFile = ($jenisKey === 'semua') ? 'SEMUA_DIKLAT' : strtoupper(str_replace('-', '_', $jenisKey));
        $filename  = "Data_{$labelFile}_" . date('Ymd') . ".xls";

        $headers = [
            "Content-Type"        => "application/vnd.ms-excel; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=\"$filename\"",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $esc = fn($v) => htmlspecialchars((string) ($v ?? '-'), ENT_XML1 | ENT_QUOTES, 'UTF-8');

        $callback = function () use ($sheetsData, $esc) {
            echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
            echo '<?mso-application progid="Excel.Sheet"?>' . "\n";
            echo '<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
                    xmlns:o="urn:schemas-microsoft-com:office:office"
                    xmlns:x="urn:schemas-microsoft-com:office:excel"
                    xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet">' . "\n";

            echo '<Styles>
                    <Style ss:ID="Default" ss:Name="Normal">
                        <Alignment ss:Vertical="Center"/>
                        <Font ss:FontName="Arial" ss:Size="10"/>
                    </Style>
                    <Style ss:ID="sTitle">
                        <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
                        <Font ss:FontName="Arial" ss:Size="11" ss:Bold="1"/>
                    </Style>
                    <Style ss:ID="sHead">
                        <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
                        <Borders>
                            <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
                        </Borders>
                        <Font ss:FontName="Arial" ss:Size="9" ss:Bold="1" ss:Color="#FFFFFF"/>
                        <Interior ss:Color="#0D1B2A" ss:Pattern="Solid"/>
                    </Style>
                    <Style ss:ID="sText">
                        <Alignment ss:Horizontal="Left" ss:Vertical="Center" ss:WrapText="1"/>
                        <Borders>
                            <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
                        </Borders>
                        <Font ss:FontName="Arial" ss:Size="9"/>
                    </Style>
                    <Style ss:ID="sCenter">
                        <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
                        <Borders>
                            <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
                        </Borders>
                        <Font ss:FontName="Arial" ss:Size="9"/>
                    </Style>
                    <Style ss:ID="sTotal">
                        <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
                        <Borders>
                            <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
                        </Borders>
                        <Font ss:FontName="Arial" ss:Size="9" ss:Bold="1"/>
                        <Interior ss:Color="#F2F2F2" ss:Pattern="Solid"/>
                    </Style>
                  </Styles>' . "\n";

            $columns = [
                ['label' => 'NOMOR',                        'width' => 40],
                ['label' => 'NAMA',                         'width' => 150],
                ['label' => 'NIP',                          'width' => 130],
                ['label' => 'TEMPAT LAHIR',                 'width' => 110],
                ['label' => 'TANGGAL LAHIR',                'width' => 90],
                ['label' => 'PANGKAT / GOLONGAN RUANG',     'width' => 130],
                ['label' => 'JABATAN',                      'width' => 130],
                ['label' => 'KUALIFIKASI',                  'width' => 130],
                ['label' => 'TEMPAT PELAKSANAAN',           'width' => 150],
                ['label' => 'TANGGAL PELAKSANAAN',          'width' => 110],
                ['label' => 'TANGGAL SELESAI PELAKSANAAN',  'width' => 120],
                ['label' => 'JUMLAH JAM PELAJARAN',         'width' => 100],
                ['label' => 'NO STTP',                      'width' => 140],
                ['label' => 'TANGGAL STTP',                 'width' => 90],
                ['label' => 'PEJABAT YANG MENANDATANGANI',  'width' => 160],
                ['label' => 'UPLOAD SERTIFIKAT',            'width' => 200],
            ];
            $mergeAcross = count($columns) - 1;

            // Tanggal berformat YYYY-MM-DD ditampilkan d-m-Y, teks bebas (data lama) apa adanya
            $tgl = function ($nilai) {
                $nilai = trim((string) $nilai);
                if ($nilai === '') {
                    return '-';
                }

                return preg_match('/^\d{4}-\d{2}-\d{2}/', $nilai)
                    ? \Carbon\Carbon::parse($nilai)->format('d-m-Y')
                    : $nilai;
            };

            foreach ($sheetsData as $sheetItem) {
                echo '<Worksheet ss:Name="' . $esc($sheetItem['sheet']) . '"><Table>' . "\n";

                foreach ($columns as $col) {
                    echo '<Column ss:Width="' . $col['width'] . '"/>' . "\n";
                }

                echo '<Row ss:Height="18"><Cell ss:MergeAcross="' . $mergeAcross . '" ss:StyleID="sTitle"><Data ss:Type="String">JUMLAH APARATUR DINAS PEMADAM KEBAKARAN DAN PENYELAMATAN KOTA JAMBI</Data></Cell></Row>' . "\n";
                echo '<Row ss:Height="18"><Cell ss:MergeAcross="' . $mergeAcross . '" ss:StyleID="sTitle"><Data ss:Type="String">YANG MEMENUHI STANDAR KUALIFIKASI PEMADAM KEBAKARAN (DATA ' . $esc($sheetItem['judul']) . ')</Data></Cell></Row>' . "\n";
                echo '<Row ss:Height="18"><Cell ss:MergeAcross="' . $mergeAcross . '" ss:StyleID="sTitle"><Data ss:Type="String">TAHUN ' . date('Y') . '</Data></Cell></Row>' . "\n";
                echo '<Row ss:Height="10"></Row>' . "\n";

                echo '<Row ss:Height="28">' . "\n";
                foreach ($columns as $col) {
                    echo '<Cell ss:StyleID="sHead"><Data ss:Type="String">' . $esc($col['label']) . '</Data></Cell>' . "\n";
                }
                echo '</Row>' . "\n";

                if ($sheetItem['data']->isEmpty()) {
                    echo '<Row ss:Height="24"><Cell ss:MergeAcross="' . $mergeAcross . '" ss:StyleID="sCenter"><Data ss:Type="String">Belum ada data untuk ' . $esc($sheetItem['judul']) . '</Data></Cell></Row>' . "\n";
                } else {
                    foreach ($sheetItem['data'] as $index => $item) {
                        $linkSertifikat = !empty($item->file_sertifikat) ? asset('storage/' . $item->file_sertifikat) : '-';

                        echo '<Row ss:AutoFitHeight="1">
                                <Cell ss:StyleID="sCenter"><Data ss:Type="Number">' . ($index + 1) . '</Data></Cell>
                                <Cell ss:StyleID="sText"><Data ss:Type="String">' . $esc($item->nama ?? '-') . '</Data></Cell>
                                <Cell ss:StyleID="sCenter"><Data ss:Type="String">' . $esc($item->nip ?? '-') . '</Data></Cell>
                                <Cell ss:StyleID="sText"><Data ss:Type="String">' . $esc($item->tempat_lahir ?? '-') . '</Data></Cell>
                                <Cell ss:StyleID="sCenter"><Data ss:Type="String">' . $esc($tgl($item->tgl_lahir ?? null)) . '</Data></Cell>
                                <Cell ss:StyleID="sText"><Data ss:Type="String">' . $esc($item->pangkat_golongan ?? '-') . '</Data></Cell>
                                <Cell ss:StyleID="sText"><Data ss:Type="String">' . $esc($item->jabatan ?? '-') . '</Data></Cell>
                                <Cell ss:StyleID="sText"><Data ss:Type="String">' . $esc($item->kualifikasi ?? '-') . '</Data></Cell>
                                <Cell ss:StyleID="sText"><Data ss:Type="String">' . $esc($item->tempat_pelaksanaan ?? '-') . '</Data></Cell>
                                <Cell ss:StyleID="sCenter"><Data ss:Type="String">' . $esc($tgl($item->tanggal_pelaksanaan ?? null)) . '</Data></Cell>
                                <Cell ss:StyleID="sCenter"><Data ss:Type="String">' . $esc($tgl($item->tanggal_selesai_pelaksanaan ?? null)) . '</Data></Cell>
                                <Cell ss:StyleID="sCenter"><Data ss:Type="String">' . $esc($item->jumlah_jam_pelajaran ?? '-') . '</Data></Cell>
                                <Cell ss:StyleID="sCenter"><Data ss:Type="String">' . $esc($item->no_sttp ?? '-') . '</Data></Cell>
                                <Cell ss:StyleID="sCenter"><Data ss:Type="String">' . $esc($tgl($item->tanggal_sttp ?? null)) . '</Data></Cell>
                                <Cell ss:StyleID="sText"><Data ss:Type="String">' . $esc($item->ditandatangani_oleh ?? '-') . '</Data></Cell>
                                <Cell ss:StyleID="sText"><Data ss:Type="String">' . $esc($linkSertifikat) . '</Data></Cell>
                              </Row>' . "\n";
                    }
                }

                echo '<Row ss:Height="22">
                        <Cell ss:MergeAcross="' . $mergeAcross . '" ss:StyleID="sTotal"><Data ss:Type="String">TOTAL DATA ' . $esc($sheetItem['judul']) . ': ' . $sheetItem['data']->count() . ' ORANG</Data></Cell>
                      </Row>' . "\n";

                echo '</Table></Worksheet>' . "\n";
            }

            echo '</Workbook>';
        };

        return response()->stream($callback, 200, $headers);
    }

    public function cetakPdf($jenis = 'semua')
    {
        $map = [
            'diksar'           => ['tabel' => 'tbl_diksar',           'judul' => 'DIKSAR'],
            'diklat-f1'        => ['tabel' => 'tbl_diklat_f1',        'judul' => 'DIKLAT F1'],
            'diklat-f2'        => ['tabel' => 'tbl_diklat_f2',        'judul' => 'DIKLAT F2'],
            'diklat-rescue'    => ['tabel' => 'tbl_diklat_rescue',    'judul' => 'DIKLAT RESCUE'],
            'diklat-mfr'       => ['tabel' => 'tbl_diklat_mfr',       'judul' => 'DIKLAT MFR'],
            'diklat-operator'  => ['tabel' => 'tbl_diklat_operator',  'judul' => 'DIKLAT OPERATOR'],
            'diklat-inspektur' => ['tabel' => 'tbl_diklat_inspektur', 'judul' => 'DIKLAT INSPEKTUR'],
            'diklat-ppl'       => ['tabel' => 'tbl_diklat_ppl',       'judul' => 'DIKLAT PPL'],
        ];

        $jenisKey = strtolower($jenis);

        if ($jenisKey === 'semua' || !isset($map[$jenisKey])) {
            $semua_diklat = [];
            foreach ($map as $key => $info) {
                $semua_diklat[] = [
                    'judul' => $info['judul'],
                    'data'  => \Illuminate\Support\Facades\Schema::hasTable($info['tabel'])
                        ? DB::table($info['tabel'])->orderBy('id', 'asc')->get()
                        : collect([]),
                ];
            }
            $judul = 'SEMUA DIKLAT';
            return view('internal.pencegahan.cetak_pdf_diklat', compact('semua_diklat', 'judul'));
        }

        $tabel = $map[$jenisKey]['tabel'];
        $judul = $map[$jenisKey]['judul'];
        $data  = \Illuminate\Support\Facades\Schema::hasTable($tabel)
            ? DB::table($tabel)->orderBy('id', 'asc')->get()
            : collect([]);

        return view('internal.pencegahan.cetak_pdf_diklat', compact('data', 'judul'));
    }

    // ==========================================
    // BAGIAN INSPEKSI BANGUNAN
    // ==========================================
    public function index()
    {
        $data_inspeksi = InspeksiBangunan::orderBy('id', 'asc')->get();
        $data_fire_drill = FireDrill::orderBy('id', 'asc')->get();

        $total_inspeksi = $data_inspeksi->count();
        $total_fire_drill = $data_fire_drill->count();

        return view('internal.pencegahan.inspeksi_bangunan', compact(
            'data_inspeksi', 'data_fire_drill', 'total_inspeksi', 'total_fire_drill'
        ));
    }

    public function indexInspeksiBangunan()
    {
        $data_inspeksi = InspeksiBangunan::orderBy('id', 'asc')->get();

        $daftar_tahun = $data_inspeksi
            ->map(function ($item) {
                if (! empty($item->tahun)) {
                    return (int) $item->tahun;
                }
                if (empty($item->tanggal_inspeksi)) {
                    return null;
                }

                return (int) \Carbon\Carbon::parse($item->tanggal_inspeksi)->format('Y');
            })
            ->filter()
            ->unique()
            ->sortDesc()
            ->values();

        $daftar_jenis = $data_inspeksi
            ->map(fn ($item) => trim((string) ($item->jenis_usaha ?? '')))
            ->filter()
            ->unique(fn (string $jenis) => strtolower($jenis))
            ->map(fn (string $jenis) => strtoupper($jenis))
            ->sort()
            ->values();

        return view('internal.pencegahan.inspeksi_bangunan', compact('data_inspeksi', 'daftar_tahun', 'daftar_jenis'));
    }

    public function create()
    {
        return $this->createInspeksiBangunan();
    }

    public function store(Request $request)
    {
        return $this->storeInspeksiBangunan($request);
    }

    public function edit($id)
    {
        return $this->editInspeksiBangunan($id);
    }

    public function update(Request $request, $id)
    {
        return $this->updateInspeksiBangunan($request, $id);
    }

    public function createInspeksiBangunan()
    {
        return view('internal.pencegahan.tambah_inspeksi_bangunan');
    }

    public function storeInspeksiBangunan(Request $request)
    {
        $validated = $request->validate([
            'nama_tempat'               => 'required|string|max:255',
            'jenis_usaha'               => 'required|string|max:255',
            'kualifikasi_bangunan'      => 'required|in:Rendah,Sedang,Tinggi',
            'resiko_kebakaran'          => 'required|in:Rendah,Sedang,Tinggi',
            'luas_bangunan'             => 'required|string|max:100',
            'alamat'                    => 'required|string|max:500',
            'nama_penanggung_jawab'     => 'required|string|max:255',
            'no_telepon'                => 'required|string|max:50',
            'sistem_proteksi_kebakaran' => 'required|in:Memenuhi Syarat,Memenuhi Syarat dengan Catatan,Tidak Memenuhi Syarat',
            'tanggal_inspeksi'          => 'required|date',
            'surat_perintah_tugas'      => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'rekomendasi'               => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $data = [
            'nama_tempat'               => $validated['nama_tempat'],
            'jenis_usaha'               => $validated['jenis_usaha'],
            'kualifikasi_bangunan'      => $validated['kualifikasi_bangunan'],
            'resiko_kebakaran'          => $validated['resiko_kebakaran'],
            'luas_bangunan'             => $validated['luas_bangunan'],
            'alamat'                    => $validated['alamat'],
            'nama_penanggung_jawab'     => $validated['nama_penanggung_jawab'],
            'no_telepon'                => $validated['no_telepon'],
            'sistem_proteksi_kebakaran' => $validated['sistem_proteksi_kebakaran'],
            'tanggal_inspeksi'          => $validated['tanggal_inspeksi'],
        ];

        if (\Illuminate\Support\Facades\Schema::hasColumn('inspeksi_bangunans', 'tahun')) {
            $data['tahun'] = (int) \Carbon\Carbon::parse($validated['tanggal_inspeksi'])->format('Y');
        }

        $destinationPath = public_path('uploads/inspeksi');

        if (! file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $fileInputs = [
            'surat_perintah_tugas',
            'rekomendasi',
        ];

        foreach ($fileInputs as $input) {
            if ($request->hasFile($input)) {
                $file = $request->file($input);
                $filename = time() . '_' . uniqid() . '_' . $input . '.' . $file->getClientOriginalExtension();
                $file->move($destinationPath, $filename);
                $data[$input] = $filename;
            }
        }

        InspeksiBangunan::create($data);

        return redirect('/internal/pencegahan/inspeksi-kebakaran/bangunan')
            ->with('success', 'Data Inspeksi Bangunan berhasil ditambahkan!');
    }

    public function editInspeksiBangunan($id)
    {
        $item = InspeksiBangunan::findOrFail($id);

        return view('internal.pencegahan.edit_inspeksi_bangunan', compact('item'));
    }

    public function updateInspeksiBangunan(Request $request, $id)
    {
        $item = InspeksiBangunan::findOrFail($id);

        $validated = $request->validate([
            'nama_tempat'               => 'required|string|max:255',
            'jenis_usaha'               => 'required|string|max:255',
            'kualifikasi_bangunan'      => 'required|in:Rendah,Sedang,Tinggi',
            'resiko_kebakaran'          => 'required|in:Rendah,Sedang,Tinggi',
            'luas_bangunan'             => 'required|string|max:100',
            'alamat'                    => 'required|string|max:500',
            'nama_penanggung_jawab'     => 'required|string|max:255',
            'no_telepon'                => 'required|string|max:50',
            'sistem_proteksi_kebakaran' => 'required|in:Memenuhi Syarat,Memenuhi Syarat dengan Catatan,Tidak Memenuhi Syarat',
            'tanggal_inspeksi'          => 'required|date',
            'surat_perintah_tugas'      => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'rekomendasi'               => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $data = [
            'nama_tempat'               => $validated['nama_tempat'],
            'jenis_usaha'               => $validated['jenis_usaha'],
            'kualifikasi_bangunan'      => $validated['kualifikasi_bangunan'],
            'resiko_kebakaran'          => $validated['resiko_kebakaran'],
            'luas_bangunan'             => $validated['luas_bangunan'],
            'alamat'                    => $validated['alamat'],
            'nama_penanggung_jawab'     => $validated['nama_penanggung_jawab'],
            'no_telepon'                => $validated['no_telepon'],
            'sistem_proteksi_kebakaran' => $validated['sistem_proteksi_kebakaran'],
            'tanggal_inspeksi'          => $validated['tanggal_inspeksi'],
        ];

        if (\Illuminate\Support\Facades\Schema::hasColumn('inspeksi_bangunans', 'tahun')) {
            $tanggalBerubah = (string) ($item->tanggal_inspeksi ?? '') !== (string) $validated['tanggal_inspeksi'];
            $data['tahun'] = (! $tanggalBerubah && ! empty($item->tahun))
                ? (int) $item->tahun
                : (int) \Carbon\Carbon::parse($validated['tanggal_inspeksi'])->format('Y');
        }

        $destinationPath = public_path('uploads/inspeksi');

        if (! file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $fileInputs = [
            'surat_perintah_tugas',
            'rekomendasi',
        ];

        foreach ($fileInputs as $input) {
            if ($request->hasFile($input)) {
                if ($item->$input && file_exists($destinationPath . '/' . $item->$input)) {
                    unlink($destinationPath . '/' . $item->$input);
                }

                $file = $request->file($input);
                $filename = time() . '_' . uniqid() . '_' . $input . '.' . $file->getClientOriginalExtension();
                $file->move($destinationPath, $filename);
                $data[$input] = $filename;
            }
        }

        $item->update($data);

        return redirect('/internal/pencegahan/inspeksi-kebakaran/bangunan')
            ->with('success', 'Data Inspeksi Bangunan berhasil diperbarui!');
    }

    public function destroyInspeksiBangunan($id)
    {
        $item = InspeksiBangunan::findOrFail($id);
        $destinationPath = public_path('uploads/inspeksi');

        $fileInputs = [
            'surat_perintah_tugas',
            'rekomendasi',
        ];

        foreach ($fileInputs as $input) {
            if ($item->$input && file_exists($destinationPath . '/' . $item->$input)) {
                unlink($destinationPath . '/' . $item->$input);
            }
        }

        $item->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }

    // ==========================================
    // BAGIAN FIRE DRILL
    // ==========================================
    public function indexFireDrill()
    {
        $data_fire_drill = FireDrill::orderBy('id', 'asc')->get();
        $daftar_tahun = $data_fire_drill->pluck('tahun')->filter()->unique()->sortDesc()->values();
        $daftar_instansi = $data_fire_drill->pluck('nama_instansi')->filter()->unique()->sort()->values();

        return view('internal.pencegahan.fire_drill', compact('data_fire_drill', 'daftar_tahun', 'daftar_instansi'));
    }

    public function createFireDrill()
    {
        return view('internal.pencegahan.tambah_fire_drill');
    }

    public function storeFireDrill(Request $request)
    {
        $validated = $request->validate([
            'nama_instansi'         => 'required|string|max:255',
            'tanggal_pelaksanaan'   => 'required|string|max:255',
            'tempat_pelaksanaan'    => 'required|string|max:255',
            'total_peserta'         => 'required|integer|min:0',
            'nama_penanggung_jawab' => 'required|string|max:255',
            'no_telepon'            => 'required|string|max:50',
            'surat_perintah_tugas'  => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $tahun = preg_match('/\b(19\d{2}|20\d{2})\b/', $validated['tanggal_pelaksanaan'], $m)
            ? (int) $m[1]
            : (int) date('Y');

        $data = [
            'nama_instansi'         => $validated['nama_instansi'],
            'tahun'                 => $tahun,
            'tanggal_pelaksanaan'   => $validated['tanggal_pelaksanaan'],
            'tempat_pelaksanaan'    => $validated['tempat_pelaksanaan'],
            'total_peserta'         => (int) $validated['total_peserta'],
            'nama_penanggung_jawab' => $validated['nama_penanggung_jawab'],
            'no_telepon'            => $validated['no_telepon'],
        ];

        if ($request->hasFile('surat_perintah_tugas')) {
            $destinationPath = public_path('uploads/fire_drill');
            if (! file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $file = $request->file('surat_perintah_tugas');
            $filename = time() . '_' . uniqid() . '_spt.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $filename);
            $data['surat_perintah_tugas'] = $filename;
        }

        FireDrill::create($data);

        return redirect('/internal/pencegahan/inspeksi-kebakaran/fire-drill')
            ->with('success', 'Data Fire Drill berhasil ditambahkan!');
    }

    public function editFireDrill($id)
    {
        $item = FireDrill::findOrFail($id);

        return view('internal.pencegahan.edit_fire_drill', compact('item'));
    }

    public function updateFireDrill(Request $request, $id)
    {
        $item = FireDrill::findOrFail($id);

        $validated = $request->validate([
            'nama_instansi'         => 'required|string|max:255',
            'tanggal_pelaksanaan'   => 'required|string|max:255',
            'tempat_pelaksanaan'    => 'required|string|max:255',
            'total_peserta'         => 'required|integer|min:0',
            'nama_penanggung_jawab' => 'required|string|max:255',
            'no_telepon'            => 'required|string|max:50',
            'surat_perintah_tugas'  => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $tahun = preg_match('/\b(19\d{2}|20\d{2})\b/', $validated['tanggal_pelaksanaan'], $m)
            ? (int) $m[1]
            : (int) ($item->tahun ?? date('Y'));

        $data = [
            'nama_instansi'         => $validated['nama_instansi'],
            'tahun'                 => $tahun,
            'tanggal_pelaksanaan'   => $validated['tanggal_pelaksanaan'],
            'tempat_pelaksanaan'    => $validated['tempat_pelaksanaan'],
            'total_peserta'         => (int) $validated['total_peserta'],
            'nama_penanggung_jawab' => $validated['nama_penanggung_jawab'],
            'no_telepon'            => $validated['no_telepon'],
        ];

        if ($request->hasFile('surat_perintah_tugas')) {
            $destinationPath = public_path('uploads/fire_drill');
            if (! file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            if ($item->surat_perintah_tugas && file_exists($destinationPath . '/' . $item->surat_perintah_tugas)) {
                unlink($destinationPath . '/' . $item->surat_perintah_tugas);
            }

            $file = $request->file('surat_perintah_tugas');
            $filename = time() . '_' . uniqid() . '_spt.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $filename);
            $data['surat_perintah_tugas'] = $filename;
        }

        $item->update($data);

        return redirect('/internal/pencegahan/inspeksi-kebakaran/fire-drill')
            ->with('success', 'Data Fire Drill berhasil diperbarui!');
    }

    public function destroyFireDrill($id)
    {
        $item = FireDrill::findOrFail($id);
        $destinationPath = public_path('uploads/fire_drill');

        if ($item->surat_perintah_tugas && file_exists($destinationPath . '/' . $item->surat_perintah_tugas)) {
            unlink($destinationPath . '/' . $item->surat_perintah_tugas);
        }

        $item->delete();

        return redirect()->back()->with('success', 'Data Fire Drill berhasil dihapus!');
    }

    private function bersihkanDaftarNama($rawText)
    {
        if (empty($rawText)) return [];
        return collect(preg_split('/\r\n|\r|\n/', (string) $rawText))
            ->map(function ($line) {
                return trim(preg_replace('/^\d+[\.\)\-\s]+/', '', trim($line)));
            })
            ->filter()
            ->values()
            ->all();
    }

    // ==========================================
    // BAGIAN PELATIHAN KELUARGA (DAMKAR GOES TO RT)
    // ==========================================
    public function indexPelatihanKeluarga()
    {
        $data_pelatihan = PelatihanKeluarga::orderBy('tanggal_pelaksanaan', 'desc')->get();
        return view('internal.pencegahan.pelatihan_keluarga', compact('data_pelatihan')); 
    }

    public function createPelatihanKeluarga()
    {
        return view('internal.pencegahan.tambah_pelatihan_keluarga'); 
    }

    public function storePelatihanKeluarga(Request $request)
    {
        $validated = $request->validate([
            'tanggal_pelaksanaan'    => 'required|date',
            'kecamatan'              => 'required|string|max:100',
            'kelurahan'              => 'required|string|max:100',
            'rt'                     => 'required|string|max:255',
            'peserta_laki_laki'      => 'required|integer|min:0',
            'peserta_perempuan'      => 'required|integer|min:0',
            'nama_peserta_laki_laki' => 'nullable|string',
            'nama_peserta_perempuan' => 'nullable|string',
            'link_dokumentasi'       => 'nullable|string|max:3000',
        ]);

        $links = $this->parseLinkDokumentasi($request->input('link_dokumentasi'));
        if ($links === false) {
            return back()->withInput()->withErrors([
                'link_dokumentasi' => 'Ada link yang tidak valid. Setiap link harus diawali http:// atau https://',
            ]);
        }

        $validated['link_dokumentasi'] = $links;

        $listLaki = $this->bersihkanDaftarNama($request->nama_peserta_laki_laki);
        $listPerempuan = $this->bersihkanDaftarNama($request->nama_peserta_perempuan);

        $validated['nama_peserta_laki_laki'] = count($listLaki) > 0 ? implode("\n", $listLaki) : null;
        $validated['nama_peserta_perempuan'] = count($listPerempuan) > 0 ? implode("\n", $listPerempuan) : null;

        PelatihanKeluarga::create($validated);

        return redirect()->route('pelatihan_keluarga.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function editPelatihanKeluarga($id)
    {
        $item = PelatihanKeluarga::findOrFail($id);
        return view('internal.pencegahan.edit_pelatihan_keluarga', compact('item')); 
    }

    public function updatePelatihanKeluarga(Request $request, $id)
    {
        $item = PelatihanKeluarga::findOrFail($id);

        $validated = $request->validate([
            'tanggal_pelaksanaan'    => 'required|date',
            'kecamatan'              => 'required|string|max:100',
            'kelurahan'              => 'required|string|max:100',
            'rt'                     => 'required|string|max:255',
            'peserta_laki_laki'      => 'required|integer|min:0',
            'peserta_perempuan'      => 'required|integer|min:0',
            'nama_peserta_laki_laki' => 'nullable|string',
            'nama_peserta_perempuan' => 'nullable|string',
            'link_dokumentasi'       => 'nullable|string|max:3000',
        ]);

        $links = $this->parseLinkDokumentasi($request->input('link_dokumentasi'));
        if ($links === false) {
            return back()->withInput()->withErrors([
                'link_dokumentasi' => 'Ada link yang tidak valid. Setiap link harus diawali http:// atau https://',
            ]);
        }

        $validated['link_dokumentasi'] = $links;

        $listLaki = $this->bersihkanDaftarNama($request->nama_peserta_laki_laki);
        $listPerempuan = $this->bersihkanDaftarNama($request->nama_peserta_perempuan);

        $validated['nama_peserta_laki_laki'] = count($listLaki) > 0 ? implode("\n", $listLaki) : null;
        $validated['nama_peserta_perempuan'] = count($listPerempuan) > 0 ? implode("\n", $listPerempuan) : null;

        $item->update($validated);

        return redirect()->route('pelatihan_keluarga.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroyPelatihanKeluarga($id)
    {
        $item = PelatihanKeluarga::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }

    private function parseLinkDokumentasi($raw)
    {
        $links = collect(preg_split('/\r\n|\r|\n/', (string) $raw))
            ->map(fn ($l) => trim($l))
            ->filter()
            ->values();

        foreach ($links as $l) {
            if (!preg_match('#^https?://#i', $l) || !filter_var($l, FILTER_VALIDATE_URL)) {
                return false;
            }
        }

        return $links->isEmpty() ? null : $links->implode("\n");
    }

    // ==========================================
    // FUNGSI DOWNLOAD EXCEL & PDF (INSPEKSI BANGUNAN)
    // ==========================================
    public function cetakExcelInspeksi(Request $request)
    {
        $tahunDipilih = $request->query('tahun');
        $jenisDipilih = $request->query('jenis');
        $hasTahunCol = \Illuminate\Support\Facades\Schema::hasColumn('inspeksi_bangunans', 'tahun');

        $query = InspeksiBangunan::query();

        if (filled($tahunDipilih)) {
            if ($hasTahunCol) {
                $query->where('tahun', (int) $tahunDipilih);
            } else {
                $query->whereYear('tanggal_inspeksi', (int) $tahunDipilih);
            }
        }
        if (filled($jenisDipilih)) {
            $query->whereRaw('LOWER(TRIM(jenis_usaha)) = ?', [strtolower(trim((string) $jenisDipilih))]);
        }

        $data = $query->orderBy('id', 'asc')->get();

        $labelFile = filled($tahunDipilih) ? "Tahun_{$tahunDipilih}" : 'Semua_Data';
        $filename = "Data_Inspeksi_Bangunan_{$labelFile}_" . date('Ymd') . '.xls';

        $headers = [
            'Content-Type'        => 'application/vnd.ms-excel; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Pragma'              => 'no-cache',
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Expires'             => '0',
        ];

        $esc = fn ($v) => htmlspecialchars((string) $v, ENT_XML1 | ENT_QUOTES, 'UTF-8');

        $callback = function () use ($data, $tahunDipilih, $esc) {
            echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
            echo '<?mso-application progid="Excel.Sheet"?>' . "\n";
            echo '<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
                    xmlns:o="urn:schemas-microsoft-com:office:office"
                    xmlns:x="urn:schemas-microsoft-com:office:excel"
                    xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet">' . "\n";

            echo '<Styles>
                    <Style ss:ID="Default" ss:Name="Normal">
                        <Alignment ss:Vertical="Center"/>
                        <Font ss:FontName="Arial" ss:Size="10"/>
                    </Style>
                    <Style ss:ID="sTitle">
                        <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
                        <Font ss:FontName="Arial" ss:Size="11" ss:Bold="1"/>
                    </Style>
                    <Style ss:ID="sHead">
                        <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
                        <Borders>
                            <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
                        </Borders>
                        <Font ss:FontName="Arial" ss:Size="9" ss:Bold="1" ss:Color="#FFFFFF"/>
                        <Interior ss:Color="#0D1B2A" ss:Pattern="Solid"/>
                    </Style>
                    <Style ss:ID="sText">
                        <Alignment ss:Horizontal="Left" ss:Vertical="Center" ss:WrapText="1"/>
                        <Borders>
                            <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
                        </Borders>
                        <Font ss:FontName="Arial" ss:Size="9"/>
                    </Style>
                    <Style ss:ID="sCenter">
                        <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
                        <Borders>
                            <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
                        </Borders>
                        <Font ss:FontName="Arial" ss:Size="9"/>
                    </Style>
                    <Style ss:ID="sTotal">
                        <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
                        <Borders>
                            <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
                        </Borders>
                        <Font ss:FontName="Arial" ss:Size="9" ss:Bold="1"/>
                        <Interior ss:Color="#F2F2F2" ss:Pattern="Solid"/>
                    </Style>
                  </Styles>' . "\n";

            $columns = [
                ['label' => 'NO',                        'width' => 40],
                ['label' => 'NAMA BANGUNAN',             'width' => 150],
                ['label' => 'JENIS BANGUNAN',            'width' => 110],
                ['label' => 'KUALIFIKASI BANGUNAN',      'width' => 110],
                ['label' => 'RESIKO KEBAKARAN',          'width' => 110],
                ['label' => 'LUAS BANGUNAN',             'width' => 100],
                ['label' => 'ALAMAT',                    'width' => 160],
                ['label' => 'NAMA PENANGGUNG JAWAB',     'width' => 140],
                ['label' => 'NO TELFON',                 'width' => 110],
                ['label' => 'SISTEM PROTEKSI KEBAKARAN', 'width' => 160],
                ['label' => 'TANGGAL PEMERIKSAAN',       'width' => 110],
                ['label' => 'UPLOAD SPT',                'width' => 180],
                ['label' => 'UPLOAD REKOMENDASI',        'width' => 180],
            ];
            $mergeAcross = count($columns) - 1;

            $tgl = function ($nilai) {
                $nilai = trim((string) $nilai);
                if ($nilai === '') {
                    return '-';
                }

                return preg_match('/^\d{4}-\d{2}-\d{2}/', $nilai)
                    ? \Carbon\Carbon::parse($nilai)->format('d-m-Y')
                    : $nilai;
            };

            $sheetName = filled($tahunDipilih) ? 'Tahun ' . $tahunDipilih : 'Inspeksi Bangunan';
            $subTahun = filled($tahunDipilih) ? 'TAHUN ' . $esc($tahunDipilih) : 'SEMUA TAHUN';

            echo '<Worksheet ss:Name="' . $esc($sheetName) . '"><Table>' . "\n";

            foreach ($columns as $col) {
                echo '<Column ss:Width="' . $col['width'] . '"/>' . "\n";
            }

            echo '<Row ss:Height="18"><Cell ss:MergeAcross="' . $mergeAcross . '" ss:StyleID="sTitle"><Data ss:Type="String">DATA INSPEKSI KEBAKARAN BANGUNAN GEDUNG DAN LINGKUNGAN</Data></Cell></Row>' . "\n";
            echo '<Row ss:Height="18"><Cell ss:MergeAcross="' . $mergeAcross . '" ss:StyleID="sTitle"><Data ss:Type="String">DINAS PEMADAM KEBAKARAN DAN PENYELAMATAN KOTA JAMBI (' . $subTahun . ')</Data></Cell></Row>' . "\n";
            echo '<Row ss:Height="10"></Row>' . "\n";

            echo '<Row ss:Height="28">' . "\n";
            foreach ($columns as $col) {
                echo '<Cell ss:StyleID="sHead"><Data ss:Type="String">' . $esc($col['label']) . '</Data></Cell>' . "\n";
            }
            echo '</Row>' . "\n";

            if ($data->isEmpty()) {
                echo '<Row ss:Height="24"><Cell ss:MergeAcross="' . $mergeAcross . '" ss:StyleID="sCenter"><Data ss:Type="String">Belum ada data Inspeksi Bangunan</Data></Cell></Row>' . "\n";
            } else {
                foreach ($data as $index => $row) {
                    $linkSpt = ! empty($row->surat_perintah_tugas) ? asset('uploads/inspeksi/' . $row->surat_perintah_tugas) : '-';
                    $linkRekom = ! empty($row->rekomendasi) ? asset('uploads/inspeksi/' . $row->rekomendasi) : '-';

                    echo '<Row ss:AutoFitHeight="1">
                            <Cell ss:StyleID="sCenter"><Data ss:Type="Number">' . ($index + 1) . '</Data></Cell>
                            <Cell ss:StyleID="sText"><Data ss:Type="String">' . $esc($row->nama_tempat ?? '-') . '</Data></Cell>
                            <Cell ss:StyleID="sText"><Data ss:Type="String">' . $esc($row->jenis_usaha ?? '-') . '</Data></Cell>
                            <Cell ss:StyleID="sCenter"><Data ss:Type="String">' . $esc($row->kualifikasi_bangunan ?? '-') . '</Data></Cell>
                            <Cell ss:StyleID="sCenter"><Data ss:Type="String">' . $esc($row->resiko_kebakaran ?? '-') . '</Data></Cell>
                            <Cell ss:StyleID="sCenter"><Data ss:Type="String">' . $esc($row->luas_bangunan ?? '-') . '</Data></Cell>
                            <Cell ss:StyleID="sText"><Data ss:Type="String">' . $esc($row->alamat ?? '-') . '</Data></Cell>
                            <Cell ss:StyleID="sText"><Data ss:Type="String">' . $esc($row->nama_penanggung_jawab ?? '-') . '</Data></Cell>
                            <Cell ss:StyleID="sCenter"><Data ss:Type="String">' . $esc($row->no_telepon ?? '-') . '</Data></Cell>
                            <Cell ss:StyleID="sCenter"><Data ss:Type="String">' . $esc($row->sistem_proteksi_kebakaran ?? '-') . '</Data></Cell>
                            <Cell ss:StyleID="sCenter"><Data ss:Type="String">' . $esc($tgl($row->tanggal_inspeksi ?? null)) . '</Data></Cell>
                            <Cell ss:StyleID="sText"><Data ss:Type="String">' . $esc($linkSpt) . '</Data></Cell>
                            <Cell ss:StyleID="sText"><Data ss:Type="String">' . $esc($linkRekom) . '</Data></Cell>
                          </Row>' . "\n";
                }
            }

            echo '<Row ss:Height="22">
                    <Cell ss:MergeAcross="' . $mergeAcross . '" ss:StyleID="sTotal"><Data ss:Type="String">TOTAL DATA INSPEKSI BANGUNAN: ' . $data->count() . ' BANGUNAN</Data></Cell>
                  </Row>' . "\n";

            echo '</Table></Worksheet></Workbook>';
        };

        return response()->stream($callback, 200, $headers);
    }

    public function cetakPdfInspeksi(Request $request)
    {
        $tahunDipilih = $request->query('tahun');
        $jenisDipilih = $request->query('jenis');
        $hasTahunCol = \Illuminate\Support\Facades\Schema::hasColumn('inspeksi_bangunans', 'tahun');

        $query = InspeksiBangunan::query();

        if (filled($tahunDipilih)) {
            if ($hasTahunCol) {
                $query->where('tahun', (int) $tahunDipilih);
            } else {
                $query->whereYear('tanggal_inspeksi', (int) $tahunDipilih);
            }
        }
        if (filled($jenisDipilih)) {
            $query->whereRaw('LOWER(TRIM(jenis_usaha)) = ?', [strtolower(trim((string) $jenisDipilih))]);
        }

        $data = $query->orderBy('id', 'asc')->get();

        return view('internal.pencegahan.cetak_pdf_inspeksi', compact('data', 'tahunDipilih', 'jenisDipilih'));
    }

    // ==========================================
    // FUNGSI DOWNLOAD EXCEL & PDF (FIRE DRILL)
    // ==========================================
    public function cetakExcelFireDrill(Request $request)
    {
        $tahunDipilih = $request->query('tahun');
        $instansiDipilih = $request->query('instansi');

        $query = FireDrill::query();

        if (filled($tahunDipilih)) {
            $query->where('tahun', (int) $tahunDipilih);
        }
        if (filled($instansiDipilih)) {
            $query->whereRaw('LOWER(nama_instansi) = ?', [strtolower($instansiDipilih)]);
        }

        $data = $query->orderBy('id', 'asc')->get();

        $labelFile = filled($tahunDipilih) ? "Tahun_{$tahunDipilih}" : 'Semua_Data';
        $filename = "Data_Fire_Drill_{$labelFile}_" . date('Ymd') . '.xls';

        $headers = [
            'Content-Type'        => 'application/vnd.ms-excel; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Pragma'              => 'no-cache',
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Expires'             => '0',
        ];

        $esc = fn ($v) => htmlspecialchars((string) $v, ENT_XML1 | ENT_QUOTES, 'UTF-8');

        $callback = function () use ($data, $tahunDipilih, $esc) {
            echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
            echo '<?mso-application progid="Excel.Sheet"?>' . "\n";
            echo '<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
                    xmlns:o="urn:schemas-microsoft-com:office:office"
                    xmlns:x="urn:schemas-microsoft-com:office:excel"
                    xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet">' . "\n";

            echo '<Styles>
                    <Style ss:ID="Default" ss:Name="Normal">
                        <Alignment ss:Vertical="Center"/>
                        <Font ss:FontName="Arial" ss:Size="10"/>
                    </Style>
                    <Style ss:ID="sTitle">
                        <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
                        <Font ss:FontName="Arial" ss:Size="11" ss:Bold="1"/>
                    </Style>
                    <Style ss:ID="sHead">
                        <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
                        <Borders>
                            <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
                        </Borders>
                        <Font ss:FontName="Arial" ss:Size="9" ss:Bold="1" ss:Color="#FFFFFF"/>
                        <Interior ss:Color="#0D1B2A" ss:Pattern="Solid"/>
                    </Style>
                    <Style ss:ID="sText">
                        <Alignment ss:Horizontal="Left" ss:Vertical="Center" ss:WrapText="1"/>
                        <Borders>
                            <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
                        </Borders>
                        <Font ss:FontName="Arial" ss:Size="9"/>
                    </Style>
                    <Style ss:ID="sCenter">
                        <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
                        <Borders>
                            <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
                        </Borders>
                        <Font ss:FontName="Arial" ss:Size="9"/>
                    </Style>
                    <Style ss:ID="sTotal">
                        <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
                        <Borders>
                            <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
                            <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
                        </Borders>
                        <Font ss:FontName="Arial" ss:Size="9" ss:Bold="1"/>
                        <Interior ss:Color="#F2F2F2" ss:Pattern="Solid"/>
                    </Style>
                  </Styles>' . "\n";

            $columns = [
                ['label' => 'NO',                               'width' => 40],
                ['label' => 'NAMA INSTANSI/LEMBAGA',            'width' => 180],
                ['label' => 'TANGGAL PELAKSANAAN',              'width' => 130],
                ['label' => 'TEMPAT PELAKSANAAN',               'width' => 160],
                ['label' => 'JUMLAH PESERTA',                   'width' => 95],
                ['label' => 'NAMA PENANGGUNG JAWAB',            'width' => 140],
                ['label' => 'NO TELFON/WA PENANGGUNG JAWAB',    'width' => 150],
                ['label' => 'UPLOAD SPT',                       'width' => 190],
            ];
            $mergeAcross = count($columns) - 1;
            $sheetName = filled($tahunDipilih) ? 'Tahun ' . $tahunDipilih : 'Fire Drill';
            $subTahun = filled($tahunDipilih) ? 'TAHUN ' . $esc($tahunDipilih) : 'SEMUA TAHUN';

            echo '<Worksheet ss:Name="' . $esc($sheetName) . '"><Table>' . "\n";

            foreach ($columns as $col) {
                echo '<Column ss:Width="' . $col['width'] . '"/>' . "\n";
            }

            echo '<Row ss:Height="18"><Cell ss:MergeAcross="' . $mergeAcross . '" ss:StyleID="sTitle"><Data ss:Type="String">DATA PELAKSANAAN PELATIHAN PEMADAM KEBAKARAN (FIRE DRILL)</Data></Cell></Row>' . "\n";
            echo '<Row ss:Height="18"><Cell ss:MergeAcross="' . $mergeAcross . '" ss:StyleID="sTitle"><Data ss:Type="String">DINAS PEMADAM KEBAKARAN DAN PENYELAMATAN KOTA JAMBI (' . $subTahun . ')</Data></Cell></Row>' . "\n";
            echo '<Row ss:Height="10"></Row>' . "\n";

            echo '<Row ss:Height="28">' . "\n";
            foreach ($columns as $col) {
                echo '<Cell ss:StyleID="sHead"><Data ss:Type="String">' . $esc($col['label']) . '</Data></Cell>' . "\n";
            }
            echo '</Row>' . "\n";

            $sumPeserta = 0;

            if ($data->isEmpty()) {
                echo '<Row ss:Height="24"><Cell ss:MergeAcross="' . $mergeAcross . '" ss:StyleID="sCenter"><Data ss:Type="String">Belum ada data Fire Drill</Data></Cell></Row>' . "\n";
            } else {
                foreach ($data as $index => $row) {
                    $jml = (int) ($row->total_peserta ?? 0);
                    $sumPeserta += $jml;
                    $linkSpt = ! empty($row->surat_perintah_tugas) ? asset('uploads/fire_drill/' . $row->surat_perintah_tugas) : '-';

                    echo '<Row ss:AutoFitHeight="1">
                            <Cell ss:StyleID="sCenter"><Data ss:Type="Number">' . ($index + 1) . '</Data></Cell>
                            <Cell ss:StyleID="sText"><Data ss:Type="String">' . $esc($row->nama_instansi ?? '-') . '</Data></Cell>
                            <Cell ss:StyleID="sCenter"><Data ss:Type="String">' . $esc($row->tanggal_pelaksanaan ?? '-') . '</Data></Cell>
                            <Cell ss:StyleID="sText"><Data ss:Type="String">' . $esc($row->tempat_pelaksanaan ?? '-') . '</Data></Cell>
                            <Cell ss:StyleID="sCenter"><Data ss:Type="Number">' . $jml . '</Data></Cell>
                            <Cell ss:StyleID="sText"><Data ss:Type="String">' . $esc($row->nama_penanggung_jawab ?? '-') . '</Data></Cell>
                            <Cell ss:StyleID="sCenter"><Data ss:Type="String">' . $esc($row->no_telepon ?? '-') . '</Data></Cell>
                            <Cell ss:StyleID="sText"><Data ss:Type="String">' . $esc($linkSpt) . '</Data></Cell>
                          </Row>' . "\n";
                }
            }

            echo '<Row ss:Height="22">
                    <Cell ss:MergeAcross="3" ss:StyleID="sTotal"><Data ss:Type="String">JUMLAH TOTAL (' . $data->count() . ' INSTANSI)</Data></Cell>
                    <Cell ss:StyleID="sTotal"><Data ss:Type="Number">' . $sumPeserta . '</Data></Cell>
                    <Cell ss:MergeAcross="2" ss:StyleID="sTotal"><Data ss:Type="String"></Data></Cell>
                  </Row>' . "\n";

            echo '</Table></Worksheet></Workbook>';
        };

        return response()->stream($callback, 200, $headers);
    }

    public function cetak(Request $request)
    {
        $tahunDipilih = $request->query('tahun');
        $instansiDipilih = $request->query('instansi');

        $query = FireDrill::query();

        if (filled($tahunDipilih)) {
            $query->where('tahun', (int) $tahunDipilih);
        }
        if (filled($instansiDipilih)) {
            $query->whereRaw('LOWER(nama_instansi) = ?', [strtolower($instansiDipilih)]);
        }

        $data = $query->orderBy('id', 'asc')->get();

        return view('internal.pencegahan.cetak_pdf_fire_drill', compact('data', 'tahunDipilih', 'instansiDipilih'));
    }

   // ==========================================
    // BAGIAN KUNJUNGAN SEKOLAH
    // ==========================================
    public function indexKunjungan()
    {
        $koleksiData = KunjunganSekolah::orderBy('created_at', 'desc')->get()->map(function($item) {
            // Deteksi tahun dari string tanggal (contoh: "14 dan 15 Januari 2026")
            preg_match('/\d{4}/', $item->tanggal_kunjungan, $matches);
            $item->tahun_parsed = !empty($matches) ? $matches[0] : date('Y');
            return $item;
        });

        $groupedByYear = $koleksiData->sortByDesc('tahun_parsed')->groupBy('tahun_parsed');
        $daftar_tahun = $groupedByYear->keys()->sortDesc()->values();

        return view('internal.pencegahan.kunjungan_sekolah', compact('koleksiData', 'groupedByYear', 'daftar_tahun'));
    }

    public function createKunjungan()
    {
        return view('internal.pencegahan.tambah_kunjungan_sekolah');
    }

    public function storeKunjungan(Request $request)
    {
        $validated = $request->validate([
            'nama_sekolah'      => 'required|string|max:255',
            'tanggal_kunjungan' => 'required|string|max:255',
            'siswa_perempuan'   => 'required|integer|min:0',
            'siswa_laki_laki'   => 'required|integer|min:0',
            'guru'              => 'required|integer|min:0',
            'orang_tua'         => 'required|integer|min:0',
        ]);

        $validated['total_kunjungan'] = $validated['siswa_perempuan'] + $validated['siswa_laki_laki'] + $validated['guru'] + $validated['orang_tua'];

        KunjunganSekolah::create($validated);

        return redirect()->route('kunjungan_sekolah.index')->with('success', 'Data Kunjungan Sekolah berhasil ditambahkan!');
    }

    public function editKunjungan($id)
    {
        $item = KunjunganSekolah::findOrFail($id);
        return view('internal.pencegahan.edit_kunjungan_sekolah', compact('item'));
    }

    public function updateKunjungan(Request $request, $id)
    {
        $item = KunjunganSekolah::findOrFail($id);

        $validated = $request->validate([
            'nama_sekolah'      => 'required|string|max:255',
            'tanggal_kunjungan' => 'required|string|max:255',
            'siswa_perempuan'   => 'required|integer|min:0',
            'siswa_laki_laki'   => 'required|integer|min:0',
            'guru'              => 'required|integer|min:0',
            'orang_tua'         => 'required|integer|min:0',
        ]);

        $validated['total_kunjungan'] = $validated['siswa_perempuan'] + $validated['siswa_laki_laki'] + $validated['guru'] + $validated['orang_tua'];

        $item->update($validated);

        return redirect()->route('kunjungan_sekolah.index')->with('success', 'Data Kunjungan Sekolah berhasil diperbarui!');
    }

    public function destroyKunjungan($id)
    {
        $item = KunjunganSekolah::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'Data Kunjungan Sekolah berhasil dihapus!');
    }

    public function cetakKunjungan(Request $request)
    {
        $tahunDipilih = $request->query('tahun');
        $query = KunjunganSekolah::query();

        if (filled($tahunDipilih)) {
            $query->where('tanggal_kunjungan', 'like', "%{$tahunDipilih}%");
        }

        $data = $query->orderBy('created_at', 'desc')->get();
        return view('internal.pencegahan.cetak_pdf_kunjungan', compact('data', 'tahunDipilih'));
    }

    public function cetakExcelKunjungan(Request $request)
    {
        $tahunDipilih = $request->query('tahun');
        $query = KunjunganSekolah::query();

        if (filled($tahunDipilih)) {
            $query->where('tanggal_kunjungan', 'like', "%{$tahunDipilih}%");
        }

        $data = $query->orderBy('created_at', 'desc')->get();
        $filename = "Data_Kunjungan_Sekolah" . ($tahunDipilih ? "_Tahun_{$tahunDipilih}" : "") . "_" . date('Ymd') . ".xls";

        $html = '<table border="1" cellpadding="5" cellspacing="0">
                    <thead>
                        <tr>
                            <th rowspan="2" style="background-color: #0f172a; color: white;">NO</th>
                            <th rowspan="2" style="background-color: #0f172a; color: white;">NAMA SEKOLAH</th>
                            <th rowspan="2" style="background-color: #0f172a; color: white;">TANGGAL</th>
                            <th colspan="4" style="background-color: #0f172a; color: white;">BANYAK KUNJUNGAN</th>
                            <th rowspan="2" style="background-color: #0f172a; color: white;">TOTAL</th>
                        </tr>
                        <tr>
                            <th style="background-color: #0f172a; color: white;">SISWA PEREMPUAN</th>
                            <th style="background-color: #0f172a; color: white;">SISWA LAKI-LAKI</th>
                            <th style="background-color: #0f172a; color: white;">GURU</th>
                            <th style="background-color: #0f172a; color: white;">ORANG TUA</th>
                        </tr>
                    </thead>
                    <tbody>';

        foreach ($data as $index => $row) {
            $html .= '<tr>
                        <td>' . ($index + 1) . '</td>
                        <td>' . e($row->nama_sekolah) . '</td>
                        <td>' . e($row->tanggal_kunjungan) . '</td>
                        <td>' . $row->siswa_perempuan . '</td>
                        <td>' . $row->siswa_laki_laki . '</td>
                        <td>' . $row->guru . '</td>
                        <td>' . $row->orang_tua . '</td>
                        <td>' . $row->total_kunjungan . '</td>
                      </tr>';
        }

        $html .= '</tbody></table>';

        return response($html)
            ->header('Content-Type', 'application/vnd.ms-excel')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }
}