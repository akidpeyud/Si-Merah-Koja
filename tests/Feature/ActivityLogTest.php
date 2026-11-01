<?php

namespace Tests\Feature;

use App\Http\Middleware\LogInternalActivity;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Tests\TestCase;

class ActivityLogTest extends TestCase
{
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->prepareDatabase();

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Role::findOrCreate('Sekretariat', 'web');

        $this->user = User::create([
            'nama_lengkap' => 'Petugas Internal',
            'email' => 'petugas_'.uniqid().'@damkar.go.id',
            'nomor_pegawai' => 'PEG'.rand(10000, 99999),
            'password' => Hash::make('password123'),
        ]);
        $this->user->assignRole('Sekretariat');
    }

    private function prepareDatabase(): void
    {
        Schema::dropIfExists('activity_logs');
        Schema::dropIfExists('model_has_roles');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('users');

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

        Schema::create('roles', function (Blueprint $table) {
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
     * Tamu / belum login tidak bisa membuka halaman riwayat aktivitas
     */
    public function test_guest_cannot_access_riwayat_aktivitas(): void
    {
        $response = $this->get('/internal/riwayat-aktivitas');
        $response->assertRedirect('/login');
    }

    /**
     * User internal yang telah login dapat mengakses halaman riwayat aktivitas
     */
    public function test_authenticated_internal_user_can_access_riwayat_aktivitas(): void
    {
        $response = $this->actingAs($this->user)->get('/internal/riwayat-aktivitas');

        $response->assertStatus(200);
        $response->assertSee('Riwayat Aktivitas');
    }

    /**
     * ActivityLog record helper mencatat aktivitas dengan tepat
     */
    public function test_activity_log_record_helper_creates_entry(): void
    {
        $log = ActivityLog::record(
            action: 'Tambah',
            module: 'Kelola Berita',
            description: 'Menambahkan berita simulasi kebakaran',
            properties: ['judul' => 'Simulasi Kebakaran di Gedung'],
            user: $this->user
        );

        $this->assertDatabaseHas('activity_logs', [
            'id' => $log->id,
            'action' => 'Tambah',
            'module' => 'Kelola Berita',
            'user_name' => 'Petugas Internal',
        ]);

        $response = $this->actingAs($this->user)->get('/internal/riwayat-aktivitas');
        $response->assertStatus(200);
        $response->assertSee('Menambahkan berita simulasi kebakaran');
    }

    /**
     * Request POST di rute internal yang berhasil akan otomatis tercatat ke activity_logs oleh middleware
     */
    public function test_internal_crud_request_is_automatically_logged_by_middleware(): void
    {
        $middleware = new LogInternalActivity;
        $request = Request::create('/internal/operator/pengumuman/store', 'POST', [
            'judul' => 'Pengumuman Latihan Gabungan Damkar',
        ]);

        $this->actingAs($this->user);

        $response = $middleware->handle($request, function () {
            return new Response('ok', 200);
        });

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertDatabaseHas('activity_logs', [
            'action' => 'Tambah',
            'module' => 'Pengumuman',
            'user_name' => 'Petugas Internal',
        ]);
    }
}
