<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Barang;

class TransaksiKeluar extends Model
{
    use HasFactory;
    protected $table = 'transaksi_keluar';
    protected $fillable = ['barang_id', 'jumlah', 'harga_jual', 'tanggal', 'waktu'];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    protected static function booted()
    {
        static::creating(function ($transaksi) {
            if (empty($transaksi->waktu)) {
                $transaksi->waktu = now()->format('H:i:s');
            }
        });
        static::created(function ($transaksi) {
            $barang = $transaksi->barang;
            if ($barang && $barang->stok >= $transaksi->jumlah) {
                $barang->decrement('stok', $transaksi->jumlah);
            } else {
                // Rollback jika stok tidak cukup
                throw new \Exception('Stok barang tidak cukup!');
            }
        });
    }
}
