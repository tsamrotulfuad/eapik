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
        Schema::create('inovasi_perangkat_daerahs', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique()->index();
            $table->string('nama_inovasi');
            $table->string('registrasi_iga');
            $table->string('tahapan_inovasi');
            $table->string('inisiator_inovasi');
            $table->string('nama_inisiator');
            $table->string('jenis_inovasi');
            $table->string('klasifikasi_inovasi');
            $table->string('bentuk_inovasi');
            $table->string('astacita_inovasi');
            $table->string('urusan_inovasi');
            $table->string('koordinat_inovasi');
            $table->date('waktu_ujicoba_inovasi');
            $table->date('waktu_implementasi_inovasi');
            $table->date('waktu_pengembangan_inovasi')->nullable();
            $table->text('rancang_bangun_inovasi');
            $table->text('tujuan_inovasi');
            $table->text('manfaat_inovasi');
            $table->text('hasil_inovasi');
            $table->string('anggaran_inovasi')->nullable();
            $table->string('profilbisnis_inovasi')->nullable();
            $table->string('hki_inovasi')->nullable();
            $table->string('penghargaan_inovasi')->nullable();
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
        Schema::dropIfExists('inovasi_perangkat_daerahs');
    }
};
