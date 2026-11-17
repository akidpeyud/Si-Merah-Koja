<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PencegahanTemplateExport implements FromArray, ShouldAutoSize, WithHeadings, WithStyles
{
    public function __construct(public string $modul) {}

    /**
     * @return array<int, string>
     */
    public function headings(): array
    {
        return $this->schema()['headings'];
    }

    /**
     * @return array<int, array<int, string|int|float>>
     */
    public function array(): array
    {
        return [$this->schema()['sample']];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '0F172A'],
                ],
            ],
        ];
    }

    /**
     * @return array{headings: array<int, string>, sample: array<int, string|int|float>}
     */
    private function schema(): array
    {
        $diklatSchema = [
            'headings' => [
                'nama',
                'nip',
                'tempat_lahir',
                'tgl_lahir',
                'pangkat_golongan',
                'jabatan',
                'kualifikasi',
                'tempat_pelaksanaan',
                'tanggal_pelaksanaan',
                'tanggal_selesai_pelaksanaan',
                'jumlah_jam_pelajaran',
                'no_sttp',
                'tanggal_sttp',
                'pejabat_penandatangan',
            ],
            'sample' => [
                'Budi Santoso',
                '199001012015031001',
                'Jambi',
                '1990-01-01',
                'Penata Muda / III.a',
                'Anggota Pemadam Kebakaran',
                'Pemadam I',
                'Pusdiklatkar Ciracas Jakarta',
                '2026-05-10',
                '2026-05-20',
                '100 JP',
                'STTP/001/2026',
                '2026-05-21',
                'Kepala Dinas Damkartan Kota Jambi',
            ],
        ];

        return match ($this->modul) {
            'diksar', 'diklat-f1', 'diklat-f2', 'diklat-rescue', 'diklat-mfr', 'diklat-operator', 'diklat-inspektur', 'diklat-ppl' => $diklatSchema,
            'inspeksi-bangunan' => [
                'headings' => [
                    'nama_bangunan',
                    'jenis_bangunan',
                    'kualifikasi_bangunan',
                    'resiko_kebakaran',
                    'luas_bangunan',
                    'alamat',
                    'nama_penanggung_jawab',
                    'no_telepon',
                    'sistem_proteksi_kebakaran',
                    'tanggal_inspeksi',
                ],
                'sample' => [
                    'PT. Contoh Bangunan',
                    'KANTOR',
                    'Sedang',
                    'Sedang',
                    '1.250',
                    'Jl. HOS Cokroaminoto No. 10, Kota Jambi',
                    'Ahmad Fauzi',
                    '081234567890',
                    'Memenuhi Syarat',
                    '2026-11-17',
                ],
            ],
            'fire-drill' => [
                'headings' => [
                    'nama_instansi',
                    'tanggal_pelaksanaan',
                    'tempat_pelaksanaan',
                    'total_peserta',
                    'nama_penanggung_jawab',
                    'no_telepon',
                ],
                'sample' => [
                    'RSUD Abdul Manap',
                    '2026-11-17',
                    'Halaman RSUD Abdul Manap',
                    45,
                    'Dr. Hendra',
                    '081234567890',
                ],
            ],
            'pks' => [
                'headings' => [
                    'nama_perusahaan',
                    'nomor_pks',
                    'tanggal_perjanjian',
                    'lama_kerjasama',
                    'pihak_pertama',
                    'pihak_kedua',
                    'keterangan',
                ],
                'sample' => [
                    'PT. Wilmar Nabati Indonesia',
                    'PKS/015/DAMKARTAN/2026',
                    '2026-11-17',
                    '5 Tahun',
                    'Direktur PT. Wilmar Nabati Indonesia',
                    'Kepala Dinas Damkartan Kota Jambi',
                    'Kerjasama Pencegahan & Penanggulangan Kebakaran',
                ],
            ],
            'sosialisasi' => [
                'headings' => [
                    'jenis_kegiatan',
                    'no_tanggal_surat_permohonan',
                    'nama_instansi',
                    'tempat_pelaksanaan',
                    'alamat',
                    'tanggal_pelaksanaan',
                    'jumlah_peserta',
                    'nama_penanggung_jawab',
                    'no_telepon',
                ],
                'sample' => [
                    'Luar',
                    '-',
                    'SMAN 1 Kota Jambi',
                    'Aula SMAN 1 Kota Jambi',
                    'Jl. Urip Sumoharjo, Kota Jambi',
                    '2026-11-17',
                    60,
                    'Siti Aminah',
                    '081234567890',
                ],
            ],
            'kunjungan-sekolah' => [
                'headings' => [
                    'nama_sekolah',
                    'tanggal_kunjungan',
                    'siswa_perempuan',
                    'siswa_laki_laki',
                    'guru',
                    'orang_tua',
                ],
                'sample' => [
                    'TK Pertiwi II Kota Jambi',
                    '2026-11-17',
                    20,
                    22,
                    5,
                    10,
                ],
            ],
            'pelatihan-keluarga' => [
                'headings' => [
                    'nama_peserta',
                    'jenis_kelamin',
                    'kelurahan',
                    'kecamatan',
                    'tanggal_pelaksanaan',
                    'tempat_pelaksanaan',
                    'alamat_pelaksanaan',
                ],
                'sample' => [
                    'Rahmat Hidayat',
                    'Laki-laki',
                    'Simpang III Sipin',
                    'Kota Baru',
                    '2026-11-17',
                    'Kantor Lurah Simpang III Sipin',
                    'Jl. Soemantri Brojonegoro, Kota Jambi',
                ],
            ],
            'edukasi' => [
                'headings' => [
                    'institusi',
                    'alamat_institusi',
                    'kecamatan',
                    'kelurahan',
                    'nama_pemohon',
                    'jabatan_pemohon',
                    'nik',
                    'no_kontak',
                    'tgl_kegiatan',
                    'usia_3_6',
                    'usia_7_12',
                    'usia_13_18',
                    'usia_18_keatas',
                    'status_permohonan',
                ],
                'sample' => [
                    'SDN 12 Kota Jambi',
                    'Jl. Jend. Sudirman, Kota Jambi',
                    'Jambi Selatan',
                    'Thehok',
                    'Dewi Sartika',
                    'Kepala Sekolah',
                    '1571010101900001',
                    '081234567890',
                    '2026-11-17',
                    0,
                    40,
                    0,
                    5,
                    'Pending',
                ],
            ],
            'redkar' => [
                'headings' => [
                    'nama_lengkap',
                    'nik',
                    'jenis_kelamin',
                    'tempat_lahir',
                    'tanggal_lahir',
                    'status_perkawinan',
                    'agama',
                    'nomor_telp',
                    'alamat',
                    'rt_rw',
                    'kecamatan',
                    'kelurahan',
                    'pendidikan_terakhir',
                    'latar_belakang_pendidikan',
                    'pekerjaan',
                    'status_verifikasi',
                ],
                'sample' => [
                    'Andi Pratama',
                    '1571020202950001',
                    'Laki-Laki',
                    'Jambi',
                    '1995-02-02',
                    'Belum Kawin',
                    'Islam',
                    '081234567890',
                    'Jl. Pattimura Lrg. Karya',
                    '05/02',
                    'Alam Barajo',
                    'Kenali Besar',
                    'SMA',
                    'IPA',
                    'Wiraswasta',
                    'Terverifikasi',
                ],
            ],
            'rpkbgl', 'skk' => [
                'headings' => [
                    'nama_pemohon',
                    'email_pemohon',
                    'no_whatsapp',
                    'nama_usaha',
                    'nik_pemilik_usaha',
                    'alamat_pemilik_usaha',
                    'kategori_bangunan',
                    'alamat_bangunan',
                    'kecamatan',
                    'kelurahan',
                    'luas_lahan',
                    'luas_bangunan',
                    'tinggi_bangunan',
                    'status_permohonan',
                ],
                'sample' => [
                    'Hendra Wijaya',
                    'hendra@example.com',
                    '081234567890',
                    'Hotel Jambi Makmur',
                    '1571030303850001',
                    'Jl. Gatot Subroto, Kota Jambi',
                    'Hotel / Penginapan',
                    'Jl. Gatot Subroto No. 22, Kota Jambi',
                    'Pasar Jambi',
                    'Sungai Asam',
                    1500,
                    1200,
                    18,
                    'Pending',
                ],
            ],
            default => [
                'headings' => ['nama'],
                'sample' => ['Contoh Data'],
            ],
        };
    }
}
