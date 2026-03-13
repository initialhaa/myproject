@extends('layouts.app')

@section('title', 'Transaksi Saya')

@section('content')
<h2 class="mb-3">Transaksi Saya</h2>

<div class="table-responsive">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Total Quantity</th>
                <th>Total Transaksi</th>
                <th>Tanggal Transaksi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $index => $transaction)
            <tr>
                <td>{{ $transactions->firstItem() + $index }}</td>
                <td>{{ $transaction->total_quantity }}</td>
                <td>Rp {{ number_format($transaction->total_transaksi, 0, ',', '.') }}</td>
                <td>{{ $transaction->tanggal_transaksi->format('d-m-Y') }}</td>
                <td>
                    <a href="{{ route('customer.transactions.show', $transaction) }}" class="btn btn-primary">Lihat Transaksi</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center;">Belum ada transaksi</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="pagination">
    {{ $transactions->links() }}
</div>
@endsection