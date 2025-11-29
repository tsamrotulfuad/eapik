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
        Schema::table('inovasi_masyarakats', function (Blueprint $table) {
            $table->string('ktp_file')->after('hasil_inovasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inovasi_masyarakats', function (Blueprint $table) {
            $table->dropColumn('ktp_file');
        });
    }
};
