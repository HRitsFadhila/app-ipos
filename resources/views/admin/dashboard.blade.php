@extends('adminlte::page')

@section('title', 'Dashboard Toko Sembako')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1><i class="fas fa-store text-success"></i> Dashboard Toko Sembako</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <!-- Kotak Informasi Statistik (Small Box) -->
    <div class="row">
        <!-- Total Produk -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>120</h3>
                    <p>Total Jenis Barang</p>
                </div>
                <div class="icon">
                    <i class="fas fa-boxes"></i>
                </div>
                <a href="#" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- Stok Menipis -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>5</h3>
                    <p>Stok Hampir Habis</p>
                </div>
                <div class="icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <a href="#" class="small-box-footer">Cek Stok <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- Transaksi Hari Ini -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>48</h3>
                    <p>Transaksi Hari Ini</p>
                </div>
                <div class="icon">
                    <i class="fas fa-cash-register"></i>
                </div>
                <a href="#" class="small-box-footer">Buka Kasir <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- Total Pendapatan -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>Rp 2.450k</h3>
                    <p>Omzet Hari Ini</p>
                </div>
                <div class="icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <a href="#" class="small-box-footer">Lihat Laporan <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <!-- Tabel / Informasi Tambahan -->
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-history"></i> Transaksi Penjualan Terbaru</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No. Invoice</th>
                                <th>Kasir</th>
                                <th>Total Belanja</th>
                                <th>Waktu</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>INV/20261113/001</td>
                                <td>Siti Aminah</td>
                                <td>Rp 75.000</td>
                                <td>13 Nov 2026, 14:20</td>
                                <td>
                                    <button class="btn btn-xs btn-info"><i class="fas fa-eye"></i> Detail</button>
                                </td>
                            </tr>
                            <tr>
                                <td>INV/20261113/002</td>
                                <td>Siti Aminah</td>
                                <td>Rp 120.000</td>
                                <td>13 Nov 2026, 15:05</td>
                                <td>
                                    <button class="btn btn-xs btn-info"><i class="fas fa-eye"></i> Detail</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <!-- Tambahan CSS kustom jika diperlukan -->
@stop

@section('js')
    <script>
        console.log("Dashboard Sembako berhasil dimuat!");
    </script>
@stop
