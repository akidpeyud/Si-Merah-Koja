<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Tests\TestCase;

class KelolaPemohonTest extends TestCase
{
    protected User $superUser;

    protected User $operatorUser;

    protected User $otherUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->prepareDatabase();

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Role::findOrCreate('Super User', 'web');
        Role::findOrCreate('Operator', 'web');
        Role::findOrCreate('Sekretariat', 'web');

        $this->superUser = User::create([
            'nama_lengkap' => 'Admin Super',
            'email' => 'super@damkar.go.id',
            'nomor_pegawai' => '11111111',
            'password' => Hash::make('password'),
        ]);
        $this->superUser->assignRole('Super User');

        $this->operatorUser = User::create([
            'nama_lengkap' => 'Operator User',
            'email' => 'operator@damkar.go.id',
            'nomor_pegawai' => '22222222',
            'password' => Hash::make('password'),
        ]);
        $this->operatorUser->assignRole('Operator');

        $this->otherUser = User::create([
            'nama_lengkap' => 'Staf Lain',
            'email' => 'staf@damkar.go.id',
            'nomor_pegawai' => '33333333',
            'password' => Hash::make('password'),
        ]);
        $this->otherUser->assignRole('Sekretariat');
    }

    private function prepareDatabase(): void
    {
        Schema::dropIfExists('model_has_roles');
        Schema::dropIfExists('model_has_permissions');
        Schema::dropIfExists('role_has_permissions');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('users');
        Schema::dropIfExists('pemohons');

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('email')->unique();
            $table->string('nomor_pegawai')->unique();
            $table->string('role')->default('pegawai');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('pemohons', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 16)->unique();
            $table->string('nama_lengkap');
            $table->string('email')->unique();
            $table->string('no_whatsapp');
            $table->string('password');
            $table->string('role')->default('pemohon');
            $table->timestamps();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('guard_name');
            $table->timestamps();
        });

        Schema::create('permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('guard_name');
            $table->timestamps();
        });

        Schema::create('model_has_roles', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id');
            $table->string('model_type');
            $table->unsignedBigInteger('model_id');
            $table->index(['model_id', 'model_type']);
        });

        Schema::create('model_has_permissions', function (Blueprint $table) {
            $table->unsignedBigInteger('permission_id');
            $table->string('model_type');
            $table->unsignedBigInteger('model_id');
            $table->index(['model_id', 'model_type']);
        });

        Schema::create('role_has_permissions', function (Blueprint $table) {
            $table->unsignedBigInteger('permission_id');
            $table->unsignedBigInteger('role_id');
        });
    }

    public function test_super_user_can_access_kelola_pemohon(): void
    {
        $response = $this->actingAs($this->superUser)->get('/internal/kelola-pemohon');

        $response->assertStatus(200);
    }

    public function test_operator_user_can_access_kelola_pemohon(): void
    {
        $response = $this->actingAs($this->operatorUser)->get('/internal/kelola-pemohon');

        $response->assertStatus(200);
    }

    public function test_unauthorized_role_is_denied(): void
    {
        $response = $this->actingAs($this->otherUser)->get('/internal/kelola-pemohon');

        $response->assertRedirect('/internal/index');
        $response->assertSessionHas('error');
    }

    public function test_operator_can_store_pemohon(): void
    {
        $response = $this->actingAs($this->operatorUser)->post('/internal/kelola-pemohon/tambah', [
            'nik' => '1571012345670002',
            'nama_lengkap' => 'Pemohon Baru',
            'email' => 'baru@pemohon.com',
            'no_whatsapp' => '081234567891',
            'password' => 'password123',
            'role' => 'pemohon',
        ]);

        $response->assertSessionDoesntHaveErrors();
        $this->assertDatabaseHas('pemohons', ['nik' => '1571012345670002']);
    }

    public function test_operator_can_update_pemohon(): void
    {
        $id = DB::table('pemohons')->insertGetId([
            'nik' => '1571012345670003',
            'nama_lengkap' => 'Pemohon Edit',
            'email' => 'edit@pemohon.com',
            'no_whatsapp' => '081234567892',
            'password' => Hash::make('password123'),
            'role' => 'pemohon',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->actingAs($this->operatorUser)->put('/internal/kelola-pemohon/update/'.$id, [
            'nik' => '1571012345670003',
            'nama_lengkap' => 'Pemohon Edit Berhasil',
            'email' => 'edit@pemohon.com',
            'no_whatsapp' => '081234567892',
            'role' => 'pemohon',
        ]);

        $response->assertSessionDoesntHaveErrors();
        $this->assertDatabaseHas('pemohons', ['nama_lengkap' => 'Pemohon Edit Berhasil']);
    }

    public function test_operator_can_destroy_pemohon(): void
    {
        $id = DB::table('pemohons')->insertGetId([
            'nik' => '1571012345670004',
            'nama_lengkap' => 'Pemohon Hapus',
            'email' => 'hapus@pemohon.com',
            'no_whatsapp' => '081234567893',
            'password' => Hash::make('password123'),
            'role' => 'pemohon',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->actingAs($this->operatorUser)->delete('/internal/kelola-pemohon/hapus/'.$id);

        $response->assertSessionDoesntHaveErrors();
        $this->assertDatabaseMissing('pemohons', ['id' => $id]);
    }
}
