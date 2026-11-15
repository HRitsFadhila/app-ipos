@extends('adminlte::page')

@section('title', 'Tambah Pengguna Baru')

@section('content_header')
    <h1><i class="fas fa-user-plus text-primary"></i> Tambah Akun Pengguna</h1>
@stop

@section('content')
    <div class="card card-primary card-outline">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group mb-3">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Contoh: Siti Kasir" required>
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="email">Alamat Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Contoh: kasir@toko.com" required>
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Tampilkan pilihan role hanya jika yang login adalah Owner --}}
                @if(Auth::user()->role == 'owner')
                    <div class="form-group mb-3">
                        <label for="role">Hak Akses (Role)</label>
                        <select name="role" class="form-control @error('role') is-invalid @enderror" required>
                            <option value="cashier">Kasir</option>
                            <option value="admin">Administrator</option>
                        </select>
                        @error('role')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                @else
                    {{-- Jika Admin yang membuat, otomatis jadi kasir --}}
                    <input type="hidden" name="role" value="cashier">
                    <div class="alert alert-info py-2 mb-3">
                        <small><i class="fas fa-info-circle"></i> Akun baru ini akan otomatis terdaftar sebagai <strong>Kasir</strong>.</small>
                    </div>
                @endif

                <div class="form-group mb-3">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Minimal 6 karakter" required>
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Akun</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
@stop
