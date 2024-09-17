<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pesawat', function (Blueprint $table) {
            $table->id('id_pesawat');
            $table->string('no_registrasi')->unique();
            $table->string('nama_maskapai');
            $table->string('gambar_maskapai');
            $table->string('tipe_pesawat');
            $table->string('jenis_pesawat');
            $table->integer('kapasitas_penumpang');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pesawat');
    }
};