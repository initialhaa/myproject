<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $transactions = Transaction::where('user_id', Auth::id())
            ->orderBy('tanggal_transaksi', 'desc')
            ->paginate(10);

        return view('customer.transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::orderBy('nama_produk', 'asc')->get();
        return view('customer.transactions.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'quantities' => 'required|array',
            'quantities.*' => 'required|min:0'
        ]);
        
        $quantities = $request->quantities;
        $products = Product::whereIn('id', array_keys($quantities))->get();

        // Filter produk dengan quantity > 0
        $itemsToBuy = [];
        $totalQuantity = 0;
        $totalAmount = 0;
        
        
        foreach ($products as $product) {
            $qty = $quantities[$product->id] ?? 0;
            if ($qty > 0) {
                $itemsToBuy[] = [
                    'product' => $product,
                    'quantity' => $qty,
                    'subtotal' => $product->harga * $qty
                ];
                $totalQuantity += $qty;
                $totalAmount += $product->harga * $qty;
            }
        }
        
        if (empty($itemsToBuy)) {
            return back()->with('error', 'Minimal satu produk harus dibeli');
        }
        
        DB::beginTransaction();
        try {
            // Membuat transaction
            $transaction = Transaction::create([
                'user_id' => Auth::id(),
                'nama_customer' => Auth::user()->name,
                'total_quantity' => $totalQuantity,
                'total_transaksi' => $totalAmount,
                'tanggal_transaksi' => Auth::user()->updated_at,
            ]);
            
            // Membuat transaction details
            foreach ($itemsToBuy as $item) {
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $item['product']->id,
                    'quantity' => $item['quantity'],
                    'subtotal' => $item['subtotal'],
                ]);
            }
            
            DB::commit();
            return redirect()->route('customer.transactions.show', $transaction)
                ->with('success', 'Transaksi berhasil dibuat');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access');
        }
        
        $transaction->load('details.product');
        return view('customer.transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}