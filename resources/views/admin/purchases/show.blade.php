@extends('adminlte::page')

@section('title', 'Detail Barang Masuk')

@section('content_header')
    <h1><i class="fas fa-file-invoice text-info"></i> Detail Transaksi Restock</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title pt-1"><i class="fas fa-info-circle"></i> Informasi Nota & Supplier</h3>
                    <div class="card-tools">
                        <a href="{{ route('purchases.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali ke Riwayat
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <span class="text-muted d-block">Nomor Faktur / Nota</span>
                            <h5 class="text-bold text-dark font-weight-bold">{{ $purchase->invoice_number }}</h5>
                        </div>
                        <div class="col-md-4 mb-3">
                            <span class="text-muted d-block">Nama Supplier</span>
                            <h5 class="text-bold text-primary">{{ $purchase->supplier->name }}</h5>
                            <small class="text-muted">{{ $purchase->supplier->phone }} | {{ $purchase->supplier->address }}</small>
                        </div>
                        <div class="col-md-4 mb-3">
                            <span class="text-muted d-block">Petugas / Admin Pencatat</span>
                            <h5 class="text-bold text-dark">{{ $purchase->user->name ?? 'System' }}</h5>
                            <small class="text-muted">Tanggal: {{ $purchase->created_at->format('d M Y, H:i') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card card-success card-outline">
                <div class="card-header">
                    <h3 class="card-title pt-1"><i class="fas fa-boxes"></i> Daftar Item Produk yang Dibeli</h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped m-0">
                            <thead>
                                <tr>
                                    <th style="width: 50px" class="text-center">No</th>
                                    <th>Kode SKU</th>
                                    <th>Nama Produk</th>
                                    <th class="text-right">Harga Beli (Modal)</th>
                                    <th class="text-center">Jumlah (Qty)</th>
                                    <th class="text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($purchase->details as $index => $detail)
                                    <tr>
                                        <td class="text-center align-middle py-3">{{ $index + 1 }}</td>
                                        <td class="align-middle py-3"><span class="text-dark font-weight-bold">{{ $detail->product->code ?? '-' }}</span></td>
                                        <td class="align-middle py-3">{{ $detail->product->name ?? 'Produk Dihapus' }}</td>
                                        <td class="align-middle text-right py-3">Rp {{ number_format($detail->purchase_price, 0, ',', '.') }}</td>
                                        <td class="align-middle text-center py-3">{{ $detail->quantity }} {{ $detail->product->unit ?? '' }}</td>
                                        <td class="align-middle text-right font-weight-bold py-3">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="5" class="text-right align-middle py-3">Total Keseluruhan Biaya:</th>
                                    <th class="text-right text-lg text-success align-middle py-3">
                                        Rp {{ number_format($purchase->total_cost, 0, ',', '.') }}
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
