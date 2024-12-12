<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('dokumentasi_pesawat', function (Blueprint $table) {
            // Ensure the existing column is dropped if it exists
            if (Schema::hasColumn('dokumentasi_pesawat', 'lokasi_perbaikan')) {
                $table->dropColumn('lokasi_perbaikan');
            }

            // Add the new foreign key column
            $table->unsignedBigInteger('lokasi_perbaikan_id')->after('waktu_perbaikan');

            // Add the foreign key constraint
            $table->foreign('lokasi_perbaikan_id')->references('id')->on('lokasi_perbaikan')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('dokumentasi_pesawat', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['lokasi_perbaikan_id']);

            // Drop the foreign key column
            $table->dropColumn('lokasi_perbaikan_id');

            // Optionally, add back the original column if needed
            $table->string('lokasi_perbaikan')->after('waktu_perbaikan');
        });
    }
};