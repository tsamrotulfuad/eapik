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
        Schema::create('indikator_inovasi_perangkat_daerahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inovasi_id')->constrained('inovasi_perangkat_daerahs')->cascadeOnDelete();
            $table->string('regulasi_inovasi');
            $table->string('regulasi_inovasi_upload');
            $table->string('ketersediaan_sdm');
            $table->string('ketersediaan_sdm_upload');
            $table->string('dukungan_anggaran');
            $table->string('dukungan_anggaran_upload');
            $table->string('kecepatan_penciptaan');
            $table->string('kecepatan_penciptaan_upload');
            $table->string('kemanfaatan');
            $table->string('kemanfaatan_upload');
            $table->string('sosialisasi');
            $table->string('sosialisasi_upload');
            $table->string('kemudahan_proses');
            $table->string('kemudahan_upload');
            $table->string('alat_kerja');
            $table->string('alat_kerja_upload');
            $table->string('kualitas');
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
        Schema::dropIfExists('indikator_inovasi_perangkat_daerahs');
    }
};
