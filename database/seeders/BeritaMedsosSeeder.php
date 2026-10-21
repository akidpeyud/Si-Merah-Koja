<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Mengisi tabel berita_medsos dari daftar link (hasil file_link_berkas.xlsx).
 *
 * Jalankan:
 *   php artisan db:seed --class=BeritaMedsosSeeder
 *
 * - Satu link = satu baris berita_medsos.
 * - Nama sheet = kategori (dicocokkan ke kategori_berita.nama_kategori, dibuat bila belum ada).
 * - Bisa dijalankan ulang: link yang sudah ada di tabel dilewati (tidak dobel).
 * - Butuh `php artisan storage:link` agar gambar tampil.
 */
class BeritaMedsosSeeder extends Seeder
{
    private const UA_BROWSER  = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36';
    private const UA_FACEBOOK = 'facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)';
    private const UA_TWITTER  = 'Twitterbot/1.0';

    private const PLACEHOLDER_PATH = 'berita_medsos/placeholder.png';
    private const PLACEHOLDER_PNG  = 'iVBORw0KGgoAAAANSUhEUgAAAEAAAAAkCAIAAAC2bqvFAAAAPElEQVR42u3PMQ0AMAgAMJh/h3ycqJgLEpLWQbN64rIXxwkICAgICAgICAgICAgICAgICAgICAgICAhs++e4Au84WIkmAAAAAElFTkSuQmCC';

    /** Nama sumber yang rapi berdasarkan domain. */
    private const SITE_NAMES = [
        'instagram.com' => 'Instagram',
        'tiktok.com'    => 'TikTok',
        'youtube.com'   => 'YouTube',
        'youtu.be'      => 'YouTube',
        'facebook.com'  => 'Facebook',
        'fb.watch'      => 'Facebook',
        'x.com'         => 'X (Twitter)',
        'twitter.com'   => 'X (Twitter)',
        'jambione.com'                  => 'Jambi One',
        'jambiekspres.disway.id'        => 'Jambi Ekspres',
        'jambiekspres.bacakoran.co'     => 'Jambi Ekspres',
        'jambiindependent.disway.id'    => 'Jambi Independent',
        'jambiindependent.bacakoran.co' => 'Jambi Independent',
        'jambitv.disway.id'             => 'Jambi TV',
        'jambi.tribunnews.com'          => 'Tribun Jambi',
        'bicarajambi.com'               => 'Bicara Jambi',
        'sepucukjambi.id'               => 'Sepucuk Jambi',
        'mattanews.co'                  => 'Matta News',
        'infojambi.com'                 => 'Info Jambi',
        'siginjaione.com'               => 'Siginjai One',
        'metrojambi.com'                => 'Metro Jambi',
        'detik.com'                     => 'Detik',
        'regional.kompas.com'           => 'Kompas',
        'generasi-indonesia.com'        => 'Generasi Indonesia',
        'reportasenusantara.com'        => 'Reportase Nusantara',
        'detail.id'                     => 'Detail.id',
        'okezone.com'                   => 'Okezone',
        'inews.id'                      => 'iNews',
        'jambilink.id'                  => 'Jambilink',
        'jambiseru.com'                 => 'Jambi Seru',
        'jambibro.com'                  => 'Jambi Bro',
        'sekato.id'                     => 'Sekato',
        'signalberita.com'              => 'Signal Berita',
        'dradio.id'                     => 'D Radio',
        'ceritajambi.com'               => 'Cerita Jambi',
        'lihatjambi.com'                => 'Lihat Jambi',
        'seloko.id'                     => 'Seloko',
        'jambi.antaranews.com'          => 'Antara Jambi',
        'kabarku.id'                    => 'Kabarku',
        'jambiday.com'                  => 'Jambi Day',
        'jambiupdate.co'                => 'Jambi Update',
        'zonabrita.com'                 => 'Zona Brita',
        'sinarjambi.com'                => 'Sinar Jambi',
        'gracak.com'                    => 'Gracak',
        'mediakpk.co.id'                => 'Media KPK',
        'brisik.co'                     => 'Brisik',
        'jambikota.go.id'               => 'Pemkot Jambi',
        'jambi.indozone.id'             => 'Indozone Jambi',
        'swarajambi.net'                => 'Swara Jambi',
        'jambiprima.com'                => 'Jambi Prima',
        'seputarberita.co.id'           => 'Seputar Berita',
        'bidikindonesianews.co.id'      => 'Bidik Indonesia News',
        'jamberita.com'                 => 'Jamberita',
        'wartanews.co'                  => 'Warta News',
        'jambi.pikiran-rakyat.com'      => 'Pikiran Rakyat Jambi',
        'orasi.id'                      => 'Orasi',
        'global-hukumindonesia.id'      => 'Global Hukum Indonesia',
        'jambitrends.com'               => 'Jambi Trends',
    ];

    // =====================================================================
    //  DATA: [nama kategori (nama sheet)] => [daftar link]
    // =====================================================================
    private function data(): array
    {
        return [
            'Kebakaran Rumah' => [
                'https://mattanews.co/19-rumah-terbakar-di-cempaka-putih-jambi-damkar-kerahkan-60-personel/',
                'https://www.jambione.com/megapolitan/1367503933/kenapa-19-rumah-di-cempaka-putih-terbakar-ini-kata-damkartan-kota-jambi',
                'https://youtu.be/Feah-EPJ2WE',
                'https://jambiekspres.disway.id/hukum/read/714199/5-unit-rumah-terbakar-di-kawasan-padat-penduduk-arab-melayu-api-diduga-berasal-dari-tungku-masak',
                'https://youtu.be/IqDwj3ob1rM',
                'https://jambitv.disway.id/peristiwa/read/13568/kebakaran-hebat-di-arab-melayu-jambi-5-rumah-hangus-dilalap-api',
                'https://jambi.tribunnews.com/makalam/1194443/penyebab-kebakaran-di-arab-melayu-sebrang-kota-jambi-diduga-dari-bara-anglo',
                'https://youtu.be/OzIIcRYtXYQ',
                'https://youtu.be/3VvHiCwykDI',
                'https://www.metrojambi.com/metro/137381770/tempat-praktek-dokter-spesialis-anak-juga-ikut-terbakar-api-diduga-dari-korsleting-listrik',
                'https://youtu.be/K5lnr8kWhgw',
                'https://youtu.be/pU0FVrhzOXI',
                'https://youtu.be/mouEAwfZP6k',
                'https://youtu.be/D71f6rhkes4',
                'https://youtu.be/JIJAxLWh2Ks',
                'https://youtu.be/MpfTRxP-xVU',
                'https://youtu.be/zP0FxaV_Gec',
                'https://youtu.be/R6WPT-Vy1vM',
                'https://youtu.be/rPgXPeNNCr0',
                'https://sepucukjambi.id/kebakaran-hebat-di-poll-bbm-kota-baru-jambi-api-nyaris-picu-ledakan-tangki-damkar-beraksi/',
                'https://www.instagram.com/reel/DYXKfDfhSq9/',
                'https://www.bicarajambi.com/2026/05/aksi-heroik-damkartan-kota-jambi-cegah.html',
                'https://jambiekspres.disway.id/hukum/read/715516/gudang-minyak-di-kotabaru-terbakar-lima-kendaraan-hangus',
                'https://www.generasi-indonesia.com/2026/05/lima-kendaraan-pengangkut-bbm-non.html',
                'https://youtu.be/Ritp04mECAA',
                'https://youtu.be/PMArAu9Eo9Y',
                'https://reportasenusantara.com/gudang-minyak-di-kelurahan-sukakarya-kota-jambi-terbakar/',
                'https://www.jambione.com/megapolitan/1367405602/bedeng-2-pintu-di-paal-merah-ludes-terbakar-suara-ledakan-dari-plafon-jadi-awal-petaka',
                'https://www.generasi-indonesia.com/2026/06/respon-cepat-damkar-kebakaran-bedeng-di.html',
                'https://www.bicarajambi.com/2026/06/suara-letusan-di-plafon-damkartan-kota.html',
                'https://youtu.be/3xTMnH1wUwI',
                'https://www.jambione.com/megapolitan/1367415408/rumah-di-kenali-asam-atas-terbakar-saat-penghuni-tak-di-rumah-diduga-akibat-korsleting-komputer',
                'https://sepucukjambi.id/satu-rumah-semi-permanen-di-jambi-dilalap-api-dugaan-awal-berasal-dari-peralatan-komputer/',
                'https://jambiekspres.disway.id/hukum/read/717063/diduga-akibat-korsleting-satu-unit-rumah-semi-permanen-terbakar',
                'https://youtu.be/do35vZvnagU',
                'https://youtu.be/Wm7ptQbNyVY',
                'https://www.siginjaione.com/2026/07/kebakaran-melanda-dua-unit-rumah-di.html',
                'https://www.jambione.com/megapolitan/1367452509/diduga-korsleting-listrik-dua-rumah-di-arab-melayu-kota-jambi-terbakar',
                'https://jambiekspres.disway.id/hukum/read/718633/diduga-korsleting-listrik-dua-rumah-di-arab-melayu-jambi-terbakar',
                'https://www.infojambi.com/kebakaran-hebat-landa-pemukiman-pelayangan-satu-petugas-damkar-cedera',
                'https://youtu.be/Wven2eT9suQ',
                'https://youtu.be/1RZ-fm5ZM4o',
                'https://youtu.be/bJ-2Cpy-83k',
                'https://youtu.be/HMnRf7anQOI',
                'https://youtu.be/kpCWqor6I4I',
                'https://www.infojambi.com/asrama-polda-jambi-terbakar-petugas-damkar-nyaris-pingsan',
                'https://detail.id/2026/07/delapan-asrama-polisi-di-belakang-polda-jambi-hangus-terbakar-penyebab-masih-diselidiki/',
                'https://share.google/QLW0SiAh1MAfSwwF7',
                'https://www.generasi-indonesia.com/2026/07/delapan-rumah-dinas-mess-polda-jambi.html',
                'https://sepucukjambi.id/8-mess-rumah-dinas-polda-jambi-terbakar-damkartan-kerahkan-90-personel-dan-12-armada/',
                'https://www.jambione.com/megapolitan/1367474831/8-rumah-dinas-mess-polda-jambi-terbakar-damkartan-kerahkan-90-personel-padamkan-api',
                'https://www.siginjaione.com/2026/07/kebakaran-melanda-delapan-unit-rumah.html',
                'https://www.bicarajambi.com/2026/07/lawan-kobaran-api-damkartan-tembus.html',
                'https://youtu.be/riIldV1RrZY',
                'https://share.google/01UvYJ4Lkafv3xwZg',
                'https://youtu.be/N23BeqHZMuo',
                'https://www.bicarajambi.com/2026/08/senja-hingga-tengah-malam-damkartan.html',
                'https://youtu.be/IFLYSttuEfQ',
                'https://youtu.be/0RQHAmsWaVQ',
                'https://www.bicarajambi.com/2026/08/19-rumah-hangus-di-kawasan-cempaka.html',
                'https://jambiekspres.disway.id/hukum/read/721590/kebakaran-di-cempaka-putih-jelutung-19-rumah-hangus',
                'https://www.infojambi.com/pemukiman-padat-di-cempaka-putih-terbakar-19-rumah-hangus-dilahap-api',
                'https://www.jambione.com/megapolitan/1367503936/19-rumah-terbakar-di-cempaka-putih-jambi-maulana-diza-pastikan-korban-dapat-bantuan-hingga-pemulihan',
                'https://www.jambione.com/megapolitan/1367503745/cempaka-putih-kota-jambi-dilanda-kebakaran-19-rumah-terbakar-puluhan-warga-terdampak',
                'https://share.google/I2Bh8j7NLLoxj3pck',
                'https://youtu.be/GMRLbjMHtO4',
                'https://www.infojambi.com/kebakaran-landa-talang-banjar-rumah-kosong-dan-kios-dilahap-api',
                'https://www.jambione.com/megapolitan/1367513510/ini-daftar-kios-yang-terbakar-dalam-kebakaran-di-talang-banjar-kota-jambi',
                'https://www.jambione.com/megapolitan/1367513503/kebakaran-hanguskan-1-bangunan-dan-5-kios-di-talang-banjar-damkar-kerahkan-40-personel',
                'https://jambiekspres.disway.id/hukum/read/713336/kebakaran-rumah-di-kenali-besar-anak-6-tahun-alami-luka-bakar-di-wajah',
                'https://sepucukjambi.id/kebakaran-spbu-jelutung-jambi-damkar-padamkan-api-dalam-45-menit/',
                'https://www.jambione.com/megapolitan/1365945334/detik-detik-spbu-jelutung-terbakar-api-nyaris-melahap-seluruh-pompa-bensin',
                'https://www.infojambi.com/kebakaran-hebat-spbu-hanguskan-sebuah-mobil',
                'https://news.okezone.com/read/2025/04/30/340/3134920/spbu-di-jambi-terbakar-hebat-minibus-ludes-dilahap-api',
                'https://youtu.be/m-NacsBSyUY',
                'https://www.bicarajambi.com/2025/05/ditinggal-penghuninya-rumah-terbakar.html',
                'https://youtu.be/K5-NzujWysU',
                'https://youtu.be/f8m0DS9355o',
                'https://youtu.be/8LHdeDUnqnU',
                'https://youtu.be/tjuhuBpwCik',
                'https://youtu.be/p4kFZjiWC4Q',
                'https://www.detik.com/sumbagsel/berita/d-8104829/kbm-tetap-berjalan-usai-smp-20-jambi-terbakar-siswa-belajar-di-laboratorium',
                'https://regional.inews.id/berita/kebakaran-di-smpn-20-jambi-diduga-korsleting-listrik-dari-ruang-koperasi',
                'https://signalberita.com/gedung-smpn-20-kota-jambi-terbakar-ini-dugaan-sementara-menurut-wawako/',
                'https://jambilink.id/post/5519/damkar-kerahkan-7-armada-kebakaran-smpn-20-jambi-hanguskan-5-ruangan',
                'https://www.detik.com/sumbagsel/berita/d-8104732/6-ruangan-di-smp-20-kota-jambi-hangus-terbakar-diduga-korsleting-listrik',
                'https://dradio.id/kebakaran-sekolah-di-kota-jambi-enam-ruangan-hangus-diduga-korsleting-listrik/',
                'https://www.jambiseru.com/berita-jambi/10/09/gedung-smpn-20-kota-jambi-terbakar-enam-ruangan-hangus',
                'https://www.jambione.com/megapolitan/1366551674/si-jago-merah-lahap-smpn-20-kota-jambi-wawako-diza-langsung-tinjau-lokasi',
                'https://x.com/garudatvnews/status/1965710868232253642',
                'https://jambibro.com/smpn-20-terbakar-diza-langsung-turun/',
                'https://jambi.tribunnews.com/makalam/1175527/kebakaran-smpn-20-jambi-damkar-sempat-terkendala-rolling-door-dan-suplai-air',
                'https://sekato.id/smpn-20-kota-jambi-terbakar-wakil-wali-kota-diza-tinjau-langsung-lokasi/',
                'https://jambiindependent.disway.id/read/704279/breaking-news-smpn-20-kota-jambi-kebakaran-sejumlah-ruang-terbakar',
                'https://mediakpk.co.id/2025/09/10/kebakaran-smp-20-kota-jambi-api-hanguskan-ruang-kelas/',
                'https://youtu.be/QOhT3LklkPM',
                'https://youtu.be/pVp5iJLWAjI',
                'https://youtu.be/4wasc4pnCYs',
                'https://vt.tiktok.com/ZSy2cAXq1/',
                'https://youtu.be/tRtWSIroWDc',
                'https://www.infojambi.com/kebakaran-belasan-rumah-di-pucuk-diduga-akibat-korsleting-ac',
                'https://www.metrojambi.com/peristiwa/136773998/belasan-rumah-di-eks-lokalisasi-payo-sigadung-pucuk-kota-jambi-terbakar-penyebabnya-diduga-karena-ini',
                'https://regional.kompas.com/read/2025/10/31/220017978/kebakaran-di-eks-lokalisasi-payo-sigadung-jambi-12-rumah-hangus-dilalap-api',
                'https://jambiekspres.bacakoran.co/berita-utama/read/27932/pucuk-membara-12-rumah-terbakar',
                'https://regional.kompas.com/read/2025/10/31/191727478/12-rumah-di-jambi-ludes-terbakar-diduga-korsleting-ac-berdebu',
                'https://jambi.tribunnews.com/makalam/1180527/12-rumah-terbakar-di-eks-lokalisasi-payosigadung-jambi-terbakar',
                'https://youtu.be/RzUInsL4rcU',
                'https://youtu.be/fkrk-qNTdos',
                'https://youtu.be/5_0GlEAC-K8',
                'https://youtu.be/-F1rLOZHX_U',
                'https://youtu.be/lrU8957x2aw',
                'https://jambi.tribunnews.com/makalam/1181771/korsleting-kompor-listrik-hanguskan-rumah-dan-pabrik-tahu-di-koni-jambi',
                'https://vt.tiktok.com/ZSyvWNh27/',
                'https://youtu.be/lMghc2iyATo',
                'https://www.youtube.com/watch?v=HPzYCJeEFKQ',
                'https://youtu.be/H58Tbd7wMzM',
                'https://youtu.be/62P8f46bPMQ',
                'https://youtu.be/-65qojxYi_c',
                'https://youtu.be/-T_poWxegP0',
                'https://share.google/jFBezV53F5hR7qhvr',
                'https://youtu.be/NEXsHwdG3H4',
                'https://youtu.be/x5qpc9Dgg44',
                'https://youtu.be/E2DBTNttjdc',
                'https://youtu.be/SIJCWqyO_Ls',
            ],
            'Lainnya' => [
                'https://regional.kompas.com/read/2025/10/10/185557978/di-jambi-damkar-pun-dipanggil-untuk-panen-mangga',
                'https://share.google/qsny4AWy1KCkcl5X8',
                'https://youtu.be/IqCdgyhzPSI',
                'https://youtu.be/oeozgfwAr1M',
                'https://youtu.be/AN7XD1opAtE',
                'https://www.metrojambi.com/hukum/136774227/puluhan-motor-di-jambi-hilang-dalam-dua-pekan-mahasiswa-dan-warga-ngadu-ke-damkar',
                'https://youtu.be/K37lHIR1nMI',
                'https://www.infojambi.com/warga-amankan-pelaku-pelecehan-saat-kebakaran-pabrik-tahu',
                'https://youtu.be/e7fT63tuIsI',
                'https://youtu.be/Vr9bdPxxEgc',
                'https://youtu.be/IOzYYBfeV3s',
                'https://youtu.be/YxKpB_yu8RQ',
                'https://youtu.be/1EDQH4wPWrc',
                'https://youtu.be/FggPtmdokl0',
                'https://youtu.be/YB9eZzuzHk0',
                'https://youtu.be/E_Q4qm5DUxc',
                'https://youtu.be/BdPR89MXwhw',
                'https://youtu.be/GwRd0av3nc8',
                'https://www.facebook.com/share/v/1Gw2KgS87u/',
                'https://www.facebook.com/share/p/1CBWCF3bxG/',
                'https://www.facebook.com/share/v/1JGtdC7Hxd/',
                'https://www.facebook.com/share/v/18Xdfr1R3r/',
                'https://www.facebook.com/share/v/1HW2dX5E5P/',
            ],
            'Prestasi' => [
                'https://jambikota.go.id/berita/tim-firefighter-kota-jambi-berhasil-raih-juara-harapan-2-tingkat-pada-skill-competition-national',
                'https://www.jambione.com/megapolitan/1367374159/juara-regional-bersinar-nasional-damkar-kota-jambi-raih-harapan-2-di-ajang-firefighter-skill-competition-2026',
                'https://ceritajambi.com/tim-firefighter-kota-jambi-berhasil-raih-juara-harapan-2-tingkat-pada-skill-competition-national/',
                'https://www.bicarajambi.com/2026/04/luar-biasa-damkartan-kota-jambi-pulang.html',
                'https://youtu.be/DOhk7n1lsP8',
                'https://youtu.be/ezduLrees38',
                'https://jambiekspres.disway.id/read/698652/mustari-affandi-resmi-pimpin-apkari-wawako-minta-apkari-perkuat-profesionalisme',
                'https://www.bicarajambi.com/2025/07/mustari-affandi-pimpin-dpd-apkari-jambi.html',
                'https://jambiday.com/kadis-damkartan-kota-jambi-dilantik-menjadi-ketua-apkari-jambi/',
                'https://www.lihatjambi.com/daerah/57415791597/program-kota-tangguh-jadi-prioritas-walikota-jambi-damkartan-dapat-armada-baru',
                'https://www.infojambi.com/kadis-damkartan-kota-jambi-terima-indonesia-inspiring-professional-and-leadership-award-2025-2026',
                'https://www.jambione.com/kolom/1366980160/kadis-damkartan-kota-jambi-raih-inspiring-professional-and-leadership-award-20252026',
                'https://brisik.co/kadis-damkartan-kota-jambi-mustari-affandi-terima-penghargaan-inspiring-professional-and-leadership-award/',
                'https://youtu.be/_O8sKPdTB2Q',
                'https://jambi.tribunnews.com/makalam/1195086/tim-damkartan-kota-jambi-juara-regional-sumatera-di-national-firefighter-skill-competition-2026?sfnsn=wiwspwa',
            ],
            'Penyelamatan Warga' => [
                'https://www.bicarajambi.com/2026/04/jelang-senja-damkartan-kota-jambi.html',
                'https://youtu.be/ooPUcjfgkFs',
                'https://youtu.be/g3ur8h-FEBc',
                'https://youtu.be/7Qc7coSNPGM',
                'https://youtu.be/6nRptmW_0cQ',
                'https://sepucukjambi.id/pasien-hendak-cuci-darah-kesulitan-bergerak-9-personel-damkartan-kota-jambi-turun-tangan/',
                'https://www.bicarajambi.com/2025/02/lewat-tengah-malam-damkartan-kota-jambi.html',
                'https://www.jambione.com/megapolitan/1365679829/damkartan-kota-jambi-evakuasi-warga-terjebak-banjir-mustari-affandi-kami-siaga-24-jam',
                'https://www.jambiupdate.co/read/2025/02/23/117820/terjebak-genangan-banjir-belasan-warga-kota-jambi-terpaksa-di-evakuasi-tim-penyelamat',
                'https://sepucukjambi.id/satgas-evakuasi-korban-banjir-di-kota-baru/?amp=1',
                'https://www.jambione.com/megapolitan/1365724655/tak-pakai-pengaman-pria-di-jambi-kesetrum-dan-terjatuh-ke-kabel-listrik-dievakuasi-dengan-tali',
                'https://www.bicarajambi.com/2025/03/damkartan-kota-jambi-berhasil.html',
                'https://bidikindonesianews.co.id/damkartan-kota-jambi-selamatkan-warga-kesetrum-di-kabel-listrik/',
                'https://seputarberita.co.id/damkartan-kota-jambi-selamatkan-warga-kesetrum-di-kabel-listrik/',
                'https://youtu.be/GYQo7K_kWv8',
                'https://youtu.be/C9CJSY1REQM',
                'https://www.jambione.com/news/1365767633/dinyatakan-hilang-sejak-jumat-sore-warga-kenali-besar-ditemukan-meninggal-di-galian-pematang-gajah-jaluko',
                'https://jambiekspres.disway.id/read/692807/tim-damkartan-dikerahkan-lakukan-pencarian-bocah-hilang-di-kenali-besar-kota-jambi-ditemukan-tak-bernyawa',
                'https://regional.kompas.com/read/2025/03/30/170601378/satu-warga-jambi-tewas-usai-jatuh-ke-sungai-dan-tertimpa-bangunan-roboh',
                'https://jambi.tribunnews.com/2025/05/23/nenek-gultom-datangi-damkar-kota-jambi-jelang-telah-malam-telinganya-terjepit-anting-anting',
                'https://20.detik.com/detikupdate/20250523-250523071/video-aksi-damkar-jambi-bantu-lepas-anting-lansia-yang-tersangkut',
                'https://youtu.be/us5gpSwjbuU',
                'https://jambiekspres.disway.id/read/697857/wanita-obesitas-terjatuh-di-kamar-mandi-tim-damkartan-kota-jambi-lakukan-evakuasi-khusus',
                'https://sepucukjambi.id/terjebak-di-kamar-mandi-damkar-kota-jambi-evakuasi-wanita-obesitas/',
                'https://www.jambione.com/megapolitan/1366153365/butuh-1-jam-dan-15-petugas-evakuasi-wanita-obesitas-di-kota-jambi-ini-bikin-haru',
                'https://www.bicarajambi.com/2025/06/jatuh-di-kamar-mandi-wanita-overweight.html',
                'https://www.detik.com/sumbagsel/berita/d-7968878/jatuh-di-kamar-mandi-wanita-jambi-berbobot-130-kg-dibawa-damkar-ke-rs',
                'https://20.detik.com/detikupdate/20250617-250617128/video-momen-damkar-jambi-evakuasi-wanita-obesitas-jatuh-di-kamar-mandi',
                'https://youtu.be/0cXrub4dHcs',
                'https://youtu.be/21iPzYQCuqk',
                'https://www.infojambi.com/petugas-damkar-bantu-polisi-evakuasi-mayat-membusuk-dalam-rumah',
                'https://news.detik.com/detiktv/d-8007931/video-damkar-evakuasi-cincin-kawin-di-resepsi-pernikahan-warga-di-jambi',
                'https://youtu.be/ZMekhZrlx0U',
                'https://youtu.be/MG4J3UoX7xg',
                'https://jambiekspres.disway.id/read/699172/panik-saat-prosesi-pernikahan-cincin-tak-bisa-dilepas-damkar-jadi-penyelamat',
                'https://youtu.be/vFUqZx3xgDo',
                'https://youtu.be/D4M5L3lIbn4',
                'https://youtu.be/DifUcJIR0lA',
                'https://youtu.be/JIkrwXGh2xk',
                'https://www.instagram.com/reel/DQeiEL0Ad4D/',
                'https://youtu.be/ZVzCXTwHuy4',
                'https://youtu.be/EJrw1mJZOf0',
                'https://jambiindependent.bacakoran.co/read/36038/dengan-hati-hati-damkartan-kota-jambi-akhirnya-evakuasi-cincin-titanium-terjebak-di-jari-warga',
                'https://sepucukjambi.id/evakuasi-cincin-di-jari-warga-tim-damkartan-kota-jambi-tindak-cepat-dan-aman/',
                'https://jambiekspres.disway.id/metropolis/read/707380/duka-ditengah-banjir-kota-jambi-warga-tersengat-listrik-hingga-anak-terbawa-arus',
                'https://youtu.be/yum0JZAW0NU',
                'https://youtu.be/DsAw50W3yTM',
                'https://youtu.be/MaqL_c6Sugs',
                'https://youtu.be/pBjCJ_3hwUY',
                'https://youtu.be/7iwEFN5WyOg',
                'https://www.swarajambi.net/2025/12/saat-banjir-di-kota-jambi-damkartan-evakuasi-warga-hingga-lakukan-pencarian-anak.html',
                'https://jambiprima.com/read/2025/12/13/20244/banjir-terjang-kota-jambi-warga-tersengat-listrik-hingga-anak-hilang-terseret-arus',
                'https://jambi.tribunnews.com/makalam/1184498/banjir-meluas-di-jambi-damkar-evakuasi-warga-hingga-anak-hanyut',
                'https://jambi.indozone.id/news/2486509388/evakuasi-warga-dan-lansia-terjebak-banjir-di-kota-jambi',
                'https://youtu.be/SYzRNu1MvIA',
                'https://www.instagram.com/p/DSXRWD7k3SD/',
                'https://youtu.be/F5E9EQJfLt0',
                'https://youtu.be/IareWzhQ-go',
                'https://youtu.be/dUk0rNEEhOE',
                'https://youtu.be/5mQHrYYRcOw',
                'https://youtu.be/sXYXhfL4Gck',
                'https://seloko.id/mabuk-miras-berujung-maut-damkar-evakuasi-jasad-mahasiswa-asal-kumpeh-ulu-yang-terjatuh-dari-jembatan-batanghari-ii/',
                'https://www.infojambi.com/diduga-mabuk-di-jembatan-aurduri-ii-rudiono-tewas-terjatuh',
                'https://jambiekspres.disway.id/metropolis/read/708208/nongkrong-sambil-minum-alkohol-seorang-mahasiswa-20-tahun-terjatuh-di-jembatan-aurduri-ii',
                'https://www.instagram.com/p/DS4Akemkxpw/',
                'https://youtu.be/GNaqeFzQIp4',
                'https://youtu.be/jWFewK1D3n0',
                'https://youtu.be/hpOar5vE9oY',
            ],
            'Bencana Alam' => [
                'https://youtu.be/boQZwXmWBf0',
                'https://youtu.be/q1aHWml-Z1Y',
                'https://zonabrita.com/kesiapsiagaan-hadapi-bencana-banjir-wawako-jambi-cek-debit-ketinggian-air/',
                'https://www.jambione.com/megapolitan/1365839856/respon-cepat-ketua-dprd-kota-jambi-turun-ke-lokasi-rumah-amblas-di-aur-kenali',
                'https://ceritajambi.com/hujan-deras-sebabkan-rumah-amblas-di-jambi-ketua-dprd-tinjau-lokasi/',
                'https://jamberita.com/read/2025/04/03/5984192/respon-cepat-warga-meski-masih-lebaran-kfa-tinjau-rumah-warga-yang-amblas-ke-sungai/',
                'https://youtu.be/DSo8KtCiTHE',
                'https://youtu.be/aqibs6IimCI',
                'https://youtu.be/hh14AC-1OjY',
                'https://youtu.be/Rf7WelZVqII',
                'https://youtu.be/h2tnqeEUoOA',
                'https://youtu.be/3ejdX9mxukY',
                'https://youtu.be/F0JA1IgjbuY',
                'https://www.youtube.com/live/TFmGIiwB5kU',
                'https://youtu.be/LXgSA6zTaks',
                'https://youtu.be/DK1gOxUZ_gY',
                'https://youtu.be/Oax2HDoZ9x4',
                'https://youtu.be/MfcvMpxj2MY',
                'https://www.jambione.com/megapolitan/1366949506/inilah-rentetan-kejadian-darurat-saat-hujan-lebat-melanda-kota-jambi-nomor-3-paling-mengkhawatirkan-bagi-orang-tua',
                'https://jambi.tribunnews.com/news/1184559/kaleidoskop-hujan-deras-guyur-jambi-banjir-rendam-jalan-sekolah-hingga-rumah-sakit',
                'https://www.instagram.com/p/DSXPLRdkyep/',
                'https://youtu.be/5pe7IRwtPoQ',
                'https://youtu.be/q81L0vF8gBQ',
                'https://youtu.be/N0DT3h9JV9o',
                'https://youtu.be/cgPEzV9iPxg',
            ],
            'Edukasi' => [
                'https://youtu.be/ID5hN5Jkkws',
                'https://jambitrends.com/read/2026/07/18/291/damkar-goes-to-rt-edukasi-warga-rt-32-grand-kenali-cegah-dan-tangani-kebakaran',
                'https://www.youtube.com/live/ZT43sQh2THc',
                'https://www.youtube.com/live/nLuB2nk2neE',
                'https://www.youtube.com/live/A2Eg7Em23zo',
                'https://sepucukjambi.id/kemendagri-siap-fasilitasi-sdm-damkar-apkari-jambi-diminta-aktif-dorong-formasi-dan-anggaran/',
                'https://www.jambione.com/megapolitan/1366212638/dukungan-penuh-pemerintah-direktur-mpbk-bak-kemendagri-kota-jambi-diprioritaskan-dapat-hibah-armada-damkar',
                'https://share.google/nuHy2LczOU20jBT3w',
                'https://share.google/G8a7zCaAMRCfLRUxO',
                'https://sinarjambi.com/dinas-damkartan-kota-jambi-gelar-workshop/',
                'https://jambiekspres.disway.id/read/698656/sadar-bahaya-api-damkartan-kota-jambi-bekali-150-pelaku-usaha-hadapi-kebakaran',
                'https://www.kabarku.id/2025/07/waspada-bahaya-api-damkartan-kota-jambi.html',
                'https://jambi.tribunnews.com/2025/07/02/150-peserta-ikuti-workshop-pencegahan-dan-penanggulangan-kebakaran-di-kota-jambi',
                'https://www.jambione.com/megapolitan/1366213260/dinas-damkartan-kota-jambi-gelar-workshop-manajemen-pencegahan-kebakaran',
                'https://sepucukjambi.id/diklat-pemadam-1-kota-jambi-dinas-damkar-tingkatkan-kompetensi-sdm-damkar/',
                'https://jambiday.com/dinas-damkartan-kota-jambi-gelar-diklat-pemadam-1/',
                'https://www.jambione.com/megapolitan/1366214484/dinas-damkartan-kota-jambi-gelar-diklat-pemadam-1-tingkatkan-profesionalisme-dan-kapasitas-aparatur',
                'https://jambiekspres.disway.id/read/698667/gelar-diklat-pemadam-1-bekali-petugas-damkar-kota-jambi-untuk-lebih-profesional',
                'https://www.kabarku.id/2025/07/tingkatkan-kualitas-layanan-damkartan.html',
                'https://jambiupdate.co/read/2025/07/02/119009/gelar-diklat-pemadam-1-bekali-petugas-damkar-kota-jambi-untuk-lebih-profesional',
                'https://www.infojambi.com/diklat-keahlian-dan-keterampilan-petugas-damkar-resmi-ditutup-wakil-wali-kota-jambi',
                'https://www.bicarajambi.com/2025/07/diklat-keahlian-dan-keterampilan.html',
                'https://orasi.id/2025/07/wakil-wali-kota-jambi-resmi-tutup-diklat-pemadam-1/',
                'https://sepucukjambi.id/peningkatan-kapasitas-sdm-damkartan-kota-jambi-diklat-pemadam-1-sukses-digelar/',
                'https://jambiekspres.disway.id/read/698950/ditutup-wawako-diza-44-peserta-diklat-pemadam-lulus-dengan-predikat-memuaskan',
                'https://www.global-hukumindonesia.id/2025/07/wakil-walikota-jambi-resmi-tutup-diklat.html',
                'https://share.google/bojeQcet1r4QZlZX2',
                'https://jambiindependent.bacakoran.co/read/31099/komitmen-wali-kota-maulana-pemerintah-harus-hadir-dengan-fasilitas-terbaik-bagi-warga',
                'https://www.jambione.com/megapolitan/1366483473/wali-kota-maulana-serahkan-kendaraan-rescue-perkuat-kesiapsiagaan-damkartan-kota-jambi',
                'https://sinarjambi.com/lengkapi-armada-rescue-wali-kota-maulana-tingkatkan-keselamatan-masyarakat-semakin-optimal/',
                'https://ceritajambi.com/tingkatkan-layanan-keselamatan-pemkot-jambi-lengkapi-damkartan-dengan-5-unit-kendaraan-rescue/',
                'https://jambinewsroom.com/berita/read/fasilitas-damkartan-terus-ditingkatkan-pemkot-jambi-wujudkan-kota-tangguh-hadapi-bencana',
                'https://jambiindependent.bacakoran.co/read/31100/wawako-diza-kehadiran-ttis-penting-jaga-keamanan-sistem-elektronik-pemerintah',
                'https://zonabrita.com/wali-kota-maulana-kukuhkan-redkar-2025-relawan-damkar-ditetapkan-sebagai-garda-terdepan-kemanusiaan/',
                'https://jambi.pikiran-rakyat.com/jambi-raya/pr-3469805181/walikota-maulana-relawan-pemadam-kebakaran-adalah-garda-terdepan-keselamatan-warga-jambi',
                'https://jambi.antaranews.com/berita/639213/pemkot-jambi-berdayakan-masyarakat-mitigasi-bencana-lewat-redkar-2025',
                'https://wartanews.co/kukuhkan-redkar-kota-jambi-wali-kota-maulana-apresiasi-peran-emak-emak/',
                'https://www.lihatjambi.com/daerah/57416284391/wali-kota-maulana-kukuhkan-relawan-pemadam-kebakaran-kota-jambi-2025-perkuat-program-kampung-tangguh',
                'https://rri.co.id/daerah/1984256/sebanyak-360-relawan-damkar-kota-jambi-akan-dikukuhkan',
                'https://tanyafakta.co/read/2025/11/20/17819/wali-kota-maulana-kukuhkan-relawan-pemadam-kebakaran-2025-untuk-perkuat-program-kampung-tangguh-jambi/',
                'https://youtu.be/9z-jhHB9djc',
                'https://www.instagram.com/reel/DSRd6I_Es8u/',
                'https://www.instagram.com/reel/DSgj6_Zk6Qh/',
                'https://youtu.be/oFgOc0_CxCQ',
            ],
            'Evakuasi Hewan' => [
                'https://youtu.be/iPdIU7DpF-0',
                'https://sepucukjambi.id/geger-subuh-ular-sanca-3-meter-masuk-perumahan-di-kota-jambi-damkar-bereaksi/',
                'https://vt.tiktok.com/ZSHGFCtKL/',
                'https://jambiekspres.disway.id/metropolis/read/713834/belum-hilang-kaget-muncul-lagi-dua-sanca-teror-warga-kota-jambi-dalam-semalam',
                'https://jambiindependent.disway.id/metronews/read/711904/warga-alam-barajo-kota-jambi-dibuat-geger-dengan-kemunculkan-seekor-ular-sanca',
                'https://mattanews.co/respon-cepat-damkartan-kota-jambi-kucing-terjebak-di-plafon-rumah-berhasil-dievakuasi/',
                'https://www.facebook.com/share/r/1Kk45Xpzdh/',
                'https://www.instagram.com/reel/DXRZzqWk7lx/',
                'https://www.bicarajambi.com/2026/04/mangsa-ternak-warga-ular-berbobot-50-kg.html',
                'https://youtu.be/07-biDWnqvY',
                'https://www.bicarajambi.com/2026/05/musang-dan-ular-sanca-keok-di-tangan.html',
                'https://www.bicarajambi.com/2026/05/serang-fakultas-hukum-unja-ditaklukan.html',
                'https://youtu.be/hz9HMTea3ds',
                'https://youtu.be/kl9xjEtSnx0',
                'https://youtu.be/tw8U0BiBFtE',
                'https://youtu.be/-PPfsgrjB_E',
                'https://youtu.be/lX-tuwQ8LJc',
                'https://youtu.be/X3pa-Wfime4',
                'https://youtu.be/jT5X6mSNGf8',
                'https://youtu.be/MrxsfvBP3ec',
                'https://youtu.be/qC7q1WcYTWY',
                'https://youtu.be/GzG54YlLexk',
                'https://youtu.be/851FdsXOvFQ',
                'https://www.siginjaione.com/2026/08/dua-ular-sanca-raksasa-bersembunyi-di.html',
                'https://sepucukjambi.id/kobra-satu-meter-gegerkan-warga-danau-teluk-tim-damkar-jambi-bergerak-4-menit-ke-lokasi/',
                'https://www.jambione.com/megapolitan/1367493709/gagal-dievakuasi-warga-hingga-dini-hari-sapi-di-jambi-diselamatkan-damkar',
                'https://youtu.be/wuHnE0bbNFo',
                'https://www.bicarajambi.com/2025/02/2-ular-dan-1-biawak-tak-berkutik-di.html',
                'https://www.bicarajambi.com/2025/02/oyen-tersenyum-haru-diselamatkan.html',
                'https://www.bicarajambi.com/2025/02/januari-2025-ada-33-ular-dievakuasi.html',
                'https://www.bicarajambi.com/2025/02/ular-sanca-berulah-memangsa-seekor-ayam.html',
                'https://regional.kompas.com/read/2025/04/03/155925078/ular-masuk-ke-rumah-warga-pascabanjir-di-jambi-ada-sanca-dan-kobra',
                'https://youtu.be/qoiz6v46ZDQ',
                'https://jambi.tribunnews.com/2025/05/21/ular-sanca-di-paal-5-kota-jambi-sempat-tarung-vs-petugas-damkar-bersarang-di-gorong-gorong-warga',
                'https://youtu.be/kMyV5R3-6rE',
                'https://youtu.be/DQp6Kj4QYIs',
                'https://youtu.be/DNAwjUkshLE',
                'https://youtu.be/5ib5zo2pYn4',
                'https://jambi.tribunnews.com/2025/06/19/damkar-kota-jambi-evakuasi-ular-sanca-3-meter-dari-drainase-warga',
                'https://jambiekspres.disway.id/read/698991/damkar-kota-jambi-evakuasi-ular-sanca-sepanjang-1-meter-di-kebun-handil',
                'https://jambiekspres.disway.id/read/698997/anak-kera-masuk-bak-penampung-air-damkar-jambi-lakukan-evakuasi-di-olak-kemang',
                'https://youtu.be/Y5j75aOd0g8',
                'https://youtu.be/-fn5S9hW5zk',
                'https://youtu.be/fUEjKSvyMD4',
                'https://youtu.be/cnuuu2gQjqM',
                'https://youtu.be/R9PQwCZqeBI',
                'https://youtu.be/UQUvCqQMYKc',
                'https://youtu.be/Zz21QTrxtNM',
                'https://youtu.be/lBh1lOBqzZs',
                'https://youtu.be/95vPHEKyZ-U',
                'https://youtu.be/nzGvW34ca9w',
                'https://youtu.be/t3s36VMyOkM',
                'https://youtu.be/13V-mf8I-2I',
                'https://youtu.be/oBsOy2QPUAs',
                'https://vt.tiktok.com/ZSyvcWVJ4/',
                'https://youtu.be/5adi24YEkB0',
                'https://youtu.be/JFdOX1BO7xE',
                'https://youtu.be/quQ2qw0Wbm8',
                'https://youtu.be/l3tcQQt7osk',
                'https://youtu.be/-4M_qXSZ0QM',
                'https://youtu.be/klsQInNt_mE',
                'https://youtu.be/JbBNhwGrn1E',
                'https://youtu.be/JlKvond732k',
                'https://youtu.be/MNHWVDbpMYY',
                'https://youtu.be/ltqZw_9GEWc',
                'https://youtu.be/kh1NuMASZOw',
                'https://youtu.be/B0CyQi8xGKQ',
                'https://youtu.be/fH8jjeCSzLU',
                'https://youtu.be/cFtBBFT-TTc',
                'https://youtu.be/qsV4SBgX5JU',
                'https://youtu.be/NOSY0NMLuto',
                'https://youtu.be/7MpvCnxlMeo',
                'https://youtu.be/BVVHMAEEAuM',
                'https://youtu.be/BhtJBGCutWY',
                'https://youtu.be/HABpzwNUuMI',
                'https://youtu.be/AJo5-TikG7Q',
            ],
            'Kebakaran Lahan' => [
                'https://sepucukjambi.id/respons-10-menit-damkar-jambi-berhasil-kendalikan-api-di-area-lapangan-tembak/',
                'https://youtu.be/0a0sAG0MbzM',
                'https://www.siginjaione.com/2026/08/kebakaran-lahan-terjadi-di-kelurahan.html',
                'https://www.jambione.com/megapolitan/1367477514/kebakaran-lahan-dekat-sekolah-rakyat-di-alam-barajo-damkar-berjibaku-25-jam-padamkan-api',
                'https://www.siginjaione.com/2026/08/kebakaran-lahan-kawasan-kuburan.html',
                'https://gracak.com/berita/420/lahan-dekat-pemakaman-sengkawang-di-jambi-terbakar-damkar-padamkan-api-dalam-43-menit',
                'https://seloko.id/lahan-kuburan-sengkawang-jambi-terbakar/',
                'https://mattanews.co/kebakaran-lahan-di-kuburan-sengkawang-jambi-diduga-dipicu-pembakaran-sampah/',
                'https://gracak.com/berita/419/lahan-dekat-sekolah-rakyat-di-jambi-terbakar',
                'https://seloko.id/lahan-1-hektar-di-mayang-mangurai-terbakar-petugas-damkar-berjibaku-padamkan-api/',
                'https://youtu.be/QV4I3SBZCNw',
                'https://youtu.be/agz04cCcjHs',
                'https://youtu.be/6QMB9wISUIo',
                'https://youtu.be/AzMT0hBajUM',
            ],
            'Pemberian Bantuan' => [
                'https://jambi.antaranews.com/berita/605013/pemerintah-kota-jambi-serahkan-bantuan-bencana-kebakaran',
                'https://jambi.tribunnews.com/2025/02/17/serahkan-bantuan-korban-bencana-kota-jambi-pj-wali-kota-wujud-hadirnya-pemerintah',
                'https://www.jambione.com/megapolitan/1365657102/serahkan-bantuan-korban-pj-wali-kota-ingatkan-warga-mawas-diri',
                'https://www.kabarku.id/2025/02/haru-pilu-pj-wali-kota-jambi-serahkan.html',
                'https://sepucukjambi.id/walikota-jambi-maulana-perkuat-program-kota-tangguh-serahkan-bantuan-korban-bencana/',
                'https://youtu.be/f7ZpmxT0-jg',
                'https://sepucukjambi.id/dijadwalkan-pekan-depan-walikota-maulana-instruksikan-pengiriman-bantuan-kemanusiaan-untuk-korban-bencana-sumatera/',
                'https://ceritajambi.com/wali-kota-maulana-instruksikan-pengiriman-bantuan-bagi-korban-banjir-di-pulau-sumatera/',
                'https://www.jambione.com/megapolitan/1366895654/pemkot-jambi-siapkan-tim-khusus-bantu-korban-bencana-di-sumatera-maulana-semua-dipersiapkan-matang',
                'https://jambiekspres.disway.id/metropolis/read/706703/peduli-sesama-pemkot-jambi-kirim-tim-khusus-bantu-korban-bencana-di-sumatera',
            ],
            'Kebakaran Benda' => [
                'https://news.detik.com/detiktv/d-8015173/video-diduga-korsleting-motor-listrik-di-jambi-terbakar-di-jalan',
                'https://jambi.antaranews.com/berita/622329/damkartan-kota-jambi-padamkan-motor-terbakar-akibat-percikan-api',
                'https://www.instagram.com/reel/DMK2fhxJx1X/',
                'https://youtu.be/4awX9liS2Bc',
                'https://youtu.be/Su46iy6-54k',
                'https://www.lihatjambi.com/daerah/57416286960/mobil-tangki-pt-putra-mauli-energi-terbakar-di-bagan-pete-satu-korban-ditemukan-meninggal-di-bawah-seng',
                'https://sepucukjambi.id/breaking-news-satu-orang-tewas-dalam-kebakaran-diduga-gudang-minyak-di-bagan-pete/',
                'https://sepucukjambi.id/mobil-tangki-ikut-terbakar-si-jago-merah-lahap-diduga-gudang-minyak-ilegal-di-bagan-pete/',
                'https://jambiindependent.disway.id/metronews/read/707334/breaking-news-kebakaran-landa-bangunan-diduga-gudang-minyak-di-bagan-pete',
                'https://jambiindependent.disway.id/metronews/read/707340/mobil-tangki-pt-putra-mauli-energi-terbakar-di-bagan-pete-1-orang-tewas',
                'https://youtu.be/aIb9JYHHCyo',
                'https://jambiekspres.disway.id/hukum/read/706699/motor-terbakar-di-kawasan-tugu-keris-respon-kilat-damkar-berhasil-padamkan-api',
                'https://jambi.tribunnews.com/makalam/1183344/motor-125-cc-terbakar-di-kota-jambi-minggu-pagi-milik-warga-riau',
                'https://ceritajambi.com/motor-terbakar-di-tugu-keris-damkar-sigap-padamkan-api/',
                'https://youtu.be/0RPr3i5lsUE',
            ],
        ];
    }

    // =====================================================================
    //  RUN
    // =====================================================================
    public function run(): void
    {
        set_time_limit(0);

        $fetch = $this->command
            ? $this->command->confirm('Tarik judul, tanggal & gambar dari internet? (lebih lama, hasil lebih lengkap)', true)
            : true;

        $this->ensurePlaceholder();

        // Link yang sudah ada di database dilewati supaya seeder aman dijalankan ulang
        $existing = [];
        foreach (DB::table('berita_medsos')->whereNotNull('link')->pluck('link') as $l) {
            $existing[$this->dedupeKey($l)] = true;
        }

        $data    = $this->data();
        $total   = array_sum(array_map('count', $data));
        $no      = 0;
        $lengkap = 0;
        $parsial = 0;
        $skip    = 0;

        foreach ($data as $namaKategori => $links) {
            $kategoriId = $this->kategoriId($namaKategori);
            $this->say("== {$namaKategori} (" . count($links) . ' link)', 'info');

            foreach ($links as $link) {
                $no++;
                $key = $this->dedupeKey($link);

                if (isset($existing[$key])) {
                    $skip++;
                    continue;
                }

                $meta = $fetch ? $this->fetchMeta($link) : [];

                // Link share.google diganti dengan alamat aslinya bila berhasil di-resolve
                $finalLink = $link;
                if ($this->hostIs($this->hostOf($link), ['share.google']) && !empty($meta['final_url'])) {
                    $finalLink = $this->cleanLink($meta['final_url']);
                    $key2 = $this->dedupeKey($finalLink);
                    if (isset($existing[$key2])) {
                        $skip++;
                        continue;
                    }
                    $existing[$key2] = true;
                }
                $existing[$key] = true;

                $sumber  = $this->sumberDariLink($finalLink);
                $judul   = !empty($meta['title']) ? $meta['title'] : $this->judulDariUrl($finalLink, $sumber);
                $tanggal = $meta['date'] ?? $this->tanggalDariUrl($finalLink) ?? now()->format('Y-m-d H:i:s');
                $gambar  = !empty($meta['image']) ? $this->unduhGambar($meta['image'], $finalLink) : null;

                $lengkapItem = $gambar !== null && !empty($meta['title']);
                $gambar    ??= self::PLACEHOLDER_PATH;

                DB::table('berita_medsos')->insert([
                    'kategori_id' => $kategoriId,
                    'judul'       => Str::limit($judul, 250, ''),
                    'tanggal'     => $tanggal,
                    'sumber'      => $sumber,
                    'link'        => Str::limit($finalLink, 250, ''),
                    'gambar'      => $gambar,
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ]);

                $lengkapItem ? $lengkap++ : $parsial++;

                $this->say(sprintf(
                    '[%d/%d] %s %s',
                    $no,
                    $total,
                    $lengkapItem ? 'OK     ' : 'PARSIAL',
                    Str::limit($judul, 70)
                ), $lengkapItem ? 'line' : 'comment');
            }
        }

        $this->say("Selesai. Lengkap: {$lengkap}, parsial (judul dari URL dan/atau gambar placeholder): {$parsial}, dilewati (sudah ada): {$skip}.", 'info');
    }

    private function say(string $message, string $type = 'line'): void
    {
        $this->command?->{$type}($message);
    }

    // =====================================================================
    //  KATEGORI
    // =====================================================================
    private function kategoriId(string $nama): ?int
    {
        $row = DB::table('kategori_berita')
            ->whereRaw('LOWER(nama_kategori) = ?', [mb_strtolower($nama)])
            ->first();

        if ($row) {
            return (int) $row->id;
        }

        try {
            $data = ['nama_kategori' => $nama];
            if (Schema::hasColumn('kategori_berita', 'created_at')) {
                $data['created_at'] = now();
            }
            if (Schema::hasColumn('kategori_berita', 'updated_at')) {
                $data['updated_at'] = now();
            }
            return (int) DB::table('kategori_berita')->insertGetId($data);
        } catch (\Throwable $e) {
            $this->say("Gagal membuat kategori '{$nama}' ({$e->getMessage()}). Berita kategori ini disimpan tanpa kategori.", 'error');
            return null;
        }
    }

    // =====================================================================
    //  AMBIL METADATA (judul, gambar, tanggal)
    // =====================================================================
    private function fetchMeta(string $url): array
    {
        $host   = $this->hostOf($url);
        $result = [];

        try {
            if ($this->hostIs($host, ['youtube.com', 'youtu.be'])) {
                $result = $this->metaYoutube($url);
            } elseif ($this->hostIs($host, ['tiktok.com'])) {
                $result = $this->metaTiktok($url);
            }

            if (empty($result['title']) || empty($result['image'])) {
                $og = $this->metaOpenGraph($url);
                foreach ($og as $k => $v) {
                    if (empty($result[$k]) && !empty($v)) {
                        $result[$k] = $v;
                    }
                }
            }
        } catch (\Throwable $e) {
            // gagal total: seeder tetap lanjut dengan data dari URL
        }

        return $result;
    }

    private function metaYoutube(string $url): array
    {
        $id = $this->extractYoutubeId($url);
        if (!$id) {
            return [];
        }

        $title = null;
        try {
            $res = Http::timeout(8)->get('https://www.youtube.com/oembed', [
                'url'    => 'https://www.youtube.com/watch?v=' . $id,
                'format' => 'json',
            ]);
            if ($res->ok()) {
                $title = $res->json('title');
            }
        } catch (\Throwable $e) {
        }

        $image = "https://img.youtube.com/vi/{$id}/maxresdefault.jpg";
        try {
            if (Http::timeout(8)->head($image)->status() !== 200) {
                $image = "https://img.youtube.com/vi/{$id}/hqdefault.jpg";
            }
        } catch (\Throwable $e) {
            $image = "https://img.youtube.com/vi/{$id}/hqdefault.jpg";
        }

        return ['title' => $title, 'image' => $image];
    }

    private function metaTiktok(string $url): array
    {
        try {
            $res = Http::timeout(10)->get('https://www.tiktok.com/oembed', ['url' => $url]);
            if ($res->ok()) {
                return [
                    'title' => $res->json('title'),
                    'image' => $res->json('thumbnail_url'),
                ];
            }
        } catch (\Throwable $e) {
        }

        return [];
    }

    /** Baca tag Open Graph; coba UA browser dulu, lalu UA crawler Facebook & Twitter. */
    private function metaOpenGraph(string $url): array
    {
        $best = [];

        foreach ([self::UA_BROWSER, self::UA_FACEBOOK, self::UA_TWITTER] as $ua) {
            $fetched = $this->httpGet($url, $ua);
            $res     = $fetched['res'];

            if (!$res || !$res->ok()) {
                continue;
            }

            $parsed = $this->parseMeta($res->body(), $fetched['final']);
            $parsed['final_url'] = $fetched['final'];

            if (empty($best) || (empty($best['image']) && !empty($parsed['image']))) {
                $best = $parsed;
            }

            if (!empty($best['title']) && !empty($best['image'])) {
                break;
            }
        }

        return $best;
    }

    private function httpGet(string $url, string $userAgent, ?string $referer = null): array
    {
        $final = $url;

        try {
            $res = Http::timeout(10)
                ->connectTimeout(5)
                ->withHeaders(array_filter([
                    'User-Agent'      => $userAgent,
                    'Accept'          => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                    'Accept-Language' => 'id-ID,id;q=0.9,en;q=0.8',
                    'Referer'         => $referer,
                ]))
                ->withOptions([
                    'allow_redirects' => ['max' => 5],
                    'on_stats'        => function (\GuzzleHttp\TransferStats $stats) use (&$final) {
                        $final = (string) $stats->getEffectiveUri();
                    },
                ])
                ->get($url);

            return ['res' => $res, 'final' => $final];
        } catch (\Throwable $e) {
            return ['res' => null, 'final' => $url];
        }
    }

    private function parseMeta(string $html, string $baseUrl): array
    {
        $html = substr($html, 0, 800000);

        $doc = new \DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTML('<?xml encoding="utf-8" ?>' . $html);
        libxml_clear_errors();

        $meta = [];
        foreach ($doc->getElementsByTagName('meta') as $m) {
            $key = strtolower($m->getAttribute('property') ?: $m->getAttribute('name'));
            $val = trim($m->getAttribute('content'));
            if ($key !== '' && $val !== '' && !isset($meta[$key])) {
                $meta[$key] = $val;
            }
        }

        $title = $meta['og:title'] ?? $meta['twitter:title'] ?? null;
        if (!$title) {
            $t     = $doc->getElementsByTagName('title')->item(0);
            $title = $t ? trim($t->textContent) : null;
        }

        // Abaikan halaman tantangan anti-bot / login
        if ($title && preg_match('/^(just a moment|attention required|access denied|403 forbidden|are you a robot|log in|login|instagram$)/i', $title)) {
            $title = null;
        }

        $image = $meta['og:image:secure_url']
            ?? $meta['og:image']
            ?? $meta['twitter:image']
            ?? $meta['twitter:image:src']
            ?? null;

        $published = $meta['article:published_time']
            ?? $meta['og:article:published_time']
            ?? null;

        $date = null;
        if ($published) {
            try {
                $date = Carbon::parse($published)->timezone('Asia/Jakarta')->format('Y-m-d H:i:s');
            } catch (\Throwable $e) {
                $date = null;
            }
        }

        return [
            'title' => $title ? trim($title) : null,
            'image' => $image ? $this->absoluteUrl($image, $baseUrl) : null,
            'date'  => $date,
        ];
    }

    private function absoluteUrl(string $path, string $baseUrl): string
    {
        if (preg_match('#^https?://#i', $path)) {
            return $path;
        }

        $p      = parse_url($baseUrl);
        $scheme = $p['scheme'] ?? 'https';

        if (str_starts_with($path, '//')) {
            return $scheme . ':' . $path;
        }

        $origin = $scheme . '://' . ($p['host'] ?? '') . (isset($p['port']) ? ':' . $p['port'] : '');

        if (str_starts_with($path, '/')) {
            return $origin . $path;
        }

        return $origin . rtrim(dirname($p['path'] ?? '/'), '/') . '/' . $path;
    }

    // =====================================================================
    //  GAMBAR
    // =====================================================================
    private function unduhGambar(string $imageUrl, ?string $referer = null): ?string
    {
        try {
            $res = Http::timeout(15)
                ->connectTimeout(5)
                ->withHeaders(array_filter([
                    'User-Agent' => self::UA_BROWSER,
                    'Accept'     => 'image/avif,image/webp,image/*,*/*;q=0.8',
                    'Referer'    => $referer,
                ]))
                ->get($imageUrl);

            if (!$res->ok()) {
                return null;
            }

            $body = $res->body();
            $size = strlen($body);
            if ($size < 1024 || $size > 5 * 1024 * 1024) {
                return null;
            }

            $mime = (new \finfo(FILEINFO_MIME_TYPE))->buffer($body);
            $ext  = match ($mime) {
                'image/jpeg' => 'jpg',
                'image/png'  => 'png',
                'image/webp' => 'webp',
                default      => null,
            };

            if (!$ext) {
                return null;
            }

            $path = 'berita_medsos/' . Str::random(40) . '.' . $ext;
            Storage::disk('public')->put($path, $body);

            return $path;
        } catch (\Throwable $e) {
            return null;
        }
    }

    /** Gambar abu-abu polos untuk berita yang gambarnya tidak bisa diambil (kolom gambar wajib diisi). */
    private function ensurePlaceholder(): void
    {
        $disk = Storage::disk('public');
        if (!$disk->exists(self::PLACEHOLDER_PATH)) {
            $disk->put(self::PLACEHOLDER_PATH, base64_decode(self::PLACEHOLDER_PNG));
        }
    }

    // =====================================================================
    //  HELPER URL
    // =====================================================================
    private function hostOf(?string $url): string
    {
        $host = strtolower(parse_url($url ?? '', PHP_URL_HOST) ?? '');
        return preg_replace('/^www\./', '', $host);
    }

    private function hostIs(string $host, array $domains): bool
    {
        foreach ($domains as $d) {
            if ($host === $d || str_ends_with($host, '.' . $d)) {
                return true;
            }
        }
        return false;
    }

    private function sumberDariLink(?string $url): string
    {
        $host = $this->hostOf($url);

        foreach (self::SITE_NAMES as $domain => $name) {
            if ($host === $domain || str_ends_with($host, '.' . $domain)) {
                return $name;
            }
        }

        return $host !== '' ? $host : 'Website';
    }

    /** Buang parameter pelacak (si, igsh, utm_*, spref, dst). */
    private function cleanLink(string $url): string
    {
        $p = parse_url($url);
        if (!$p || empty($p['host'])) {
            return $url;
        }

        $drop = ['si', 'igsh', 'igshid', 'spref', 'fbclid', 'gclid', 'feature', 'page', 'ref'];
        parse_str($p['query'] ?? '', $query);
        foreach (array_keys($query) as $k) {
            if (in_array(strtolower($k), $drop, true) || str_starts_with(strtolower($k), 'utm_')) {
                unset($query[$k]);
            }
        }

        $clean = ($p['scheme'] ?? 'https') . '://' . $p['host']
            . (isset($p['port']) ? ':' . $p['port'] : '')
            . ($p['path'] ?? '');

        if (!empty($query)) {
            $clean .= '?' . http_build_query($query);
        }

        return $clean;
    }

    /** Kunci pembanding link agar tidak masuk dobel (YouTube dibandingkan dari ID videonya). */
    private function dedupeKey(string $url): string
    {
        $id = $this->extractYoutubeId($url);
        if ($id) {
            return 'yt:' . $id;
        }

        $p = parse_url($this->cleanLink($url));
        $host = strtolower(preg_replace('/^www\./', '', $p['host'] ?? ''));

        return $host . rtrim($p['path'] ?? '', '/') . (isset($p['query']) ? '?' . $p['query'] : '');
    }

    private function extractYoutubeId(string $url): ?string
    {
        $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?|shorts|live)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i';

        return preg_match($pattern, $url, $m) ? $m[1] : null;
    }

    // =====================================================================
    //  CADANGAN BILA TIDAK ADA INTERNET / SITUS MEMBLOKIR
    // =====================================================================
    private function judulDariUrl(string $url, string $sumber): string
    {
        $path = parse_url($url, PHP_URL_PATH) ?? '';
        $slug = basename(rtrim($path, '/'));
        $slug = preg_replace('/\.(html?|php)$/i', '', $slug);
        $text = trim(preg_replace('/[-_]+/', ' ', $slug));

        // slug yang cuma angka / terlalu pendek / ID video bukan judul yang berarti
        if ($text === '' || ctype_digit($text) || mb_strlen($text) < 12 || !str_contains($text, ' ')) {
            return 'Publikasi ' . $sumber;
        }

        return mb_strtoupper(mb_substr($text, 0, 1)) . mb_substr($text, 1);
    }

    private function tanggalDariUrl(string $url): ?string
    {
        // .../2025/04/30/...  (tanggal lengkap)
        if (preg_match('#/(20\d{2})/(0[1-9]|1[0-2])/(0[1-9]|[12]\d|3[01])(?=/|$)#', $url, $m)) {
            return "{$m[1]}-{$m[2]}-{$m[3]} 12:00:00";
        }

        // .../2026/05/...  (hanya bulan, mis. blogspot) -> tanggal 1
        if (preg_match('#/(20\d{2})/(0[1-9]|1[0-2])/#', $url, $m)) {
            return "{$m[1]}-{$m[2]}-01 12:00:00x";
        }

        return null;
    }
}