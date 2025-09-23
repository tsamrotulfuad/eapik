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
        Schema::create('inovasis', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->index();
            $table->string('no_regis_iga')->nullable();
            $table->smallInteger('kematangan_inovasi')->nullable();
            $table->string('nama_inovasi');
            $table->string('nama_inisiator');
            $table->string('inisiator_inovasi');
            $table->enum('jenis_inovasi', ['Digital', 'Non-Digital']);
            $table->string('klasifikasi_inovasi');
            $table->string('bentuk_inovasi');
            $table->string('asta_cita_inovasi');
            $table->string('urusan_inovasi');
            $table->date('waktu_ujicoba');
            $table->date('waktu_penerapan');
            $table->string('koordinat_inovasi');
            $table->text('anggaran_inovasi')->nullable();
            $table->text('profil_bisnis_inovasi')->nullable();
            $table->text('doc_haki_inovasi')->nullable();
            $table->text('penghargaan_inovasi')->nullable();
            $table->year('tahun_iga');
            $table->string('file_inovasi_iga')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inovasis');
    }
};
