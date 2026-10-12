<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Satu baris = satu responden Survei Kepuasan Masyarakat (SKM).
 * Seluruh daftar pertanyaan didefinisikan di sini supaya form (view), validasi,
 * dan perhitungan IKM (controller) selalu memakai sumber yang sama.
 */
class IkmResponse extends Model
{
    protected $table = 'ikm_responses';

    protected $fillable = [
        // Identitas responden
        'tanggal_layanan', 'pendidikan', 'usia', 'pekerjaan', 'disabilitas',

        // 9 unsur pelayanan (11 pernyataan)
        'u1_a', 'u1_b', 'u2_a', 'u2_b', 'u3', 'u4', 'u5', 'u6', 'u7', 'u8', 'u9',

        // 5 aspek integritas
        'diskriminasi', 'kecurangan', 'gratifikasi', 'pungli', 'percaloan',

        // Penutup
        'kritik_saran', 'kepercayaan_pusat', 'kepercayaan_daerah',

        'ip_address',
    ];

    protected $casts = [
        'tanggal_layanan' => 'date',
        'disabilitas'     => 'boolean',
    ];

    /** Pilihan jawaban untuk semua pernyataan unsur & integritas. */
    public const SKALA = [
        1 => 'Sangat tidak setuju',
        2 => 'Tidak setuju',
        3 => 'Setuju',
        4 => 'Sangat setuju',
    ];

    // CATATAN: daftar pilihan di bawah disusun sendiri. Sesuaikan dengan pilihan di form SKM jika berbeda.
    public const PENDIDIKAN = [
        'SD',
        'SMP',
        'SMA/SMK',
        'Diploma (D1-D3)',
        'Sarjana (D4/S1)',
        'Magister (S2)',
        'Doktor (S3)',
    ];

    public const PEKERJAAN = [
        'PNS',
        'TNI/Polri',
        'Pegawai Swasta',
        'Wirausaha',
        'Pelajar/Mahasiswa',
        'Petani/Nelayan',
        'Ibu Rumah Tangga',
        'Pensiunan',
        'Lainnya',
    ];

    /** Pertanyaan skala 1-10 (kolom => teks). */
    public const KEPERCAYAAN = [
        'kepercayaan_pusat'  => 'Pada skala 1 sampai 10, di mana 1 berarti tidak percaya sama sekali dan 10 berarti sangat percaya, seberapa besar tingkat kepercayaan Anda terhadap pemerintah pusat?',
        'kepercayaan_daerah' => 'Pada skala 1 sampai 10, di mana 1 berarti tidak percaya sama sekali dan 10 berarti sangat percaya, seberapa besar tingkat kepercayaan Anda terhadap pemerintah daerah?',
    ];

    /**
     * 9 unsur pelayanan menurut Permenpan RB No. 14 Tahun 2017.
     * Bentuk: [no => ['nama' => ..., 'pernyataan' => [kolom => teks, ...]]]
     * Unsur 1 dan 2 punya dua pernyataan, unsur lainnya satu.
     */
    public static function unsur(): array
    {
        return [
            1 => ['nama' => 'Persyaratan', 'pernyataan' => [
                'u1_a' => 'Informasi pelayanan tersedia melalui media elektronik maupun nonelektronik',
                'u1_b' => 'Persyaratan yang diminta sesuai dengan yang diinformasikan',
            ]],
            2 => ['nama' => 'Sistem, Mekanisme, dan Prosedur', 'pernyataan' => [
                'u2_a' => 'Standar dan prosedur layanan diinformasikan dengan jelas',
                'u2_b' => 'Prosedur/alur layanan mudah dipahami dan dilakukan',
            ]],
            3 => ['nama' => 'Waktu Penyelesaian', 'pernyataan' => [
                'u3' => 'Jangka waktu layanan sesuai dengan yang diinformasikan',
            ]],
            4 => ['nama' => 'Biaya/Tarif', 'pernyataan' => [
                'u4' => 'Biaya layanan sesuai dengan yang diinformasikan',
            ]],
            5 => ['nama' => 'Produk Spesifikasi Jenis Pelayanan', 'pernyataan' => [
                'u5' => 'Produk layanan yang diterima sesuai dengan yang dipublikasikan',
            ]],
            6 => ['nama' => 'Kompetensi Pelaksana', 'pernyataan' => [
                'u6' => 'Aplikasi sistem pelayanan merespon kebutuhan dengan cepat (membuka halaman, konten, pencarian informasi, unduh/unggah)',
            ]],
            7 => ['nama' => 'Perilaku Pelaksana', 'pernyataan' => [
                'u7' => 'Fitur pada aplikasi sistem layanan mudah digunakan',
            ]],
            8 => ['nama' => 'Penanganan Pengaduan, Saran dan Masukan', 'pernyataan' => [
                'u8' => 'Layanan konsultasi dan pengaduan mudah diakses',
            ]],
            9 => ['nama' => 'Sarana dan Prasarana', 'pernyataan' => [
                'u9' => 'Sistem layanan online nyaman dan mudah digunakan',
            ]],
        ];
    }

    /** 5 aspek integritas pelayanan. */
    public static function integritas(): array
    {
        return [
            ['field' => 'diskriminasi', 'nama' => 'Diskriminasi Layanan',         'ikon' => 'fa-scale-balanced',    'pernyataan' => 'Saya dilayani secara adil tanpa diskriminasi'],
            ['field' => 'kecurangan',   'nama' => 'Kecurangan Pelayanan',         'ikon' => 'fa-clipboard-check',   'pernyataan' => 'Layanan diberikan sesuai prosedur tanpa adanya kecurangan'],
            ['field' => 'gratifikasi',  'nama' => 'Penerimaan Di Luar Ketentuan', 'ikon' => 'fa-hand-holding-dollar', 'pernyataan' => 'Pelayanan diberikan tanpa imbalan uang, barang, atau fasilitas di luar aturan'],
            ['field' => 'pungli',       'nama' => 'Pungutan Liar',                'ikon' => 'fa-ban',               'pernyataan' => 'Tidak ada pungutan liar (pungli) dalam pelayanan'],
            ['field' => 'percaloan',    'nama' => 'Percaloan',                    'ikon' => 'fa-user-slash',        'pernyataan' => 'Tidak ada percaloan/perantara tidak resmi dalam pelayanan'],
        ];
    }

    /** Semua kolom penilaian skala 1-4 (11 pernyataan unsur + 5 integritas). */
    public static function kolomPenilaian(): array
    {
        $kolom = [];
        foreach (self::unsur() as $u) {
            foreach (array_keys($u['pernyataan']) as $field) {
                $kolom[] = $field;
            }
        }
        foreach (self::integritas() as $ig) {
            $kolom[] = $ig['field'];
        }

        return $kolom;
    }
}