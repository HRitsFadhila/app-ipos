@extends('adminlte::page')

@section('title', 'Tambah Barang Keluar')

@section('content_header')
    <h1><i class="fas fa-minus-circle text-danger"></i> Input Barang Keluar (Rusak / Hilang / Lainnya)</h1>
@stop

@section('content')
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible position-relative pr-5" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="position: absolute; right: 15px; top: 12px;">
                <span aria-hidden="true">&times;</span>
            </button>
            <h5><i class="icon fas fa-ban"></i> Terjadi Kesalahan!</h5>
            {{ session('error') }}
        </div>
    @endif

    <div class="card card-danger card-outline">
        <form action="{{ route('stock-outs.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        {{-- Pilih Produk --}}
                        <div class="form-group mb-4">
                            <label for="product_id">Pilih Produk</label>
                            <select name="product_id" class="form-control @error('product_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Produk --</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                        {{ $product->code }} - {{ $product->name }} (Stok Tersedia: {{ $product->stock }} {{ $product->unit }})
                                    </option>
                                @endforeach
                            </select>
                            @error('product_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Jenis Barang Keluar --}}
                        <div class="form-group mb-4">
                            <label for="type">Kategori Pengeluaran</label>
                            <select name="type" class="form-control @error('type') is-invalid @enderror" required>
                                <option value="Rusak" {{ old('type') == 'Rusak' ? 'selected' : '' }}>Barang Rusak (Pecah/Bocor/Sobek)</option>
                                <option value="Hilang" {{ old('type') == 'Hilang' ? 'selected' : '' }}>Barang Hilang (Selisih Stok/Pencurian)</option>
                                <option value="Kadaluarsa" {{ old('type') == 'Kadaluarsa' ? 'selected' : '' }}>Barang Kadaluarsa (Expired)</option>
                                <option value="Keperluan Toko" {{ old('type') == 'Keperluan Toko' ? 'selected' : '' }}>Keperluan / Konsumsi Toko Sendiri</option>
                            </select>
                            @error('type')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        {{-- Jumlah Kuantiti --}}
                        <div class="form-group mb-4">
                            <label for="quantity">Jumlah (Qty) yang Keluar</label>
                            <input type="number" name="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity', 1) }}" min="1" required>
                            @error('quantity')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Keterangan / Catatan --}}
                        <div class="form-group mb-4">
                            <label for="description">Keterangan / Alasan (Opsional)</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3" placeholder="Contoh: Kemasan minyak bocor saat ditata di rak">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-danger"><i class="fas fa-save"></i> Simpan & Potong Stok</button>
                <a href="{{ route('stock-outs.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
@stop
