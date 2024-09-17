<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('dokumentasi_pesawat', function (Blueprint $table) {
            $table->id('id_dokumentasi');
            $table->unsignedBigInteger('id_teknisi');
            $table->unsignedBigInteger('id_jadwal');
            $table->date('jadwal_perbaikan');
            $table->string('gambar_dokumentasi');
            $table->text('laporan');
            $table->timestamps();

            $table->foreign('id_teknisi')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_jadwal')->references('id_jadwal_pemeliharaan')->on('jadwal_pemeliharaan_pesawat')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('dokumentasi_pesawat');
    }
};

