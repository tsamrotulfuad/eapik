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
        Schema::create('bantuan_individu', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bantuan_id')->constrained('bantuans')->cascadeOnDelete();
            $table->foreignId('individu_id')->constrained('individus')->cascadeOnDelete();
            $table->date('tanggal_terima')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bantuan_individu');
    }
};
