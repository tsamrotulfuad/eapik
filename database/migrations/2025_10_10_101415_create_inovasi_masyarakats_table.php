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
        Schema::create('inovasi_masyarakats', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique()->index();
            $table->string('nama_inovasi');
            $table->string('nama_inisiator');
            $table->string('ktp_inisiator');
            $table->string('hp_inisiator');
            $table->string('tahapan_inovasi');
            $table->string('jenis_inovasi');
            $table->string('bentuk_inovasi');
            $table->string('koordinat_inovasi');
            $table->date('waktu_ujicoba_inovasi');
            $table->date('waktu_implementasi_inovasi');
            $table->text('rancang_bangun_inovasi');
            $table->text('tujuan_inovasi');
            $table->text('manfaat_inovasi');
            $table->text('hasil_inovasi');
            $table->string('hki_inovasi')->nullable();
            $table->string('penghargaan_inovasi')->nullable();
            $table->string('skt')->nullable();
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
        Schema::dropIfExists('inovasi_masyarakats');
    }
};
