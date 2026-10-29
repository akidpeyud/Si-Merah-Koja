<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProdukHukumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'peraturan-daerah',
            'peraturan-menteri',
            'peraturan-pemerintah',
            'peraturan-presiden',
            'undang-undang',
        ];

        foreach ($categories as $cat) {
            $targetDir = storage_path("app/public/produk-hukum/{$cat}");
            if (! File::exists($targetDir)) {
                File::makeDirectory($targetDir, 0755, true);
            }
        }

        $items = [
            [
                'kategori'     => 'undang-undang',
                'nomor'        => 'UU Nomor 28 Tahun 2002',
                'tahun'        => 2002,
                'judul'        => 'UU Nomor 28 Tahun 2002 Bangunan Gedung',
                'keterangan'   => null,
                'file_dokumen' => 'produk-hukum/undang-undang/Id3Adq8j2psmZKjeqnFQiInKLU1Gm1elUIXhlj61.pdf',
            ],
            [
                'kategori'     => 'peraturan-menteri',
                'nomor'        => 'NOMOR 13',
                'tahun'        => 2019,
                'judul'        => 'PERMENDAGRI NOMOR 13 TAHUN 2019 TENTANG PAKAIAN DINAS BAGI APARATUR SIPIL NEGARA DI LINGKUNGAN PERANGKAT DAERAH YANG MENYELENGGARAKAN SUB URUSAN KEBAKARAN',
                'keterangan'   => null,
                'file_dokumen' => 'produk-hukum/peraturan-menteri/UxIpGwBfBoJW8y2vkmz2uJZTMIHNDedC1VDGZ9Ht.pdf',
            ],
            [
                'kategori'     => 'peraturan-menteri',
                'nomor'        => 'NOMOR 14',
                'tahun'        => 2024,
                'judul'        => '11.Permendagri Nomor 14 Tahun 2024 PEDOMANPENYUSUNANRENCANAINDUKSISTEMPENANGGULANGAN KEBAKARANDANPENYELAMATANDI DAERAH',
                'keterangan'   => null,
                'file_dokumen' => 'produk-hukum/peraturan-menteri/3slA2QClBP3GWuza0vpaSZnI4sXonguIvbvZxxuO.pdf',
            ],
            [
                'kategori'     => 'peraturan-menteri',
                'nomor'        => 'NOMOR 69',
                'tahun'        => 2012,
                'judul'        => '12Permendagri Nomor 69 Tahun 2012 PERUBAHAN ATAS PERATURAN MENTERI DALAM NEGERI NOMOR 62 TAHUN 2008 TENTANG STANDAR PELAYANAN MINIMAL BIDANG PEMERINTAHAN DALAM NEGERI DI KABUPATENKOTA',
                'keterangan'   => null,
                'file_dokumen' => 'produk-hukum/peraturan-menteri/OCva0c9nus4CKhVFRCir5UlOkGqWXk7ZwY0LTjoQ.pdf',
            ],
            [
                'kategori'     => 'peraturan-menteri',
                'nomor'        => 'NOMOR 86',
                'tahun'        => 2022,
                'judul'        => '13.Permendagri Nomor 86 Tahun 2022 PENDIDIKAN DAN PELATIHAN BAGI APARATUR PEMADAM KEBAKARAN DAN PENYELAMATAN',
                'keterangan'   => null,
                'file_dokumen' => 'produk-hukum/peraturan-menteri/hsYttdAq0NRCyMhiRPK1ptkssZKeouaNMDA0ugnG.pdf',
            ],
            [
                'kategori'     => 'peraturan-menteri',
                'nomor'        => 'NOMOR 16',
                'tahun'        => 2020,
                'judul'        => 'PERMENDAGRI_16_TAHUN_2020 PEDOMAN NOMENKLATUR DINAS PEMADAM KEBAKARAN DAN PENYELAMATAN PROVINSI DAN KABUPATENKOTA',
                'keterangan'   => null,
                'file_dokumen' => 'produk-hukum/peraturan-menteri/5ak1TWSzNGTKqpTsVRgXmDC7JBy7Oh4oqfagpOcA.pdf',
            ],
            [
                'kategori'     => 'peraturan-menteri',
                'nomor'        => null,
                'tahun'        => 2020,
                'judul'        => 'kepmendagri-3641-306-tahun-2020 Tentang Pedoman Pembinaan Relawan',
                'keterangan'   => null,
                'file_dokumen' => 'produk-hukum/peraturan-menteri/jPl1xFaH0cUbpbryFs2fijLhPtNfkfDgBQoTFW3t.pdf',
            ],
            [
                'kategori'     => 'peraturan-presiden',
                'nomor'        => 'NOMOR 72',
                'tahun'        => 2025,
                'judul'        => 'Perpres Nomor 72 Tahun 2025 STANDAR HARGA SATUAN REGIONAL',
                'keterangan'   => null,
                'file_dokumen' => 'produk-hukum/peraturan-presiden/4NXzGe7NePeJZyes7zNze68xPts0MGLHTG1ExPfr.pdf',
            ],
            [
                'kategori'     => 'peraturan-menteri',
                'nomor'        => 'NOMOR 16',
                'tahun'        => 2019,
                'judul'        => 'Permenpan Nomor 16 Tahun 2019 TENTANG JABATAN FUNGSIONAL PEMADAM KEBAKARAN',
                'keterangan'   => null,
                'file_dokumen' => 'produk-hukum/peraturan-menteri/acHsVRRmft8JZ2RWy2oCOgrFbDas4IHaBz9CtB2I.pdf',
            ],
            [
                'kategori'     => 'peraturan-menteri',
                'nomor'        => 'NOMOR 17',
                'tahun'        => 2019,
                'judul'        => 'Permenpan Nomor 17 Tahun 2019 TENTANG JABATAN FUNGSIONAL ANALIS KEBAKARAN',
                'keterangan'   => null,
                'file_dokumen' => 'produk-hukum/peraturan-menteri/fbB0Pm0YFnNXDseE8vh22qWCm6nEu56Bg39tRfCW.pdf',
            ],
            [
                'kategori'     => 'peraturan-menteri',
                'nomor'        => 'NOMOR 17',
                'tahun'        => 2024,
                'judul'        => 'permenperin-no-17-tahun-2024 TENTANG PEMBERLAKUAN STANDAR NASIONAL INDONESIA UNTUK ALAT PEMADAM API PORTABEL SECARA WAJIB',
                'keterangan'   => null,
                'file_dokumen' => 'produk-hukum/peraturan-menteri/TwcmjKgtu7G63OtuYXqd0fjD1j2BjWS3QCW6OuUb.pdf',
            ],
            [
                'kategori'     => 'peraturan-pemerintah',
                'nomor'        => 'NOMOR 26',
                'tahun'        => 2020,
                'judul'        => 'SALINAN-PERATURAN-BKN-NOMOR-26-TAHUN-2020-TENTANG-JF-Pemadam-Kebakaran',
                'keterangan'   => null,
                'file_dokumen' => 'produk-hukum/peraturan-pemerintah/cPecVNalF1tiVIUKY4b0Nq12gAkP08nFjek1eFI2.pdf',
            ],
            [
                'kategori'     => 'peraturan-menteri',
                'nomor'        => 'NOMOR 114',
                'tahun'        => 2018,
                'judul'        => 'STANDAR PELAYANAN MINIMAL SUB URUSAN KEBAKARAN (Permendagri No 114 Tahun 2018)',
                'keterangan'   => null,
                'file_dokumen' => 'produk-hukum/peraturan-menteri/9Yr9mnCSHmBxC7NxBGSx8Gm4h86mR2crpp9Z3Mmq.pdf',
            ],
            [
                'kategori'     => 'undang-undang',
                'nomor'        => 'NOMOR 1',
                'tahun'        => 1970,
                'judul'        => 'UU Nomor 1 Tahun 1970 Tentang Keselamatan Kerja',
                'keterangan'   => null,
                'file_dokumen' => 'produk-hukum/undang-undang/RvdIWBbjPPwuKyqlMV6FGv0mNUN0eIEk0FeCini0.pdf',
            ],
            [
                'kategori'     => 'undang-undang',
                'nomor'        => 'NOMOR 1',
                'tahun'        => 2023,
                'judul'        => 'UU Nomor 1 Tahun 2023 TENTANG KITAB UNDANG-UNDANG HUKUM PIDANA',
                'keterangan'   => null,
                'file_dokumen' => 'produk-hukum/undang-undang/gT8vrowpU0RKBP7HTNsuAWMYPoGrPNZNv3MPpEKs.pdf',
            ],
            [
                'kategori'     => 'undang-undang',
                'nomor'        => 'NOMOR 22',
                'tahun'        => 2009,
                'judul'        => 'UU Nomor 22 Tahun 2009 TENTANG LALU LINTAS DAN ANGKUTAN JALAN',
                'keterangan'   => null,
                'file_dokumen' => 'produk-hukum/undang-undang/vwmKgVryr3muX9J6nBjYIL0VLQmEluKixMa269uG.pdf',
            ],
            [
                'kategori'     => 'undang-undang',
                'nomor'        => 'NOMOR 23',
                'tahun'        => 2014,
                'judul'        => 'UU Nomor 23 Tahun 2014 Tentang Pemerintah Daerah',
                'keterangan'   => null,
                'file_dokumen' => 'produk-hukum/undang-undang/XSE9uE2Xu2oKNRSIVDkNdLkb1LAiksOsufsaCGjH.pdf',
            ],
            [
                'kategori'     => 'undang-undang',
                'nomor'        => 'NOMOR 24',
                'tahun'        => 2007,
                'judul'        => 'UU NOMOR 24 TAHUN 2007 TENTANG PENANGGULANGAN BENCANA',
                'keterangan'   => null,
                'file_dokumen' => 'produk-hukum/undang-undang/ZXWdNvZAQvnsf82eR5B6ib1H9vFp5cqunidrP3vw.pdf',
            ],
            [
                'kategori'     => 'undang-undang',
                'nomor'        => 'NOMOR 32',
                'tahun'        => 2009,
                'judul'        => 'UU Nomor 32 Tahun 2009 TENTANG PERLINDUNGAN DAN PENGELOLAAN LINGKUNGAN HIDUP',
                'keterangan'   => null,
                'file_dokumen' => 'produk-hukum/undang-undang/OxWFD5WxlTMDvEkhmNP35CFM2zufPgn0auNvVyFf.pdf',
            ],
            [
                'kategori'     => 'undang-undang',
                'nomor'        => 'NOMOR 41',
                'tahun'        => 1999,
                'judul'        => 'UU Nomor 41 Tahun 1999 TENTANG KEHUTANAN',
                'keterangan'   => null,
                'file_dokumen' => 'produk-hukum/undang-undang/TKM2FAyH1drcy7a29oTFY4GDsmqOLjC2Tf51oksw.pdf',
            ],
            [
                'kategori'     => 'undang-undang',
                'nomor'        => 'NOMOR 44',
                'tahun'        => 2009,
                'judul'        => 'UU Nomor 44 Tahun 2009 TENTANG RUMAH SAKIT',
                'keterangan'   => null,
                'file_dokumen' => 'produk-hukum/undang-undang/6KRgKCP60RNxOs99ngEExR0CnUdDxuVgQNWXTOAh.pdf',
            ],
            [
                'kategori'     => 'peraturan-menteri',
                'nomor'        => 'NOMOR 4',
                'tahun'        => 1980,
                'judul'        => '2. Peraturan Menteri Ketenagakerjaan No. 4 Tahun 1980 TENTANG SYARAT-SYARAT PEMASANGAN DAN PEMELIHARAN ALAT PEMADAM API RINGAN',
                'keterangan'   => null,
                'file_dokumen' => 'produk-hukum/peraturan-menteri/MU5acT0o3GHEK9NxuExslCvNHArgtPluQx2TlqXC.pdf',
            ],
            [
                'kategori'     => 'peraturan-menteri',
                'nomor'        => 'NOMOR 26',
                'tahun'        => 2008,
                'judul'        => '3. Peraturan Menteri Pekerjaan Umum Nomor 26PRT2008 TENTANG PERSYARATAN TEKNIS SISTEM PROTEKSI KEBAKARAN PADA BANGUNAN GEDUNG DAN LINGKUNGAN',
                'keterangan'   => null,
                'file_dokumen' => 'produk-hukum/peraturan-menteri/gMrbJa0Z1LGVraxPJ5bkDuQLSoXqqemFVvCtDPKd.pdf',
            ],
            [
                'kategori'     => 'peraturan-menteri',
                'nomor'        => 'NOMOR 20',
                'tahun'        => 2009,
                'judul'        => '4. Peraturan Menteri Pekerjaan Umum Nomor 20 Tahun 2009 TENTANG PEDOMAN TEKNIS MANAJEMEN PROTEKSI KEBAKARAN  DI PERKOTAAN',
                'keterangan'   => null,
                'file_dokumen' => 'produk-hukum/peraturan-menteri/GfT8ti4KAyUIjzy4bf9VG6KdhXUuNHFUJnUaA61a.pdf',
            ],
            [
                'kategori'     => 'peraturan-menteri',
                'nomor'        => 'NOMOR 66',
                'tahun'        => 2016,
                'judul'        => '5. Peraturan Menteri Kesehatan Nomor 66 Tahun 2016 TENTANG KESELAMATAN DAN KESEHATAN KERJA RUMAH SAKIT',
                'keterangan'   => null,
                'file_dokumen' => 'produk-hukum/peraturan-menteri/RtngZOETSw2BXUeq2hfExP1lJqqC1QV72veVk3js.pdf',
            ],
            [
                'kategori'     => 'peraturan-menteri',
                'nomor'        => 'NOMOR 114',
                'tahun'        => 2018,
                'judul'        => '6. Peraturan Menteri Dalam Negeri Nomor 114 Tahun 2018 TENTANG STANDAR TEKNIS PELAYANAN DASAR PADA STANDAR PELAYANAN MINIMAL SUB URUSAN KEBAKARAN DAERAH KABUPATENKOTA',
                'keterangan'   => null,
                'file_dokumen' => 'produk-hukum/peraturan-menteri/rkfzTScghybPOzUUQ74sfkSnTviQVvul7USEgEiX.pdf',
            ],
            [
                'kategori'     => 'peraturan-daerah',
                'nomor'        => 'NOMOR 8',
                'tahun'        => 2003,
                'judul'        => '7. Peraturan Daerah Kota Jambi Nomor 8 Tahun 2003 TENTANG PENCEGAHAN DAN PENANGGULANGAN BAHAYA KEBAKARAN',
                'keterangan'   => null,
                'file_dokumen' => 'produk-hukum/peraturan-daerah/pt4TwJ6ijIpnvNlx8wk0H2q8o0QVjaImqcNchZo6.pdf',
            ],
            [
                'kategori'     => 'peraturan-menteri',
                'nomor'        => 'NOMOR 17',
                'tahun'        => 2024,
                'judul'        => '8. Peraturan Menteri Perindustrian Republik Indonesia Nomor 17 Tahun 2024 TENTANG PEMBERLAKUAN STANDAR NASIONAL INDONESIA UNTUK ALAT PEMADAM API PORTABEL SECARA WAJIB',
                'keterangan'   => null,
                'file_dokumen' => 'produk-hukum/peraturan-menteri/yLy5j6Ixm5gUptjb90VrJFDDFWWvssXTiF8ZyYWE.pdf',
            ],
            [
                'kategori'     => 'peraturan-menteri',
                'nomor'        => 'NOMOR 186',
                'tahun'        => 1991,
                'judul'        => '9. Keputusan Menteri Tenaga Kerja Nomor KEP-186MEN1991 TENTANG UNIT PENANGGULANGAN KEBAKARAN DI TEMPAT KERJA',
                'keterangan'   => null,
                'file_dokumen' => 'produk-hukum/peraturan-menteri/3uC2GrC3dWqlHqHwgcNO7JOC3KAbWklTNdJU6N3K.pdf',
            ],
        ];

        $now = Carbon::now();

        foreach ($items as $item) {
            // Pastikan file dokumen tersedia di storage/app/public
            $destPath = storage_path('app/public/' . $item['file_dokumen']);
            if (! File::exists($destPath)) {
                $seedPath = storage_path('app/public/seed-files/' . $item['file_dokumen']);
                if (File::exists($seedPath)) {
                    File::copy($seedPath, $destPath);
                } elseif (File::exists(public_path('storage/' . $item['file_dokumen']))) {
                    File::copy(public_path('storage/' . $item['file_dokumen']), $destPath);
                }
            }

            $item['created_at'] = $now;
            $item['updated_at'] = $now;

            DB::table('produk_hukums')->updateOrInsert(
                [
                    'kategori' => $item['kategori'],
                    'judul'    => $item['judul'],
                ],
                $item
            );
        }
    }
}
