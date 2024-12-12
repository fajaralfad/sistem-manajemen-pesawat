<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('technician_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('technician_id');
            $table->unsignedBigInteger('plane_id');
            $table->string('status');
            $table->date('work_date');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('technician_id')->references('id')->on('technicians')->onDelete('cascade');
            $table->foreign('plane_id')->references('id')->on('planes')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('technician_histories');
    }
};