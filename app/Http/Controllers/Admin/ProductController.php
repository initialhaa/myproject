<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pencarian = Product::orderBy('nama_produk', 'asc');
        if ($request->has('search') && !empty($request->search)) {
           $pencarian->where('nama_produk', 'like', '%' . $request->search . '%');
        }
        $product = $pencarian->paginate(10);
        return view('admin.product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|max:255',
            'harga' => 'required|numeric|min:0'
        ]);

        Product::create($request->all());
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->validate([
            'nama_product' => 'required|max:255',
            'harga' => 'required|numeric|min:0'
        ]);
        Product::updated($request->all());
        return redirect()->route('admin.products.index')->with('success', 'berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'berhasil di hapus');
    }
    
}
