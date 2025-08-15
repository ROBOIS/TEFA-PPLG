@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Tambah Barang</h2>
    <form action="{{ route('barang.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" class="form-control" id="stok" name="stok" min="0" required>
        </div>
        <div class="mb-3">
            <label for="harga_beli" class="form-label">Harga Beli</label>
            <input type="number" class="form-control" id="harga_beli" name="harga_beli" min="0" required>
        </div>
        <div class="mb-3">
            <label for="harga_jual" class="form-label">Harga Jual</label>
            <input type="number" class="form-control" id="harga_jual" name="harga_jual" min="0" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('barang.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
