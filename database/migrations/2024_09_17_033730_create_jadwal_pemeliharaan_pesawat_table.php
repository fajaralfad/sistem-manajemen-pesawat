<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('jadwal_pemeliharaan_pesawat', function (Blueprint $table) {
            $table->id('id_jadwal_pemeliharaan');
            $table->unsignedBigInteger('id_pesawat');
            $table->date('jadwal_pemeliharaan');
            $table->text('deskripsi');
            $table->enum('status', ['scheduled', 'in_progress', 'completed', 'cancelled']);
            $table->timestamps();

            $table->foreign('id_pesawat')->references('id_pesawat')->on('pesawat')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('jadwal_pemeliharaan_pesawat');
    }
};
