@extends('adminlte::page')

@section('title', 'Riwayat Barang Masuk')

@section('content_header')
    <h1><i class="fas fa-dolly text-success"></i> Riwayat Barang Masuk (Restock)</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible position-relative pr-5" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title pt-1">Daftar Transaksi Restock</h3>
            <div class="card-tools">
                <a href="{{ route('purchases.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Input Barang Masuk
                </a>
            </div>
        </div>

        <div class="card-body p-0">
            <table class="table table-bordered table-striped m-0">
                <thead>
                    <tr>
                        <th style="width: 50px" class="text-center">No</th>
                        <th>No. Faktur</th>
                        <th>Supplier</th>
                        <th>Admin / Petugas</th>
                        <th>Total Biaya</th>
                        <th>Tanggal</th>
                        <th style="width: 120px" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($purchases as $index => $purchase)
                        <tr>
                            <td class="text-center align-middle">{{ $purchases->firstItem() + $index }}</td>
                            <td class="align-middle"><code>{{ $purchase->invoice_number }}</code></td>
                            <td class="align-middle">{{ $purchase->supplier->name }}</td>
                            <td class="align-middle">{{ $purchase->user->name }}</td>
                            <td class="align-middle">Rp {{ number_format($purchase->total_cost, 0, ',', '.') }}</td>
                            <td class="align-middle">{{ $purchase->created_at->format('d M Y, H:i') }}</td>
                            <td class="text-center align-middle">
                                <a href="{{ route('purchases.show', $purchase->id) }}" class="btn btn-xs btn-info">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-3">Belum ada riwayat barang masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer clearfix">
            <div class="float-right m-0">
                {{ $purchases->links() }}
            </div>
        </div>
    </div>
@stop
