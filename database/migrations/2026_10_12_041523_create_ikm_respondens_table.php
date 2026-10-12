<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ikm_responses', function (Blueprint $t) {
            $t->id();

            // Identitas responden
            $t->date('tanggal_layanan')->index();
            $t->string('pendidikan', 30);
            $t->unsignedTinyInteger('usia');
            $t->string('pekerjaan', 40);
            $t->boolean('disabilitas')->default(false);

            // 9 unsur pelayanan (11 pernyataan), nilai 1-4
            foreach (['u1_a', 'u1_b', 'u2_a', 'u2_b', 'u3', 'u4', 'u5', 'u6', 'u7', 'u8', 'u9'] as $k) {
                $t->unsignedTinyInteger($k);
            }

            // 5 aspek integritas, nilai 1-4
            foreach (['diskriminasi', 'kecurangan', 'gratifikasi', 'pungli', 'percaloan'] as $k) {
                $t->unsignedTinyInteger($k);
            }

            // Penutup
            $t->text('kritik_saran');
            $t->unsignedTinyInteger('kepercayaan_pusat');   // 1-10
            $t->unsignedTinyInteger('kepercayaan_daerah');  // 1-10

            $t->string('ip_address', 45)->nullable();
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ikm_responses');
    }
};