<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('data_asns', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jabatan');
            $table->integer('pns')->default(0);
            $table->integer('pppk')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('data_asns');
    }
};
