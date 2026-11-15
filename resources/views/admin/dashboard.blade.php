@extends('adminlte::page')

@section('title', 'Dashboard Toko Sembako')

@section('content_header')
    <div class="content-header mb-2">
        <h1><i class="bi bi-speedometer2 text-primary mr-2"></i> Dashboard Toko Sembako</h1>
    </div>
@stop

@section('content')
    <!-- Banner Selamat Datang -->
    <div class="row mb-3">
        <div class="col-12">
            <div class="callout callout-info shadow-sm bg-white py-3">
                <h5><i class="bi bi-megaphone-fill text-info mr-1"></i> Selamat Datang, <strong>{{ Auth::user()->name }}</strong>!</h5>
                <p class="mb-0 text-muted">
                    Anda masuk sebagai
                    <span class="badge badge-primary text-uppercase px-2 py-1" style="color: #212529 !important;">
                        {{ Auth::user()->role ?? 'Admin' }}
                    </span>.
                    Kelola inventaris, stok masuk, dan data toko dengan mudah melalui panel di samping.
                </p>
            </div>
        </div>
    </div>

    <!-- Statistik Cards (Card Berwarna dengan Teks & Ikon Hitam) -->
    <div class="row">
        <!-- Total Produk -->
        <div class="col-lg-3 col-md-6 col-12 mb-4">
            <div class="card bg-info border-0 shadow h-100 py-2">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1" style="letter-spacing: 0.5px;">Total Produk</div>
                            <div class="h1 mb-0 font-weight-bold text-dark">{{ $totalProducts }}</div>
                        </div>
                        <div class="p-3 rounded-circle" style="background-color: rgba(0, 0, 0, 0.1);">
                            <i class="bi bi-box-seam text-dark" style="font-size: 2.2rem;"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-0 pt-0 pb-2">
                    <a href="{{ route('products.index') }}" class="text-dark font-weight-bold small text-decoration-none">
                        Kelola Produk <i class="bi bi-arrow-right-circle ml-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Kategori Barang -->
        <div class="col-lg-3 col-md-6 col-12 mb-4">
            <div class="card bg-success border-0 shadow h-100 py-2">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1" style="letter-spacing: 0.5px;">Kategori Barang</div>
                            <div class="h1 mb-0 font-weight-bold text-dark">{{ $totalCategories }}</div>
                        </div>
                        <div class="p-3 rounded-circle" style="background-color: rgba(0, 0, 0, 0.1);">
                            <i class="bi bi-tags text-dark" style="font-size: 2.2rem;"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-0 pt-0 pb-2">
                    <a href="{{ route('categories.index') }}" class="text-dark font-weight-bold small text-decoration-none">
                        Kelola Kategori <i class="bi bi-arrow-right-circle ml-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Supplier -->
        <div class="col-lg-3 col-md-6 col-12 mb-4">
            <div class="card bg-warning border-0 shadow h-100 py-2">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1" style="letter-spacing: 0.5px;">Supplier</div>
                            <div class="h1 mb-0 font-weight-bold text-dark">{{ $totalSuppliers }}</div>
                        </div>
                        <div class="p-3 rounded-circle" style="background-color: rgba(0, 0, 0, 0.1);">
                            <i class="bi bi-truck text-dark" style="font-size: 2.2rem;"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-0 pt-0 pb-2">
                    <a href="{{ route('suppliers.index') }}" class="text-dark font-weight-bold small text-decoration-none">
                        Kelola Supplier <i class="bi bi-arrow-right-circle ml-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Pengguna Sistem -->
        <div class="col-lg-3 col-md-6 col-12 mb-4">
            <div class="card bg-danger border-0 shadow h-100 py-2">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1" style="letter-spacing: 0.5px;">Pengguna Sistem</div>
                            <div class="h1 mb-0 font-weight-bold text-dark">{{ $totalUsers }}</div>
                        </div>
                        <div class="p-3 rounded-circle" style="background-color: rgba(0, 0, 0, 0.1);">
                            <i class="bi bi-people text-dark" style="font-size: 2.2rem;"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-0 pt-0 pb-2">
                    <a href="{{ route('users.index') }}" class="text-dark font-weight-bold small text-decoration-none">
                        Kelola User <i class="bi bi-arrow-right-circle ml-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Aktivitas Terakhir (Barang Masuk) -->
    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card card-primary card-outline shadow-sm">
                <div class="card-header bg-white py-3">
                    <h3 class="card-title font-weight-bold text-dark m-0">
                        <i class="bi bi-clock-history text-primary mr-1"></i> Aktivitas Restock (Barang Masuk) Terakhir
                    </h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover table-striped m-0">
                        <thead>
                            <tr class="bg-light">
                                <th style="width: 50px" class="text-center">No</th>
                                <th>No. Faktur</th>
                                <th>Supplier</th>
                                <th>Total Biaya</th>
                                <th>Dicatat Oleh</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentPurchases as $index => $purchase)
                                <tr>
                                    <td class="text-center align-middle py-3">{{ $index + 1 }}</td>
                                    <td class="align-middle font-weight-bold py-3 text-primary">{{ $purchase->invoice_number }}</td>
                                    <td class="align-middle py-3">{{ $purchase->supplier->name ?? '-' }}</td>
                                    <td class="align-middle py-3 font-weight-bold text-success">Rp {{ number_format($purchase->total_cost, 0, ',', '.') }}</td>
                                    <td class="align-middle py-3">
                                        <span class="badge bg-light text-dark border px-2 py-1 font-weight-bold">{{ $purchase->user->name ?? '-' }}</span>
                                    </td>
                                    <td class="align-middle py-3 text-muted">{{ $purchase->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">Belum ada aktivitas barang masuk.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
