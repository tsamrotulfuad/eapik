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
        Schema::table('inovasi_perangkat_daerahs', function (Blueprint $table) {
            $table->boolean('is_kirim')->default(false)->after('tahun');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inovasi_perangkat_daerahs', function (Blueprint $table) {
            $table->dropColumn('is_kirim');
        });
    }
};
