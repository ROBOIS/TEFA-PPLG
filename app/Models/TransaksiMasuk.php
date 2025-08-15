<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiMasuk extends Model
{
    use HasFactory;
    protected $table = 'transaksi_masuk';
    protected $fillable = ['barang_id', 'jumlah', 'harga_beli', 'tanggal'];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
