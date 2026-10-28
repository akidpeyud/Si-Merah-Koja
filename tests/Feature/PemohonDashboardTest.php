<?php

namespace Tests\Feature;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class PemohonDashboardTest extends TestCase
{
    protected int $pemohonId;

    protected function setUp(): void
    {
        parent::setUp();

        $this->prepareDatabase();

        // Buat data akun pemohon uji coba
        $this->pemohonId = DB::table('pemohons')->insertGetId([
            'nik' => '1571012345670001',
            'nama_lengkap' => 'Budi Santoso',
            'email' => 'budi.santoso@example.com',
            'no_whatsapp' => '081234567890',
            'password' => Hash::make('password123'),
            'role' => 'pemohon',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    private function prepareDatabase(): void
    {
        Schema::dropIfExists('pemohons');
        Schema::dropIfExists('permohonan_skk');
        Schema::dropIfExists('permohonan_perpanjang_skk');
        Schema::dropIfExists('permohonan_rpkbgl');
        Schema::dropIfExists('izin_keramaian');
        Schema::dropIfExists('penggunaan_sarana');
        Schema::dropIfExists('permohonan_edukasi');

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

        Schema::create('permohonan_skk', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemohon')->nullable();
            $table->string('email_pemohon')->nullable();
            $table->string('no_whatsapp')->nullable();
            $table->string('nama_usaha')->nullable();
            $table->string('nik_pemilik_usaha')->nullable();
            $table->text('alamat_pemilik_usaha')->nullable();
            $table->string('kategori_bangunan')->nullable();
            $table->text('alamat_bangunan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kelurahan')->nullable();
            $table->decimal('luas_lahan', 10, 2)->nullable();
            $table->decimal('luas_bangunan', 10, 2)->nullable();
            $table->decimal('tinggi_bangunan', 8, 2)->nullable();
            $table->string('file_surat_permohonan')->nullable();
            $table->string('file_persyaratan_lainnya')->nullable();
            $table->string('status_permohonan')->default('Pending');
            $table->timestamps();
        });

        Schema::create('permohonan_perpanjang_skk', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemohon')->nullable();
            $table->string('email_pemohon')->nullable();
            $table->string('no_whatsapp')->nullable();
            $table->string('nama_usaha')->nullable();
            $table->string('nik_pemilik_usaha')->nullable();
            $table->text('alamat_pemilik_usaha')->nullable();
            $table->string('kategori_bangunan')->nullable();
            $table->text('alamat_bangunan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kelurahan')->nullable();
            $table->decimal('luas_lahan', 10, 2)->nullable();
            $table->decimal('luas_bangunan', 10, 2)->nullable();
            $table->decimal('tinggi_bangunan', 8, 2)->nullable();
            $table->string('file_surat_permohonan')->nullable();
            $table->string('file_persyaratan_lainnya')->nullable();
            $table->string('status_permohonan')->default('Pending');
            $table->string('nomor_skk_lama')->nullable();
            $table->date('tanggal_terbit_skk_lama')->nullable();
            $table->date('masa_berlaku_skk_lama')->nullable();
            $table->string('file_skk_lama')->nullable();
            $table->timestamps();
        });

        Schema::create('permohonan_rpkbgl', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemohon')->nullable();
            $table->string('email_pemohon')->nullable();
            $table->string('no_whatsapp')->nullable();
            $table->string('nama_usaha')->nullable();
            $table->string('nik_pemilik_usaha')->nullable();
            $table->text('alamat_pemilik_usaha')->nullable();
            $table->string('kategori_bangunan')->nullable();
            $table->text('alamat_bangunan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kelurahan')->nullable();
            $table->decimal('luas_lahan', 10, 2)->nullable();
            $table->decimal('luas_bangunan', 10, 2)->nullable();
            $table->decimal('tinggi_bangunan', 8, 2)->nullable();
            $table->string('ada_lift')->nullable();
            $table->date('tgl_pemeriksaan')->nullable();
            $table->string('file_surat_permohonan')->nullable();
            $table->string('file_fotokopi_ktp')->nullable();
            $table->string('file_nib')->nullable();
            $table->string('file_pbg_imb')->nullable();
            $table->string('file_slo_listrik')->nullable();
            $table->string('file_slf_bangunan')->nullable();
            $table->string('file_denah_bangunan')->nullable();
            $table->string('file_pjk3')->nullable();
            $table->text('file_data_teknis_proteksi')->nullable();
            $table->text('file_persyaratan_lainnya')->nullable();
            $table->string('status_permohonan')->default('Pending');
            $table->timestamps();
        });

        Schema::create('izin_keramaian', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->string('nik', 16)->nullable();
            $table->string('no_hp')->nullable();
            $table->text('alamat')->nullable();
            $table->string('nama_direktur')->nullable();
            $table->string('nama_usaha')->nullable();
            $table->string('no_izin_usaha')->nullable();
            $table->string('nama_acara')->nullable();
            $table->string('jenis_event')->nullable();
            $table->string('lokasi_acara')->nullable();
            $table->date('tgl_pelaksanaan')->nullable();
            $table->time('waktu_mulai')->nullable();
            $table->time('waktu_selesai')->nullable();
            $table->integer('jumlah_penonton')->nullable();
            $table->integer('jumlah_apar')->nullable();
            $table->integer('jumlah_staff')->nullable();
            $table->string('surat_permohonan')->nullable();
            $table->string('fotokopi_ktp')->nullable();
            $table->string('foto_jalur_evakuasi')->nullable();
            $table->string('bukti_pajak_bpprd')->nullable();
            $table->string('surat_pernyataan')->nullable();
            $table->string('status_permohonan')->default('Pending');
            $table->timestamps();
        });

        Schema::create('penggunaan_sarana', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemohon_id')->nullable();
            $table->string('nama')->nullable();
            $table->string('nik', 16)->nullable();
            $table->string('no_hp')->nullable();
            $table->string('alamat')->nullable();
            $table->string('jenis_pemohon')->nullable();
            $table->string('nama_penanggung_jawab')->nullable();
            $table->string('nama_instansi')->nullable();
            $table->string('alamat_instansi')->nullable();
            $table->string('sarana')->nullable();
            $table->text('kegunaan')->nullable();
            $table->string('nama_kegiatan')->nullable();
            $table->string('lokasi_kegiatan')->nullable();
            $table->date('tgl_pelaksanaan')->nullable();
            $table->time('waktu_mulai')->nullable();
            $table->time('waktu_selesai')->nullable();
            $table->string('surat_permohonan')->nullable();
            $table->string('fotokopi_ktp')->nullable();
            $table->string('sket_denah_lokasi')->nullable();
            $table->string('status')->default('Menunggu');
            $table->timestamps();
        });

        Schema::create('permohonan_edukasi', function (Blueprint $table) {
            $table->id();
            $table->string('institusi')->nullable();
            $table->text('alamat_institusi')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('nama_pemohon')->nullable();
            $table->string('jabatan_pemohon')->nullable();
            $table->string('nik', 16)->nullable();
            $table->string('no_kontak')->nullable();
            $table->date('tgl_kegiatan')->nullable();
            $table->integer('usia_3_6')->nullable();
            $table->integer('usia_7_12')->nullable();
            $table->integer('usia_13_18')->nullable();
            $table->integer('usia_18_keatas')->nullable();
            $table->string('surat_permohonan')->nullable();
            $table->text('syarat_lainnya')->nullable();
            $table->string('status_permohonan')->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Tamu tanpa session login tidak boleh mengakses dashboard pemohon.
     */
    public function test_guest_cannot_access_dashboard(): void
    {
        $response = $this->get(route('pemohon.dashboard'));

        $response->assertRedirect(route('pemohon.login'));
    }

    /**
     * Pemohon yang login dapat mengakses dashboard monitoring dan melihat datanya.
     */
    public function test_authenticated_pemohon_can_access_dashboard_and_see_applications(): void
    {
        // Masukkan data permohonan SKK milik pemohon
        DB::table('permohonan_skk')->insert([
            'nama_pemohon' => 'Budi Santoso',
            'nik_pemilik_usaha' => '1571012345670001',
            'no_whatsapp' => '081234567890',
            'nama_usaha' => 'Hotel Grand Jambi',
            'kategori_bangunan' => 'Hotel',
            'status_permohonan' => 'Pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->withSession([
            'pemohon_id' => $this->pemohonId,
            'pemohon_nama' => 'Budi Santoso',
            'pemohon_email' => 'budi.santoso@example.com',
            'pemohon_role' => 'pemohon',
        ])->get(route('pemohon.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Budi Santoso');
        $response->assertSee('Hotel Grand Jambi');
        $response->assertSee('SKK Baru');
        $response->assertSee('Total Berkas Diajukan');
    }

    /**
     * Pemohon dapat memperbarui informasi profil akun.
     */
    public function test_pemohon_can_update_profile(): void
    {
        $response = $this->withSession([
            'pemohon_id' => $this->pemohonId,
            'pemohon_nama' => 'Budi Santoso',
            'pemohon_email' => 'budi.santoso@example.com',
            'pemohon_role' => 'pemohon',
        ])->put(route('pemohon.profil.update'), [
            'nama_lengkap' => 'Budi Santoso M.Kom',
            'no_whatsapp' => '081299998888',
            'email' => 'budi.baru@example.com',
        ]);

        $response->assertRedirect(route('pemohon.dashboard', ['tab' => 'profil']));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('pemohons', [
            'id' => $this->pemohonId,
            'nama_lengkap' => 'Budi Santoso M.Kom',
            'no_whatsapp' => '081299998888',
            'email' => 'budi.baru@example.com',
        ]);
    }

    /**
     * Pemohon dapat mengganti kata sandi dengan kata sandi saat ini yang benar.
     */
    public function test_pemohon_can_update_password(): void
    {
        $response = $this->withSession([
            'pemohon_id' => $this->pemohonId,
            'pemohon_nama' => 'Budi Santoso',
            'pemohon_email' => 'budi.santoso@example.com',
            'pemohon_role' => 'pemohon',
        ])->put(route('pemohon.password.update'), [
            'current_password' => 'password123',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        $response->assertRedirect(route('pemohon.dashboard', ['tab' => 'profil']));
        $response->assertSessionHas('success');

        $updatedPemohon = DB::table('pemohons')->where('id', $this->pemohonId)->first();
        $this->assertTrue(Hash::check('newpassword123', $updatedPemohon->password));
    }

    /**
     * Penggantian kata sandi gagal jika kata sandi lama salah.
     */
    public function test_update_password_fails_if_current_password_wrong(): void
    {
        $response = $this->withSession([
            'pemohon_id' => $this->pemohonId,
            'pemohon_nama' => 'Budi Santoso',
            'pemohon_email' => 'budi.santoso@example.com',
            'pemohon_role' => 'pemohon',
        ])->put(route('pemohon.password.update'), [
            'current_password' => 'wrongpassword',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        $response->assertRedirect(route('pemohon.dashboard', ['tab' => 'profil']));
        $response->assertSessionHasErrors(['current_password']);
    }
}
