            <li class="nav-item mb-2">
                <a class="nav-link text-white" href="{{ route('rekap-penjualan.index') }}">Rekap Penjualan</a>
            </li>
@extends('layouts.app')

@section('content')
<style>
    .sidebar {
        min-width: 220px;
        min-height: 100vh;
        transition: transform 0.35s cubic-bezier(.4,2,.6,1), box-shadow 0.3s;
        will-change: transform;
        z-index: 1000;
        position: relative;
    }
    .sidebar-hidden {
        transform: translateX(-100%);
        box-shadow: none;
    }
    .sidebar-visible {
        transform: translateX(0);
        box-shadow: 2px 0 8px rgba(0,0,0,0.05);
    }
</style>
<div class="d-flex" style="position:relative;">
    <nav id="sidebar" class="sidebar bg-primary text-white p-3 sidebar-visible">
        <h4 class="mb-4">Menu</h4>
        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a class="nav-link text-white" href="/dashboard">Home</a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link text-white" href="{{ route('barang.index') }}">Barang</a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link text-white" href="{{ route('transaksi-masuk.index') }}">Transaksi Masuk</a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link text-white" href="{{ route('transaksi-keluar.index') }}">Transaksi Keluar</a>
            </li>
            <li class="nav-item mb-2">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="nav-link text-white bg-transparent border-0 p-0" style="cursor:pointer;">Logout</button>
                </form>
            </li>
        </ul>
    </nav>
    <main class="flex-fill p-4">
        <h2 class="mb-4">Transaksi Keluar</h2>
        <a href="{{ route('transaksi-keluar.create') }}" class="btn btn-primary mb-3">Tambah Transaksi Keluar</a>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Harga Jual</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksi as $t)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $t->barang->nama }}</td>
                    <td>{{ $t->jumlah }}</td>
                    <td>Rp{{ number_format($t->harga_jual,0,',','.') }}</td>
                    <td>{{ $t->tanggal }}</td>
                    <td>{{ $t->waktu }}</td>
                    <td>
                        <form action="{{ route('transaksi-keluar.destroy', $t->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</div>
@endsection
