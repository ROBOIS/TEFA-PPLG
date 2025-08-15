<?php


namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;
use App\Models\TransaksiKeluar;

class RekapTransaksiKeluarController extends Controller
{
    public function index(Request $request)
    {
        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');
        $query = TransaksiKeluar::with('barang');
        if ($tanggal_awal && $tanggal_akhir) {
            $query->whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir]);
        }
        $transaksi = $query->orderBy('tanggal', 'desc')->get();
        $total = $transaksi->sum('harga_jual');
        return view('rekap_transaksi_keluar.index', compact('transaksi', 'tanggal_awal', 'tanggal_akhir', 'total'));
    }

    public function exportPdf(Request $request)
    {
        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');
        $query = TransaksiKeluar::with('barang');
        if ($tanggal_awal && $tanggal_akhir) {
            $query->whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir]);
        }
        $transaksi = $query->orderBy('tanggal', 'desc')->get();
        $total = $transaksi->sum('harga_jual');

    $pdf = Pdf::loadView('rekap_transaksi_keluar.pdf', compact('transaksi', 'tanggal_awal', 'tanggal_akhir', 'total'));
    return $pdf->download('rekap_transaksi_keluar.pdf');
    }
}
