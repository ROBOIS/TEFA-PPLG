<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiMasuk;
use App\Models\Barang;

class TransaksiMasukController extends Controller
{
    public function index()
    {
        $transaksi = TransaksiMasuk::with('barang')->orderBy('tanggal', 'desc')->get();
        return view('transaksi_masuk.index', compact('transaksi'));
    }

    public function create()
    {
        $barang = Barang::all();
        return view('transaksi_masuk.create', compact('barang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'jumlah' => 'required|integer|min:1',
            'harga_beli' => 'required|integer|min:0',
            'tanggal' => 'required|date',
        ]);
        $transaksi = TransaksiMasuk::create($request->all());
        // Tambah stok barang
        $barang = $transaksi->barang;
        $barang->increment('stok', $transaksi->jumlah);
        return redirect()->route('transaksi-masuk.index')->with('success', 'Transaksi masuk berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $transaksi = TransaksiMasuk::findOrFail($id);
        // Kurangi stok barang jika transaksi dihapus
        $barang = $transaksi->barang;
        $barang->decrement('stok', $transaksi->jumlah);
        $transaksi->delete();
        return redirect()->route('transaksi-masuk.index')->with('success', 'Transaksi masuk berhasil dihapus');
    }
}
