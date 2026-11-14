@extends('adminlte::page')

@section('title', 'Manajemen Supplier')

@section('content_header')
    <h1><i class="fas fa-tags text-success"></i>Supplier</h1>
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
            <h3 class="card-title pt-1">Daftar Supplier</h3>
            <div class="card-tools">
                <a href="{{ route('suppliers.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Tambah Supplier
                </a>
            </div>
        </div>

        <div class="card-body p-0">
            <table class="table table-bordered table-striped m-0">
                <thead>
                    <tr>
                        <th style="width: 50px" class="text-center">No</th>
                        <th>Nama Supplier</th>
                        <th>Nomor HP</th>
                        <th>Alamat</th>
                        <th style="width: 160px" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($suppliers as $index => $supplier)
                        <tr>
                            <td class="text-center align-middle">{{ $suppliers->firstItem() + $index }}</td>
                            <td class="align-middle">{{ $supplier->name }}</td>
                            <td class="align-middle">{{ $supplier->phone }}</td>
                            <td class="align-middle">{{ $supplier->address }}</td>
                            <td class="text-center align-middle">
                                <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-xs btn-warning mr-1">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus ini?');">
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
                            <td colspan="4" class="text-center py-3">Belum ada data supplier.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer clearfix">
            <div class="float-right m-0">
                {{ $suppliers->links() }}
            </div>
        </div>
    </div>
@stop
