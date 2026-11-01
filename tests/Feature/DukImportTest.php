<?php

namespace Tests\Feature;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Tests\TestCase;

class DukImportTest extends TestCase
{
    protected User $superUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->prepareDatabase();

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Role::findOrCreate('Super User', 'web');

        $this->superUser = User::create([
            'nama_lengkap' => 'Admin Super',
            'email' => 'superuser_'.uniqid().'@damkar.go.id',
            'nomor_pegawai' => 'SU'.rand(10000, 99999),
            'password' => Hash::make('password123'),
        ]);
        $this->superUser->assignRole('Super User');
    }

    private function prepareDatabase(): void
    {
        Schema::dropIfExists('activity_logs');
        Schema::dropIfExists('model_has_roles');
        Schema::dropIfExists('model_has_permissions');
        Schema::dropIfExists('role_has_permissions');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('pegawais');
        Schema::dropIfExists('users');

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('email')->unique();
            $table->string('nomor_pegawai')->unique();
            $table->string('role')->default('pegawai');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        $permissionMigration = require base_path('database/migrations/2026_10_07_011638_create_permission_tables.php');
        $permissionMigration->up();

        $pegawaiMigration = require base_path('database/migrations/2026_09_28_170705_create_pegawais_table.php');
        $pegawaiMigration->up();

        $ubahTahunMigration = require base_path('database/migrations/2026_10_22_000000_ubah_kolom_tahun_lulus_di_tabel_pegawais.php');
        $ubahTahunMigration->up();

        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('user_name')->nullable();
            $table->string('user_role')->nullable();
            $table->string('action', 50);
            $table->string('module', 100);
            $table->text('description')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->json('properties')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Uji import data DUK dari format CSV bertingkat
     */
    public function test_can_import_duk_from_multiline_csv(): void
    {
        $csvContent = <<<'CSV'
,,,,,,,,,DAFTAR URUT KEPANGKATAN,,,,,,,,,,
,,,,,,,,          DINAS PEMADAM KEBAKARAN DAN PENYELAMATAN ,,,,,,,,,,,
,,,,,,,,        KOTA JAMBI,,,,,,,,,,,
,,,,,,,,,,,,,,,,,,,
,,,,,,,,,,,,,,,,,PERIODE OKTOBER TAHUN 2026,,
,,,,,,,,,,,,,,,,,,,
,NO,NAMA,NIP,PANGKAT,,JABATAN,,MASA KERJA,,LATIHAN JABATAN,,,PENDIDIKAN,,,TEMPAT TANGGAL LAHIR,JENIS KELAMIN           ( L/P ),CATATAN MUTASI PEGAWAI,STATUS CPNS/PNS/PPPK
,,,,,,,,,,,,,,,,,,,
,,,,Gol ,TMT,NAMA,TMT,Th,Bln,NAMA ,TAHUN LULUS ,TEMPAT,NAMA,TAHUN ,TINGKAT Ijazah,,,,
,,,,RUANG,,,,,,,,,,,,,,,
,,,,,,,,,,,,,,LULUS,,,,,
,1.0,2.0,3.0,4.0,5.0,6.0,7.0,8.0,9.0,10.0,11.0,12.0,13.0,14.0,15.0,16.0,17.0,18.0,19.0
,1.0,"MUSTARI AFFANDI,AP,ME",19750816 199311 1 001,IV/c,44470.0,Kepala Dinas Damkar,44960.0,32.0,8.0,1. ADUM,1999.0,Medan,SD,1987.0,SD,"Jambi, 16-08-1975",Laki-laki,Satpol PP Kota Jambi,PNS
,,,,,,,,,,2. ADUMLA,2000.0,Jakarta,SMP,1990.0,SLTP,,,,
,,,,,,,,,,3. Diklatpim Tk.III,2015.0,Jambi,SMA,1995.0,SLTA,,,,
,,,,,,,,,,4. Diklatpim Tk.II ,2023.0,Jakarta,D IV,1997.0,D.IV,,,,
,,,,,,,,,,,,,S2,2020.0,S.2,,,,
,2.0,"AZWAR,SE",19691027 198902 1 001,IV/a,43922.0,Kabid Sarana dan Prasarana,44960.0,37.0,5.0,Diklatpim IV,1999.0,Jambi,SD,1982.0,SD,"Jambi,27 -10- 1969",Laki-laki,Dinsos Kota Jambi,PNS
,,,,,,,,,,,,,SMP,1985.0,SLTP,,,,
,,,,,,,,,,,,,SMA,1988.0,SLTA,,,,
,,,,,,,,,,,,,S.1,2003.0,S1,,,,
,3.0,"ARDIANSYAH,S,STP",19850523 200312 1 001,IV/a,44287.0,Kabid Pencegahan,45233.0,22.0,7.0,1. Diklatpim Tk.IV,2009.0,Jambi,SD,1997.0,SD,"Jambi,",Laki-Laki,Koperasi,PNS
,,,,,,,,,,,,,SLTP,2000.0,SLTP,31190.0,,UKM,
,10.0,"SUHERMANTO,SE",19720830 199602 1 001,III/d,43922.0,Kasi Peningkatan kapasitas Aparatur,44200.0,34.0,4.0,DIKLATPIM.IV,2020.0,Jambi,SD,1985.0,SD,Jambi,Laki-laki,Pol.PP Kota Jambi,PNS
,,,,,,,,,,,,,SMP,1988.0,SLTP,26541.0,,,
,,,,,,,,,,,,,,,KEPALA DINAS PEMADAM KEBAKARAN,,,,
,,,,,,,,,,,,,,,"MUSTARI AFFANDI,AP,ME",,,,
CSV;

        $file = UploadedFile::fake()->createWithContent('duk_test.csv', $csvContent);

        $response = $this->actingAs($this->superUser)->post('/internal/kepegawaian/duk/import', [
            'file_excel' => $file,
        ]);

        $response->assertRedirect('/internal/kepegawaian/duk');
        $response->assertSessionHas('success');

        // Pastikan baris nomor kolom 1,2,3... tidak masuk sebagai pegawai
        $this->assertDatabaseMissing('pegawais', [
            'nip' => '3',
        ]);
        $this->assertDatabaseMissing('pegawais', [
            'nama' => '2',
        ]);

        // Cek Mustari Affandi
        $mustari = Pegawai::where('nip', '197508161993111001')->first();
        $this->assertNotNull($mustari);
        $this->assertEquals('MUSTARI AFFANDI,AP,ME', $mustari->nama);
        $this->assertEquals('IV/c', $mustari->pangkat_gol_ruang);
        $this->assertEquals('2021-10-01', $mustari->pangkat_tmt);
        $this->assertEquals('Kepala Dinas Damkar', $mustari->jabatan_nama);
        $this->assertEquals('2023-02-03', $mustari->jabatan_tmt);
        $this->assertEquals(32, $mustari->masa_kerja_th);
        $this->assertEquals(8, $mustari->masa_kerja_bln);

        // Cek penggabungan multiline riwayat Diklat
        $this->assertStringContainsString('1. ADUM', $mustari->latihan_jabatan_nama);
        $this->assertStringContainsString('2. ADUMLA', $mustari->latihan_jabatan_nama);
        $this->assertStringContainsString('3. Diklatpim Tk.III', $mustari->latihan_jabatan_nama);

        // Cek penggabungan multiline riwayat Pendidikan
        $this->assertStringContainsString('SD', $mustari->pendidikan_nama);
        $this->assertStringContainsString('SMP', $mustari->pendidikan_nama);
        $this->assertStringContainsString('SMA', $mustari->pendidikan_nama);
        $this->assertStringContainsString('S2', $mustari->pendidikan_nama);

        // Cek Azwar
        $azwar = Pegawai::where('nip', '196910271989021001')->first();
        $this->assertNotNull($azwar);
        $this->assertEquals('AZWAR,SE', $azwar->nama);
        $this->assertEquals('IV/a', $azwar->pangkat_gol_ruang);
        $this->assertEquals('2020-04-01', $azwar->pangkat_tmt);
        $this->assertEquals(37, $azwar->masa_kerja_th);
        $this->assertEquals(5, $azwar->masa_kerja_bln);

        // Cek Ardiansyah (Tempat baris 1: Jambi, Tanggal baris 2: 31190.0 => 23-05-1985)
        $ardiansyah = Pegawai::where('nip', '198505232003121001')->first();
        $this->assertNotNull($ardiansyah);
        $this->assertStringContainsString('23-05-1985', $ardiansyah->tempat_tanggal_lahir);
        $this->assertStringContainsString('Jambi', $ardiansyah->tempat_tanggal_lahir);
        $this->assertStringContainsString('Koperasi UKM', $ardiansyah->catatan_mutasi_pegawai);

        // Cek Suhermanto (Tempat baris 1: Jambi, Tanggal baris 2: 26541.0 => 30-08-1972)
        $suhermanto = Pegawai::where('nip', '197208301996021001')->first();
        $this->assertNotNull($suhermanto);
        $this->assertStringContainsString('30-08-1972', $suhermanto->tempat_tanggal_lahir);
        $this->assertStringContainsString('Jambi', $suhermanto->tempat_tanggal_lahir);
    }
}
