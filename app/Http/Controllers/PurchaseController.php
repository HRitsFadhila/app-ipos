<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with(['supplier', 'user'])->latest()->paginate(10);
        return view('admin.purchases.index', compact('purchases'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $products = Product::all();
        return view('admin.purchases.create', compact('suppliers', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'invoice_number' => 'required|string|max:100|unique:purchases,invoice_number',
            'products' => 'required|array|min:1',
            'products.*' => 'required|exists:products,id',
            'quantities' => 'required|array|min:1',
            'quantities.*' => 'required|integer|min:1',
            'prices' => 'required|array|min:1',
            'prices.*' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            $totalCost = 0;
            // Hitung total keseluruhan biaya terlebih dahulu
            for ($i = 0; $i < count($request->products); $i++) {
                $totalCost += $request->quantities[$i] * $request->prices[$i];
            }

            // 1. Simpan Header Purchase
            $purchase = Purchase::create([
                'supplier_id' => $request->supplier_id,
                'user_id' => Auth::id(),
                'invoice_number' => $request->invoice_number,
                'total_cost' => $totalCost,
            ]);

            // 2. Simpan Detail & Update Stok Produk
            for ($i = 0; $i < count($request->products); $i++) {
                $productId = $request->products[$i];
                $qty = $request->quantities[$i];
                $price = $request->prices[$i];
                $subtotal = $qty * $price;

                PurchaseDetail::create([
                    'purchase_id' => $purchase->id,
                    'product_id' => $productId,
                    'quantity' => $qty,
                    'purchase_price' => $price,
                    'subtotal' => $subtotal,
                ]);

                // Update stok produk bertambah dan perbarui harga beli modal terakhir
                $product = Product::findOrFail($productId);
                $product->increment('stock', $qty);
                $product->update(['purchase_price' => $price]);
            }

            DB::commit();
            return redirect()->route('purchases.index')->with('success', 'Transaksi barang masuk berhasil disimpan dan stok bertambah!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function show(Purchase $purchase)
    {
        $purchase->load(['supplier', 'user', 'details.product']);
        return view('admin.purchases.show', compact('purchase'));
    }
}
