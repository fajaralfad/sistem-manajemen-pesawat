<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('dokumentasi_pesawat', function (Blueprint $table) {
            $table->time('waktu_perbaikan');// Replace 'existing_column' with the column after which you want to add the new columns
            $table->string('jenis_perbaikan')->after('waktu_perbaikan');
            $table->string('lokasi_perbaikan')->after('jenis_perbaikan');
            $table->string('status_perbaikan')->after('lokasi_perbaikan');
        });
    }

    public function down()
    {
        Schema::table('dokumentasi_pesawat', function (Blueprint $table) {
            $table->dropColumn('waktu_perbaikan');
            $table->dropColumn('jenis_perbaikan');
            $table->dropColumn('lokasi_perbaikan');
            $table->dropColumn('status_perbaikan');
        });
    }
};