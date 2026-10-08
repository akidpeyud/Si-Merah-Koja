<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak PDF - Inspeksi Bangunan | SIMERAH KOJA</title>
    <style>
        @page { size: A4 landscape; margin: 12mm; }
        * { box-sizing: border-box; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        body { font-family: 'Times New Roman', Times, serif; font-size: 12px; color: #000; margin: 0; }

        /* KOP SURAT */
        .kop-surat { width: 100%; border-bottom: 4px double #000; padding-bottom: 8px; margin-bottom: 12px; border-collapse: collapse; }
        .kop-surat td { border: none; padding: 0; vertical-align: middle; }
        .logo-kiri { text-align: left; width: 12%; }
        .logo-kanan { text-align: right; width: 12%; }
        .teks-tengah { text-align: center; width: 76%; line-height: 1.3; }
        .teks-tengah .pemerintah { font-size: 15px; font-family: Arial, sans-serif; }
        .teks-tengah .dinas { font-size: 22px; font-weight: bold; font-family: Arial, sans-serif; }
        .teks-tengah .alamat { font-size: 12px; font-family: Arial, sans-serif; }

        .judul-dokumen { text-align: center; font-weight: bold; font-size: 13px; margin-bottom: 14px; line-height: 1.5; font-family: Arial, sans-serif; }

        /* TABEL */
        .table-data { width: 100%; border-collapse: collapse; table-layout: fixed; font-family: Arial, sans-serif; font-size: 11px; }
        .table-data th, .table-data td { border: 1px solid #000; padding: 6px 8px; text-align: left; vertical-align: top; word-wrap: break-word; overflow-wrap: anywhere; }
        .table-data th { background-color: #e9ecef; text-align: center; font-weight: bold; vertical-align: middle; text-transform: uppercase; }
        .table-data thead { display: table-header-group; }
        .table-data tr { page-break-inside: avoid; }
        .text-center { text-align: center; }

        /* BADGE DOKUMEN (sama dengan web) */
        .dok-badge { display: inline-block; padding: 3px 8px; margin: 0 3px 3px 0; border-radius: 4px; color: #fff; font-size: 9px; font-weight: bold; letter-spacing: .03em; text-transform: uppercase; }
        .dok-spt   { background: #3b82f6; }
        .dok-ba    { background: #10b981; }
        .dok-nilai { background: #06b6d4; }
        .dok-rekom { background: #8b5cf6; }
        .dok-skk   { background: #ef4444; }

        .ringkasan { margin-top: 10px; font-family: Arial, sans-serif; font-size: 11px; }
        .cetak-info { margin-top: 4px; font-family: Arial, sans-serif; font-size: 9px; color: #444; }

        /* DOKUMEN DI DALAM KOLOM TABEL: 5 thumbnail sejajar */
        .td-dok { padding: 4px 5px !important; }
        .dok-row { display: flex; gap: 1.5mm; }
        .dok-slot { flex: 1 1 0; min-width: 0; text-align: center; }
        .dok-thumb { height: 24mm; display: flex; align-items: center; justify-content: center; background: #f1f3f6; border: 1px solid #c5cad3; border-radius: 2px; overflow: hidden; }
        .dok-thumb img { max-width: 100%; max-height: 24mm; width: auto; height: auto; display: block; }
        .dok-thumb.kosong { background: #fafbfc; border: 1px dashed #c5cad3; }
        .dok-thumb .pdf { font-size: 8px; font-weight: bold; color: #555; }
        .dok-slot .dok-badge { display: block; margin: 1mm 0 0; padding: 1.5px 0; font-size: 7.5px; border-radius: 2px; text-align: center; }
        .dok-slot.kosong .dok-badge { opacity: .3; }
        .tidak-ada { color: #888; font-style: italic; text-align: center; font-size: 10px; }

        /* LAMPIRAN: 1 BANGUNAN = 1 HALAMAN (grid 3 x 2, ukuran tetap) */
        .lp-page { page-break-before: always; height: 182mm; overflow: hidden; font-family: Arial, sans-serif; }
        .lp-head { display: flex; justify-content: space-between; align-items: center; height: 11mm; border-bottom: 2px solid #000; margin-bottom: 3mm; }
        .lp-title { font-weight: bold; font-size: 12px; text-transform: uppercase; letter-spacing: .02em; }
        .lp-count { font-size: 10px; color: #333; }
        .lp-grid { display: grid; grid-template-columns: repeat(3, 1fr); grid-template-rows: 80mm 80mm; gap: 3mm; }
        .lp-box { border: 1px solid #8a8f98; border-radius: 3px; padding: 2mm; overflow: hidden; background: #fff; }
        .lp-cap { height: 7mm; display: flex; align-items: center; gap: 6px; font-size: 10px; font-weight: bold; }
        .lp-cap .dok-badge { margin: 0; }
        .lp-img { height: 66mm; display: flex; align-items: center; justify-content: center; background: #f1f3f6; border-radius: 2px; overflow: hidden; }
        .lp-img img { max-width: 100%; max-height: 66mm; width: auto; height: auto; display: block; }
        .lp-img .nonimg { font-size: 10px; color: #444; text-align: center; padding: 8px; word-break: break-all; }
        .lp-empty { border: 1px dashed #aab0b8; color: #8a8f98; font-size: 10px; background: #fafbfc; }
        .lp-info { background: #f8f9fb; }
        .lp-info h4 { font-size: 13px; margin: 0 0 2mm; line-height: 1.25; }
        .lp-info table { width: 100%; border-collapse: collapse; font-size: 10px; }
        .lp-info td { border: 0; padding: 1.5mm 0; vertical-align: top; }
        .lp-info td:first-child { width: 34%; color: #555; }
        .lp-check { margin-top: 3mm; font-size: 10px; }
        .lp-check div { display: flex; align-items: center; gap: 6px; margin-bottom: 1.2mm; }
        .lp-ok { color: #198754; font-weight: bold; }
        .lp-no { color: #b0b5bd; }
    </style>
</head>
<body>

    @php
        // kode => [label badge, nama lengkap, kelas warna]
        $dokMeta = [
            'spt'   => ['SPT',   'Surat Perintah Tugas',                      'dok-spt'],
            'ba'    => ['BA',    'Berita Acara',                              'dok-ba'],
            'nilai' => ['NILAI', 'Hasil Penilaian',                           'dok-nilai'],
            'rekom' => ['REKOM', 'Rekomendasi',                               'dok-rekom'],
            'skk'   => ['SKK',   'SKK (Sertifikat Keselamatan Kebakaran)',    'dok-skk'],
        ];

        // Ubah nilai tersimpan menjadi URL: /uploads/inspeksi/<nama-file>
        $urlDok = function ($v) {
            $v = trim((string) $v);
            if (\Illuminate\Support\Str::startsWith($v, ['http://', 'https://'])) return $v;
            $v = ltrim($v, '/');
            if (!\Illuminate\Support\Str::startsWith($v, ['uploads/', 'storage/'])) $v = 'uploads/inspeksi/' . $v;
            return asset($v);
        };

        // Cari semua dokumen milik satu baris data, apa pun nama kolomnya.
        // File dikenali dari akhiran nama file: ..._spt.png, ..._ba.jpg, ..._nilai.jpeg, ..._rekom.png, ..._skk.png
        $cariDok = function ($item) use ($dokMeta, $urlDok) {
            $attrs = method_exists($item, 'getAttributes') ? $item->getAttributes() : (array) $item;
            $hasil = [];
            foreach ($attrs as $key => $val) {
                if (!is_string($val) || $val === '') continue;
                $vals = [$val];
                $dec = json_decode($val, true);
                if (is_array($dec)) {
                    $vals = collect($dec)->flatten()->filter(fn ($x) => is_string($x) && $x !== '')->all();
                }
                foreach ($vals as $v) {
                    $tipe = null;
                    if (preg_match('/_(spt|ba|nilai|rekom|skk)\.[A-Za-z0-9]+$/i', $v, $m)) {
                        $tipe = strtolower($m[1]);
                    } elseif (preg_match('/\.(jpe?g|png|gif|webp|pdf)$/i', $v)) {
                        foreach (array_keys($dokMeta) as $t) {
                            if (preg_match('/(^|_)(file|dokumen|dok|doc|upload|lampiran)?_?' . $t . '(_file|_path)?$/i', $key)) { $tipe = $t; break; }
                        }
                    }
                    if ($tipe && !isset($hasil[$tipe])) $hasil[$tipe] = $urlDok($v);
                }
            }
            return $hasil;   // contoh: ['spt' => url, 'nilai' => url]
        };

        $dokData = collect($data)->map(fn ($it) => $cariDok($it));
    @endphp

    <!-- KOP SURAT -->
    <table class="kop-surat">
        <tr>
            <td class="logo-kiri"><img src="/images/jambi.png" alt="Logo Jambi" style="width: 75px; height: auto;"></td>
            <td class="teks-tengah">
                <span class="pemerintah">PEMERINTAH KOTA JAMBI</span><br>
                <span class="dinas">DINAS PEMADAM KEBAKARAN DAN<br>PENYELAMATAN</span><br>
                <span class="alamat">Jl, HOS Cokroaminoto No, 113 Telp. 0741-41171</span>
            </td>
            <td class="logo-kanan"><img src="/images/logo.png" alt="Logo Damkar" style="width: 75px; height: auto;"></td>
        </tr>
    </table>

    <div class="judul-dokumen">
        DATA INSPEKSI KEBAKARAN (BANGUNAN &amp; GEDUNG)<br>
        TAHUN {{ date('Y') }}
    </div>

    <!-- TABEL DATA -->
    <table class="table-data">
        <colgroup>
            <col style="width:4%">
            <col style="width:17%">
            <col style="width:10%">
            <col style="width:15%">
            <col style="width:54%">
        </colgroup>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Tempat</th>
                <th>Bulan / Tanggal Inspeksi</th>
                <th>Jenis Usaha</th>
                <th>Dokumen Terlampir</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $item)
            @php $docs = $dokData[$index] ?? []; @endphp
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $item->nama_tempat ?? '-' }}</td>
                <td class="text-center">{{ $item->tanggal_inspeksi ?? '-' }}</td>
                <td>{{ $item->jenis_usaha ?? '-' }}</td>
                <td class="td-dok">
                    @if(!empty($docs))
                    <div class="dok-row">
                        @foreach($dokMeta as $kode => $meta)
                            @php $ada = isset($docs[$kode]); @endphp
                            <div class="dok-slot {{ $ada ? '' : 'kosong' }}">
                                <div class="dok-thumb {{ $ada ? '' : 'kosong' }}">
                                    @if($ada)
                                        @if(preg_match('/\.(jpe?g|png|gif|webp|bmp)(\?.*)?$/i', $docs[$kode]))
                                            <img src="{{ $docs[$kode] }}" alt="{{ $meta[1] }}"
                                                 onerror="this.outerHTML='<span class=&quot;pdf&quot;>Gagal muat</span>'">
                                        @else
                                            <span class="pdf">{{ strtoupper(pathinfo($docs[$kode], PATHINFO_EXTENSION)) }}</span>
                                        @endif
                                    @endif
                                </div>
                                <span class="dok-badge {{ $meta[2] }}">{{ $meta[0] }}</span>
                            </div>
                        @endforeach
                    </div>
                    @else
                        <div class="tidak-ada">Tidak ada dokumen</div>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center">Belum ada data Inspeksi Bangunan</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="ringkasan"><strong>Total data:</strong> {{ count($data) }} bangunan</div>
    <div class="cetak-info">Dicetak pada {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d F Y, H:i') }} WIB melalui SIMERAH KOJA</div>

    <!-- ====== LAMPIRAN BESAR (opsional): tambahkan ?lampiran=1 pada URL cetak ====== -->
    @if(request()->boolean('lampiran'))
    @php
        $punyaDok = $dokData->filter(fn ($d) => !empty($d))->keys()->values();
        $totalLampiran = $punyaDok->count();
        $urut = 0;
        $urutan = ['spt', 'ba', 'nilai', 'rekom', 'skk'];
    @endphp

    @foreach($data as $index => $item)
        @php $docs = $dokData[$index] ?? []; @endphp
        @if(!empty($docs))
        @php $urut++; @endphp
        <section class="lp-page">
            <div class="lp-head">
                <span class="lp-title">Lampiran Dokumen Inspeksi Bangunan &amp; Gedung</span>
                <span class="lp-count">Data No. {{ $loop->iteration }} pada tabel &middot; Lampiran {{ $urut }} dari {{ $totalLampiran }}</span>
            </div>

            <div class="lp-grid">
                @foreach($urutan as $kode)
                    @php $meta = $dokMeta[$kode]; @endphp
                    <div class="lp-box">
                        <div class="lp-cap"><span class="dok-badge {{ $meta[2] }}">{{ $meta[0] }}</span> {{ $meta[1] }}</div>
                        @if(isset($docs[$kode]))
                            <div class="lp-img">
                                @if(preg_match('/\.(jpe?g|png|gif|webp|bmp)(\?.*)?$/i', $docs[$kode]))
                                    <img src="{{ $docs[$kode] }}" alt="{{ $meta[1] }}"
                                         onerror="this.outerHTML='<div class=&quot;nonimg&quot;>Gambar tidak dapat dimuat</div>'">
                                @else
                                    <div class="nonimg">File {{ strtoupper(pathinfo($docs[$kode], PATHINFO_EXTENSION)) }}<br>{{ basename($docs[$kode]) }}</div>
                                @endif
                            </div>
                        @else
                            <div class="lp-img lp-empty">Belum diupload</div>
                        @endif
                    </div>
                @endforeach

                {{-- Kartu info bangunan (mengisi kotak ke-6) --}}
                <div class="lp-box lp-info">
                    <h4>{{ $item->nama_tempat ?? '-' }}</h4>
                    <table>
                        <tr><td>Tgl inspeksi</td><td>{{ $item->tanggal_inspeksi ?? '-' }}</td></tr>
                        <tr><td>Jenis usaha</td><td>{{ $item->jenis_usaha ?? '-' }}</td></tr>
                        <tr><td>Kelengkapan</td><td><strong>{{ count($docs) }} dari 5</strong> dokumen</td></tr>
                    </table>
                    <div class="lp-check">
                        @foreach($urutan as $kode)
                            <div>
                                @if(isset($docs[$kode]))<span class="lp-ok">&#10003;</span>@else<span class="lp-no">&#10007;</span>@endif
                                <span>{{ $dokMeta[$kode][1] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        @endif
    @endforeach
    @endif

    <script>window.onload = function () { window.print(); }</script>
</body>
</html>