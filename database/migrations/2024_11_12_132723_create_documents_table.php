<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    public function up()
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->id(); // ID Dokumentasi
            $table->unsignedBigInteger('technician_id'); // ID Teknisi
            $table->unsignedBigInteger('schedule_id'); // ID Jadwal
            $table->dateTime('repair_schedule'); // Jadwal Perbaikan
            $table->string('image_path'); // Gambar Dokumentasi
            $table->text('report')->nullable(); // Laporan Perbaikan
            $table->timestamps(); // created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
