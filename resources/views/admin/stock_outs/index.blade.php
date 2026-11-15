@extends('adminlte::page')

@section('title', 'Riwayat Barang Keluar')

@section('content_header')
    <h1><i class="fas fa-exclamation-triangle text-danger"></i> Riwayat Barang Keluar (Rusak/Hilang/Lainnya)</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible position-relative pr-5" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="card card-danger card-outline">
        <div class="card-header">
            <h3 class="card-title pt-1">Daftar Pengeluaran Stok Non-Penjualan</h3>
            <div class="card-tools">
                <a href="{{ route('stock-outs.create') }}" class="btn btn-danger btn-sm">
                    <i class="fas fa-plus"></i> Tambah Barang Keluar
                </a>
            </div>
        </div>

        <div class="card-body p-0">
            <table class="table table-bordered table-striped m-0">
                <thead>
                    <tr>
                        <th style="width: 50px" class="text-center">No</th>
                        <th>Tanggal</th>
                        <th>Nama Produk</th>
                        <th>Kategori Keluar</th>
                        <th class="text-center">Jumlah</th>
                        <th>Keterangan</th>
                        <th>Petugas</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stockOuts as $index => $item)
                        <tr>
                            <td class="text-center align-middle">{{ $stockOuts->firstItem() + $index }}</td>
                            <td class="align-middle">{{ $item->created_at->format('d M Y, H:i') }}</td>
                            <td class="align-middle font-weight-bold">{{ $item->product->name ?? 'Produk Dihapus' }}</td>
                            <td class="align-middle">
                                @if($item->type == 'Rusak')
                                    <strong class="text-danger">Rusak</strong>
                                @elseif($item->type == 'Hilang')
                                    <strong class="text-warning">Hilang</strong>
                                @elseif($item->type == 'Kadaluarsa')
                                    <strong class="text-secondary">Kadaluarsa</strong>
                                @else
                                    <strong class="text-info">Keperluan Toko</strong>
                                @endif
                            </td>
                            <td class="align-middle text-center font-weight-bold text-danger">-{{ $item->quantity }} {{ $item->product->unit ?? '' }}</td>
                            <td class="align-middle">{{ $item->description ?? '-' }}</td>
                            <td class="align-middle">{{ $item->user->name ?? 'Admin' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-3">Belum ada riwayat barang keluar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer clearfix">
            <div class="float-right m-0">
                {{ $stockOuts->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@stop
