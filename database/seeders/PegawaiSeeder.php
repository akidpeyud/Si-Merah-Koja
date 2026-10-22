<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Bersihkan tabel terlebih dahulu agar tidak ada duplikasi data
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Pegawai::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $data = [
            [
                'no_urut' => 1,
                'nip' => '197508161993111001',
                'nama' => 'MUSTARI AFFANDI,AP,ME',
                'tempat_tanggal_lahir' => 'Jambi, 16-08-1975',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'IV/c',
                'pangkat_tmt' => '2021-10-01',
                'jabatan_nama' => 'Kepala Dinas Damkar',
                'jabatan_tmt' => '2023-02-03',
                'masa_kerja_th' => 32,
                'masa_kerja_bln' => 8,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
D.IV
S.2',
                'pendidikan_nama' => 'SD
SMP
SMA
D IV
S2',
                'pendidikan_tahun_lulus' => '1987
1990
1995
1997
2020',
                'latihan_jabatan_nama' => 'ADUM
ADUMLA
Diklatpim Tk.III
Diklatpim Tk.II',
                'latihan_jabatan_tahun_lulus' => '1999
2000
2015
2023',
                'latihan_jabatan_tempat' => 'Medan
Jakarta
Jambi
Jakarta',
                'catatan_mutasi_pegawai' => 'Satpol PP Kota Jambi',
            ],
            [
                'no_urut' => 2,
                'nip' => '196910271989021001',
                'nama' => 'AZWAR,SE',
                'tempat_tanggal_lahir' => 'Jambi,27 -10- 1969',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'IV/a',
                'pangkat_tmt' => '2020-04-01',
                'jabatan_nama' => 'Kabid Sarana dan Prasarana',
                'jabatan_tmt' => '2023-02-03',
                'masa_kerja_th' => 37,
                'masa_kerja_bln' => 5,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
S1',
                'pendidikan_nama' => 'SD
SMP
SMA
S.1',
                'pendidikan_tahun_lulus' => '1982
1985
1988
2003',
                'latihan_jabatan_nama' => 'Diklatpim IV',
                'latihan_jabatan_tahun_lulus' => '1999',
                'latihan_jabatan_tempat' => 'Jambi',
                'catatan_mutasi_pegawai' => 'Dinsos Kota Jambi',
            ],
            [
                'no_urut' => 3,
                'nip' => '198505232003121001',
                'nama' => 'ARDIANSYAH,S,STP',
                'tempat_tanggal_lahir' => 'Jambi, 23-05-1985',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'IV/a',
                'pangkat_tmt' => '2021-04-01',
                'jabatan_nama' => 'Kabid Pencegahan',
                'jabatan_tmt' => '2023-11-03',
                'masa_kerja_th' => 22,
                'masa_kerja_bln' => 7,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
D.IV',
                'pendidikan_nama' => 'SD
SLTP
SLTA
D.IV',
                'pendidikan_tahun_lulus' => '1997
2000
2003
2007',
                'latihan_jabatan_nama' => 'Diklatpim Tk.IV',
                'latihan_jabatan_tahun_lulus' => '2009',
                'latihan_jabatan_tempat' => 'Jambi',
                'catatan_mutasi_pegawai' => 'Koperasi UKM',
            ],
            [
                'no_urut' => 4,
                'nip' => '198110132008011002',
                'nama' => 'KIKI, ST',
                'tempat_tanggal_lahir' => 'Jambi, 13 - 10 - 1981',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'IV/a',
                'pangkat_tmt' => '2024-04-01',
                'jabatan_nama' => 'Sekretaris',
                'jabatan_tmt' => '2025-10-02',
                'masa_kerja_th' => 18,
                'masa_kerja_bln' => 6,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
S1',
                'pendidikan_nama' => 'SD
SMP
SMA
S.1',
                'pendidikan_tahun_lulus' => '1993
1996
1999
2003',
                'latihan_jabatan_nama' => 'Diklatpim Tk.III',
                'latihan_jabatan_tahun_lulus' => '2022',
                'latihan_jabatan_tempat' => 'Jambi',
                'catatan_mutasi_pegawai' => 'DLH Kota Jambi',
            ],
            [
                'no_urut' => 5,
                'nip' => '197907092010011011',
                'nama' => 'BINSAR FREDDY GUMUNTAR BUTAR BUTAR,ST,M.Si',
                'tempat_tanggal_lahir' => 'Pematang Siantar, 09-07-1979',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'IV/a',
                'pangkat_tmt' => '2026-04-01',
                'jabatan_nama' => 'Kasi Pengadaan Sarana Prasarana',
                'jabatan_tmt' => '2023-06-19',
                'masa_kerja_th' => 16,
                'masa_kerja_bln' => 6,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
S1
S2',
                'pendidikan_nama' => 'SD
SMP
SMA
S1
S.2',
                'pendidikan_tahun_lulus' => '1992
1995
1998
2004
2023',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => 'Dinas PU Kota Jambi',
            ],
            [
                'no_urut' => 6,
                'nip' => '198206142010012018',
                'nama' => 'DEWI SARTIKA, M.M',
                'tempat_tanggal_lahir' => 'Jambi, 14-6-1982',
                'jenis_kelamin' => 'Perempuan',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'IV/a',
                'pangkat_tmt' => '2026-04-01',
                'jabatan_nama' => 'Kasubbag Umum Dan Kepegawaian',
                'jabatan_tmt' => '2021-01-04',
                'masa_kerja_th' => 16,
                'masa_kerja_bln' => 6,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
S1
S2',
                'pendidikan_nama' => 'SD
SMP
SMA
S1
S2',
                'pendidikan_tahun_lulus' => '1996
1999
2002
2006
2019',
                'latihan_jabatan_nama' => 'Diklat PKP',
                'latihan_jabatan_tahun_lulus' => '2022',
                'latihan_jabatan_tempat' => 'Jambi',
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 7,
                'nip' => '198610222010011007',
                'nama' => 'RULLY KURNIAWAN, S.IP, ME',
                'tempat_tanggal_lahir' => 'Jambi, 22-10-1986',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'IV/a',
                'pangkat_tmt' => '2026-04-01',
                'jabatan_nama' => 'Kasi Penyelamatan Dan Evakuasi',
                'jabatan_tmt' => '2025-10-02',
                'masa_kerja_th' => 16,
                'masa_kerja_bln' => 6,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
S1
S2',
                'pendidikan_nama' => 'SD
SMP
SMA
S.1
S.2',
                'pendidikan_tahun_lulus' => '1998
2001
2004
2009
2017',
                'latihan_jabatan_nama' => 'Diklat PKP',
                'latihan_jabatan_tahun_lulus' => '2024',
                'latihan_jabatan_tempat' => 'Jambi',
                'catatan_mutasi_pegawai' => 'BPKAD',
            ],
            [
                'no_urut' => 8,
                'nip' => '197405292000121001',
                'nama' => 'ABDURRAHMAN ANWAR,SE',
                'tempat_tanggal_lahir' => 'Jambi, 29-05-1974',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'III/d',
                'pangkat_tmt' => '2015-10-01',
                'jabatan_nama' => 'Kasi Pencegahan inspeksi',
                'jabatan_tmt' => '2025-10-02',
                'masa_kerja_th' => 25,
                'masa_kerja_bln' => 7,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
S1',
                'pendidikan_nama' => 'SD
SMP
SMA
S.1',
                'pendidikan_tahun_lulus' => '1986
1989
1992
2005',
                'latihan_jabatan_nama' => 'Diklatpim IV',
                'latihan_jabatan_tahun_lulus' => '2007',
                'latihan_jabatan_tempat' => 'Jambi',
                'catatan_mutasi_pegawai' => 'Kec.Jambi Timur',
            ],
            [
                'no_urut' => 9,
                'nip' => '197004051990022001',
                'nama' => 'NENI MARYANTI,SE',
                'tempat_tanggal_lahir' => 'Jambi, 05/04/1970',
                'jenis_kelamin' => 'Perempuan',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'III/d',
                'pangkat_tmt' => '2018-04-01',
                'jabatan_nama' => 'Penelaah Tehnis Kebijakan',
                'jabatan_tmt' => '2026-02-27',
                'masa_kerja_th' => 36,
                'masa_kerja_bln' => 6,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
S1',
                'pendidikan_nama' => 'SD
SMP
SMA
S.1',
                'pendidikan_tahun_lulus' => '1983
1986
1985
2012',
                'latihan_jabatan_nama' => 'Diklatpim IV',
                'latihan_jabatan_tahun_lulus' => '2012',
                'latihan_jabatan_tempat' => 'Jambi',
                'catatan_mutasi_pegawai' => 'Dispenda',
            ],
            [
                'no_urut' => 10,
                'nip' => '197208301996021001',
                'nama' => 'SUHERMANTO,SE',
                'tempat_tanggal_lahir' => 'Jambi, 30-08-1972',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'III/d',
                'pangkat_tmt' => '2020-04-01',
                'jabatan_nama' => 'Kasi Peningkatan kapasitas Aparatur',
                'jabatan_tmt' => '2021-01-04',
                'masa_kerja_th' => 34,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
S1',
                'pendidikan_nama' => 'SD
SMP
STM
S1',
                'pendidikan_tahun_lulus' => '1985
1988
1991
-',
                'latihan_jabatan_nama' => 'DIKLATPIM.IV',
                'latihan_jabatan_tahun_lulus' => '2020',
                'latihan_jabatan_tempat' => 'Jambi',
                'catatan_mutasi_pegawai' => 'Pol.PP Kota Jambi 28-05-2002',
            ],
            [
                'no_urut' => 11,
                'nip' => '196908161996021001',
                'nama' => 'A.KADIR,SH',
                'tempat_tanggal_lahir' => 'Jambi, 16-08-1969',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'III/d',
                'pangkat_tmt' => '2020-04-01',
                'jabatan_nama' => 'Penelaah Tehnis Kebijakan',
                'jabatan_tmt' => '2026-02-27',
                'masa_kerja_th' => 30,
                'masa_kerja_bln' => 5,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
S1',
                'pendidikan_nama' => 'SD
MTs
SMA
S.1',
                'pendidikan_tahun_lulus' => '1983
1986
1989
2007',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => 'Kelurahan Jelutung',
            ],
            [
                'no_urut' => 12,
                'nip' => '197702272008011005',
                'nama' => 'AGUNG SUNARIADI, SP',
                'tempat_tanggal_lahir' => 'Jambi, 27-02-1977',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'III/d',
                'pangkat_tmt' => '2020-04-01',
                'jabatan_nama' => 'Penelaah Tehnis Kebijakan',
                'jabatan_tmt' => '2026-02-27',
                'masa_kerja_th' => 18,
                'masa_kerja_bln' => 6,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
S1',
                'pendidikan_nama' => 'SD
SMP
SMA
S.1',
                'pendidikan_tahun_lulus' => '1988
1991
1994
2001',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 13,
                'nip' => '198809252007011001',
                'nama' => 'DEKI IRAWAN,S.IP',
                'tempat_tanggal_lahir' => 'Jambi, 25/09/1988',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'III/d',
                'pangkat_tmt' => '2020-10-01',
                'jabatan_nama' => 'Analis Kebakaran Ahli Muda',
                'jabatan_tmt' => '2021-12-31',
                'masa_kerja_th' => 19,
                'masa_kerja_bln' => 6,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
S1',
                'pendidikan_nama' => 'SD
SMP
SMA
S1',
                'pendidikan_tahun_lulus' => '2000
2003
2006
2009',
                'latihan_jabatan_nama' => 'Diklatpim Tk.IV',
                'latihan_jabatan_tahun_lulus' => '2012',
                'latihan_jabatan_tempat' => 'Jambi',
                'catatan_mutasi_pegawai' => 'Kel.Cempaka Putih',
            ],
            [
                'no_urut' => 14,
                'nip' => '197202272009011003',
                'nama' => 'TRI HASTATI.M, SP',
                'tempat_tanggal_lahir' => 'Jambi, 27-2-1972',
                'jenis_kelamin' => 'Perempuan',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'III/d',
                'pangkat_tmt' => '2021-04-01',
                'jabatan_nama' => 'Analis Kebakaran Ahli Muda',
                'jabatan_tmt' => '2021-12-31',
                'masa_kerja_th' => 17,
                'masa_kerja_bln' => 6,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
S1',
                'pendidikan_nama' => 'SD
SMP
SMA
SI',
                'pendidikan_tahun_lulus' => '1985
1988
1991
1998',
                'latihan_jabatan_nama' => 'Diklat Fire Inspektur',
                'latihan_jabatan_tahun_lulus' => '2019',
                'latihan_jabatan_tempat' => 'Jakarta',
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 15,
                'nip' => '197601232010011007',
                'nama' => 'INDRA JAFRIZAL, ST',
                'tempat_tanggal_lahir' => 'Kerinci, 23-1-1976',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'III/d',
                'pangkat_tmt' => '2021-10-01',
                'jabatan_nama' => 'Kasi Pemadaman dan investigasi',
                'jabatan_tmt' => '2021-01-04',
                'masa_kerja_th' => 16,
                'masa_kerja_bln' => 6,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
S.1',
                'pendidikan_nama' => 'SD
SMP
SMA
S1',
                'pendidikan_tahun_lulus' => '1984
1992
1995
2001',
                'latihan_jabatan_nama' => 'Diklat PKP',
                'latihan_jabatan_tahun_lulus' => '2022',
                'latihan_jabatan_tempat' => 'Jambi',
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 16,
                'nip' => '198410312008011002',
                'nama' => 'EZWIN KURNIAWAN, SE',
                'tempat_tanggal_lahir' => 'Jambi, 31-10-1984',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'III/c',
                'pangkat_tmt' => '2020-10-01',
                'jabatan_nama' => 'Penelaah Tehnis Kebijakan',
                'jabatan_tmt' => '2026-02-27',
                'masa_kerja_th' => 18,
                'masa_kerja_bln' => 6,
                'pendidikan_tingkat_ijazah' => 'SD
SMP
SMA
S1',
                'pendidikan_nama' => 'SD
SMP
SMA
S.1',
                'pendidikan_tahun_lulus' => '1996
1999
2002
2012',
                'latihan_jabatan_nama' => 'Diklat PKP',
                'latihan_jabatan_tahun_lulus' => '2022',
                'latihan_jabatan_tempat' => 'Jambi',
                'catatan_mutasi_pegawai' => 'Lurah Selamat',
            ],
            [
                'no_urut' => 17,
                'nip' => '198304042008011003',
                'nama' => 'MUZIAT,SE',
                'tempat_tanggal_lahir' => 'Jambi, 04-04-1983',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'III/c',
                'pangkat_tmt' => '2023-10-01',
                'jabatan_nama' => 'Penelaah Tehnis Kebijakan',
                'jabatan_tmt' => '2026-02-27',
                'masa_kerja_th' => 18,
                'masa_kerja_bln' => 6,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
S1',
                'pendidikan_nama' => 'SD
SMP
SMU
S.1',
                'pendidikan_tahun_lulus' => '1996
2000
2003
2014',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 18,
                'nip' => '197107032007012012',
                'nama' => 'JUARTI,SE',
                'tempat_tanggal_lahir' => 'Jambi, 03-07-1971',
                'jenis_kelamin' => 'Perempuan',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'III/c',
                'pangkat_tmt' => '2025-10-01',
                'jabatan_nama' => 'Penelaah Tehnis Kebijakan',
                'jabatan_tmt' => '2026-02-27',
                'masa_kerja_th' => 19,
                'masa_kerja_bln' => 6,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
S1',
                'pendidikan_nama' => 'SD
MTs
SMA
S.1',
                'pendidikan_tahun_lulus' => '1985
1988
1991
2016',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 19,
                'nip' => '197907172008011006',
                'nama' => 'MUHAMMAD HAPIS,SE',
                'tempat_tanggal_lahir' => 'Jambi, 17-07-1979',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'III/c',
                'pangkat_tmt' => '2025-10-01',
                'jabatan_nama' => 'Penata Layanan Opersional',
                'jabatan_tmt' => '2026-02-27',
                'masa_kerja_th' => 18,
                'masa_kerja_bln' => 6,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
S1',
                'pendidikan_nama' => 'SD
SMP
SMA
S.1',
                'pendidikan_tahun_lulus' => '1993
1996
1999
2016',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 20,
                'nip' => '197003091996011001',
                'nama' => 'DARMAWAN',
                'tempat_tanggal_lahir' => 'Jambi, 9/3/1970',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'III/b',
                'pangkat_tmt' => '2021-04-01',
                'jabatan_nama' => 'Pengadministrasi Perkantoran',
                'jabatan_tmt' => '2026-02-27',
                'masa_kerja_th' => 30,
                'masa_kerja_bln' => 5,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMU',
                'pendidikan_tahun_lulus' => '1982
1987
1992',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => 'Kantor Pengelolah Parkir',
            ],
            [
                'no_urut' => 21,
                'nip' => '199208292019032013',
                'nama' => 'MONALISA,SE. M.Ak',
                'tempat_tanggal_lahir' => 'Jambi, 29 Agustus 1992',
                'jenis_kelamin' => 'Perempuan',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'III/b',
                'pangkat_tmt' => '2023-04-01',
                'jabatan_nama' => 'Kasubbag Keuangan',
                'jabatan_tmt' => '2026-02-10',
                'masa_kerja_th' => 7,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
S1
S2',
                'pendidikan_nama' => 'SD
SMP
SMA
S.1
S.2',
                'pendidikan_tahun_lulus' => '2004
2007
2010
2015
2020',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 22,
                'nip' => '198204082005011003',
                'nama' => 'SANDI PRYANTO,SE',
                'tempat_tanggal_lahir' => 'Jambi, 8/4/1982',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'III/b',
                'pangkat_tmt' => '2023-04-01',
                'jabatan_nama' => 'Arsiparis Ahli Pertama',
                'jabatan_tmt' => '2021-03-25',
                'masa_kerja_th' => 21,
                'masa_kerja_bln' => 6,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
Sarjana',
                'pendidikan_nama' => 'SD
SMP
SMA
S.1',
                'pendidikan_tahun_lulus' => '1994
1997
2000
2016',
                'latihan_jabatan_nama' => 'Diklat Arsip',
                'latihan_jabatan_tahun_lulus' => '2021',
                'latihan_jabatan_tempat' => 'Jambi',
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 23,
                'nip' => '198011252009011012',
                'nama' => 'NOVIANTO,SE',
                'tempat_tanggal_lahir' => 'Jambi, 25-11-1980',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'III/b',
                'pangkat_tmt' => '2023-04-01',
                'jabatan_nama' => 'Penelaah Tehnis Kebijakan',
                'jabatan_tmt' => '2026-02-27',
                'masa_kerja_th' => 17,
                'masa_kerja_bln' => 6,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
S1',
                'pendidikan_nama' => 'SD
SMP
SMA
S.1',
                'pendidikan_tahun_lulus' => '1993
1996
1996
2017',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 24,
                'nip' => '198504212010011008',
                'nama' => 'MUTASOR,SE',
                'tempat_tanggal_lahir' => 'Jambi, 21-04-1985',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'III/b',
                'pangkat_tmt' => '2024-08-01',
                'jabatan_nama' => 'Analis  Kebakaran Ahli  Pertama',
                'jabatan_tmt' => '2021-09-02',
                'masa_kerja_th' => 16,
                'masa_kerja_bln' => 6,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
S1',
                'pendidikan_nama' => 'SD
MTs
SMK
S.1',
                'pendidikan_tahun_lulus' => '1997
2000
2003
2017',
                'latihan_jabatan_nama' => 'Diklat Rescue
Diklat Pemadam II',
                'latihan_jabatan_tahun_lulus' => '2010
2012',
                'latihan_jabatan_tempat' => 'Jambi
Bandung',
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 25,
                'nip' => '198311072009011007',
                'nama' => 'RD. SYAHRIAL,SE',
                'tempat_tanggal_lahir' => 'Jambi, 07-11-1983',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'III/b',
                'pangkat_tmt' => '2026-04-01',
                'jabatan_nama' => 'Penelaah Tehnis Kebijakan',
                'jabatan_tmt' => '2026-02-27',
                'masa_kerja_th' => 17,
                'masa_kerja_bln' => 6,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
S.1',
                'pendidikan_nama' => 'SD
MTs
SMA
S.1',
                'pendidikan_tahun_lulus' => '1997
2000
2003
2021',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 26,
                'nip' => '197307172007011008',
                'nama' => 'SAHRI',
                'tempat_tanggal_lahir' => 'Jambi, 17-07-1973',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'III/a',
                'pangkat_tmt' => '2023-04-01',
                'jabatan_nama' => 'Pegadministrasi Perkantoran',
                'jabatan_tmt' => '2026-02-27',
                'masa_kerja_th' => 19,
                'masa_kerja_bln' => 6,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1989
1991
1994',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 27,
                'nip' => '197505092007011004',
                'nama' => 'MISMAN',
                'tempat_tanggal_lahir' => 'Jambi, 09-05-1974',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'III/a',
                'pangkat_tmt' => '2025-02-01',
                'jabatan_nama' => 'Pemadam Kebakaran Mahir',
                'jabatan_tmt' => '2024-11-01',
                'masa_kerja_th' => 19,
                'masa_kerja_bln' => 6,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
STM',
                'pendidikan_tahun_lulus' => '1989
1992
1995',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 28,
                'nip' => '198209212008011005',
                'nama' => 'KASIANTO',
                'tempat_tanggal_lahir' => 'Jambi, 21-9-1982',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'III/a',
                'pangkat_tmt' => '2025-02-01',
                'jabatan_nama' => 'Pemadam Kebakaran Mahir',
                'jabatan_tmt' => '2024-11-01',
                'masa_kerja_th' => 18,
                'masa_kerja_bln' => 6,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMK',
                'pendidikan_tahun_lulus' => '1996
1999
2001',
                'latihan_jabatan_nama' => 'Diklat Resque
Bintek Fire Figter II',
                'latihan_jabatan_tahun_lulus' => '2010
2016',
                'latihan_jabatan_tempat' => 'Jakarta
Jakarta',
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 29,
                'nip' => '197007062006041007',
                'nama' => 'WILOPO',
                'tempat_tanggal_lahir' => 'Jambi, 06-07-1970',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'III/a',
                'pangkat_tmt' => '2025-04-01',
                'jabatan_nama' => 'Pengadministrasi Perkantoran',
                'jabatan_tmt' => '2026-02-27',
                'masa_kerja_th' => 20,
                'masa_kerja_bln' => 3,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
Paket C',
                'pendidikan_tahun_lulus' => '1984
1987
2007',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 30,
                'nip' => '198303302009011011',
                'nama' => 'RIDWAN,SE',
                'tempat_tanggal_lahir' => 'Jambi, 30-03-1983',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'III/a',
                'pangkat_tmt' => '2025-04-01',
                'jabatan_nama' => 'Penelaah Tehnis Kebijakan',
                'jabatan_tmt' => '2026-02-27',
                'masa_kerja_th' => 17,
                'masa_kerja_bln' => 6,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
S1',
                'pendidikan_nama' => 'SD
SMP
SMA
S 1',
                'pendidikan_tahun_lulus' => '1996
2000
2003
2025',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 31,
                'nip' => '198312222009011006',
                'nama' => 'KMS. RAHMAD  RIYADI,SE',
                'tempat_tanggal_lahir' => 'Selat, 22-12-1983',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'III/a',
                'pangkat_tmt' => '2025-04-01',
                'jabatan_nama' => 'Penata Layanan Opersional',
                'jabatan_tmt' => '2026-02-27',
                'masa_kerja_th' => 17,
                'masa_kerja_bln' => 6,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
S1',
                'pendidikan_nama' => 'SD
SMP
SMU
S 1',
                'pendidikan_tahun_lulus' => '1997
2000
2003
2023',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 32,
                'nip' => '197203122009011009',
                'nama' => 'AMAN. S',
                'tempat_tanggal_lahir' => 'Jambi, 12-03-1972',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'III/a',
                'pangkat_tmt' => '2025-04-01',
                'jabatan_nama' => 'Pengadministrasi Perkantoran',
                'jabatan_tmt' => '2026-02-27',
                'masa_kerja_th' => 17,
                'masa_kerja_bln' => 6,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1987
1990
1993',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 33,
                'nip' => '197609012009011011',
                'nama' => 'MUHAMMAD  RUSDI',
                'tempat_tanggal_lahir' => 'Jambi, 01-09-1976',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'III/a',
                'pangkat_tmt' => '2025-04-01',
                'jabatan_nama' => 'Pengadministras Perkantoran',
                'jabatan_tmt' => '2026-02-27',
                'masa_kerja_th' => 17,
                'masa_kerja_bln' => 6,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
MTsN
MAN',
                'pendidikan_tahun_lulus' => '1989
1992
1995',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 34,
                'nip' => '197906042009011014',
                'nama' => 'PONIADI',
                'tempat_tanggal_lahir' => 'Jambi, 04-06-1979',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'III/a',
                'pangkat_tmt' => '2025-04-01',
                'jabatan_nama' => 'Pengadministrasi Perkantoran',
                'jabatan_tmt' => '2026-02-27',
                'masa_kerja_th' => 17,
                'masa_kerja_bln' => 6,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1993
1996
2000',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 35,
                'nip' => '198005212009011009',
                'nama' => 'ARIEF  MASDIANTO',
                'tempat_tanggal_lahir' => 'Jambi, 21-05-1980',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'III/a',
                'pangkat_tmt' => '2025-04-01',
                'jabatan_nama' => 'Pengadministrasi Perkantoran',
                'jabatan_tmt' => '2026-02-27',
                'masa_kerja_th' => 17,
                'masa_kerja_bln' => 6,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1992
1995
1998',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 36,
                'nip' => '198108272009011015',
                'nama' => 'A. SAHBUDINSYAH',
                'tempat_tanggal_lahir' => 'Jambi, 27-08-1981',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'III/a',
                'pangkat_tmt' => '2025-04-01',
                'jabatan_nama' => 'Pengadministrasi Perkantoran',
                'jabatan_tmt' => '2026-02-27',
                'masa_kerja_th' => 17,
                'masa_kerja_bln' => 6,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1995
1998
2001',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 37,
                'nip' => '198206272009011010',
                'nama' => 'ABDI  MULIA',
                'tempat_tanggal_lahir' => 'Jambi, 27-06-1982',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'III/a',
                'pangkat_tmt' => '2025-04-01',
                'jabatan_nama' => 'Pengadministrasi Perkantoran',
                'jabatan_tmt' => '2026-02-27',
                'masa_kerja_th' => 17,
                'masa_kerja_bln' => 6,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1995
1998
2001',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 38,
                'nip' => '198308232009011009',
                'nama' => 'M. RIDWANSYAH',
                'tempat_tanggal_lahir' => 'Jambi, 23-08-1983',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'III/a',
                'pangkat_tmt' => '2025-04-01',
                'jabatan_nama' => 'Pengadministrasi Perkantoran',
                'jabatan_tmt' => '2026-02-27',
                'masa_kerja_th' => 17,
                'masa_kerja_bln' => 6,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1995
1998
2001',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 39,
                'nip' => '200206202025102001',
                'nama' => 'FADHILA AFZALIYA,S.Tr.i.p',
                'tempat_tanggal_lahir' => 'Kota Jambi, 20-06-2002',
                'jenis_kelamin' => 'Perempuan',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'III/a',
                'pangkat_tmt' => '2025-10-01',
                'jabatan_nama' => 'Analis Kebakaran Ahli Pertama',
                'jabatan_tmt' => '2025-10-01',
                'masa_kerja_th' => 0,
                'masa_kerja_bln' => 9,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
D.IV',
                'pendidikan_nama' => 'SD
SMP
SMA
D.IV',
                'pendidikan_tahun_lulus' => '2014
2017
2020
2025',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 40,
                'nip' => '197904122007011007',
                'nama' => 'BENI ASRIL',
                'tempat_tanggal_lahir' => 'Jambi, 12-04-1979',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'III/a',
                'pangkat_tmt' => '2026-04-01',
                'jabatan_nama' => 'Pengadministrasi Perkantoran',
                'jabatan_tmt' => '2026-02-27',
                'masa_kerja_th' => 19,
                'masa_kerja_bln' => 6,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
Paket C',
                'pendidikan_tahun_lulus' => '1993
1996
2006',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 41,
                'nip' => '198004212007011005',
                'nama' => 'WAKIJAN',
                'tempat_tanggal_lahir' => 'Jambi, 21-04-1980',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'III/a',
                'pangkat_tmt' => '2026-04-01',
                'jabatan_nama' => 'Pengadministrasi Perkantoran',
                'jabatan_tmt' => '2026-02-27',
                'masa_kerja_th' => 19,
                'masa_kerja_bln' => 6,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
Paket C',
                'pendidikan_tahun_lulus' => '1994
1997
2006',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 42,
                'nip' => '198509172010011003',
                'nama' => 'SABARI',
                'tempat_tanggal_lahir' => 'Jambi, 19-09-1985',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'III/a',
                'pangkat_tmt' => '2026-04-01',
                'jabatan_nama' => 'Pengadministrasi Perkantoran',
                'jabatan_tmt' => '2026-02-27',
                'masa_kerja_th' => 16,
                'masa_kerja_bln' => 6,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1998
2001
2004',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => 'Kel.Sungai Asam',
            ],
            [
                'no_urut' => 43,
                'nip' => '197408011996011001',
                'nama' => 'IMRON',
                'tempat_tanggal_lahir' => 'Jambi, 01-08-1974',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'II/d',
                'pangkat_tmt' => '2009-10-01',
                'jabatan_nama' => 'Pengadministrasi Perkantoran',
                'jabatan_tmt' => '2026-02-27',
                'masa_kerja_th' => 30,
                'masa_kerja_bln' => 6,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1989
1992
1995',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => 'Dinas PU Kota Jambi',
            ],
            [
                'no_urut' => 44,
                'nip' => '198208132008011003',
                'nama' => 'SUMARDI',
                'tempat_tanggal_lahir' => 'Jambi, 13-08-1982',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'II/d',
                'pangkat_tmt' => '2020-04-01',
                'jabatan_nama' => 'Pengadministrasi Perkantoran',
                'jabatan_tmt' => '2026-02-27',
                'masa_kerja_th' => 18,
                'masa_kerja_bln' => 6,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SLTA',
                'pendidikan_tahun_lulus' => '1995
1998
2001',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 45,
                'nip' => '198410092009011006',
                'nama' => 'HERMAN YANTO',
                'tempat_tanggal_lahir' => 'Jambi, 09-10-1984',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'II/d',
                'pangkat_tmt' => '2021-04-01',
                'jabatan_nama' => 'Pemadam Kebakaran Terampil',
                'jabatan_tmt' => '2021-09-03',
                'masa_kerja_th' => 17,
                'masa_kerja_bln' => 6,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
MTs
SMK',
                'pendidikan_tahun_lulus' => '1997
2000
2003',
                'latihan_jabatan_nama' => 'Diklat Pemadam II',
                'latihan_jabatan_tahun_lulus' => '2018',
                'latihan_jabatan_tempat' => 'Jakarta',
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 46,
                'nip' => '198508072010011004',
                'nama' => 'KMS.  M.MUAMAR',
                'tempat_tanggal_lahir' => 'Jambi, 07-08-1985',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'II/d',
                'pangkat_tmt' => '2023-04-01',
                'jabatan_nama' => 'Pemadam Kebakaran Terampil',
                'jabatan_tmt' => '2021-09-03',
                'masa_kerja_th' => 16,
                'masa_kerja_bln' => 6,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
MTs
MAL',
                'pendidikan_tahun_lulus' => '1988
2001
2004',
                'latihan_jabatan_nama' => 'Diklat Fire Figther I',
                'latihan_jabatan_tahun_lulus' => '2007',
                'latihan_jabatan_tempat' => 'Jakarta',
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 47,
                'nip' => '198509182010011004',
                'nama' => 'EDI BAMBANG EVIANTO',
                'tempat_tanggal_lahir' => 'Ds. Baru Kibul 18-09-1985',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'II/d',
                'pangkat_tmt' => '2023-04-01',
                'jabatan_nama' => 'Pemadam Kebakaran Terampil',
                'jabatan_tmt' => '2021-09-03',
                'masa_kerja_th' => 16,
                'masa_kerja_bln' => 6,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1998
2001
2004',
                'latihan_jabatan_nama' => 'Diklat Reque
Diklat Pemadam II',
                'latihan_jabatan_tahun_lulus' => '2010
2019',
                'latihan_jabatan_tempat' => 'Jakarta
Jakarta',
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 48,
                'nip' => '198605312010011002',
                'nama' => 'BAMBANG SUGIONO',
                'tempat_tanggal_lahir' => 'Jambi, 31-05-1986',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'II/d',
                'pangkat_tmt' => '2023-04-01',
                'jabatan_nama' => 'Pemadam Kebakaran Terampil',
                'jabatan_tmt' => '2021-09-03',
                'masa_kerja_th' => 16,
                'masa_kerja_bln' => 6,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1998
2001
2004',
                'latihan_jabatan_nama' => 'Diklat Pemadam Kebakaran I
Diklat Pemadam II',
                'latihan_jabatan_tahun_lulus' => '2007
2013',
                'latihan_jabatan_tempat' => 'Jakarta
Bandung',
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 49,
                'nip' => '198605022010011004',
                'nama' => 'DWI  WAHYUDI',
                'tempat_tanggal_lahir' => 'Jambi, 02-05-1986',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'II/c',
                'pangkat_tmt' => '2023-04-01',
                'jabatan_nama' => 'Pemadam Kebakaran Terampil',
                'jabatan_tmt' => '2021-09-03',
                'masa_kerja_th' => 16,
                'masa_kerja_bln' => 6,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
Paket C',
                'pendidikan_tahun_lulus' => '2000
2004
2010',
                'latihan_jabatan_nama' => 'Dilat Pemadam II',
                'latihan_jabatan_tahun_lulus' => '2018',
                'latihan_jabatan_tempat' => 'Jakarta',
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 50,
                'nip' => '197005172007011007',
                'nama' => 'WAGIMIN',
                'tempat_tanggal_lahir' => 'Jambi, 17-05-1970',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'II/c',
                'pangkat_tmt' => '2023-10-01',
                'jabatan_nama' => 'Pengadministrasi Perkantoran',
                'jabatan_tmt' => '2026-02-27',
                'masa_kerja_th' => 18,
                'masa_kerja_bln' => 6,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
Paket B
Paket C',
                'pendidikan_tahun_lulus' => '1986
2009
2014',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 51,
                'nip' => '198309152024211003',
                'nama' => 'RUDI YANTO,S.T',
                'tempat_tanggal_lahir' => 'Jambi,15-09-1983',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'IX',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Analis Kebakaran Pertama/Ahli Pertama',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
S1',
                'pendidikan_nama' => 'SD
SMP
SMA
S.1',
                'pendidikan_tahun_lulus' => '1998
2001
2004
2009',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 52,
                'nip' => '198501292024211007',
                'nama' => 'WELLY YUDHANTORO,S.T',
                'tempat_tanggal_lahir' => 'Jambi,29-01-1985',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'IX',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Analis Kebakaran Pertama/Ahli Pertama',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
S1',
                'pendidikan_nama' => 'SD
SMP
SMA
S.1',
                'pendidikan_tahun_lulus' => '1997
2000
2003
2010',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 53,
                'nip' => '198809082024211015',
                'nama' => 'M.AL HUDRI,S.T',
                'tempat_tanggal_lahir' => 'Jambi, 08-09-1988',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'IX',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Analis Kebakaran Pertama/Ahli Pertama',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
S1',
                'pendidikan_nama' => 'SD
SMP
SMA
S.1',
                'pendidikan_tahun_lulus' => '2000
2003
2006
2013',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 54,
                'nip' => '198811222024212002',
                'nama' => 'DIAN ARIANSYAH,S.T',
                'tempat_tanggal_lahir' => 'Palembang,22-12-1988',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'IX',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Analis Kebakaran Pertama/Ahli Pertama',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
S1',
                'pendidikan_nama' => 'SD
SMP
SMA
S.1',
                'pendidikan_tahun_lulus' => '2001
2004
2007
2012',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 55,
                'nip' => '198901292024211007',
                'nama' => 'DIKY SUCIPTO,S.T',
                'tempat_tanggal_lahir' => 'Jambi, 29-01-1989',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'IX',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Analis Kebakaran Pertama/Ahli Pertama',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
S1',
                'pendidikan_nama' => 'SD
SMP
SMA
S.1',
                'pendidikan_tahun_lulus' => '2000
2003
2006
2014',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 56,
                'nip' => '199301132024211007',
                'nama' => 'ARI ADRIANUS,S.T',
                'tempat_tanggal_lahir' => 'Jambi, 13-01-1993',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'IX',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Analis Kebakaran Pertama/Ahli Pertama',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
S.1',
                'pendidikan_nama' => 'SD
SMP
SMA
S.1',
                'pendidikan_tahun_lulus' => '2005
2008
2011
2020',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 57,
                'nip' => '199407132024212004',
                'nama' => 'DENI GUSRIANTI,S.T',
                'tempat_tanggal_lahir' => 'Batang Hari, 13-07-1994',
                'jenis_kelamin' => 'Perempuan',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'IX',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Analis Kebakaran Pertama/Ahli Pertama',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
S.1',
                'pendidikan_nama' => 'SD
SMP
SMA
S.1',
                'pendidikan_tahun_lulus' => '2006
2009
2014
2016',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 58,
                'nip' => '199410222024211009',
                'nama' => 'TEGUH FAHRIANTO,S.T',
                'tempat_tanggal_lahir' => 'Merangin,22-10-1994',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'IX',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Analis Kebakaran Pertama/Ahli Pertama',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
S.1',
                'pendidikan_nama' => 'SD
SMP
SMA
S.1',
                'pendidikan_tahun_lulus' => '2006
2009
2012
2017',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 59,
                'nip' => '199506142024211001',
                'nama' => 'ROBBY PRADIANSYAH,S.T',
                'tempat_tanggal_lahir' => 'Batanghari, 14-06-1995',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'IX',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Analis Kebakaran Pertama/Ahli Pertama',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
S.1',
                'pendidikan_nama' => 'SD
SMP
SMA
S.1',
                'pendidikan_tahun_lulus' => '2008
2011
2014
2019',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 60,
                'nip' => '19951224202421003',
                'nama' => 'MOHD.FAIZAL HIDAYAT,S.T',
                'tempat_tanggal_lahir' => 'Jambi, 24/12/1995',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'IX',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Analis Kebakaran Pertama/Ahli Pertama',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
S.1',
                'pendidikan_nama' => 'SD
SMP
SMA
S.1',
                'pendidikan_tahun_lulus' => '2008
2011
2014
2020',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 61,
                'nip' => '199603022024212003',
                'nama' => 'NENCY DWIYANA PUTRI,S.T',
                'tempat_tanggal_lahir' => 'Merangin,02-03-1996',
                'jenis_kelamin' => 'Perempuan',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'IX',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Analis Kebakaran Pertama/Ahli Pertama',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
S.1',
                'pendidikan_nama' => 'SD
SMP
SMA
S.1',
                'pendidikan_tahun_lulus' => '2008
2011
2014
2020',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 62,
                'nip' => '199701052024212004',
                'nama' => 'DWI ANGGRAINI,S.T',
                'tempat_tanggal_lahir' => 'Jambi,05-07-1997',
                'jenis_kelamin' => 'Perempuan',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'IX',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Analis Kebakaran Pertama/Ahli Pertama',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
S.1',
                'pendidikan_nama' => 'SD
SMP
SMA
S.1',
                'pendidikan_tahun_lulus' => '2008
2011
2014
2019',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 63,
                'nip' => '199806282024211002',
                'nama' => 'MUHAMMAD YUSUF KHANAFI,S.T',
                'tempat_tanggal_lahir' => 'Tanjabtim,28-06-1998',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'IX',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Analis Kebakaran Pertama/Ahli Pertama',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
S.1',
                'pendidikan_nama' => 'SD
SMP
SMA
S.1',
                'pendidikan_tahun_lulus' => '2011
2014
2017
2021',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 64,
                'nip' => '199902192024212026',
                'nama' => 'DINDA NADILLA,S.T',
                'tempat_tanggal_lahir' => 'Batang Hari,19-02-1999',
                'jenis_kelamin' => 'Perempuan',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'IX',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Analis Kebakaran Pertama/Ahli Pertama',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
S.1',
                'pendidikan_nama' => 'SD
SMP
SMA
S.1',
                'pendidikan_tahun_lulus' => '2011
2014
2017
2022',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 65,
                'nip' => '198809172024211004',
                'nama' => 'ALFIAN WIDYANANTA HERNAWAN,A.Md',
                'tempat_tanggal_lahir' => 'Blora, 17-09-1988',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'VII',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Terampil',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
D.III',
                'pendidikan_nama' => 'SD
SMP
SMA
D.III',
                'pendidikan_tahun_lulus' => '2000
2003
2006
2012',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 66,
                'nip' => '19960409202421211006',
                'nama' => 'WENDO.A.R, A.Md',
                'tempat_tanggal_lahir' => 'Jambi,09-04-1996',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'VII',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Terampil',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
D.III',
                'pendidikan_nama' => 'SD
SMP
SMA
D.III',
                'pendidikan_tahun_lulus' => '2009
2012
2015
2018',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 67,
                'nip' => '199801172024211002',
                'nama' => 'M.ILHAMARDHY RAMADHAN,A.Md',
                'tempat_tanggal_lahir' => 'Jambi, 17-01-1998',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'VII',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Terampil',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA
D.III',
                'pendidikan_tahun_lulus' => '2009
2012
2015
2018',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 68,
                'nip' => '200008272024211001',
                'nama' => 'MUHAMMAD TAUFIK,A.Md.KKK',
                'tempat_tanggal_lahir' => 'Pesisir selatan, 17-01-1988',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'VII',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Terampil',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
D.III',
                'pendidikan_nama' => 'SD
SMP
SMA
D.III',
                'pendidikan_tahun_lulus' => '2012
2015
2018
2021',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 69,
                'nip' => '196811212024211001',
                'nama' => 'AMRULLAH',
                'tempat_tanggal_lahir' => 'Bungo Tebo, 21-11-1968',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
MTs
SMA',
                'pendidikan_tahun_lulus' => '1982
1986
1989',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 70,
                'nip' => '196904102024212002',
                'nama' => 'INDRA SULASTRI',
                'tempat_tanggal_lahir' => 'Batang hari, 10-04-1969',
                'jenis_kelamin' => 'Perempuan',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1983
1986
1990',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 71,
                'nip' => '197008092024212001',
                'nama' => 'SUHENI',
                'tempat_tanggal_lahir' => 'Jambi, 09-08-1970',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
MTs
SMA',
                'pendidikan_tahun_lulus' => '1983
1986
1989',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 72,
                'nip' => '197009052024211002',
                'nama' => 'RIMAN JAYA',
                'tempat_tanggal_lahir' => 'Bengkulu Selatan 05-09-1970,',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1985
1987
2001',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 73,
                'nip' => '197010282024211003',
                'nama' => 'EDI MARJOKO',
                'tempat_tanggal_lahir' => 'Jambi, 28-10-1970',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1985
2006
2016',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 74,
                'nip' => '197503032024211004',
                'nama' => 'YUDI',
                'tempat_tanggal_lahir' => 'Musi Banyu Asin,03-03-1975',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1989
1992
1995',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 75,
                'nip' => '1975040520242211002',
                'nama' => 'MUKRIM',
                'tempat_tanggal_lahir' => 'Palembang, 05-04-1975',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1988
1991
1994',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 76,
                'nip' => '197505072024211005',
                'nama' => 'TURMAN',
                'tempat_tanggal_lahir' => 'Jambi, 07-05-1975',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
MTs
SMA',
                'pendidikan_tahun_lulus' => '1988
1991
1994',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 77,
                'nip' => '197606202024212007',
                'nama' => 'HAMIDAH',
                'tempat_tanggal_lahir' => 'Jambi, 20-06-1976',
                'jenis_kelamin' => 'Perempuan',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
MTs
SMA',
                'pendidikan_tahun_lulus' => '1988
1991
1994',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 78,
                'nip' => '197610172024211001',
                'nama' => 'MUHAMMAD ARIF',
                'tempat_tanggal_lahir' => 'Jambi., 17-10-1976',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1990
1993
1996',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 79,
                'nip' => '197704052024211006',
                'nama' => 'KHOLID IS',
                'tempat_tanggal_lahir' => 'Jambi, 05-04-1977',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1990
1993
1996',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 80,
                'nip' => '197706222024212009',
                'nama' => 'TISRIANTI',
                'tempat_tanggal_lahir' => 'Solok, 22-06-1977',
                'jenis_kelamin' => 'Perempuan',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
MTs
SMA',
                'pendidikan_tahun_lulus' => '1991
1995
1998',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 81,
                'nip' => '197707072024211006',
                'nama' => 'MUHAMMAD IDRUS',
                'tempat_tanggal_lahir' => 'Jambi, 07-07-1977',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
Paket C',
                'pendidikan_tahun_lulus' => '1993
1996
2008',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 82,
                'nip' => '197711112024211001',
                'nama' => 'HARI CANDRA',
                'tempat_tanggal_lahir' => 'Jambi,11-11-1977',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1990
1993
1996',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 83,
                'nip' => '197802162024212006',
                'nama' => 'RAHMI FELIANA',
                'tempat_tanggal_lahir' => 'Palembang, 16-02-1978',
                'jenis_kelamin' => 'Perempuan',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
MTs
SMA',
                'pendidikan_tahun_lulus' => '1991
1994
1997',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 84,
                'nip' => '197807022024212010',
                'nama' => 'YULIANA',
                'tempat_tanggal_lahir' => 'Jambi, 02-07-1978',
                'jenis_kelamin' => 'Perempuan',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
MTs
SMA',
                'pendidikan_tahun_lulus' => '1992
1995
1998',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 85,
                'nip' => '197808122024211001',
                'nama' => 'EFFENDI',
                'tempat_tanggal_lahir' => 'Jambi, 12-08-1978',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1991
1994
1997',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 86,
                'nip' => '197808232024211004',
                'nama' => 'ANDI STIAWAN',
                'tempat_tanggal_lahir' => 'Jambi, 23-08-1978',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
MTs
SMU',
                'pendidikan_tahun_lulus' => '1991
1995
1998',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 87,
                'nip' => '197903102024212009',
                'nama' => 'TUTI ALAWIYAH',
                'tempat_tanggal_lahir' => 'Jambi, 10-03-1979',
                'jenis_kelamin' => 'Perempuan',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1993
1996
1999',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 88,
                'nip' => '197904062024211004',
                'nama' => 'SLAMET',
                'tempat_tanggal_lahir' => 'Jambi,06-04-1979',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1991
1994
1997',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 89,
                'nip' => '197908022024211003',
                'nama' => 'AMID JAYA',
                'tempat_tanggal_lahir' => 'Jambi, 02-08-1979',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1993
1996
1999',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 90,
                'nip' => '197908252024211001',
                'nama' => 'FITRIADI',
                'tempat_tanggal_lahir' => 'Jambi,25-08-1979',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1992
1995
1998',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 91,
                'nip' => '198002162024211001',
                'nama' => 'FIRMANSYAH',
                'tempat_tanggal_lahir' => 'Jambi, 16-02-1980',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1992
1995
1998',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 92,
                'nip' => '19800729202421008',
                'nama' => 'M.ARIF WAHYUDI',
                'tempat_tanggal_lahir' => 'Jambi, 29-07-1980',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1992
1995
1998',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 93,
                'nip' => '198009022024211001',
                'nama' => 'R.MARCURY',
                'tempat_tanggal_lahir' => 'Jakarta, 02-09-1980',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1992
1995
1999',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 94,
                'nip' => '198201022024212019',
                'nama' => 'SRI KURNIATI',
                'tempat_tanggal_lahir' => 'Ogan Komering Ulu, 02-01-1982',
                'jenis_kelamin' => 'Perempuan',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
MTs
SMA',
                'pendidikan_tahun_lulus' => '1993
1996
1999',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 95,
                'nip' => '198202042024212024',
                'nama' => 'PATMAWATI',
                'tempat_tanggal_lahir' => 'Padang, 04-02-1982',
                'jenis_kelamin' => 'Perempuan',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
MTs
SMA',
                'pendidikan_tahun_lulus' => '1994
1997
2000',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 96,
                'nip' => '198208162024211016',
                'nama' => 'HASANUDIN',
                'tempat_tanggal_lahir' => 'Ogan Komiring Ulu, 16-08-1982',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1995
1998
2001',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 97,
                'nip' => '198209012024211005',
                'nama' => 'ARDI YANTO',
                'tempat_tanggal_lahir' => 'Jambi, 01-09-1982',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1995
1998
2001',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 98,
                'nip' => '198209052024211012',
                'nama' => 'TEGUH SUFRIYANTO',
                'tempat_tanggal_lahir' => 'Jambi, 03-09-1982',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
MTs
SMA',
                'pendidikan_tahun_lulus' => '1995
1998
2021',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 99,
                'nip' => '198210142024211001',
                'nama' => 'RUDI UTOYO',
                'tempat_tanggal_lahir' => 'Jambi, 14-10-1982',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1994
1997
2006',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 100,
                'nip' => '198302112024212014',
                'nama' => 'MIRA MULYANA',
                'tempat_tanggal_lahir' => 'Jambi, 11-02-1983',
                'jenis_kelamin' => 'Perempuan',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
MTs
SMA',
                'pendidikan_tahun_lulus' => '1995
1998
2001',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 101,
                'nip' => '198307132024211005',
                'nama' => 'RIYADI YULIATMOKO',
                'tempat_tanggal_lahir' => 'Jambi, 13-07-1983',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1995
1998
2001',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 102,
                'nip' => '198308052024211002',
                'nama' => 'AGUS WIYOTO, SE',
                'tempat_tanggal_lahir' => 'Jambi, 05-08-1983',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
S.1',
                'pendidikan_nama' => 'SD
SMP
SMA
S.1',
                'pendidikan_tahun_lulus' => '1996
1999
2002
2013',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 103,
                'nip' => '19840302202421003',
                'nama' => 'FIRDAUS',
                'tempat_tanggal_lahir' => 'Jambi, 02-03-1984',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1998
2001
2004',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 104,
                'nip' => '198409032024211012',
                'nama' => 'DAVID HERMANSYAH',
                'tempat_tanggal_lahir' => 'Simalungun, 05-09-1984',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
MTs
SMA',
                'pendidikan_tahun_lulus' => '1996
1999
2002',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 105,
                'nip' => '198409102024212022',
                'nama' => 'YANI SUSANTI',
                'tempat_tanggal_lahir' => 'Jambi, 10-09-1984',
                'jenis_kelamin' => 'Perempuan',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1996
1999
2002',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 106,
                'nip' => '198410282024211015',
                'nama' => 'HUSNUL MUBAROQ',
                'tempat_tanggal_lahir' => 'Jambi, 28-10-1984',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1995
1998
2001',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 107,
                'nip' => '198505242024211009',
                'nama' => 'FERDINAN RONALDO TELAH',
                'tempat_tanggal_lahir' => 'Batang hari, 24-05-1985',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1997
2000
2003',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 108,
                'nip' => '198506262024212023',
                'nama' => 'SUSI ERMAWATI',
                'tempat_tanggal_lahir' => 'Jambi,26-06-1985',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1999
2002
2005',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 109,
                'nip' => '198507202024212020',
                'nama' => 'ELYSA TATINIA',
                'tempat_tanggal_lahir' => 'Jambi, 20-07-1985',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1997
2000
2003',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 110,
                'nip' => '198510102024211002',
                'nama' => 'ISTARMAN',
                'tempat_tanggal_lahir' => 'Kulon Progo, 10-10-1985',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1998
2001
2004',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 111,
                'nip' => '198511062024212017',
                'nama' => 'SUSRIANI',
                'tempat_tanggal_lahir' => 'Ogan Komiring Ilir,06-11-1985',
                'jenis_kelamin' => 'Perempuan',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1998
2001
2004',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 112,
                'nip' => '198512222024211001',
                'nama' => 'DWI SALYO PRABOWO',
                'tempat_tanggal_lahir' => 'Jambi, 22-12-1985',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1998
2001
2004',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 113,
                'nip' => '198604192024211001',
                'nama' => 'AMIR HAMZA',
                'tempat_tanggal_lahir' => 'Jambi, 19-04-1986',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1999
2002
2005',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 114,
                'nip' => '198605272024211003',
                'nama' => 'HENDRA.S',
                'tempat_tanggal_lahir' => 'Lubuk Paku, 27-05-1986',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1999
2002
2005',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 115,
                'nip' => '198609112024211003',
                'nama' => 'ADE FIRNANDI RIVAI',
                'tempat_tanggal_lahir' => 'Jambi, 11-09-1986',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1998
2001
2004',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 116,
                'nip' => '198611022024211015',
                'nama' => 'ARITUA HARAHAP',
                'tempat_tanggal_lahir' => 'Jambi, 02-11-1986',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1998
2001
2004',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 117,
                'nip' => '198702122024211001',
                'nama' => 'RIKKY SUHENDAR',
                'tempat_tanggal_lahir' => 'Jambi, 12-02-1987',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1998
2001
2004',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 118,
                'nip' => '198706032024211001',
                'nama' => 'MUSTAQIM',
                'tempat_tanggal_lahir' => 'Jambi, 03-06-1987',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2001
2004
2007',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 119,
                'nip' => '198707182024211003',
                'nama' => 'JULIANSYAH SULAIMAN',
                'tempat_tanggal_lahir' => 'Jambi, 18-07-1987',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1999
2002
2005',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 120,
                'nip' => '198711132024211002',
                'nama' => 'RIFO NOFRIADI',
                'tempat_tanggal_lahir' => 'Jambi, 13-11-1987',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2000
2003
2006',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 121,
                'nip' => '198801152024211003',
                'nama' => 'EDI SUSILO',
                'tempat_tanggal_lahir' => 'Jambi, 15-01-1988',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2000
2004
2007',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 122,
                'nip' => '198803122024211002',
                'nama' => 'ADTYA PRASETYO',
                'tempat_tanggal_lahir' => 'Jambi, 12-03-1988',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2000
2003
2006',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 123,
                'nip' => '198807302024211003',
                'nama' => 'DANIL AKBAR',
                'tempat_tanggal_lahir' => 'Batang Hari, 30-07-1988',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2001
2004
2007',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 124,
                'nip' => '198809152024211009',
                'nama' => 'FADLI ASRIL',
                'tempat_tanggal_lahir' => 'Jambi, 15-09-1988',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2001
2004
2008',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 125,
                'nip' => '198810192024211002',
                'nama' => 'ARIF ARTEN',
                'tempat_tanggal_lahir' => 'Jambi, 19-10-1988',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2001
2004
2007',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 126,
                'nip' => '198810272024211007',
                'nama' => 'AGUNG CAHYO SURYO PUTRO',
                'tempat_tanggal_lahir' => 'Jambi, 27-10-1988',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2000
2003
2006',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 127,
                'nip' => '198901012024211009',
                'nama' => 'SAIPUL MUSTOPA',
                'tempat_tanggal_lahir' => 'Jambi, 01-01-1989',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2001
2005
2008',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 128,
                'nip' => '198905052024211002',
                'nama' => 'ABDUL MUTALIB.HS',
                'tempat_tanggal_lahir' => 'Muaro Jambi, 05-05-1989',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2002
2005
2008',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 129,
                'nip' => '198912292024211003',
                'nama' => 'M.KARDELA',
                'tempat_tanggal_lahir' => 'Jambi, 29-12-1989',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2002
2005
2008',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 130,
                'nip' => '199110102024211027',
                'nama' => 'SUPRAPTO',
                'tempat_tanggal_lahir' => 'Jambi, 10-10-1991',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2003
2006
2009',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 131,
                'nip' => '199110302024211019',
                'nama' => 'SUTRIMO',
                'tempat_tanggal_lahir' => 'Jambi,30-10-1991',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2003
2006
2009',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 132,
                'nip' => '199201062024211018',
                'nama' => 'RAGIL ADE NUGROHO',
                'tempat_tanggal_lahir' => 'Jambi, 06-01-1992',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2003
2006
2009',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 133,
                'nip' => '199201112024211015',
                'nama' => 'HARI SABTA KUSUMA',
                'tempat_tanggal_lahir' => 'Jambi, 11-01-1992',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2003
2006
2009',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 134,
                'nip' => '199206262024211004',
                'nama' => 'ADI KHIYOTO,SE',
                'tempat_tanggal_lahir' => 'Jambi, 26-06-1992',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
S.1',
                'pendidikan_nama' => 'SD
SMP
SMA
S.1',
                'pendidikan_tahun_lulus' => '2004
2007
2010
-',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 135,
                'nip' => '199310222024211011',
                'nama' => 'M.PIKRI',
                'tempat_tanggal_lahir' => 'Jambi,22-10-1993',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2007
2010
2013',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 136,
                'nip' => '199402132024211007',
                'nama' => 'DEDEN RAMADHAN',
                'tempat_tanggal_lahir' => 'Jambi, 13-02-1994',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2007
2010
2013',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 137,
                'nip' => '199405062024211003',
                'nama' => 'ADRIANSYAH',
                'tempat_tanggal_lahir' => 'Jambi, 06-05-1994',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2006
2009
2012',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 138,
                'nip' => '199407032024211012',
                'nama' => 'AULIA RAHMAN',
                'tempat_tanggal_lahir' => 'Jambi, 03-07-1994',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2006
2009
2012',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 139,
                'nip' => '199411272024211007',
                'nama' => 'DEBY NOFRIADI',
                'tempat_tanggal_lahir' => 'Jambi, 27-11-1994',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2006
2009
2012',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 140,
                'nip' => '199411292024211007',
                'nama' => 'ISHAK EFENDI',
                'tempat_tanggal_lahir' => 'Batang hari, 29-11-1994',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2006
2009
2012',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 141,
                'nip' => '199504212024211007',
                'nama' => 'APRYAN PRATAMA PUTRA',
                'tempat_tanggal_lahir' => 'Jambi, 21-04-1995',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2007
2010
2013',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 142,
                'nip' => '199508202024211007',
                'nama' => 'ADI PUTRA',
                'tempat_tanggal_lahir' => 'Jambi, 20-08-1995',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2007
2010
2012',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 143,
                'nip' => '199602162024211007',
                'nama' => 'FEBRY ROZIARDY PUTRA',
                'tempat_tanggal_lahir' => 'Jambi, 16-02-1996',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2007
2010
2013',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 144,
                'nip' => '199606112024211006',
                'nama' => 'M.SANUSI ANDRIAN',
                'tempat_tanggal_lahir' => 'Muaro Jambi, 11-06-1996',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2008
2011
2014',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 145,
                'nip' => '199608052024211005',
                'nama' => 'AGUS RIAWAN',
                'tempat_tanggal_lahir' => 'Jambi, 05-08-1996',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2008
2011
2014',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 146,
                'nip' => '199608182024211012',
                'nama' => 'MAS DEDE SAPUTRA',
                'tempat_tanggal_lahir' => 'Jambi, 18-08-1996',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2008
2011
2014',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 147,
                'nip' => '199611112024211009',
                'nama' => 'YOGI WANDA PUTRA',
                'tempat_tanggal_lahir' => 'Jambi, 11-11-1996',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2008
2012
2018',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 148,
                'nip' => '19961212122024211003',
                'nama' => 'EKO PERDANA',
                'tempat_tanggal_lahir' => 'Tebing Tinggi, 12-12-1996',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2007
2010
2013',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 149,
                'nip' => '199702092024211005',
                'nama' => 'SUCI FTRIYANTO',
                'tempat_tanggal_lahir' => 'Muaro Jambi, 09-02-1997',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2009
2012
2015',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 150,
                'nip' => '199706022024211004',
                'nama' => 'IRPAN WAHYUDI',
                'tempat_tanggal_lahir' => 'Jambi, 02-06-1997',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2008
2011
2014',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 151,
                'nip' => '199804072024211002',
                'nama' => 'DODI PRIA SETIAWAN',
                'tempat_tanggal_lahir' => 'Jambi, 07-04-1998',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2010
2013
2016',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 152,
                'nip' => '199804142024211004',
                'nama' => 'RANU PRASETIO',
                'tempat_tanggal_lahir' => 'Jambi, 14-04-1998',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2010
2013
2016',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 153,
                'nip' => '199905072024211004',
                'nama' => 'MUHAMMAD SUJARKONI',
                'tempat_tanggal_lahir' => 'Muaro Jambi, 07-05-1999',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2011
2014
2017',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 154,
                'nip' => '200004102024211001',
                'nama' => 'SURANDI MAULANA',
                'tempat_tanggal_lahir' => 'Tanjabtim, 10-04-2000',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2024-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2024-03-01',
                'masa_kerja_th' => 2,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2011
2014
2017',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 155,
                'nip' => '197911232025211001',
                'nama' => 'KASPUL ANWAR,S.Kom',
                'tempat_tanggal_lahir' => 'Jambi, 29-11-1979',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'IX',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Penata Layanan Operasional',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
Sarjana',
                'pendidikan_nama' => 'SD
SMP
SMU
S1',
                'pendidikan_tahun_lulus' => '1992
1995
1998
2003',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 156,
                'nip' => '198103072025211003',
                'nama' => 'RINALDO,SH',
                'tempat_tanggal_lahir' => 'Jambi, 07-03-1981',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'IX',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Penata Layanan Operasional',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
S.1',
                'pendidikan_nama' => 'SD
SMP
SMU
S 1',
                'pendidikan_tahun_lulus' => '1993
1996
1999
2005',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 157,
                'nip' => '198703092025211002',
                'nama' => 'MUHAZIRIN,S.E.Sy',
                'tempat_tanggal_lahir' => 'Jambi 09-03-1987',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'IX',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Penata Layanan Operasional',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SMP
SLTA
S.1',
                'pendidikan_nama' => 'SD
MTS
MA
S.1',
                'pendidikan_tahun_lulus' => '1998
2001
2004
2011',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 158,
                'nip' => '198511012025211006',
                'nama' => 'RAHMAT KUTANA,S.Kom',
                'tempat_tanggal_lahir' => 'Indragiri Hilir, 01-11-1985',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'IX',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Arsiparis Ahli Pertama',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
S.1',
                'pendidikan_nama' => 'SD
SMP
SMA
S.1',
                'pendidikan_tahun_lulus' => '1998
2001
2004
2014',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 159,
                'nip' => '199506292025211003',
                'nama' => 'RANDI SAPUTRA,SE',
                'tempat_tanggal_lahir' => 'Batang Hari 29-06-1995',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'IX',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Penata Layanan Operasional',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
Sarjana',
                'pendidikan_nama' => 'MIN
MTs
SMA
S.1',
                'pendidikan_tahun_lulus' => '2007
2010
2013
2018',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 160,
                'nip' => '199708242025212008',
                'nama' => 'BELLA DONA,SE',
                'tempat_tanggal_lahir' => 'Jambi, 24-08-1997',
                'jenis_kelamin' => 'Perempuan',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'IX',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Penata Layanan Operasional',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA
Sarjana',
                'pendidikan_nama' => 'SD
SMP
SMK
S.1',
                'pendidikan_tahun_lulus' => '2009
2012
2015
2023',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 161,
                'nip' => '197208012025211001',
                'nama' => 'M.NASIR',
                'tempat_tanggal_lahir' => 'Pagar Alam, 01-08-1972',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1985
1988
1991',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 162,
                'nip' => '197408032025211013',
                'nama' => 'FERIADI AGUS',
                'tempat_tanggal_lahir' => 'Lahat, 03-08-1974',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMEA',
                'pendidikan_tahun_lulus' => '1987
1990
1993',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 163,
                'nip' => '197506302025211002',
                'nama' => 'M.YAHYA',
                'tempat_tanggal_lahir' => 'Jambi, 30-06-1975',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
MTs
MA',
                'pendidikan_tahun_lulus' => '1989
1992
1995',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 164,
                'nip' => '197507122025211002',
                'nama' => 'MUHAMMAD ISNAINI',
                'tempat_tanggal_lahir' => 'Merangin, 12-07-1975',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1989
1992
1995',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 165,
                'nip' => '197510022025211001',
                'nama' => 'SUNARYO',
                'tempat_tanggal_lahir' => 'Jambi,02-10-1975',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
STM',
                'pendidikan_tahun_lulus' => '1988
1991
1995',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 166,
                'nip' => '197701272025212001',
                'nama' => 'SUZANNA',
                'tempat_tanggal_lahir' => 'Jmbi, 27-01-1977',
                'jenis_kelamin' => 'Perempuan',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pengadministrasi Perkantoran',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1989
1992
1995',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 167,
                'nip' => '197707272025211003',
                'nama' => 'HENDERIONO',
                'tempat_tanggal_lahir' => 'Tebo, 27-07-1977',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMK',
                'pendidikan_tahun_lulus' => '1991
1994
1997',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 168,
                'nip' => '197803292025211001',
                'nama' => 'ABDUL SYUKUR',
                'tempat_tanggal_lahir' => 'Jambi, 29-03-1978',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMU',
                'pendidikan_tahun_lulus' => '1991
1994
1997',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 169,
                'nip' => '197812152025211003',
                'nama' => 'RIDHO DASRIZAL HANDOKO.A',
                'tempat_tanggal_lahir' => 'Jambi, 15-12-1978',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMU',
                'pendidikan_tahun_lulus' => '1992
1995
1998',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 170,
                'nip' => '197910172025211001',
                'nama' => 'ACHMAD SYUKRI INSANI',
                'tempat_tanggal_lahir' => 'Jambi, 17-10-1979',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
MTs
SMU',
                'pendidikan_tahun_lulus' => '1991
1994
1997',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 171,
                'nip' => '198006072025211001',
                'nama' => 'HENDRA',
                'tempat_tanggal_lahir' => 'Jambi 7-6-1980',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMK',
                'pendidikan_tahun_lulus' => '1993
1996
1999',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 172,
                'nip' => '198006152025211004',
                'nama' => 'SYAMSURI',
                'tempat_tanggal_lahir' => 'Batang Hari 15-06-1980',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMU',
                'pendidikan_tahun_lulus' => '1993
1996
1999',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 173,
                'nip' => '198007212025211002',
                'nama' => 'FAHRIZAL',
                'tempat_tanggal_lahir' => 'Jambi, 21-07-1980',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
Paket C',
                'pendidikan_tahun_lulus' => '1992
1996
2003',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 174,
                'nip' => '198010162025211004',
                'nama' => 'SISWANTO',
                'tempat_tanggal_lahir' => 'Indragiri Hilir, 16-10-1980',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMK',
                'pendidikan_tahun_lulus' => '1992
1995
1998',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 175,
                'nip' => '198108182025211002',
                'nama' => 'AGUS HARIANTO',
                'tempat_tanggal_lahir' => 'Jambi , 18-08-1981',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
MTs
SMK',
                'pendidikan_tahun_lulus' => '1994
1997
2000',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 176,
                'nip' => '198112052025211001',
                'nama' => 'SUHERMAN',
                'tempat_tanggal_lahir' => 'Jambi, 05-12-1981',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMK',
                'pendidikan_tahun_lulus' => '1994
1997
2000',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 177,
                'nip' => '198112162025211019',
                'nama' => 'SAPII',
                'tempat_tanggal_lahir' => 'Muaro Jambi, 16-12-1981',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
MTs
MA',
                'pendidikan_tahun_lulus' => '1994
1997
2000',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 178,
                'nip' => '198205172025211003',
                'nama' => 'SUTRIYANTO',
                'tempat_tanggal_lahir' => 'Tanjabtim, 17-05-1982',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMU',
                'pendidikan_tahun_lulus' => '1996
1999
2002',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 179,
                'nip' => '198209082025211001',
                'nama' => 'ANTON WIBOWO',
                'tempat_tanggal_lahir' => 'Jambi, 08-09-1982',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMU',
                'pendidikan_tahun_lulus' => '1995
1999
2002',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 180,
                'nip' => '198211042025211001',
                'nama' => 'BENNI',
                'tempat_tanggal_lahir' => 'Muaro Jambi,04-11-1982',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMK',
                'pendidikan_tahun_lulus' => '1995
1998
2003',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 181,
                'nip' => '198305162025211001',
                'nama' => 'SARWO EDY',
                'tempat_tanggal_lahir' => 'Jambi, 16-05-1983',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1997
2000
2003',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 182,
                'nip' => '198308172025211003',
                'nama' => 'AGUS WAHYUDI',
                'tempat_tanggal_lahir' => 'Jambi, 17-08-1983',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMU',
                'pendidikan_tahun_lulus' => '1996
1999
2003',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 183,
                'nip' => '198309222025211001',
                'nama' => 'SUKARNO',
                'tempat_tanggal_lahir' => 'Sarolangun Bangko, 22-09-1983',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMU',
                'pendidikan_tahun_lulus' => '1995
1998
2001',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 184,
                'nip' => '198311302025211002',
                'nama' => 'ZAKIRIN',
                'tempat_tanggal_lahir' => 'Muaro Jambi, 30-11-1983',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMK',
                'pendidikan_tahun_lulus' => '1996
1999
2002',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 185,
                'nip' => '198404222025211001',
                'nama' => 'NURPAN TAUPAN',
                'tempat_tanggal_lahir' => 'Jambi, 22-04-1984',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
Paket C',
                'pendidikan_tahun_lulus' => '1996
1999
2005',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 186,
                'nip' => '198504132025211001',
                'nama' => 'KMS RCO APRIANSYAH',
                'tempat_tanggal_lahir' => 'Jambi, 13-04-1985',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
Paket B
SMA',
                'pendidikan_tahun_lulus' => '1998
2001
2004',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 187,
                'nip' => '198505072025211001',
                'nama' => 'RD.JHON HUSAIRI',
                'tempat_tanggal_lahir' => 'Jambi, 07-05-1985',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
MTs
MA',
                'pendidikan_tahun_lulus' => '1998
2001
2004',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 188,
                'nip' => '198604122025211002',
                'nama' => 'BASOPI',
                'tempat_tanggal_lahir' => 'Sarolangun, 12-04-1986',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
Paket C',
                'pendidikan_tahun_lulus' => '1999
2003
2011',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 189,
                'nip' => '198607132025211002',
                'nama' => 'MUHAROM',
                'tempat_tanggal_lahir' => 'Jambi, 13-07-1986',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMK',
                'pendidikan_tahun_lulus' => '1998
2001
2004',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 190,
                'nip' => '198608102025211003',
                'nama' => 'SANDI SAPUTRA',
                'tempat_tanggal_lahir' => 'Jambi,10-11-1986',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1998
2002
2005',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 191,
                'nip' => '198610022025211001',
                'nama' => 'M.SOLEH',
                'tempat_tanggal_lahir' => 'Jambi, 02-10-1986',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
MTs
SMK',
                'pendidikan_tahun_lulus' => '1998
2001
2004',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 192,
                'nip' => '198610142025211002',
                'nama' => 'MISBAH',
                'tempat_tanggal_lahir' => 'Jambi, 14-10-1986',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
MTs
MA',
                'pendidikan_tahun_lulus' => '1999
2002
2005',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 193,
                'nip' => '198610172025211004',
                'nama' => 'RICKY OKTORA',
                'tempat_tanggal_lahir' => 'Jambi, 17-10-1986',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
MTs
SMA',
                'pendidikan_tahun_lulus' => '1998
2002
2005',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 194,
                'nip' => '198702182025211018',
                'nama' => 'RORI ANTONI',
                'tempat_tanggal_lahir' => 'Kerinci, 18-02-1987',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
MA',
                'pendidikan_tahun_lulus' => '1998
2002
2005',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 195,
                'nip' => '198703072025211001',
                'nama' => 'MUJI HARNADI',
                'tempat_tanggal_lahir' => 'Batang Hari, 07-03-1987',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SPP',
                'pendidikan_tahun_lulus' => '1999
2002
2005',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 196,
                'nip' => '198704112025211003',
                'nama' => 'TEGUH LEKSONO',
                'tempat_tanggal_lahir' => 'Jambi, 11-04-1987',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1998
2001
2004',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 197,
                'nip' => '198705092025211002',
                'nama' => 'SUTARTO',
                'tempat_tanggal_lahir' => 'Muaro Jambi,09-05-1987',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
Paket C',
                'pendidikan_tahun_lulus' => '2024
2002
2010',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 198,
                'nip' => '198705192025211001',
                'nama' => 'M.HERI HIDAYAT',
                'tempat_tanggal_lahir' => 'Jambi, 19-05-1987',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
MA',
                'pendidikan_tahun_lulus' => '1999
2003
2007',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 199,
                'nip' => '198705282025211003',
                'nama' => 'HADI SURAWIJAYA',
                'tempat_tanggal_lahir' => 'Jambi, 28-05-1987',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
MTs
SMK',
                'pendidikan_tahun_lulus' => '1999
2002
2005',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 200,
                'nip' => '198708072025211001',
                'nama' => 'SUPRIATIN',
                'tempat_tanggal_lahir' => 'Muaro Jambi, 07-08-1987',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
Paket C',
                'pendidikan_tahun_lulus' => '2001
2004
2006',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 201,
                'nip' => '198801162025211001',
                'nama' => 'BUNNARI',
                'tempat_tanggal_lahir' => 'Jambi, 16-08-1988',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
MTs
MA',
                'pendidikan_tahun_lulus' => '2001
2004
2007',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 202,
                'nip' => '198807072025211003',
                'nama' => 'REZA AFRIZAL',
                'tempat_tanggal_lahir' => 'Jambi, 07-07-1988',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2000
2004
2007',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 203,
                'nip' => '198810262025211005',
                'nama' => 'FURQON',
                'tempat_tanggal_lahir' => 'Jambi, 20-10-1988',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
MTs
SMA',
                'pendidikan_tahun_lulus' => '2001
2004
2008',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 204,
                'nip' => '198812252025211002',
                'nama' => 'MUHAMMAD DHENI PRANATA',
                'tempat_tanggal_lahir' => 'Jambi, 25-12-1988',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2001
2004
2007',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 205,
                'nip' => '198901152025211001',
                'nama' => 'JANUARSYAH',
                'tempat_tanggal_lahir' => 'Batang Hari,15-01-1989',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
MTs
SMK',
                'pendidikan_tahun_lulus' => '2001
2004
2007',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 206,
                'nip' => '198902032025211001',
                'nama' => 'AHMAD FANANI',
                'tempat_tanggal_lahir' => 'Jambi, 03-02-1989',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2002
2005
2008',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 207,
                'nip' => '198904302025211001',
                'nama' => 'BAMBANG APRIADI',
                'tempat_tanggal_lahir' => 'Jambi , 30-04-1989',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMK',
                'pendidikan_tahun_lulus' => '2001
2004
2007',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 208,
                'nip' => '198906202025211001',
                'nama' => 'IWAN EFENDY',
                'tempat_tanggal_lahir' => 'Jambi, 20-06-1989',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
MTs
MA',
                'pendidikan_tahun_lulus' => '2000
2003
2006',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 209,
                'nip' => '198909052025211001',
                'nama' => 'MASRIZAL OKTAVIANES',
                'tempat_tanggal_lahir' => 'Solok, 05-09-1989',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
MTs
SMA',
                'pendidikan_tahun_lulus' => '2003
2006
2009',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 210,
                'nip' => '198909162025211001',
                'nama' => 'NANDA',
                'tempat_tanggal_lahir' => 'Jambi,16-09-1989',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMK',
                'pendidikan_tahun_lulus' => '2002
2005
2008',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 211,
                'nip' => '198912102025211003',
                'nama' => 'RIKI RESTIAWAN',
                'tempat_tanggal_lahir' => 'Jambi, 10-12-1989',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2003
2006
2009',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 212,
                'nip' => '198912112025211002',
                'nama' => 'DEDI THOBLAWI',
                'tempat_tanggal_lahir' => 'Jambi, 11-12-1989',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
MTs
MA',
                'pendidikan_tahun_lulus' => '2002
2006
2009',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 213,
                'nip' => '199003242025211005',
                'nama' => 'PARYONO',
                'tempat_tanggal_lahir' => 'Muaro Jambi, 24-03-1990',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2002
2005
2008',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 214,
                'nip' => '199012252025211006',
                'nama' => 'AHMAD YANI',
                'tempat_tanggal_lahir' => 'Jambi, 25-12-1990',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
MTs
MA',
                'pendidikan_tahun_lulus' => '2002
2005
2008',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 215,
                'nip' => '199103122025211001',
                'nama' => 'M.FRBRI HARMONO',
                'tempat_tanggal_lahir' => 'Jambi, 12-03-1991',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
MTs
MA',
                'pendidikan_tahun_lulus' => '2003
2006
2009',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 216,
                'nip' => '199106062025211003',
                'nama' => 'BAYU SUKMA',
                'tempat_tanggal_lahir' => 'Jambi, 06-06-1991',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMK',
                'pendidikan_tahun_lulus' => '2003
2006
2009',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 217,
                'nip' => '199109272025211004',
                'nama' => 'JAI',
                'tempat_tanggal_lahir' => 'Muaro Jambi, 27-09-1991',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMK',
                'pendidikan_tahun_lulus' => '2002
2006
2009',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 218,
                'nip' => '199203222025211003',
                'nama' => 'RAHMAD VERI RIZKI',
                'tempat_tanggal_lahir' => 'Jambi, 22-03-1992',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2004
2007
2010',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 219,
                'nip' => '199204012025211002',
                'nama' => 'AMAT ARIYANTO',
                'tempat_tanggal_lahir' => 'Jambi,01-04-1992',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMK',
                'pendidikan_tahun_lulus' => '2005
2008
2011',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 220,
                'nip' => '199204292025211003',
                'nama' => 'ARIFIN',
                'tempat_tanggal_lahir' => 'Jambi, 29-04-1992',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
Paket B
MA',
                'pendidikan_tahun_lulus' => '2003
2006
2009',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 221,
                'nip' => '199206132025211028',
                'nama' => 'DODI ATHOILA WICAKSONO',
                'tempat_tanggal_lahir' => 'Jambi, 13-06-1992',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2004
2007
2010',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 222,
                'nip' => '199206232025211003',
                'nama' => 'SURYADI',
                'tempat_tanggal_lahir' => 'Batang Hari, 23-06-1992',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'MI
SMP
SMA',
                'pendidikan_tahun_lulus' => '2005
2008
2011',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 223,
                'nip' => '199207122025211001',
                'nama' => 'MUSLIM',
                'tempat_tanggal_lahir' => 'Jambi, 12-07-1992',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
Paket B
SMA',
                'pendidikan_tahun_lulus' => '2004
2008
2010',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 224,
                'nip' => '199303192025211005',
                'nama' => 'MARDIAN HASNUR',
                'tempat_tanggal_lahir' => 'Jambi, 19-03-1993',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMK',
                'pendidikan_tahun_lulus' => '2005
2008
2011',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 225,
                'nip' => '199307212025211003',
                'nama' => 'REDI JULIAN',
                'tempat_tanggal_lahir' => 'Lubuk Linggau,21-07-1993',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2006
2009
2012',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 226,
                'nip' => '199401162025211002',
                'nama' => 'MUNIRRIYADI',
                'tempat_tanggal_lahir' => 'Muaro Jambi, 16-01-1994',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMK',
                'pendidikan_tahun_lulus' => '2008
2011
2014',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 227,
                'nip' => '199501022025212004',
                'nama' => 'SURYA MURLIA NINGSIH',
                'tempat_tanggal_lahir' => 'Tanjabtim, 02-01-1994',
                'jenis_kelamin' => 'Perempuan',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pengadministrasi Perkantoran',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
MTs
SMA',
                'pendidikan_tahun_lulus' => '2006
2009
2012',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 228,
                'nip' => '199402172025211001',
                'nama' => 'PANJI AGUNG',
                'tempat_tanggal_lahir' => 'Jambi, 17-02-1994',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2005
2008
2011',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 229,
                'nip' => '199406122025211003',
                'nama' => 'DIMAS WAHYU KURNIAWAN',
                'tempat_tanggal_lahir' => 'Merangin, 12-06-1994',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMK',
                'pendidikan_tahun_lulus' => '2005
2008
2011',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 230,
                'nip' => '199408082025211001',
                'nama' => 'MUHAMMAD HIDAYAT',
                'tempat_tanggal_lahir' => 'Jambi, 08-08-1994',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2005
2008
2011',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 231,
                'nip' => '199412082025211003',
                'nama' => 'DEDI AGUNG PAMBUDI',
                'tempat_tanggal_lahir' => 'Jambi, 18-12-1994',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMK',
                'pendidikan_tahun_lulus' => '2006
2009
2013',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 232,
                'nip' => '199412252025211001',
                'nama' => 'MUHAMMAD LUKMAN',
                'tempat_tanggal_lahir' => 'Jambi,25-12-1994',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2006
2009
2012',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 233,
                'nip' => '199505242025211001',
                'nama' => 'INDRIYANTO ADI SAPUTRA',
                'tempat_tanggal_lahir' => 'Jambi, 24-05-1995',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2010
2013
2016',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 234,
                'nip' => '199510272025211001',
                'nama' => 'MUHAMMAD RIO',
                'tempat_tanggal_lahir' => 'Jambi, 27-10-1995',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2007
2010
2013',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 235,
                'nip' => '199601012025211024',
                'nama' => 'NUR RUWANDA',
                'tempat_tanggal_lahir' => 'Muaro Jambi, 01-01-1996',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2008
2011
2014',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 236,
                'nip' => '199606272025211003',
                'nama' => 'MAJITO SUGIANTO',
                'tempat_tanggal_lahir' => 'Muaro Jambi, 27-06-1996',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMK',
                'pendidikan_tahun_lulus' => '2008
2011
2015',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 237,
                'nip' => '199608032025211001',
                'nama' => 'MUHAMMAD SYAFIQ',
                'tempat_tanggal_lahir' => 'Batang Hari, 03-08-1996',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2009
2012
2015',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 238,
                'nip' => '199608112025211002',
                'nama' => 'FERI ISHARIYANTO',
                'tempat_tanggal_lahir' => 'Muaro Jambi. 11-08-1996',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
MTs
MA',
                'pendidikan_tahun_lulus' => '2009
2011
2015',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 239,
                'nip' => '199711242025211001',
                'nama' => 'REZA EKO NOVIAN',
                'tempat_tanggal_lahir' => 'Jambi, 24-11-1997',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMK',
                'pendidikan_tahun_lulus' => '2009
2012
2015',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 240,
                'nip' => '199802022025211001',
                'nama' => 'RIAN FEBRIYANTO',
                'tempat_tanggal_lahir' => 'Jambi, 02-02-1998',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMK',
                'pendidikan_tahun_lulus' => '2010
2013
2016',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 241,
                'nip' => '199804052025211001',
                'nama' => 'MUHAMMAD SURYA PRATAMA',
                'tempat_tanggal_lahir' => 'Muaro Jambi, 05-04-1998',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2010
2013
2016',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 242,
                'nip' => '199811042025211004',
                'nama' => 'RUDI ARIANDI',
                'tempat_tanggal_lahir' => 'Jambi, 04-11-1998',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMU',
                'pendidikan_tahun_lulus' => '2010
2013
2016',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 243,
                'nip' => '199905202025211001',
                'nama' => 'ILHAM SAPUTRA',
                'tempat_tanggal_lahir' => 'Jambi, 20-05-1999',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2011
2014
2017',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 244,
                'nip' => '199908112025212001',
                'nama' => 'LESTYA RENA AGUSTEIN',
                'tempat_tanggal_lahir' => 'Tanjabbar,11-08-1999',
                'jenis_kelamin' => 'Perempuan',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pengadministrasi Perkantoran',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2011
2014
2017',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 245,
                'nip' => '199909222025212001',
                'nama' => 'SINTA NURIYAH',
                'tempat_tanggal_lahir' => 'Muaro Jambi,22-09-1999',
                'jenis_kelamin' => 'Perempuan',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pengadministrasi Perkantoran',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
Paket B
SMA',
                'pendidikan_tahun_lulus' => '2011
2014
2017',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 246,
                'nip' => '199912232025211005',
                'nama' => 'MOHD. IRFAN',
                'tempat_tanggal_lahir' => 'Jambi, 23-12-1999',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2012
2016
2019',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 247,
                'nip' => '200004022025211001',
                'nama' => 'YOGA TEDY RUSADY',
                'tempat_tanggal_lahir' => 'Kota Jambi, 02-04-2000',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-03-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-03-01',
                'masa_kerja_th' => 1,
                'masa_kerja_bln' => 4,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMK',
                'pendidikan_tahun_lulus' => '2012
2015
2018',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 248,
                'nip' => '197705302025211018',
                'nama' => 'KAHARUDDIN',
                'tempat_tanggal_lahir' => 'Tanjabtim, 30-05-1977',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-09-01',
                'jabatan_nama' => 'Pengadministrasi Perkantoran',
                'jabatan_tmt' => '2025-09-01',
                'masa_kerja_th' => 0,
                'masa_kerja_bln' => 7,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '1993
1996
1999',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 249,
                'nip' => '198007022025211030',
                'nama' => 'ISMAIL',
                'tempat_tanggal_lahir' => 'Kota Jambi, 02-07-1980',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-09-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-09-01',
                'masa_kerja_th' => 0,
                'masa_kerja_bln' => 10,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMK',
                'pendidikan_tahun_lulus' => '1994
1997
2001',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 250,
                'nip' => '198601172025211034',
                'nama' => 'FAHREZA',
                'tempat_tanggal_lahir' => 'Kota Jambi,17-01-1986',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-09-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-09-01',
                'masa_kerja_th' => 0,
                'masa_kerja_bln' => 10,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
Paket C',
                'pendidikan_tahun_lulus' => '1998
2001
2015',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 251,
                'nip' => '198801062025211033',
                'nama' => 'DODI SURYADI',
                'tempat_tanggal_lahir' => 'Kota Jambi, 06-01-1988',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-09-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-09-01',
                'masa_kerja_th' => 0,
                'masa_kerja_bln' => 10,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
Paket C',
                'pendidikan_tahun_lulus' => '2001
2004
2010',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 252,
                'nip' => '199201122025211043',
                'nama' => 'PENDI ABDULLAH',
                'tempat_tanggal_lahir' => 'Kota Jambi, 12-01-1992',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-09-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-09-01',
                'masa_kerja_th' => 0,
                'masa_kerja_bln' => 10,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
MTs
SMK',
                'pendidikan_tahun_lulus' => '2005
2008
2011',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 253,
                'nip' => '199801312025211014',
                'nama' => 'VIKY',
                'tempat_tanggal_lahir' => 'Kota Jambi, 31-01-1998',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-09-01',
                'jabatan_nama' => 'Pemadam Kebakaran Pemula',
                'jabatan_tmt' => '2025-09-01',
                'masa_kerja_th' => 0,
                'masa_kerja_bln' => 10,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2009
2012
2015',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 254,
                'nip' => '199803042025211016',
                'nama' => 'ANDRI WAHYUDI',
                'tempat_tanggal_lahir' => 'Kota Jambi, 04-03-1998',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-09-01',
                'jabatan_nama' => 'Pengadministrasi Perkantoran',
                'jabatan_tmt' => '2025-09-01',
                'masa_kerja_th' => 0,
                'masa_kerja_bln' => 10,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMA',
                'pendidikan_tahun_lulus' => '2009
2012
2015',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 255,
                'nip' => '199812102025211012',
                'nama' => 'HARI MUBAROK',
                'tempat_tanggal_lahir' => 'Kota Jambi,10-12-1998',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-09-01',
                'jabatan_nama' => 'Pengadministrasi Perkantoran',
                'jabatan_tmt' => '2025-09-01',
                'masa_kerja_th' => 0,
                'masa_kerja_bln' => 10,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
SMP
SMU',
                'pendidikan_tahun_lulus' => '2010
2013
2016',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
            [
                'no_urut' => 256,
                'nip' => '200005162025211008',
                'nama' => 'M.DODI STYAWAN',
                'tempat_tanggal_lahir' => 'Kota Jambi, 16-05-2000',
                'jenis_kelamin' => 'Laki-laki',
                'status_pegawai' => 'Aktif',
                'pangkat_gol_ruang' => 'V',
                'pangkat_tmt' => '2025-09-01',
                'jabatan_nama' => 'Pengadministrasi Perkantoran',
                'jabatan_tmt' => '2025-09-01',
                'masa_kerja_th' => 0,
                'masa_kerja_bln' => 10,
                'pendidikan_tingkat_ijazah' => 'SD
SLTP
SLTA',
                'pendidikan_nama' => 'SD
MTs
SMK',
                'pendidikan_tahun_lulus' => '2012
2015
2018',
                'latihan_jabatan_nama' => null,
                'latihan_jabatan_tahun_lulus' => null,
                'latihan_jabatan_tempat' => null,
                'catatan_mutasi_pegawai' => null,
            ],
        ];

        $now = now();
        foreach ($data as &$item) {
            $item['created_at'] = $now;
            $item['updated_at'] = $now;
        }
        unset($item);

        foreach (array_chunk($data, 50) as $chunk) {
            Pegawai::insert($chunk);
        }
    }
}
