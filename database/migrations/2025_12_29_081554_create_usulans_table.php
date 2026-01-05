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
        Schema::create('usulans', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->index();
            $table->string('nama_pengusul');
            $table->date('tanggal_usulan');
            $table->text('isu_permasalahan_usulan');
            $table->text('lokasi_permasalahan');
            $table->string('kecamatan');
            $table->string('kelurahan');
            $table->text('nama_usulan');
            $table->string('urusan_pd');
            $table->string('keterangan_usulan')->nullable();
            $table->string('status_usulan')->default('verifikasi'); // 'Verifikasi', 'Dikembalikan', 'Diterima'
            $table->text('alasan_kembali')->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usulans');
    }
};
