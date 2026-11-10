{{-- Partial Footer Publik SIMERAH KOJA --}}
@php
    $maps_link = $maps_link ?? "https://www.google.com/maps/place/6PC59JJ2%2BQ76/@-1.6180875,103.6006406,871m/data=!3m2!1e3!4b1!4m4!3m3!8m2!3d-1.6180875!4d103.6006406?entry=ttu&g_ep=EgoyMDI2MDkxNi4wIKXMDSoASAFQAw%3D%3D";
    $play_store_url = $play_store_url ?? "";
    $no_whatsapp = $no_whatsapp ?? "628117113113";
    $no_telepon = $no_telepon ?? "074141171";
    $telepon_tampil = $telepon_tampil ?? "(0741) 41171";
    $pesan_wa = $pesan_wa ?? "Terimakasih%20telah%20menghubungi%20%F0%9F%94%A5%F0%9F%94%A5%F0%9F%94%A5..%0ASistem%20Informasi%20Penanggulangan%20Kebakaran%20dan%20Penyelamatan%20Daerah%20Kota%20Jambi%20(SIMERAH%20KOJA)";
    $wa_link = $wa_link ?? ("https://wa.me/" . $no_whatsapp . "?text=" . $pesan_wa);
@endphp
<footer class="footer">
    <div class="wrap">
        <div class="footer-grid">
            {{-- Kolom 1: Logo SIMERAH KOJA, Tentang Kami, & Kontak --}}
            <div class="footer-about">
                <img src="/images/simerahkoja.png" alt="Logo SIMERAH KOJA" class="footer-logo-main" loading="lazy">
                <h3>Tentang kami</h3>
                <p>SIMERAH KOJA merupakan sistem informasi pemerintahan berbasis elektronik yang terintegrasi pada dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi.</p>

                <div class="footer-contact">
                    <a href="{{ $wa_link }}" target="_blank" rel="noopener">
                        <i class="fab fa-whatsapp"></i> {{ $no_whatsapp }} (WhatsApp)
                    </a>
                    <a href="tel:{{ $no_telepon }}">
                        <i class="fas fa-phone-alt"></i> {{ $telepon_tampil }} (Call Center Damkar)
                    </a>
                </div>
            </div>

            {{-- Kolom 2: Peta Lokasi --}}
            <div>
                <div class="map">
                    <iframe
                        title="Lokasi Dinas Pemadam Kebakaran Kota Jambi"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.202353147814!2d103.600648!3d-1.618096!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e22c8c6a234f6b1%3A0x4d537f0a82384f88!2sDinas%20Pemadam%20Kebakaran%20Kota%20Jambi!5e1!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid"
                        tabindex="-1" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <a class="map-link" href="{{ $maps_link }}" target="_blank" rel="noopener" aria-label="Buka lokasi Dinas Pemadam Kebakaran Kota Jambi di Google Maps">
                        <span><i class="fas fa-location-arrow"></i> Buka di Google Maps</span>
                    </a>
                </div>
                <a class="find" href="{{ $maps_link }}" target="_blank" rel="noopener"><i class="fas fa-map-marker-alt"></i> Temukan kami di peta</a>

                @if ($play_store_url)
                <div class="app-dl">
                    <p>Unduh aplikasi SIMERAH KOJA</p>
                    <a href="{{ $play_store_url }}" target="_blank" rel="noopener">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg" alt="Dapatkan di Google Play">
                    </a>
                </div>
                @endif
            </div>

            {{-- Kolom 3: Link Terkait --}}
            <div class="footer-links">
                <h3>Link terkait</h3>
                <ul>
                    <li><a href="https://damkar.jambikota.go.id/" target="_blank" rel="noopener"><i class="fas fa-angle-right"></i> Official Damkar</a></li>
                    <li><a href="https://jambikota.go.id/" target="_blank" rel="noopener"><i class="fas fa-angle-right"></i> Website Jambikota</a></li>
                    <li><a href="https://sikoja.jambikota.go.id/" target="_blank" rel="noopener"><i class="fas fa-angle-right"></i> SIKOJA</a></li>
                </ul>
            </div>

            {{-- Kolom 4: Statistik Pengunjung & Logo WARLD di Bawahnya --}}
            <div class="footer-stats-col">
                <x-visit-counter page="simerahkoja" :track="false" />
                </div>
            </div>
        </div>

        {{-- Bar Bawah: Hak Cipta & Media Sosial --}}
        <div class="footer-bar">
            <div>SIMERAH KOJA &copy; {{ date('Y') }}. Hak cipta dilindungi.</div>
            <div class="social">
                <a href="mailto:damkar.jbi@gmail.com" title="Email" aria-label="Email"><i class="fas fa-envelope"></i></a>
                <a href="https://twitter.com/damkarkotajambi" target="_blank" rel="noopener" title="Twitter / X" aria-label="Twitter / X"><i class="fab fa-twitter"></i></a>
                <a href="https://www.facebook.com/DamkarKotaJambi" target="_blank" rel="noopener" title="Facebook" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.youtube.com/@damkarkotajambi" target="_blank" rel="noopener" title="YouTube" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                <a href="https://www.tiktok.com/@damkar.kota.jambi" target="_blank" rel="noopener" title="TikTok" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
                <a href="https://www.instagram.com/damkar.kotajambi/" target="_blank" rel="noopener" title="Instagram" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
</footer>

<style>
/* Pastikan Grid Footer Selalu 4 Kolom Seragam di Semua Halaman */
.footer .footer-grid {
    display: grid !important;
    grid-template-columns: 1.15fr 1.1fr 0.85fr 1.1fr !important;
    gap: clamp(24px, 4vw, 48px) !important;
    align-items: start !important;
}
@media (max-width: 1024px) {
    .footer .footer-grid {
        grid-template-columns: 1fr 1fr !important;
        gap: 32px !important;
    }
}
@media (max-width: 640px) {
    .footer .footer-grid {
        grid-template-columns: 1fr !important;
        gap: 28px !important;
    }
}

.footer-logo-main {
    max-height: 80px;
    width: auto;
    object-fit: contain;
    margin-bottom: 20px;
    display: block;
}
.footer-contact {
    margin-top: 24px;
    display: grid;
    gap: 12px;
}
.footer-contact a {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    color: rgba(255, 255, 255, 0.9);
    font-size: 0.95rem;
    font-weight: 500;
    text-decoration: none;
    transition: color 0.2s ease;
}
.footer-contact a i {
    color: #e5392d;
    font-size: 1.15rem;
    width: 20px;
    text-align: center;
}
.footer-contact a:hover {
    color: #ffb627;
}

/* Kolom Statistik & Logo WARLD di Bawah Total Kunjungan */
.footer-stats-col {
    display: flex;
    flex-direction: column;
}
.footer-warld-wrapper {
    margin-top: 24px;
    display: flex;
    align-items: center;
}
.footer-warld-link {
    display: inline-flex;
    align-items: center;
    text-decoration: none;
    transition: transform 0.25s ease;
}
.footer-warld-logo {
    max-width: 175px;
    width: 100%;
    height: auto;
    object-fit: contain;
    opacity: 0.95;
    transition: transform 0.25s ease, opacity 0.25s ease, filter 0.25s ease;
}
.footer-warld-link:hover .footer-warld-logo {
    opacity: 1;
    transform: scale(1.05);
    filter: drop-shadow(0 0 10px rgba(212, 255, 58, 0.45));
}

.footer .footer-links a {
    color: rgba(255, 255, 255, 0.7);
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 6px 0;
    font-size: 0.95rem;
    transition: color 0.2s, gap 0.2s;
}
.footer .footer-links a i {
    font-size: 0.7rem;
    color: #e5392d;
}
.footer .footer-links a:hover {
    color: #ffffff;
    gap: 14px;
}
</style>
