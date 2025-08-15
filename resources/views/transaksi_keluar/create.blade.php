@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Tambah Transaksi Keluar</h2>
    <form action="{{ route('transaksi-keluar.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="barang_id" class="form-label">Nama Barang</label>
            <select name="barang_id" id="barang_id" class="form-control" required>
                <option value="">-- Pilih Barang --</option>
                @foreach($barang as $b)
                    <option value="{{ $b->id }}" data-harga="{{ $b->harga_jual }}">{{ $b->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" min="1" value="1" required>
        </div>
        <div class="mb-3">
            <label for="harga_jual" class="form-label">Harga Jual</label>
            <input type="number" class="form-control" id="harga_jual" name="harga_jual" min="0" readonly required>
            <small class="text-muted" id="harga_satuan_info"></small>
        </div>
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('transaksi-keluar.index') }}" class="btn btn-secondary">Kembali</a>
        <script>
        const barangSelect = document.getElementById('barang_id');
        const jumlahInput = document.getElementById('jumlah');
        const hargaJualInput = document.getElementById('harga_jual');
        const hargaSatuanInfo = document.getElementById('harga_satuan_info');
        function updateHargaJual() {
            const selected = barangSelect.options[barangSelect.selectedIndex];
            const hargaSatuan = parseInt(selected.getAttribute('data-harga')) || 0;
            const jumlah = parseInt(jumlahInput.value) || 1;
            hargaJualInput.value = hargaSatuan * jumlah;
            hargaSatuanInfo.innerText = hargaSatuan ? `Harga satuan: Rp${hargaSatuan.toLocaleString('id-ID')}` : '';
        }
        barangSelect.addEventListener('change', updateHargaJual);
        jumlahInput.addEventListener('input', updateHargaJual);
        document.addEventListener('DOMContentLoaded', updateHargaJual);
        </script>
    </form>
</div>
@endsection
