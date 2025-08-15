<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transaksi_keluar', function (Blueprint $table) {
            if (!Schema::hasColumn('transaksi_keluar', 'waktu')) {
                $table->time('waktu')->nullable()->after('tanggal');
            }
        });
    }
    public function down(): void
    {
        Schema::table('transaksi_keluar', function (Blueprint $table) {
            if (Schema::hasColumn('transaksi_keluar', 'waktu')) {
                $table->dropColumn('waktu');
            }
        });
    }
};
