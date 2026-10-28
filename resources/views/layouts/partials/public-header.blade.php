{{-- Partial Header Navigasi Publik SIMERAH KOJA --}}
@php
    $no_whatsapp    = "628117113113";
    $no_telepon     = "074141171";
    $telepon_tampil = "(0741) 41171";
    $pesan_wa = "Terimakasih%20telah%20menghubungi%20%F0%9F%94%A5%F0%9F%94%A5%F0%9F%94%A5..%0ASistem%20Informasi%20Penanggulangan%20Kebakaran%20dan%20Penyelamatan%20Daerah%20Kota%20Jambi%20(SIMERAH%20KOJA)%0A%0AMohon%20Isi%20Laporan%20Pengaduan%3A%20%0A%0ANama%20Pelapor%20%20%20%3A%0ANo.%20HP%20Pelapor%20%3A%0AAlamat%20Pelapor%20%3A%0AJenis%20Laporan%20%20%20%3A%20%20(Kebakaran%2FEvakuasi)%0A%0AAlamat%20Kejadian%20%3A%0A%0AKirim%20Peta%20Lokasi%20kejadian%20(Google%20Maps)%20%3A%0A%0AKirim%20Foto%20%26%20Video%20Kejadian%20%3A%0A%0ALaporan%20akan%20segera%20kami%20tindaklanjuti%20%F0%9F%9A%92%F0%9F%9A%92%F0%9F%9A%92%0ASalam%20YUDHA%20BRAMA%20JAYA%20Dinas%20Pemadam%20Kebakaran%20%26%20Penyelamatan%20Kota%20Jambi.";
    $wa_link   = "https://wa.me/" . $no_whatsapp . "?text=" . $pesan_wa;
@endphp
<header class="site-header" id="siteHeader">
    <nav class="nav" aria-label="Navigasi utama">
        <div class="brand">
            <a href="/" aria-label="SIMERAH KOJA, beranda">
                <img src="/images/jambi.png" alt="Logo Pemkot Jambi">
            </a>
            <a href="/" title="Beranda">
                <img src="/images/logo.png" alt="Logo Damkar">
            </a>
            <a href="javascript:void(0)" aria-label="Logo Redkar" style="pointer-events: none; cursor: default;">
                <img src="/images/logo-redkar.png" alt="Logo Redkar">
            </a>
        </div>

        <button class="nav-toggle" type="button" aria-label="Buka menu" aria-expanded="false" aria-controls="navPanel">
            <i class="fas fa-bars"></i>
        </button>

        <div class="nav-panel" id="navPanel">
            <!-- ===== Menu utama ===== -->
            <ul class="menu">
                <li class="has-drop {{ request()->is('profil*') ? 'current' : '' }}">
                    <button class="menu-trigger" type="button" aria-expanded="false">Profil <i class="fas fa-chevron-down"></i></button>
                    <ul class="dropdown">
                        <li><a href="/profil/visi-misi" {!! request()->is('profil/visi-misi') ? 'aria-current="page"' : '' !!}>Visi Misi</a></li>
                        <li><a href="/profil/sotk" {!! request()->is('profil/sotk') ? 'aria-current="page"' : '' !!}>SOTK</a></li>
                        <li><a href="/profil/tupoksi" {!! request()->is('profil/tupoksi') ? 'aria-current="page"' : '' !!}>Tupoksi</a></li>
                        <li><a href="/profil/kepegawaian" {!! request()->is('profil/kepegawaian') ? 'aria-current="page"' : '' !!}>Kepegawaian</a></li>
                        <li><a href="/profil/program-kegiatan" {!! request()->is('profil/program-kegiatan') ? 'aria-current="page"' : '' !!}>Program Kegiatan</a></li>
                        <li><a href="/profil/cascading" {!! request()->is('profil/cascading') ? 'aria-current="page"' : '' !!}>Cascading</a></li>
                    </ul>
                </li>

                <li class="has-drop {{ request()->is('layanan-fasilitas*') ? 'current' : '' }}">
                    <button class="menu-trigger" type="button" aria-expanded="false">Layanan <i class="fas fa-chevron-down"></i></button>
                    <ul class="dropdown">
                        <li><a href="/layanan-fasilitas/edukasi_sosialisasi" {!! request()->is('layanan-fasilitas/edukasi_sosialisasi') ? 'aria-current="page"' : '' !!}>Kunjungan, Edukasi dan Sosialisasi</a></li>
                        <li><a href="/layanan-fasilitas/izin-keramaian" {!! request()->is('layanan-fasilitas/izin-keramaian') ? 'aria-current="page"' : '' !!}>Rekomendasi Izin Pengamanan Event Keramaian</a></li>
                        <li><a href="/layanan-fasilitas/layanan_perizinan" {!! request()->is('layanan-fasilitas/layanan_perizinan') ? 'aria-current="page"' : '' !!}>Rekomendasi Penilaian Proteksi Kebakaran Bangunan Gedung dan Lingkungan</a></li>
                        <li><a href="/layanan-fasilitas/penggunaan-sarana" {!! request()->is('layanan-fasilitas/penggunaan-sarana') ? 'aria-current="page"' : '' !!}>Permohonan Penggunaan Sarana Pemadam Kebakaran</a></li>
                        <li><a href="/layanan-fasilitas/skk" {!! request()->is('layanan-fasilitas/skk') ? 'aria-current="page"' : '' !!}>Permohonan Sertifikat Keselamatan Kebakaran</a></li>
                    </ul>
                </li>

                <li><a class="menu-link {{ request()->is('public-sigap*') ? 'is-active' : '' }}" href="/public-sigap">Sigapkar</a></li>

                <li class="has-drop {{ request()->is('sop*') ? 'current' : '' }}">
                    <button class="menu-trigger" type="button" aria-expanded="false">SOP <i class="fas fa-chevron-down"></i></button>
                    <ul class="dropdown">
                        <li><a href="/sop/pencegahan" {!! request()->is('sop/pencegahan') ? 'aria-current="page"' : '' !!}>Pencegahan</a></li>
                        <li><a href="/sop/pemadaman" {!! request()->is('sop/pemadaman') ? 'aria-current="page"' : '' !!}>Pemadaman Kebakaran</a></li>
                        <li><a href="/sop/penyelamatan" {!! request()->is('sop/penyelamatan') ? 'aria-current="page"' : '' !!}>Penyelamatan dan Evakuasi</a></li>
                        <li><a href="/sop/sarpras" {!! request()->is('sop/sarpras') ? 'aria-current="page"' : '' !!}>Sarana dan Prasarana</a></li>
                        <li><a href="/sop/kepegawaian" {!! request()->is('sop/kepegawaian') ? 'aria-current="page"' : '' !!}>Kepegawaian</a></li>
                        <li><a href="/sop/keuangan" {!! request()->is('sop/keuangan') ? 'aria-current="page"' : '' !!}>Keuangan</a></li>
                    </ul>
                </li>

                <li class="has-drop {{ request()->is('produk-hukum*') ? 'current' : '' }}">
                    <button class="menu-trigger" type="button" aria-expanded="false">Produk Hukum <i class="fas fa-chevron-down"></i></button>
                    <ul class="dropdown">
                        <li><a href="/produk-hukum/undang-undang" {!! request()->is('produk-hukum/undang-undang') ? 'aria-current="page"' : '' !!}>Undang-Undang</a></li>
                        <li><a href="/produk-hukum/peraturan-pemerintah" {!! request()->is('produk-hukum/peraturan-pemerintah') ? 'aria-current="page"' : '' !!}>Peraturan Pemerintah</a></li>
                        <li><a href="/produk-hukum/peraturan-menteri" {!! request()->is('produk-hukum/peraturan-menteri') ? 'aria-current="page"' : '' !!}>Peraturan Menteri</a></li>
                        <li><a href="/produk-hukum/peraturan-daerah" {!! request()->is('produk-hukum/peraturan-daerah') ? 'aria-current="page"' : '' !!}>Peraturan Daerah</a></li>
                        <li><a href="/produk-hukum/peraturan-kepala-daerah" {!! request()->is('produk-hukum/peraturan-kepala-daerah') ? 'aria-current="page"' : '' !!}>Peraturan Kepala Daerah</a></li>
                    </ul>
                </li>

                <li class="has-drop {{ request()->is('dokumen*') ? 'current' : '' }}">
                    <button class="menu-trigger" type="button" aria-expanded="false">Dokumen <i class="fas fa-chevron-down"></i></button>
                    <ul class="dropdown">
                        <li><a href="/dokumen/renstra" {!! request()->is('dokumen/renstra') ? 'aria-current="page"' : '' !!}>Renstra</a></li>
                        <li><a href="/dokumen/renja" {!! request()->is('dokumen/renja') ? 'aria-current="page"' : '' !!}>Renja</a></li>
                        <li><a href="/dokumen/spm" {!! request()->is('dokumen/spm') ? 'aria-current="page"' : '' !!}>SPM</a></li>
                        <li><a href="/dokumen/sakip" {!! request()->is('dokumen/sakip') ? 'aria-current="page"' : '' !!}>SAKIP</a></li>
                        <li><a href="/dokumen/lppd" {!! request()->is('dokumen/lppd') ? 'aria-current="page"' : '' !!}>LPPD</a></li>
                    </ul>
                </li>

                <li class="has-drop {{ request()->is('sarpras*') ? 'current' : '' }}">
                    <button class="menu-trigger" type="button" aria-expanded="false">Sarpras <i class="fas fa-chevron-down"></i></button>
                    <ul class="dropdown">
                        <li><a href="{{ route('sarpras.sarana') }}" {!! request()->is('sarpras/sarana*') ? 'aria-current="page"' : '' !!}>Sarana</a></li>
                        <li><a href="{{ route('sarpras.prasarana') }}" {!! request()->is('sarpras/prasarana*') ? 'aria-current="page"' : '' !!}>Prasarana</a></li>
                    </ul>
                </li>

                <li class="has-drop {{ request()->is('ikm*', 'pengumuman*', 'edu-damkar*', 'infografis*', 'media-informasi*', 'ujung-ujung-damkar*', 'pemadaman-penyelamatan-evakuasi*') ? 'current' : '' }}">
                    <button class="menu-trigger" type="button" aria-expanded="false">Galeri <i class="fas fa-chevron-down"></i></button>
                    <ul class="dropdown">
                        <li><a href="/ikm" {!! request()->is('ikm*') ? 'aria-current="page"' : '' !!}>IKM (Indeks Kepuasan Masyarakat)</a></li>
                        <li><a href="/pengumuman" {!! request()->is('pengumuman*') ? 'aria-current="page"' : '' !!}>Pengumuman</a></li>
                        <li class="has-sub {{ request()->is('edu-damkar*', 'infografis*', 'media-informasi*', 'ujung-ujung-damkar*', 'pemadaman-penyelamatan-evakuasi*') ? 'current' : '' }}">
                            <button class="sub-trigger" type="button" aria-expanded="false">
                                Berita <i class="fas fa-chevron-right"></i>
                            </button>
                            <ul class="dropdown-sub">
                                <li><a href="/edu-damkar" {!! request()->is('edu-damkar*') ? 'aria-current="page"' : '' !!}>Edu Damkar</a></li>
                                <li><a href="{{ route('publik.infografis') }}" {!! request()->is('infografis*') ? 'aria-current="page"' : '' !!}>Infografis</a></li>
                                <li><a href="/media-informasi" {!! request()->is('media-informasi*') ? 'aria-current="page"' : '' !!}>Media Informasi</a></li>
                                <li><a href="/ujung-ujung-damkar" {!! request()->is('ujung-ujung-damkar*') ? 'aria-current="page"' : '' !!}>Ujung-ujung Damkar</a></li>
                                <li><a href="{{ route('publik.kejadian') }}" {!! request()->is('pemadaman-penyelamatan-evakuasi*') ? 'aria-current="page"' : '' !!}>Pemadaman, Penyelamatan dan Evakuasi</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>

            <!-- ===== Tombol kanan: Lapor darurat + Masuk ===== -->
            <ul class="nav-actions">
                <li class="has-drop">
                    <button class="btn-nav btn-nav--alert menu-trigger-cta" type="button" aria-expanded="false">
                        <span class="beacon" aria-hidden="true"></span> Lapor darurat <i class="fas fa-chevron-down"></i>
                    </button>
                    <ul class="dropdown">
                        <li><a href="tel:112"><i class="fas fa-headset"></i> Call Center 112</a></li>
                        <li><a href="tel:{{ $no_telepon }}"><i class="fas fa-phone-alt"></i> Telepon {{ $telepon_tampil }}</a></li>
                        <li><a href="{{ $wa_link }}" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> WhatsApp</a></li>
                    </ul>
                </li>

                @if(session()->has('pemohon_id'))
                    <li class="has-drop">
                        <button class="btn-nav btn-nav--ghost menu-trigger-cta" type="button" aria-expanded="false">
                            <i class="fas fa-user-circle"></i> {{ strtok(session('pemohon_nama'), " ") }} <i class="fas fa-chevron-down"></i>
                        </button>
                        <ul class="dropdown">
                            <li><a href="{{ route('pemohon.dashboard') }}"><i class="fas fa-id-card" style="color: var(--amber);"></i> Dashboard Profil</a></li>
                            <li><a href="{{ route('pemohon.dashboard') }}"><i class="fas fa-list-check"></i> Monitoring Berkas</a></li>
                            <li>
                                <form action="{{ route('pemohon.logout') }}" method="POST" style="margin: 0;">
                                    @csrf
                                    <button type="submit" class="btn-logout">
                                        <i class="fas fa-sign-out-alt"></i> Keluar
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li><a class="btn-nav btn-nav--ghost" href="{{ route('pemohon.login') }}">Masuk</a></li>
                @endif
            </ul>
        </div>
    </nav>
</header>
