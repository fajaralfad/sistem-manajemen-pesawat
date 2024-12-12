<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('dokumentasi_pesawat', function (Blueprint $table) {
            $table->unsignedBigInteger('pesawat_id')->after('id_dokumentasi');
            $table->foreign('pesawat_id')->references('id_pesawat')->on('pesawat')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('dokumentasi_pesawat', function (Blueprint $table) {
            $table->dropForeign(['pesawat_id']);
            $table->dropColumn('pesawat_id');
        });
    }
};