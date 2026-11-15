@extends('adminlte::page')

@section('title', 'Manajemen Pengguna')

@section('content_header')
    <h1><i class="fas fa-users text-primary"></i> Manajemen Pengguna & Kasir</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible position-relative pr-5" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible position-relative pr-5" role="alert">
        {{ session('error') }}
    </div>
@endif

    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title pt-1">Daftar Akun Pengguna</h3>
            <div class="card-tools">
                <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-user-plus"></i> Tambah Akun Baru
                </a>
            </div>
        </div>

        <div class="card-body p-0">
            <table class="table table-bordered table-striped m-0">
                <thead>
                    <tr>
                        <th style="width: 50px" class="text-center">No</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th style="width: 180px;">Role / Hak Akses</th>
                        <th style="width: 160px" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $user)
                        <tr>
                            <td class="text-center align-middle py-3">{{ $users->firstItem() + $index }}</td>
                            <td class="align-middle font-weight-bold py-3">{{ $user->name }}</td>
                            <td class="align-middle py-3">{{ $user->email }}</td>
                            <td class="align-middle py-3">
                                @if($user->role == 'owner')
                                    <strong class="text-primary">Owner</strong>
                                @elseif($user->role == 'admin')
                                    <strong class="text-danger">Administrator</strong>
                                @else
                                    <strong class="text-success">Kasir</strong>
                                @endif
                            </td>
                            <td class="text-center align-middle py-3">
                                @if(Auth::user()->role == 'owner' || (Auth::user()->role == 'admin' && $user->role !== 'owner'))
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                @endif

                                @if($user->id !== Auth::id())
                                    @if(Auth::user()->role == 'owner' || (Auth::user()->role == 'admin' && $user->role !== 'owner'))
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus akun ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Belum ada data pengguna.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer clearfix">
            <div class="float-right m-0">
                {{ $users->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@stop
