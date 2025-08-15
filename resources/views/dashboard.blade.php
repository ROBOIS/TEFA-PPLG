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
    #toggleSidebar {
        position: fixed;
        top: 18px;
        left: 18px;
        z-index: 1100;
        width: 48px;
        height: 48px;
        border-radius: 50%;
        font-size: 1.5rem;
        box-shadow: none;
        display: flex;
        align-items: center;
        justify-content: center;
        background: transparent;
        border: none;
        color: #0d6efd;
        transition: background 0.2s, color 0.2s;
        opacity: 0.5;
    }
    #toggleSidebar:hover {
        background: rgba(13,110,253,0.1);
        color: #0d6efd;
        opacity: 1;
    }
    /* Tombol toggle selalu tampil */
</style>
<button id="toggleSidebar" class="mb-3" aria-label="Toggle Sidebar">☰</button>
<div class="d-flex" style="position:relative;">
    <nav id="sidebar" class="sidebar bg-primary text-white p-3 sidebar-visible">
        <h4 class="mb-4">Dashboard</h4>
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
                <a class="nav-link text-white" href="{{ route('transaksi-keluar.index') }}">Penjualan</a>
            </li>
            <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="{{ route('rekap-penjualan.index') }}">Rekap Penjualan</a>
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
        <h2>Selamat Datang di Dashboard</h2>
        <div class="row mb-4">
            <div class="col-md-3 mb-2">
                <div class="card text-bg-light h-100">
                    <div class="card-body">
                        <h5 class="card-title">Total Barang</h5>
                        <p class="card-text fs-4">{{ $totalBarang ?? '-' }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-2">
                <div class="card text-bg-light h-100">
                    <div class="card-body">
                        <h5 class="card-title">Transaksi Masuk</h5>
                        <p class="card-text fs-4">{{ $totalMasuk ?? '-' }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-2">
                <div class="card text-bg-light h-100">
                    <div class="card-body">
                        <h5 class="card-title">Penjualan</h5>
                        <p class="card-text fs-4">{{ $totalKeluar ?? '-' }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-2">
                <div class="card text-bg-light h-100">
                    <div class="card-body">
                        <h5 class="card-title">Total Nilai Penjualan</h5>
                        <p class="card-text fs-4">Rp{{ number_format($totalNilaiKeluar ?? 0,0,',','.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('toggleSidebar');
    let sidebarVisible = true;
    function setSidebarVisibility(visible) {
        sidebarVisible = visible;
        if (visible) {
            sidebar.classList.remove('sidebar-hidden');
            sidebar.classList.add('sidebar-visible');
        } else {
            sidebar.classList.remove('sidebar-visible');
            sidebar.classList.add('sidebar-hidden');
        }
    }
    toggleBtn.addEventListener('click', function() {
        setSidebarVisibility(!sidebarVisible);
    });
    // Responsive: hide sidebar by default on small screens
    function handleResize() {
        if (window.innerWidth < 768) {
            setSidebarVisibility(false);
        } else {
            setSidebarVisibility(true);
        }
    }
    window.addEventListener('resize', handleResize);
    handleResize();
</script>
@endsection
