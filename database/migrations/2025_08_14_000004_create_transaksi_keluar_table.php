<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi_keluar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_id')->constrained('barang')->onDelete('cascade');
            $table->integer('jumlah');
            $table->integer('harga_jual');
            $table->date('tanggal');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('transaksi_keluar');
    }
};
