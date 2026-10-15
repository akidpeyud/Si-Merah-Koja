@php
    // Format item: [label, url, icon]
    $ops = 'Super User|Sapra|Damtan|Pencegahan|Sekretariat|Operator';

    $menu = [
        [
            'title' => 'Bagian Pencegahan', 'icon' => 'fa-shield-halved', 'roles' => $ops,
            'items' => [
                ['Peningkatan Kapasitas Aparatur', '/internal/pencegahan/peningkatan-kapasitas', 'fa-arrow-trend-up'],
                ['Pencegahan Kebakaran & Inspeksi', '/internal/pencegahan/inspeksi-kebakaran', 'fa-magnifying-glass-chart'],
                ['Pemberdayaan Masyarakat & Dunia Usaha', '/internal/pencegahan/pemberdayaan-masyarakat', 'fa-handshake-angle'],
                ['Kelola Edukasi', '/internal/pencegahan/kelola-edukasi', 'fa-bullhorn'],
                ['Kelola Redkar', '/internal/pencegahan/kelola-redkar', 'fa-users-rectangle'],
                ['Kelola RPKBGL', '/internal/pencegahan/kelola-rpkbgl', 'fa-building-circle-check'],
                ['Kelola SKK', '/internal/pencegahan/kelola-skk', 'fa-file-shield'],
            ],
        ],
        [
            'title' => 'Bagian Pemadaman', 'icon' => 'fa-fire-extinguisher', 'roles' => $ops,
            'items' => [
                ['Kelola Rekap Objek Kebakaran', '/internal/damtan/rekap-objek', 'fa-house-chimney-crack'],
                ['Kelola Data Laporan', '/internal/damtan/data-laporan', 'fa-clipboard-list'],
                ['Kelola Surat Korban', '/internal/surat-korban/data', 'fa-folder-open'],
                ['Kelola Surat Keramaian', route('internal.izin-keramaian.index'), 'fa-users-rectangle'],
                ['Kelola Penggunaan Sarana', url('/internal/damtan/kelola-penggunaan-sarana'), 'fa-truck-droplet'],
                ['Rekap Layanan & Penyelamatan', '/internal/damtan/rekap-layanan', 'fa-truck-medical'],
            ],
        ],
        [
            'title' => 'Bagian Sapra', 'icon' => 'fa-warehouse', 'roles' => $ops,
            'items' => [
                ['Sarana Pemadam Kebakaran', '/sapra/sarana-mako', 'fa-fire-extinguisher'],
                ['Prasarana Pemadam Kebakaran', '/sapra/prasarana-mako', 'fa-building'],
                ['Sarana Penyelamatan & Evakuasi', '/sapra/sarana-penyelamatan', 'fa-life-ring'],
                ['Sarana Pemeriksaan Proteksi', '/sapra/sarana-pemeriksaan', 'fa-search-location'],
                ['Kelola Data Pos', '/sapra/kelola-pos', 'fa-warehouse'],
                ['Sumber Air', '/sapra/data_hidrant_gedung', 'fa-droplet'],
                ['Data Hidrant Kota Jambi', '/sapra/data-hidrant-kota', 'fa-map-location-dot'],
                ['Mutu Baku Kebutuhan', '/sapra/kebutuhan-sarpras', 'fa-boxes-stacked'],
                ['Serah Terima Barang', '/sapra/distribusi-staff', 'fa-people-carry-box'],
            ],
        ],
        [
            'title' => 'Kepegawaian', 'icon' => 'fa-user-tie', 'roles' => $ops,
            'items' => [
                ['Data Urut Kepegawaian', '/internal/kepegawaian/duk', 'fa-user-tie'],
                ['Rekap Data ASN', '/internal/data-asn', 'fa-users'],
                ['SOP & Dokumen', '/internal/program-kerja', 'fa-file-contract'],
                ['Dokumen Publik', route('dokumen-publik.index'), 'fa-file-lines'],
            ],
        ],
        [
            'title' => 'Berita & Media', 'icon' => 'fa-newspaper', 'roles' => $ops,
            'items' => [
                ['Berita', '/internal/operator/kelola-berita', 'fa-newspaper'],
                ['Info Grafis', '/internal/operator/infografis', 'fa-image'],
                ['Berita Medsos', '/internal/operator/berita-medsos', 'fa-brands fa-instagram'],
                ['Ujung-Ujung Damkar', '/internal/operator/ujung-damkar', 'fa-brands fa-youtube'],
                ['Edu Damkar', '/internal/operator/edu-damkar', 'fa-graduation-cap'],
                ['Kelola Pengumuman', '/internal/operator/pengumuman', 'fa-bullhorn'],
                ['Titik Peta Sigap', '/internal/peta-sigap/data', 'fa-location-dot'],
            ],
        ],
        [
            'title' => 'Produk Hukum', 'icon' => 'fa-scale-balanced', 'roles' => $ops,
            'items' => [
                ['Undang-Undang', '/internal/produk-hukum/undang-undang', 'fa-scale-balanced'],
                ['Peraturan Pemerintah', '/internal/produk-hukum/peraturan-pemerintah', 'fa-landmark'],
                ['Peraturan Menteri', '/internal/produk-hukum/peraturan-menteri', 'fa-book-bookmark'],
                ['Peraturan Daerah', '/internal/produk-hukum/peraturan-daerah', 'fa-file-shield'],
                ['Peraturan Kepala Daerah', '/internal/produk-hukum/peraturan-kepala-daerah', 'fa-file-signature'],
            ],
        ],
        [
            'title' => 'Profil Instansi', 'icon' => 'fa-sitemap', 'roles' => $ops,
            'items' => [
                ['Visi Misi', '/internal/profil-instansi/visi-misi', 'fa-bullseye'],
                ['SOTK', '/internal/profil-instansi/sotk', 'fa-sitemap'],
                ['Tupoksi', '/internal/profil-instansi/tupoksi', 'fa-list-check'],
                ['Program Kegiatan', '/internal/profil-instansi/program-kegiatan', 'fa-calendar-check'],
                ['Cascading', '/internal/profil-instansi/cascading', 'fa-diagram-project'],
            ],
        ],
        [
            'title' => 'Pengaturan Akun', 'icon' => 'fa-user-gear', 'roles' => $ops, 'kicker' => 'Akun',
            'items' => [
                // Item ke-4 (opsional) = batasan role khusus item
                ['Profil Saya', url('/internal/profil'), 'fa-user-pen'],
                ['Kelola Pengguna', url('/internal/kelola-user'), 'fa-users-gear', 'Super User'],
                ['Kelola Akun Pemohon', url('/internal/kelola-pemohon'), 'fa-address-book', 'Super User'],
            ],
        ],
    ];

    // Cocokkan URL aktif berdasarkan path (tanpa domain)
    $isActive = function ($url) {
        $path = trim((string) parse_url($url, PHP_URL_PATH), '/');
        return $path !== '' && request()->is($path, $path . '/*');
    };
    $iconClass = fn ($i) => str_contains($i, 'fa-brands') ? $i : 'fas ' . $i;
@endphp

@foreach($menu as $g)
    @if(Auth::user()->hasAnyRole(explode('|', $g['roles'])))
        @if(!empty($g['kicker']))
            <div class="side-kicker">{{ $g['kicker'] }}</div>
        @endif

        @php $open = collect($g['items'])->contains(fn ($it) => $isActive($it[1])); @endphp
        <details class="side-group" @if($open) open @endif>
            <summary>
                <i class="fas {{ $g['icon'] }}"></i>
                <span class="lbl">{{ $g['title'] }}</span>
                <i class="fas fa-chevron-down chev"></i>
            </summary>
            <div class="side-sub">
                @foreach($g['items'] as $it)
                    @continue(!empty($it[3]) && !Auth::user()->hasAnyRole(explode('|', $it[3])))
                    <a href="{{ $it[1] }}" class="{{ $isActive($it[1]) ? 'active' : '' }}">
                        <i class="{{ $iconClass($it[2]) }}" style="width:18px;text-align:center;margin-top:3px;"></i>
                        <span class="lbl">{{ $it[0] }}</span>
                    </a>
                @endforeach
            </div>
        </details>
    @endif
@endforeach