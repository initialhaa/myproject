@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')
<div style="background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Detail Transaksi</h2>
        <a href="{{ route('customer.transactions.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <div class="mb-4">
        <p><strong>Nama Customer:</strong> {{ $transaction->nama_customer }}</p>
        <p><strong>Total Quantity:</strong> {{ $transaction->total_quantity }}</p>
        <p><strong>Total Transaksi:</strong> Rp {{ number_format($transaction->total_transaksi, 0, ',', '.') }}</p>
        <p><strong>Tanggal Transaksi:</strong> {{ $transaction->tanggal_transaksi->format('d-m-Y H:i:s') }}</p>
    </div>

    <h3 class="mb-3">Daftar Produk</h3>
    
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaction->details as $index => $detail)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $detail->product->nama_produk }}</td>
                    <td>Rp {{ number_format($detail->product->harga, 0, ',', '.') }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection