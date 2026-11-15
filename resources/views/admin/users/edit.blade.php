@extends('adminlte::page')

@section('title', 'Edit Pengguna')

@section('content_header')
    <h1><i class="fas fa-user-edit text-warning"></i> Edit Akun Pengguna</h1>
@stop

@section('content')
    <div class="card card-warning card-outline">
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group mb-3">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="email">Alamat Email</label>
                    <input type="email" name="email" class="form-control @error('email' ) is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Hak Akses Role --}}
                @if(Auth::user()->role == 'owner')
                    <div class="form-group mb-3">
                        <label for="role">Hak Akses (Role)</label>
                        <select name="role" class="form-control @error('role') is-invalid @enderror" required>
                            <option value="cashier" {{ old('role', $user->role) == 'cashier' ? 'selected' : '' }}>Kasir</option>
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrator</option>
                            <option value="owner" {{ old('role', $user->role) == 'owner' ? 'selected' : '' }}>Owner</option>
                        </select>
                        @error('role')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                @else
                    <div class="form-group mb-3">
                        <label for="role_display">Hak Akses (Role)</label>
                        <input type="text" class="form-control" value="{{ ucfirst($user->role) }}" disabled>
                        <input type="hidden" name="role" value="{{ $user->role }}">
                    </div>
                @endif

                <div class="form-group mb-3">
                    <label for="password">Password Baru <small class="text-muted">(Kosongkan jika tidak ingin mengubah password)</small></label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Biarkan kosong jika tidak diubah">
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-warning text-white"><i class="fas fa-sync"></i> Perbarui Akun</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
@stop
