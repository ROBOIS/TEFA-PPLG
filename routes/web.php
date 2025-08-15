
<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RekapTransaksiKeluarController;
use App\Http\Controllers\TransaksiMasukController;
use App\Http\Controllers\TransaksiKeluarController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\AuthController;

Route::get('rekap-transaksi-keluar/pdf', [RekapTransaksiKeluarController::class, 'exportPdf'])->name('rekap-penjualan.pdf')->middleware('auth');

Route::resource('transaksi-masuk', TransaksiMasukController::class)->except(['show', 'edit', 'update'])->middleware('auth');
Route::resource('transaksi-keluar', TransaksiKeluarController::class)->except(['show', 'edit', 'update'])->middleware('auth');
Route::resource('barang', BarangController::class)->middleware('auth');
Route::get('rekap-transaksi-keluar', [RekapTransaksiKeluarController::class, 'index'])->name('rekap-penjualan.index')->middleware('auth');

Route::middleware(['auth'])->group(function () {
	Route::get('/dashboard', function () {
		$totalBarang = \App\Models\Barang::count();
		$totalMasuk = \App\Models\TransaksiMasuk::count();
		$totalKeluar = \App\Models\TransaksiKeluar::count();
		$totalNilaiKeluar = \App\Models\TransaksiKeluar::sum('harga_jual');
		return view('dashboard', compact('totalBarang', 'totalMasuk', 'totalKeluar', 'totalNilaiKeluar'));
	})->name('dashboard');
});

Route::get('/', [AuthController::class, 'showLoginForm']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
