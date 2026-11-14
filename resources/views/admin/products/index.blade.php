@extends('adminlte::page')

@section('title', 'Manajemen Supplier')

@section('content_header')
    <h1><i class="fas fa-tags text-success"></i>Produk</h1>
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
            <h3 class="card-title pt-1">Daftar Produk</h3>
            <div class="card-tools">
                <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Tambah Produk
                </a>
            </div>
        </div>

        <div class="card-body p-0">
            <table class="table table-bordered table-striped m-0">
                <thead>
                    <tr>
                        <th style="width: 50px" class="text-center">No</th>
                        <th>Kode</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th class="text-center">Stok</th>
                        <th class="text-center">Foto</th>
                        <th style="width: 160px" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $index => $product)
                        <tr>
                            <td class="text-center align-middle">{{ $products->firstItem() + $index }}</td>
                            <td class="align-middle"><code>{{ $product->code }}</code></td>
                            <td class="align-middle">{{ $product->name }}</td>
                            <td class="align-middle">{{ $product->category->name }}</span></td>
                            <td class="align-middle">Rp {{ number_format($product->purchase_price, 0, ',', '.') }}</td>
                            <td class="align-middle">Rp {{ number_format($product->selling_price, 0, ',', '.') }}</td>
                            <td class="text-center align-middle">
                                <span class="{{ $product->stock <= 50 ? 'text-danger font-weight-bold' : 'text-black' }}">
                                    {{ $product->stock }} {{ $product->unit }}
                                </span>
                            </td>
                            <td class="text-center align-middle">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <span>No Image</span>
                                @endif
                            </td>
                            <td class="text-center align-middle">
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-xs btn-warning mr-1">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus ini?');">
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
                {{ $products->links() }}
            </div>
        </div>
    </div>
@stop
