<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MasKasir - @yield('title')</title>
    
    {{-- CSS Bootstrap 5 & FontAwesome (Internet Wajib Jalan) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body { background-color: #f4f6f9; overflow-x: hidden; }
        .sidebar {
    height: 100vh; 
    width: 250px; 
    position: fixed; 
    top: 0; 
    left: 0;
    background-color: #343a40; 
    padding-top: 20px; 
    transition: 0.3s; 
    z-index: 1000;
    
    overflow-y: auto; 
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }
        .sidebar::-webkit-scrollbar-track {
            background: #2c3136;
        }
        .sidebar::-webkit-scrollbar-thumb {
            background: #6c757d; 
            border-radius: 3px;
        }
        .sidebar::-webkit-scrollbar-thumb:hover {
            background: #adb5bd; 
        }
        .sidebar a {
            padding: 15px 25px; text-decoration: none; font-size: 16px; color: #cfd8dc; display: block;
            border-left: 4px solid transparent;
        }
        .sidebar a:hover { background-color: #495057; color: #fff; }
        .sidebar a.active { background-color: #0d6efd; color: white; border-left: 4px solid #fff; }
        .sidebar .brand {
            font-size: 24px; font-weight: bold; color: white; text-align: center; margin-bottom: 30px;
        }
        
        .content { margin-left: 250px; padding: 30px; transition: 0.3s; }
        
        .top-navbar {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 30px; border-bottom: 1px solid #ddd; padding-bottom: 15px;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="brand"><i class="fas fa-cash-register"></i> SiKasir</div>
        
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
        </a>
        
        <a href="{{ route('pemesanan.index') }}" class="{{ request()->routeIs('pemesanan.*') ? 'active' : '' }}">
            <i class="fas fa-shopping-cart me-2"></i> Transaksi Kasir
        </a>
        
        <a href="{{ route('barang.index') }}" class="{{ request()->routeIs('barang.*') ? 'active' : '' }}">
            <i class="fas fa-box me-2"></i> Data Barang
        </a>

        {{-- SISIPKAN DI SINI --}}
        <a href="{{ route('pembelian.index') }}" class="{{ request()->routeIs('pembelian.*') ? 'active' : '' }}">
            <i class="fas fa-shopping-basket me-2"></i> Pengadaan (Restock)
        </a>
        {{-- BATAS SISIPAN --}}

       {{-- ... Menu Master Data dll di bawahnya ... --}}

{{-- HEADER KECIL (Opsional, biar rapi) --}}
<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
  <span>Master Data</span>
</h6>

    {{-- MENU JENIS BARANG (Yang sudah ada) --}}
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('jenis.*') ? 'active' : '' }}" href="{{ route('jenis.index') }}">
            <i class="fas fa-tags me-2"></i> Jenis Barang
        </a>
    </li>

    {{-- TAMBAHAN BARU: SUPPLIER --}}
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('supplier.*') ? 'active' : '' }}" href="{{ route('supplier.index') }}">
            <i class="fas fa-truck me-2"></i> Data Supplier
        </a>
    </li>

    {{-- TAMBAHAN BARU: JABATAN --}}
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('jabatan.*') ? 'active' : '' }}" href="{{ route('jabatan.index') }}">
            <i class="fas fa-briefcase me-2"></i> Data Jabatan
        </a>
    </li>
    
    {{-- MENU PEGAWAI (Yang sudah ada) --}}
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('pegawai.*') ? 'active' : '' }}" href="{{ route('pegawai.index') }}">
            <i class="fas fa-id-card me-2"></i> Data Pegawai
        </a>
    </li>
    

{{-- ... Menu Laporan dll ... --}}

        <a href="{{ route('konsumen.index') }}" class="{{ request()->routeIs('konsumen.*') ? 'active' : '' }}">
            <i class="fas fa-users me-2"></i> Pelanggan
        </a>

        <a href="{{ route('laporan.index') }}" class="{{ request()->routeIs('laporan.*') ? 'active' : '' }}">
            <i class="fas fa-chart-line me-2"></i> Laporan
        </a>

        <a href="{{ route('utilitas.index') }}" class="{{ request()->routeIs('utilitas.*') ? 'active' : '' }}">
            <i class="fas fa-tools me-2"></i> Cek Utilitas (SP/Func)
        </a>

        <form action="{{ route('logout') }}" method="POST" class="mt-5 px-3">
            @csrf
            <button type="submit" class="btn btn-danger w-100">
                <i class="fas fa-sign-out-alt me-2"></i> Logout
            </button>
        </form>
    </div>

    <div class="content">
        <div class="top-navbar">
            <h3 class="m-0">@yield('title')</h3>
            <div class="user-info text-muted">
                <i class="fas fa-user-circle"></i> Halo, <strong>{{ Auth::user()->nama_pegawai ?? 'Kasir' }}</strong>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }} <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }} 
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>