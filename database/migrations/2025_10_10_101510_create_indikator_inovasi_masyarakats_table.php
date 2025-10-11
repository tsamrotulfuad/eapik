<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('indikator_inovasi_masyarakats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inovasi_id')->constrained('inovasi_masyarakats')->cascadeOnDelete();
            $table->string('kemudahan_proses');
            $table->string('keterlibatan_aktor');
            $table->string('kemanfaatan');
            $table->string('kemanfaatan_upload');
            $table->string('sosialisasi');
            $table->string('sosialisasi_upload');
            $table->string('video_inovasi');
            $table->smallInteger('kematangan')->nullable();
            $table->year('tahun');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indikator_inovasi_masyarakats');
    }
};
