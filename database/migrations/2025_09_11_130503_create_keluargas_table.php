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
        Schema::create('keluargas', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->index();
            $table->string('no_kk')->unique(); // Nomor Kartu Keluarga
            $table->string('kepala_keluarga');
            $table->string('alamat');
            $table->timestamps();
        });

        Schema::table('individus', function (Blueprint $table) {
            $table->foreignId('keluarga_id')->after('uuid')->nullable()->constrained('keluargas')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('individus', function (Blueprint $table) {
            $table->dropConstrainedForeignId('keluarga_id');
        });

        Schema::dropIfExists('keluargas');
    }
};
