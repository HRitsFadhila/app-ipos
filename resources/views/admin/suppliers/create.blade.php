@extends('adminlte::page')

@section('title', 'Tambah Supplier')

@section('content_header')
    <h1>Tambah Supplier Baru</h1>
@stop

@section('content')
    <div class="card card-primary">
        <form action="{{ route('suppliers.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group mb-3">
                    <label for="name">Nama Supplier / Toko Grosir</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" required>
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="phone">No. Telepon / WhatsApp</label>
                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" value="{{ old('phone') }}" required>
                    @error('phone')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="address">Alamat Supplier</label>
                    <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="address" rows="3" required>{{ old('address') }}</textarea>
                    @error('address')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
@stop
