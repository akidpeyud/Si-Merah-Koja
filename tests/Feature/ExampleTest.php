<?php

namespace Tests\Feature;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Schema::dropIfExists('berita');
        Schema::dropIfExists('kejadian_damkar');
        Schema::dropIfExists('infografis');
        Schema::dropIfExists('berita_medsos');
        Schema::dropIfExists('edu_damkar');
        Schema::dropIfExists('ujung_damkar');
        Schema::dropIfExists('hero_backgrounds');

        Schema::create('kejadian_damkar', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal')->nullable();
            $table->timestamps();
        });

        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('infografis', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('berita_medsos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('edu_damkar', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('ujung_damkar', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('hero_backgrounds', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->nullable();
            $table->string('path_gambar')->nullable();
            $table->integer('urutan')->default(1);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
