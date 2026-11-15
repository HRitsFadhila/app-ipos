@extends('adminlte::page')

@section('title', 'Input Barang Masuk')

@section('content_header')
    <h1><i class="fas fa-dolly text-success"></i> Input Barang Masuk (Restock)</h1>
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

    <form action="{{ route('purchases.store') }}" method="POST">
        @csrf
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title pt-1">Form Transaksi Restock Baru</h3>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label for="supplier_id">Supplier</label>
                            <select name="supplier_id" class="form-control @error('supplier_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Supplier --</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                        {{ $supplier->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('supplier_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label for="invoice_number">Nomor Faktur / Nota</label>
                            <input type="text" name="invoice_number" class="form-control @error('invoice_number') is-invalid @enderror" value="{{ old('invoice_number') }}" placeholder="Contoh: INV/SUP/20261115/001" required>
                            @error('invoice_number')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr class="mb-4">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="m-0 text-bold text-secondary"><i class="fas fa-boxes"></i> Daftar Item Barang Masuk</h5>
                    <button type="button" id="add-row" class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i> Tambah Baris Produk
                    </button>
                </div>

                {{-- Tabel Item Dinamis --}}
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="purchase-table">
                        <thead>
                            <tr>
                                <th style="width: 35%;">Produk</th>
                                <th style="width: 20%;">Harga Beli (Modal)</th>
                                <th style="width: 15%;">Jumlah (Qty)</th>
                                <th style="width: 20%;">Subtotal</th>
                                <th style="width: 10%;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select name="products[]" class="form-control product-select" required>
                                        <option value="">-- Pilih Produk --</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}" data-price="{{ $product->purchase_price }}">
                                                {{ $product->code }} - {{ $product->name }} (Stok: {{ $product->stock }})
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="number" name="prices[]" class="form-control price-input" min="0" step="any" placeholder="0" required>
                                </td>
                                <td>
                                    <input type="number" name="quantities[]" class="form-control qty-input" min="1" value="1" required>
                                </td>
                                <td class="align-middle text-right font-weight-bold subtotal-text">
                                    Rp 0
                                </td>
                                <td class="text-center align-middle">
                                    <button type="button" class="btn btn-danger btn-sm remove-row" disabled>
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-right align-middle">Total Keseluruhan Biaya:</th>
                                <th id="grand-total" class="text-right font-weight-bold text-lg text-primary align-middle">Rp 0</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Transaksi Restock</button>
                <a href="{{ route('purchases.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </form>
@stop

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tableBody = document.querySelector('#purchase-table tbody');
        const addRowBtn = document.querySelector('#add-row');
        const grandTotalEl = document.querySelector('#grand-total');

        // Template option produk untuk baris baru
        const productOptions = `@foreach($products as $product)<option value="{{ $product->id }}" data-price="{{ $product->purchase_price }}">{{ $product->code }} - {{ $product->name }} (Stok: {{ $product->stock }})</option>@endforeach`;

        function formatRupiah(amount) {
            return 'Rp ' + new Intl.NumberFormat('id-ID').format(amount);
        }

        function calculateTotals() {
            let grandTotal = 0;
            document.querySelectorAll('#purchase-table tbody tr').forEach(row => {
                const price = parseFloat(row.querySelector('.price-input').value) || 0;
                const qty = parseInt(row.querySelector('.qty-input').value) || 0;
                const subtotal = price * qty;

                row.querySelector('.subtotal-text').textContent = formatRupiah(subtotal);
                grandTotal += subtotal;
            });
            grandTotalEl.textContent = formatRupiah(grandTotal);
        }

        // Event listener untuk kalkulasi otomatis saat harga atau qty berubah
        tableBody.addEventListener('input', function (e) {
            if (e.target.classList.contains('price-input') || e.target.classList.contains('qty-input')) {
                calculateTotals();
            }
        });

        // Event listener saat produk dipilih, otomatis mengisi harga beli terakhir produk tersebut
        tableBody.addEventListener('change', function (e) {
            if (e.target.classList.contains('product-select')) {
                const selectedOption = e.target.options[e.target.selectedIndex];
                const price = selectedOption.getAttribute('data-price') || 0;
                const row = e.target.closest('tr');
                row.querySelector('.price-input').value = price ? Math.floor(price) : '';
                calculateTotals();
            }
        });

        // Tambah baris baru
        addRowBtn.addEventListener('click', function () {
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>
                    <select name="products[]" class="form-control product-select" required>
                        <option value="">-- Pilih Produk --</option>
                        ${productOptions}
                    </select>
                </td>
                <td>
                    <input type="number" name="prices[]" class="form-control price-input" min="0" step="any" placeholder="0" required>
                </td>
                <td>
                    <input type="number" name="quantities[]" class="form-control qty-input" min="1" value="1" required>
                </td>
                <td class="align-middle text-right font-weight-bold subtotal-text">
                    Rp 0
                </td>
                <td class="text-center align-middle">
                    <button type="button" class="btn btn-danger btn-sm remove-row">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            `;
            tableBody.appendChild(newRow);
            updateRemoveButtons();
        });

        // Hapus baris
        tableBody.addEventListener('click', function (e) {
            if (e.target.closest('.remove-row')) {
                e.target.closest('tr').remove();
                calculateTotals();
                updateRemoveButtons();
            }
        });

        function updateRemoveButtons() {
            const rows = tableBody.querySelectorAll('tr');
            rows.forEach((row) => {
                const removeBtn = row.querySelector('.remove-row');
                if (rows.length === 1) {
                    removeBtn.setAttribute('disabled', 'true');
                } else {
                    removeBtn.removeAttribute('disabled');
                }
            });
        }

        // Hitung awal saat halaman dimuat
        calculateTotals();
    });
</script>
@stop
