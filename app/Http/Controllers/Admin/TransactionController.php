<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index (Request $request){
        $pencarian = Transaction::with('user')->orderBy('tanggal_transaksi', 'desc');
        if ($request->has('search') && !empty($request->search)){
            $pencarian->where('nama_customer', 'like', '%' .$request->search . '%');
        }
        $transaction = $pencarian->paginate(10);
        return view('admin.transactions.index', compact('transactions'));
    }

    public function show (Transaction $transaction){
        $transaction->load('details.product', 'user');
        return view('admin.transactions.show', compact('transaction'));
    }
}
