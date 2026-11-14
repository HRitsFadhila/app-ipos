@extends('adminlte::page')

@section('title', 'Edit Supplier')

@section('content_header')
    <h1>Edit Data Supplier</h1>
@stop

@section('content')
    <div class="card card-warning">
        <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group mb-3">
                    <label for="name">Nama Supplier / Toko Grosir</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name', $supplier->name) }}" required>
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="phone">No. Telepon / WhatsApp</label>
                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" value="{{ old('phone', $supplier->phone) }}" required>
                    @error('phone')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="address">Alamat Supplier</label>
                    <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="address" rows="3" required>{{ old('address', $supplier->address) }}</textarea>
                    @error('address')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-warning text-white"><i class="fas fa-sync"></i> Perbarui</button>
                <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
@stop
