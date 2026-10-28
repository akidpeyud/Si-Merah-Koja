<?php

namespace Tests\Feature;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Tests\TestCase;

class DukTest extends TestCase
{
    protected User $superUser;

    protected User $sekretariatUser;

    protected User $regularUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->prepareDatabase();

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Buat roles
        Role::findOrCreate('Super User', 'web');
        Role::findOrCreate('Sekretariat', 'web');
        Role::findOrCreate('Pencegahan', 'web');

        // Buat users
        $this->superUser = User::create([
            'nama_lengkap' => 'Admin Super',
            'email' => 'super@damkar.go.id',
            'nomor_pegawai' => '198001012000011001',
            'password' => Hash::make('password'),
        ]);
        $this->superUser->assignRole('Super User');

        $this->sekretariatUser = User::create([
            'nama_lengkap' => 'Staff Sekretariat',
            'email' => 'sekretariat@damkar.go.id',
            'nomor_pegawai' => '198501012005011002',
            'password' => Hash::make('password'),
        ]);
        $this->sekretariatUser->assignRole('Sekretariat');

        $this->regularUser = User::create([
            'nama_lengkap' => 'Staff Pencegahan',
            'email' => 'pencegahan@damkar.go.id',
            'nomor_pegawai' => '199001012010011003',
            'password' => Hash::make('password'),
        ]);
        $this->regularUser->assignRole('Pencegahan');
    }

    private function prepareDatabase(): void
    {
        Schema::dropIfExists('model_has_roles');
        Schema::dropIfExists('model_has_permissions');
        Schema::dropIfExists('role_has_permissions');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('pegawais');
        Schema::dropIfExists('users');

        // 1. Users table
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

        // 2. Permission tables
        $permissionMigration = require base_path('database/migrations/2026_10_07_011638_create_permission_tables.php');
        $permissionMigration->up();

        // 3. Pegawais table
        $pegawaiMigration = require base_path('database/migrations/2026_09_28_170705_create_pegawais_table.php');
        $pegawaiMigration->up();

        $ubahTahunMigration = require base_path('database/migrations/2026_10_22_000000_ubah_kolom_tahun_lulus_di_tabel_pegawais.php');
        $ubahTahunMigration->up();
    }

    /**
     * Skenario 1: Tamu (belum login) tidak dapat mengakses DUK.
     */
    public function test_guest_is_redirected_to_login(): void
    {
        $response = $this->get(route('kepegawaian.duk.index'));
        $response->assertRedirect('/login');
    }

    /**
     * Skenario 2: User terautentikasi dapat melihat daftar DUK.
     */
    public function test_authenticated_user_can_view_duk_index(): void
    {
        Pegawai::create([
            'no_urut' => 1,
            'nip' => '197508161993111001',
            'nama' => 'MUSTARI AFFANDI,AP,ME',
            'pangkat_gol_ruang' => 'IV/c',
            'status_pegawai' => 'Aktif',
            'tempat_tanggal_lahir' => 'Jambi, 16-08-1975',
        ]);

        $response = $this->actingAs($this->sekretariatUser)
            ->get(route('kepegawaian.duk.index'));

        $response->assertStatus(200);
        $response->assertSee('MUSTARI AFFANDI,AP,ME');
        $response->assertSee('197508161993111001');
    }

    /**
     * Skenario 3: Pencarian data DUK berdasarkan nama dan NIP.
     */
    public function test_duk_search_by_name_and_nip(): void
    {
        Pegawai::create([
            'no_urut' => 1,
            'nip' => '197508161993111001',
            'nama' => 'MUSTARI AFFANDI',
            'status_pegawai' => 'Aktif',
        ]);

        Pegawai::create([
            'no_urut' => 2,
            'nip' => '198505232003121001',
            'nama' => 'ARDIANSYAH',
            'status_pegawai' => 'Aktif',
        ]);

        // Cari berdasarkan nama
        $resName = $this->actingAs($this->superUser)
            ->get(route('kepegawaian.duk.index', ['search' => 'MUSTARI']));
        $resName->assertSee('MUSTARI AFFANDI');
        $resName->assertDontSee('ARDIANSYAH');

        // Cari berdasarkan NIP
        $resNip = $this->actingAs($this->superUser)
            ->get(route('kepegawaian.duk.index', ['search' => '19850523']));
        $resNip->assertSee('ARDIANSYAH');
        $resNip->assertDontSee('MUSTARI AFFANDI');
    }

    /**
     * Skenario 4: Role non-Sekretariat/Super User ditolak saat mengakses form tambah / edit.
     */
    public function test_unauthorized_role_cannot_access_create_and_edit(): void
    {
        $pegawai = Pegawai::create([
            'no_urut' => 1,
            'nip' => '197508161993111001',
            'nama' => 'MUSTARI AFFANDI',
            'status_pegawai' => 'Aktif',
        ]);

        $this->actingAs($this->regularUser)
            ->get(route('kepegawaian.duk.create'))
            ->assertStatus(403);

        $this->actingAs($this->regularUser)
            ->get(route('kepegawaian.duk.edit', $pegawai->id))
            ->assertStatus(403);
    }

    /**
     * Skenario 5: Sekretariat dapat mengakses form tambah dan menyimpan data baru.
     */
    public function test_sekretariat_can_access_create_form(): void
    {
        $response = $this->actingAs($this->sekretariatUser)
            ->get(route('kepegawaian.duk.create'));

        $response->assertStatus(200);
        $response->assertSee('Tambah Data Pegawai Baru');
    }

    /**
     * Skenario 6: Validasi saat create pegawai (no_urut dan nip harus unik).
     */
    public function test_create_pegawai_validation(): void
    {
        Pegawai::create([
            'no_urut' => 1,
            'nip' => '197508161993111001',
            'nama' => 'PEGAWAI LAMA',
            'status_pegawai' => 'Aktif',
        ]);

        $response = $this->actingAs($this->sekretariatUser)
            ->post(route('kepegawaian.duk.store'), [
                'no_urut' => 1, // duplikat
                'nip' => '197508161993111001', // duplikat
                'nama' => '', // kosong
            ]);

        $response->assertSessionHasErrors(['no_urut', 'nip', 'nama']);
    }

    /**
     * Skenario 7: Sukses menyimpan data pegawai baru dan cek tempat_tanggal_lahir.
     */
    public function test_can_store_new_pegawai(): void
    {
        $payload = [
            'no_urut' => 10,
            'nip' => '199501012020011005',
            'nama' => 'BUDI SANTOSO, S.Kom',
            'tempat_lahir' => 'Jambi',
            'tanggal_lahir' => '1995-01-01',
            'jenis_kelamin' => 'Laki-laki',
            'status_pegawai' => 'Aktif',
            'pangkat_gol_ruang' => 'III/a',
            'jabatan_nama' => 'Pranata Komputer',
            'masa_kerja_th' => 4,
            'masa_kerja_bln' => 2,
        ];

        $response = $this->actingAs($this->sekretariatUser)
            ->post(route('kepegawaian.duk.store'), $payload);

        $response->assertRedirect(route('kepegawaian.duk.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('pegawais', [
            'no_urut' => 10,
            'nip' => '199501012020011005',
            'nama' => 'BUDI SANTOSO, S.Kom',
        ]);

        $pegawai = Pegawai::where('nip', '199501012020011005')->first();
        // Cek apakah tempat_tanggal_lahir terisi dari input tempat_lahir & tanggal_lahir
        $this->assertNotNull($pegawai->tempat_tanggal_lahir, 'Tempat tanggal lahir seharusnya tidak null jika user mengisi tempat_lahir dan tanggal_lahir');
        $this->assertEquals('Jambi, 01-01-1995', $pegawai->tempat_tanggal_lahir);

        // Cek apakah halaman edit memuat accessor tempat_lahir & tanggal_lahir
        $resEdit = $this->actingAs($this->superUser)->get(route('kepegawaian.duk.edit', $pegawai->id));
        $resEdit->assertStatus(200);
        $resEdit->assertSee('value="Jambi"', false);
        $resEdit->assertSee('value="1995-01-01"', false);
    }

    /**
     * Skenario 8: Update pegawai dengan riwayat pendidikan / diklat bertahun ganda (multi-line).
     */
    public function test_update_pegawai_with_multiline_years(): void
    {
        $pegawai = Pegawai::create([
            'no_urut' => 1,
            'nip' => '197508161993111001',
            'nama' => 'MUSTARI AFFANDI',
            'status_pegawai' => 'Aktif',
            'pendidikan_tahun_lulus' => "1987\n1990\n1995\n1997\n2020",
            'latihan_jabatan_tahun_lulus' => "1999\n2000\n2015\n2023",
        ]);

        $updatePayload = [
            'no_urut' => 1,
            'nip' => '197508161993111001',
            'nama' => 'MUSTARI AFFANDI, AP, ME',
            'status_pegawai' => 'Aktif',
            'pendidikan_tahun_lulus' => "1987\n1990\n1995\n1997\n2020",
            'latihan_jabatan_tahun_lulus' => "1999\n2000\n2015\n2023",
        ];

        $response = $this->actingAs($this->superUser)
            ->put(route('kepegawaian.duk.update', $pegawai->id), $updatePayload);

        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect(route('kepegawaian.duk.index'));
    }

    /**
     * Skenario 8: Update data pegawai.
     */
    public function test_can_update_pegawai(): void
    {
        $pegawai = Pegawai::create([
            'no_urut' => 1,
            'nip' => '197508161993111001',
            'nama' => 'NAMA ASLI',
            'status_pegawai' => 'Aktif',
        ]);

        $updatePayload = [
            'no_urut' => 1, // tetap sama
            'nip' => '197508161993111001', // tetap sama
            'nama' => 'NAMA DIPERBARUI',
            'status_pegawai' => 'Cuti',
            'pangkat_gol_ruang' => 'IV/a',
        ];

        $response = $this->actingAs($this->superUser)
            ->put(route('kepegawaian.duk.update', $pegawai->id), $updatePayload);

        $response->assertRedirect(route('kepegawaian.duk.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('pegawais', [
            'id' => $pegawai->id,
            'nama' => 'NAMA DIPERBARUI',
            'status_pegawai' => 'Cuti',
            'pangkat_gol_ruang' => 'IV/a',
        ]);
    }

    /**
     * Skenario 9: Hapus data pegawai.
     */
    public function test_can_delete_pegawai(): void
    {
        $pegawai = Pegawai::create([
            'no_urut' => 99,
            'nip' => '199999999999999999',
            'nama' => 'PEGAWAI DIHAPUS',
            'status_pegawai' => 'Pensiun',
        ]);

        // Non-authorized tidak boleh menghapus
        $this->actingAs($this->regularUser)
            ->delete(route('kepegawaian.duk.destroy', $pegawai->id))
            ->assertStatus(403);

        $this->assertDatabaseHas('pegawais', ['id' => $pegawai->id]);

        // Sekretariat boleh menghapus
        $response = $this->actingAs($this->sekretariatUser)
            ->delete(route('kepegawaian.duk.destroy', $pegawai->id));

        $response->assertRedirect(route('kepegawaian.duk.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('pegawais', ['id' => $pegawai->id]);
    }
}
