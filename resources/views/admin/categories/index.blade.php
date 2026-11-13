@extends('adminlte::page')

@section('title', 'Manajemen Kategori Barang')

@section('content_header')
    <h1><i class="fas fa-tags text-success"></i> Kategori Barang</h1>
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
            <h3 class="card-title pt-1">Daftar Kategori Sembako</h3>
            <div class="card-tools">
                <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Tambah Kategori
                </a>
            </div>
        </div>

        <div class="card-body p-0">
            <table class="table table-bordered table-striped m-0">
                <thead>
                    <tr>
                        <th style="width: 50px" class="text-center">No</th>
                        <th>Nama Kategori</th>
                        <th style="width: 160px" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $index => $category)
                        <tr>
                            <td class="text-center align-middle">{{ $categories->firstItem() + $index }}</td>
                            <td class="align-middle">{{ $category->name }}</td>
                            <td class="text-center align-middle">
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-xs btn-warning mr-1">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-xs btn-danger rounded-0 rounded-right">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-3">Belum ada data kategori.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer clearfix">
            <div class="float-right m-0">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
@stop
