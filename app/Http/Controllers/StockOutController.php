<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockOut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockOutController extends Controller
{
    public function index()
    {
        $stockOuts = StockOut::with(['product', 'user'])->latest()->paginate(10);
        return view('admin.stock_outs.index', compact('stockOuts'));
    }

    public function create()
    {
        $products = Product::where('stock', '>', 0)->get();
        return view('admin.stock_outs.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'type' => 'required|in:Rusak,Hilang,Kadaluarsa,Keperluan Toko',
            'description' => 'nullable|string|max:255',
        ]);

        try {
            DB::beginTransaction();

            $product = Product::findOrFail($request->product_id);

            if ($product->stock < $request->quantity) {
                return redirect()->back()->with('error', "Jumlah keluar melebihi stok saat ini! Sisa stok: {$product->stock}")->withInput();
            }

            StockOut::create([
                'product_id' => $request->product_id,
                'user_id' => Auth::id(),
                'quantity' => $request->quantity,
                'type' => $request->type,
                'description' => $request->description,
            ]);

            $product->decrement('stock', $request->quantity);

            DB::commit();
            return redirect()->route('stock-outs.index')->with('success', 'Catatan barang keluar berhasil disimpan dan stok terpotong!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }
}
