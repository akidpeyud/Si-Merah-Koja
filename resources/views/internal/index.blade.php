@extends('layouts.dashboard')

@section('title', 'Dashboard Utama')

@section('content')
<style>
    /* Di-scope ke .dash-index; memakai token warna & font dari layouts/dashboard */
    .dash-index { padding-bottom: 1rem; }

    .dash-index .tone-blue   { --t: var(--navy);   --t-soft: var(--navy-soft); }
    .dash-index .tone-red    { --t: var(--signal); --t-soft: var(--signal-soft); }
    .dash-index .tone-orange { --t: #ea580c;       --t-soft: rgba(234,88,12,.10); }
    .dash-index .tone-amber  { --t: #b7791f;       --t-soft: rgba(244,183,64,.22); }
    .dash-index .tone-green  { --t: var(--success);--t-soft: rgba(25,135,84,.10); }
    .dash-index .tone-violet { --t: #7c3aed;       --t-soft: rgba(124,58,237,.10); }
    .dash-index .tone-slate  { --t: var(--steel);  --t-soft: rgba(100,116,139,.12); }

    .dash-index .page-head h1 { font-family: var(--font-display); font-size: clamp(1.7rem, 3vw, 2.3rem); font-weight: 700; letter-spacing: -.02em; line-height: 1.15; }
    .dash-index .page-head p  { margin-top: 6px; color: var(--steel); }

    /* Welcome */
    .dash-index .welcome { margin-top: 24px; padding: clamp(20px, 3vw, 30px); border-radius: var(--r-lg); color: #fff;
        background: linear-gradient(135deg, var(--ink) 0%, var(--ink-3) 100%); box-shadow: var(--shadow-md); }
    .dash-index .welcome-date { display: inline-flex; align-items: center; gap: 8px; font-size: .78rem; font-weight: 600; padding: 5px 13px;
        border-radius: 999px; background: rgba(255,255,255,.10); border: 1px solid rgba(255,255,255,.12); }
    .dash-index .welcome h2 { margin-top: 14px; font-family: var(--font-display); font-size: clamp(1.4rem, 2.6vw, 1.9rem); font-weight: 700; }
    .dash-index .welcome-sub { margin-top: 4px; color: rgba(255,255,255,.72); font-size: .94rem; }

    /* Chip navigasi */
    .dash-index .overview { display: grid; grid-template-columns: repeat(auto-fit, minmax(230px, 1fr)); gap: 12px; margin-top: 22px; }
    .dash-index .ov-item { position: relative; display: flex; align-items: center; gap: 12px; padding: 13px 16px; border-radius: var(--r-md);
        background: rgba(255,255,255,.07); border: 1px solid rgba(255,255,255,.12); color: #fff; transition: transform .15s, background .15s; }
    .dash-index .ov-item:hover { transform: translateY(-2px); background: rgba(255,255,255,.14); }
    .dash-index .ov-ico { flex: 0 0 40px; height: 40px; display: grid; place-items: center; border-radius: 11px; background: var(--t); color: #fff; }
    .dash-index .ov-text { display: flex; flex-direction: column; min-width: 0; }
    .dash-index .ov-title { font-size: .9rem; font-weight: 600; }
    .dash-index .ov-desc { font-size: .74rem; color: rgba(255,255,255,.66); line-height: 1.35; }
    .dash-index .ov-go { position: absolute; top: 9px; right: 12px; font-size: .68rem; opacity: .45; }

    /* Section */
    .dash-index .dash-section { margin-top: 40px; scroll-margin-top: calc(var(--topbar-h) + 16px); }
    .dash-index .section-heading { display: flex; align-items: center; gap: 12px; margin-bottom: 16px; flex-wrap: wrap; }
    .dash-index .section-heading-ico { width: 40px; height: 40px; display: grid; place-items: center; border-radius: 11px; background: var(--t-soft); color: var(--t); }
    .dash-index .section-heading h3 { font-family: var(--font-display); font-size: 1.2rem; font-weight: 700; }
    .dash-index .section-meta { margin-left: auto; font-size: .82rem; color: var(--steel); }
    .dash-index .section-meta b { color: var(--ink); }

    /* Kartu statistik */
    .dash-index .stats-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 14px; }
    .dash-index .stat-card { display: flex; flex-direction: column; justify-content: space-between; gap: 18px; padding: 16px; background: var(--white);
        border: 1px solid var(--line); border-radius: var(--r-md); transition: transform .15s, box-shadow .15s, border-color .15s; }
    .dash-index .stat-card:hover { transform: translateY(-2px); border-color: var(--t); box-shadow: var(--shadow-md); }
    .dash-index .stat-top { display: flex; align-items: center; justify-content: space-between; }
    /* Warna ikon mengikuti warna bagian (tone) agar seragam per bagian */
    .dash-index .stat-ico { width: 42px; height: 42px; display: grid; place-items: center; border-radius: 12px; font-size: 1.05rem;
        background: var(--t-soft); color: var(--t); }
    .dash-index .stat-go { font-size: .8rem; color: var(--steel-soft); transition: transform .15s, color .15s; }
    .dash-index .stat-card:hover .stat-go { transform: translateX(3px); color: var(--t); }
    .dash-index .stat-value { font-family: var(--font-display); font-size: 2rem; font-weight: 700; line-height: 1.1; }
    .dash-index .stat-value.is-empty { color: var(--line-dark); }
    .dash-index .stat-title { margin-top: 4px; font-weight: 600; font-size: .92rem; line-height: 1.35; }
    .dash-index .stat-unit { font-size: .8rem; color: var(--steel); }

    @media (max-width: 640px) {
        .dash-index .section-meta { margin-left: 0; width: 100%; }
        .dash-index .stats-grid { grid-template-columns: repeat(auto-fill, minmax(155px, 1fr)); }
    }
</style>

<div class="dash-index">
<div class="page-head">
    <h1>Ruang kerja terintegrasi</h1>
    <p>Ringkasan sistem informasi internal Disdamkartan Kota Jambi.</p>
</div>

@php
    // ------------------------------------------------------------------
    // Daftar tabel: cukup 1 kali ambil, di-cache 10 menit
    // (sebelumnya Schema::hasTable() dipanggil puluhan kali = puluhan query)
    // ------------------------------------------------------------------
    $existing = \Illuminate\Support\Facades\Cache::remember('dash:table-list', 600, function () {
        try {
            $list = \Illuminate\Support\Facades\Schema::getTableListing();
            // Hilangkan prefix schema (mis. "public.users" -> "users")
            return array_values(array_map(fn ($t) => str_contains($t, '.') ? substr(strrchr($t, '.'), 1) : $t, $list));
        } catch (\Throwable $e) {
            return null; // fallback ke hasTable
        }
    });
    $existing = $existing !== null ? array_flip($existing) : null;

    $has = function ($t) use ($existing) {
        return $existing !== null
            ? isset($existing[$t])
            : \Illuminate\Support\Facades\Schema::hasTable($t);
    };

    // Hitung jumlah baris / SUM kolom, hasil di-cache 60 detik
    $count = function ($tables, $sumColumn = null) use ($has) {
        foreach ((array) $tables as $t) {
            if ($has($t)) {
                return \Illuminate\Support\Facades\Cache::remember(
                    'dash:' . $t . ':' . ($sumColumn ?? 'count'),
                    60,
                    function () use ($t, $sumColumn) {
                        try {
                            $q = \Illuminate\Support\Facades\DB::table($t);
                            return $sumColumn ? (int) $q->sum($sumColumn) : (int) $q->count();
                        } catch (\Throwable $e) {
                            return 0;
                        }
                    }
                );
            }
        }
        return null;
    };

    $countAll = function (array $tables) use ($count) {
        $total = null;
        foreach ($tables as $t) {
            $n = $count($t);
            if ($n !== null) $total = ($total ?? 0) + $n;
        }
        return $total;
    };

    $countKategoriHukum = fn ($kat) => $has('produk_hukums')
        ? \Illuminate\Support\Facades\Cache::remember('dash:hukum:' . $kat, 60, fn () =>
            (int) \Illuminate\Support\Facades\DB::table('produk_hukums')->where('kategori', $kat)->count())
        : null;

    $countKategoriProfil = fn ($kat) => $has('profil_instansis')
        ? \Illuminate\Support\Facades\Cache::remember('dash:profil:' . $kat, 60, fn () =>
            (int) \Illuminate\Support\Facades\DB::table('profil_instansis')->where('kategori', $kat)->count())
        : null;

    $countKejadianKebakaran = $has('laporan_penyelamatans')
        ? \Illuminate\Support\Facades\Cache::remember('dash:kejadian-kebakaran', 60, fn () =>
            (int) \Illuminate\Support\Facades\DB::table('laporan_penyelamatans')
                ->whereNotNull('kategori_kebakaran')
                ->where('kategori_kebakaran', '!=', '')
                ->count())
        : null;

    $rekapTotals = $has('rekap_layanan')
        ? \Illuminate\Support\Facades\Cache::remember('dash:rekap-totals', 60, fn () =>
            \Illuminate\Support\Facades\DB::table('rekap_layanan')
                ->select('kategori', \Illuminate\Support\Facades\DB::raw('SUM(jumlah) as total'))
                ->groupBy('kategori')->pluck('total', 'kategori')->toArray())
        : [];

    $ops = 'Super User|Sapra|Damtan|Pencegahan|Sekretariat|Operator';

    $sections = [
        [
            'id' => 'pencegahan', 'title' => 'Bagian Pencegahan', 'icon' => 'fa-shield-halved', 'tone' => 'blue', 'desc' => 'Inspeksi, edukasi, dan perizinan keselamatan', 'roles' => $ops,
            'items' => [
                ['Peningkatan Kapasitas Aparatur', 'kegiatan', 'fa-arrow-trend-up', '/internal/pencegahan/peningkatan-kapasitas', $count('peningkatan_kapasitas'), 'ic-primary'],
                ['Pencegahan Kebakaran & Inspeksi', 'inspeksi', 'fa-magnifying-glass-chart', '/internal/pencegahan/inspeksi-kebakaran', $countAll(['inspeksi_bangunans', 'jadwal_inspeksis']), 'ic-danger'],
                ['Pemberdayaan Masyarakat & Dunia Usaha', 'kegiatan', 'fa-handshake-angle', '/internal/pencegahan/pemberdayaan-masyarakat', $countAll(['sosialisasi_edukasi', 'sosialisasi', 'pembinaan', 'pelatihan', 'pelatihan_keluarga', 'fire_drills']), 'ic-info'],
                ['Kelola Edukasi', 'permohonan', 'fa-bullhorn', '/internal/pencegahan/kelola-edukasi', $count('permohonan_edukasi'), 'ic-primary'],
                ['Kelola Redkar', 'data', 'fa-users-rectangle', '/internal/pencegahan/kelola-redkar', $count('redkar_registrations'), 'ic-info'],
                ['Kelola RPKBGL', 'permohonan', 'fa-building-circle-check', '/internal/pencegahan/kelola-rpkbgl', $count('permohonan_rpkbgl'), 'ic-primary'],
                ['Kelola SKK', 'permohonan (baru + perpanjangan)', 'fa-file-shield', '/internal/pencegahan/kelola-skk', ($count('permohonan_skk') ?? 0) + ($count('permohonan_perpanjang_skk') ?? 0), 'ic-danger'],
            ],
        ],
        [
            'id' => 'pemadaman', 'title' => 'Bagian Pemadaman', 'icon' => 'fa-fire-extinguisher', 'tone' => 'red', 'desc' => 'Laporan kejadian dan surat layanan', 'roles' => $ops,
            'items' => [
                ['Kelola Rekap Objek Kebakaran', 'kejadian kebakaran', 'fa-house-chimney-crack', '/internal/damtan/rekap-objek', $countKejadianKebakaran, 'ic-danger', 'skip' => true],
                ['Kelola Data Laporan', 'laporan', 'fa-clipboard-list', '/internal/damtan/data-laporan', $count('laporan_penyelamatans'), 'ic-danger'],
                ['Kelola Surat Korban', 'surat terbit', 'fa-folder-open', '/internal/surat-korban/data', $count('surat_korbans'), 'ic-primary'],
                ['Kelola Pengamanan Event Keramaian', 'surat izin', 'fa-users-rectangle', route('internal.izin-keramaian.index'), $count('izin_keramaian'), 'ic-info'],
                ['Kelola Penggunaan Sarana', 'permohonan', 'fa-truck-droplet', url('/internal/damtan/kelola-penggunaan-sarana'), $count('penggunaan_sarana'), 'ic-primary'],
            ],
        ],
        [
            'id' => 'rekap', 'title' => 'Rekap Layanan & Penyelamatan', 'icon' => 'fa-truck-medical', 'tone' => 'orange', 'roles' => $ops, 'chip' => false,
            'total' => $count('rekap_layanan', 'jumlah'),
            'items' => [
                ['Kebakaran', 'layanan', 'fa-fire-flame-curved', '/internal/damtan/rekap-layanan', $rekapTotals['kebakaran'] ?? 0, 'ic-danger'],
                ['Evakuasi Ular', 'layanan', 'fa-staff-snake', '/internal/damtan/rekap-layanan', $rekapTotals['evakuasi_ular'] ?? 0, 'ic-primary'],
                ['Rescue Darat & Air', 'layanan', 'fa-life-ring', '/internal/damtan/rekap-layanan', $rekapTotals['rescue_darat_air'] ?? 0, 'ic-info'],
                ['Evakuasi Tawon/Lebah', 'layanan', 'fa-bug', '/internal/damtan/rekap-layanan', $rekapTotals['evakuasi_tawon'] ?? 0, 'ic-primary'],
                ['Edukasi & Kunjungan', 'layanan', 'fa-users', '/internal/damtan/rekap-layanan', $rekapTotals['edukasi_kunjungan'] ?? 0, 'ic-info'],
                ['Evakuasi Hewan Lainnya', 'layanan', 'fa-cat', '/internal/damtan/rekap-layanan', $rekapTotals['evakuasi_hewan'] ?? 0, 'ic-primary'],
                ['Pemeriksaan Gedung', 'layanan', 'fa-building-circle-check', '/internal/damtan/rekap-layanan', $rekapTotals['pemeriksaan_gedung'] ?? 0, 'ic-danger'],
                ['Evakuasi Cincin/Anting', 'layanan', 'fa-ring', '/internal/damtan/rekap-layanan', $rekapTotals['evakuasi_cincin'] ?? 0, 'ic-primary'],
            ],
        ],
        [
            'id' => 'sapra', 'title' => 'Bagian Sapra', 'icon' => 'fa-warehouse', 'tone' => 'amber', 'desc' => 'Sarana, prasarana, dan sumber air', 'roles' => $ops,
            'items' => [
                ['Sarana Pemadam Kebakaran', 'unit', 'fa-fire-extinguisher', '/sapra/sarana-mako', $countAll(['sarana_kebakaran', 'sarana_pos']), 'ic-danger'],
                ['Prasarana Pemadam Kebakaran', 'data', 'fa-building', '/sapra/prasarana-mako', $countAll(['prasarana', 'prasarana_pos', 'prasaranas']), 'ic-primary'],
                ['Sarana Penyelamatan & Evakuasi', 'unit', 'fa-life-ring', '/sapra/sarana-penyelamatan', $countAll(['sarana_penyelamatan', 'sarana_penyelamatan_pos', 'sarana_penyelamatans']), 'ic-info'],
                ['Sarana Pemeriksaan Proteksi Kebakaran', 'unit', 'fa-search-location', '/sapra/sarana-pemeriksaan', $count('sarana_pemeriksaan'), 'ic-primary'],
                ['Kelola Data Pos', 'pos', 'fa-warehouse', '/sapra/kelola-pos', $countAll(['pos_pemadam', 'lokasi_pos']), 'ic-info'],
                ['Sumber Air', 'titik', 'fa-droplet', '/sapra/data_hidrant_gedung', $count(['data_hidrant_gedung', 'hidran_gedung', 'hidrant_gedung', 'sumber_air']), 'ic-info'],
                ['Data Hidrant Kota Jambi', 'hidrant', 'fa-map-location-dot', '/sapra/data-hidrant-kota', $count('hidran_kota'), 'ic-primary'],
                ['Mutu Baku Kebutuhan', 'data', 'fa-boxes-stacked', '/sapra/kebutuhan-sarpras', $count('kebutuhan_sarpras'), 'ic-primary'],
                ['Serah Terima Barang', 'transaksi', 'fa-people-carry-box', '/sapra/distribusi-staff', $count('distribusi_barang_staff'), 'ic-info'],
            ],
        ],
        [
            'id' => 'kepegawaian', 'title' => 'Kepegawaian', 'icon' => 'fa-user-tie', 'tone' => 'green', 'desc' => 'Data pegawai, ASN, dan dokumen SOP', 'roles' => $ops,
            'items' => [
                ['Data Urut Kepegawaian', 'pegawai', 'fa-user-tie', '/internal/kepegawaian/duk', $count('pegawais'), 'ic-primary'],
                ['Rekap Data ASN', 'data', 'fa-users', '/internal/data-asn', (($count('data_asns', 'pns') ?? 0) + ($count('data_asns', 'pppk') ?? 0)), 'ic-danger'],
                ['SOP & Dokumen', 'program', 'fa-file-contract', '/internal/program-kerja', $count('dokumen_sop'), 'ic-info'],
                ['Dokumen Publik', 'dokumen', 'fa-file-lines', route('dokumen-publik.index'), $count('dokumen_publik'), 'ic-primary'],
            ],
        ],
        [
            'id' => 'informasi', 'title' => 'Manajemen Informasi', 'icon' => 'fa-newspaper', 'tone' => 'violet', 'desc' => 'Berita, produk hukum, dan profil instansi', 'roles' => $ops,
            'items' => [
                ['Berita', 'berita', 'fa-newspaper', '/internal/operator/kelola-berita', $count('berita'), 'ic-primary'],
                ['Info Grafis', 'info grafis', 'fa-image', '/internal/operator/infografis', $count('infografis'), 'ic-info'],
                ['Berita Medsos', 'unggahan', 'fa-brands fa-instagram', '/internal/operator/berita-medsos', $count('berita_medsos'), 'ic-danger'],
                ['Ujung-Ujung Damkar', 'video', 'fa-brands fa-youtube', '/internal/operator/ujung-damkar', $count('ujung_damkar'), 'ic-danger'],
                ['Edu Damkar', 'materi', 'fa-graduation-cap', '/internal/operator/edu-damkar', $count('edu_damkar'), 'ic-primary'],
                ['Kelola Pengumuman', 'informasi', 'fa-bullhorn', '/internal/operator/pengumuman', $count(['pengumuman', 'pengumumans']), 'ic-info'],
                ['Kelola IKM', 'responden', 'fa-face-smile', '/internal/operator/ikm', $count('ikm_responses'), 'ic-primary'],

                ['Undang-Undang', 'dokumen hukum', 'fa-scale-balanced', '/internal/produk-hukum/undang-undang', $countKategoriHukum('undang-undang'), 'ic-primary'],
                ['Peraturan Pemerintah', 'dokumen hukum', 'fa-landmark', '/internal/produk-hukum/peraturan-pemerintah', $countKategoriHukum('peraturan-pemerintah'), 'ic-info'],
                ['Peraturan Presiden', 'dokumen hukum', 'fa-book', '/internal/produk-hukum/peraturan-presiden', $countKategoriHukum('peraturan-presiden'), 'ic-info'],
                ['Peraturan Menteri', 'dokumen hukum', 'fa-book-bookmark', '/internal/produk-hukum/peraturan-menteri', $countKategoriHukum('peraturan-menteri'), 'ic-primary'],
                ['Peraturan Daerah', 'dokumen hukum', 'fa-file-shield', '/internal/produk-hukum/peraturan-daerah', $countKategoriHukum('peraturan-daerah'), 'ic-danger'],
                ['Peraturan Kepala Daerah', 'dokumen hukum', 'fa-file-signature', '/internal/produk-hukum/peraturan-kepala-daerah', $countKategoriHukum('peraturan-kepala-daerah'), 'ic-info'],

                ['Visi Misi', 'dokumen profil', 'fa-bullseye', '/internal/profil-instansi/visi-misi', $countKategoriProfil('visi-misi'), 'ic-primary'],
                ['SOTK', 'struktur organisasi', 'fa-sitemap', '/internal/profil-instansi/sotk', $countKategoriProfil('sotk'), 'ic-info'],
                ['Tupoksi', 'tugas & fungsi', 'fa-list-check', '/internal/profil-instansi/tupoksi', $countKategoriProfil('tupoksi'), 'ic-primary'],
                ['Program Kegiatan', 'program', 'fa-calendar-check', '/internal/profil-instansi/program-kegiatan', $countKategoriProfil('program-kegiatan'), 'ic-danger'],
                ['Cascading', 'dokumen kinerja', 'fa-diagram-project', '/internal/profil-instansi/cascading', $countKategoriProfil('cascading'), 'ic-primary'],

                ['Titik Peta Sigap', 'titik', 'fa-location-dot', '/internal/peta-sigap/data', $count('titik_sigaps'), 'ic-info'],
            ],
        ],
        [
            'id' => 'akun', 'title' => 'Pengaturan Akun', 'icon' => 'fa-user-gear', 'tone' => 'slate', 'roles' => 'Super User',
            'items' => [
                ['Kelola Pengguna', 'akun pegawai', 'fa-users-gear', url('/internal/kelola-user'), $count('users'), 'ic-primary'],
                ['Kelola Akun Pemohon', 'akun pemohon', 'fa-address-book', url('/internal/kelola-pemohon'), $count('pemohons'), 'ic-info'],
            ],
        ],
    ];

    $visible = [];
    foreach ($sections as $s) {
        if (!Auth::user()->hasAnyRole(explode('|', $s['roles']))) continue;
        if (!isset($s['total'])) {
            $s['total'] = 0;
            foreach ($s['items'] as $it) {
                if (empty($it['skip']) && $it[4] !== null) $s['total'] += $it[4];
            }
        }
        $visible[] = $s;
    }
    $fmt = fn ($n) => $n === null ? '–' : number_format($n, 0, ',', '.');
@endphp

<section class="welcome">
    @php
        $jam = (int) now()->format('H');
        $sapaan = $jam < 11 ? 'Selamat pagi' : ($jam < 15 ? 'Selamat siang' : ($jam < 18 ? 'Selamat sore' : 'Selamat malam'));
    @endphp
    <span class="welcome-date"><i class="far fa-calendar"></i> {{ now()->locale('id')->translatedFormat('l, j F Y') }}</span>
    <h2>{{ $sapaan }}, {{ Auth::user()->nama_lengkap ?? 'Rekan kerja' }}.</h2>
    @hasrole('Super User')
        <p class="welcome-sub">Anda memiliki kendali penuh untuk memantau dan mengelola seluruh modul operasional maupun sistem.</p>
    @else
        <p class="welcome-sub">Anda dapat berkolaborasi mengelola laporan dari seluruh modul layanan Disdamkartan.</p>
    @endhasrole

    <div class="overview">
        @foreach($visible as $s)
            @if(($s['chip'] ?? true) && $s['id'] !== 'akun')
                <a href="#sec-{{ $s['id'] }}" class="ov-item tone-{{ $s['tone'] ?? 'slate' }}">
                    <span class="ov-go" aria-hidden="true"><i class="fas fa-arrow-down"></i></span>
                    <span class="ov-ico" aria-hidden="true"><i class="fas {{ $s['icon'] }}"></i></span>
                    <span class="ov-text">
                        <strong class="ov-title">{{ $s['title'] }}</strong>
                        <span class="ov-desc">{{ $s['desc'] ?? '' }}</span>
                    </span>
                </a>
            @endif
        @endforeach
    </div>
</section>

@foreach($visible as $s)
    <section class="dash-section tone-{{ $s['tone'] ?? 'slate' }}" id="sec-{{ $s['id'] }}">
        <div class="section-heading">
            <span class="section-heading-ico"><i class="fas {{ $s['icon'] }}"></i></span>
            <h3>{{ $s['title'] }}</h3>
            <span class="section-meta">{{ count($s['items']) }} menu &middot; <b>{{ $fmt($s['total']) }}</b> data</span>
        </div>

        <div class="stats-grid">
            @foreach($s['items'] as $it)
                <a href="{{ $it[3] }}" class="stat-card">
                    <div class="stat-top">
                        <div class="stat-ico"><i class="{{ str_contains($it[2], 'fa-brands') ? $it[2] : 'fas ' . $it[2] }}"></i></div>
                        <span class="stat-go"><i class="fas fa-arrow-right"></i></span>
                    </div>
                    <div>
                        <div class="stat-value {{ $it[4] === null ? 'is-empty' : '' }}" @if($it[4] === null) title="Tabel data belum ditemukan" @endif>{{ $fmt($it[4]) }}</div>
                        <div class="stat-title">{{ $it[0] }}</div>
                        <div class="stat-unit">{{ $it[1] }}</div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
@endforeach
</div>
@endsection