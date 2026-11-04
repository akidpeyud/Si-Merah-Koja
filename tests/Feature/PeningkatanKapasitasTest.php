<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Tests\TestCase;

class PeningkatanKapasitasTest extends TestCase
{
    protected User $pencegahanUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->prepareDatabase();

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Role::findOrCreate('Pencegahan', 'web');

        $this->pencegahanUser = User::create([
            'nama_lengkap' => 'Petugas Pencegahan',
            'email' => 'pencegahan@damkar.go.id',
            'nomor_pegawai' => '199001012015011001',
            'password' => Hash::make('password'),
        ]);
        $this->pencegahanUser->assignRole('Pencegahan');
    }

    private function prepareDatabase(): void
    {
        Schema::dropIfExists('activity_logs');
        Schema::dropIfExists('model_has_roles');
        Schema::dropIfExists('model_has_permissions');
        Schema::dropIfExists('role_has_permissions');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('permissions');
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

        $activityMigration = require base_path('database/migrations/2026_11_01_040230_create_activity_logs_table.php');
        $activityMigration->up();

        $diklatOldMigration = require base_path('database/migrations/2026_09_21_024810_create_semua_tabel_diklat.php');
        $diklatOldMigration->down();
        $diklatOldMigration->up();

        $diklatNewMigration = require base_path('database/migrations/2026_11_04_120716_ubah_kolom_tabel_diklat_sesuai_format_baru.php');
        $diklatNewMigration->up();
    }

    public function test_can_store_edit_view_export_and_delete_diklat_with_new_16_column_format(): void
    {
        Storage::fake('public');

        $sertifikat = UploadedFile::fake()->create('sertifikat_f1.pdf', 200, 'application/pdf');

        $storeResponse = $this->actingAs($this->pencegahanUser)
            ->post('/internal/pencegahan/peningkatan-kapasitas/tambah', [
                'jenis_diklat' => 'diklat-f1',
                'nama' => 'Budi Santoso',
                'nip' => '198801012015011001',
                'tempat_lahir' => 'Jambi',
                'tgl_lahir' => '1988-01-01',
                'pangkat_golongan' => 'Pengatur / II.c',
                'jabatan' => 'Pemadam Kebakaran Terampil',
                'kualifikasi' => 'Pemadam 1',
                'tempat_pelaksanaan' => 'Pusdiklat Ciracas',
                'tanggal_pelaksanaan' => '2026-05-01',
                'tanggal_selesai_pelaksanaan' => '2026-05-10',
                'jumlah_jam_pelajaran' => 70,
                'no_sttp' => 'STTP-001/2026',
                'tanggal_sttp' => '2026-05-12',
                'ditandatangani_oleh' => 'Kepala Dinas',
                'file_sertifikat' => $sertifikat,
            ]);

        $storeResponse->assertRedirect('/internal/pencegahan/peningkatan-kapasitas');

        $row = DB::table('tbl_diklat_f1')->first();
        $this->assertNotNull($row);
        $this->assertSame('Budi Santoso', $row->nama);
        $this->assertSame('198801012015011001', $row->nip);
        $this->assertSame('Pengatur / II.c', $row->pangkat_golongan);
        $this->assertSame('Pemadam 1', $row->kualifikasi);
        $this->assertSame('Pusdiklat Ciracas', $row->tempat_pelaksanaan);
        $this->assertSame('STTP-001/2026', $row->no_sttp);
        $this->assertNotNull($row->file_sertifikat);
        Storage::disk('public')->assertExists($row->file_sertifikat);

        // Halaman daftar F1 & Diksar
        $this->actingAs($this->pencegahanUser)
            ->get('/internal/pencegahan/peningkatan-kapasitas/diklat-f1')
            ->assertOk()
            ->assertSee('Budi Santoso')
            ->assertSee('Pengatur / II.c')
            ->assertSee('STTP-001/2026');

        $this->actingAs($this->pencegahanUser)
            ->get('/internal/pencegahan/peningkatan-kapasitas/diksar')
            ->assertOk();

        // Halaman detail & edit
        $this->actingAs($this->pencegahanUser)
            ->get('/internal/pencegahan/peningkatan-kapasitas/lihat/diklat-f1/'.$row->id)
            ->assertOk()
            ->assertSee('Budi Santoso');

        $this->actingAs($this->pencegahanUser)
            ->get('/internal/pencegahan/peningkatan-kapasitas/edit/diklat-f1/'.$row->id)
            ->assertOk()
            ->assertSee('Budi Santoso');

        // Export PDF & Excel
        $this->actingAs($this->pencegahanUser)
            ->get('/internal/pencegahan/peningkatan-kapasitas/cetak-pdf/diklat-f1')
            ->assertOk()
            ->assertSee('Budi Santoso');

        $this->actingAs($this->pencegahanUser)
            ->get('/internal/pencegahan/peningkatan-kapasitas/cetak-excel/diklat-f1')
            ->assertOk();

        // Update
        $this->actingAs($this->pencegahanUser)
            ->post('/internal/pencegahan/peningkatan-kapasitas/edit/diklat-f1/'.$row->id, [
                'nama' => 'Budi Santoso, S.Tr.',
                'nip' => '198801012015011001',
                'pangkat_golongan' => 'Penata Muda / III.a',
                'jabatan' => 'Danru',
                'kualifikasi' => 'Pemadam 1',
                'tempat_pelaksanaan' => 'Pusdiklat Ciracas',
                'jumlah_jam_pelajaran' => 75,
                'no_sttp' => 'STTP-001/2026',
                'ditandatangani_oleh' => 'Kepala Dinas',
            ])
            ->assertRedirect('/internal/pencegahan/peningkatan-kapasitas');

        $this->assertDatabaseHas('tbl_diklat_f1', [
            'id' => $row->id,
            'nama' => 'Budi Santoso, S.Tr.',
            'pangkat_golongan' => 'Penata Muda / III.a',
        ]);

        // Delete
        $this->actingAs($this->pencegahanUser)
            ->delete('/internal/pencegahan/peningkatan-kapasitas/hapus/diklat-f1/'.$row->id)
            ->assertRedirect();

        $this->assertDatabaseMissing('tbl_diklat_f1', ['id' => $row->id]);
        Storage::disk('public')->assertMissing($row->file_sertifikat);
    }
}
