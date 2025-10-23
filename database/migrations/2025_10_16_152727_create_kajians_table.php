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
        Schema::create('kajians', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kajian');
            $table->string('slug');
            $table->string('ringkasan_kajian');
            $table->year('tahun_kajian');
            $table->string('file_kajian');
            $table->string('kajian_link')->nullable();
            $table->foreignId('bidang_id')->constrained('bidangs');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kajians');
    }
};
