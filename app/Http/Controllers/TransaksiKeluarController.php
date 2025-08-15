<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiKeluar;
use App\Models\Barang;

class TransaksiKeluarController extends Controller
{
    public function index()
    {
        $transaksi = TransaksiKeluar::with('barang')->orderBy('tanggal', 'desc')->get();
        return view('transaksi_keluar.index', compact('transaksi'));
    }

    public function create()
    {
        $barang = Barang::all();
        return view('transaksi_keluar.create', compact('barang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'jumlah' => 'required|integer|min:1',
            'harga_jual' => 'required|integer|min:0',
            'tanggal' => 'required|date',
        ]);
        try {
            TransaksiKeluar::create($request->all());
        } catch (\Exception $e) {
            return back()->withErrors(['stok' => $e->getMessage()])->withInput();
        }
        return redirect()->route('transaksi-keluar.index')->with('success', 'Transaksi keluar berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $transaksi = TransaksiKeluar::findOrFail($id);
        // Kembalikan stok barang jika transaksi dihapus
        $barang = $transaksi->barang;
        $barang->increment('stok', $transaksi->jumlah);
        $transaksi->delete();
        return redirect()->route('transaksi-keluar.index')->with('success', 'Transaksi keluar berhasil dihapus');
    }
}
