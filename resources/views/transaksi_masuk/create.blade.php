@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Tambah Transaksi Masuk</h2>
    <form action="{{ route('transaksi-masuk.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="barang_id" class="form-label">Nama Barang</label>
            <select name="barang_id" id="barang_id" class="form-control" required>
                <option value="">-- Pilih Barang --</option>
                @foreach($barang as $b)
                    <option value="{{ $b->id }}">{{ $b->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" min="1" required>
        </div>
        <div class="mb-3">
            <label for="harga_beli" class="form-label">Harga Beli</label>
            <input type="number" class="form-control" id="harga_beli" name="harga_beli" min="0" required>
        </div>
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('transaksi-masuk.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
