@extends('layouts.app')

@section('title', 'Daftar Transaksi')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
    <h2>Daftar Transaksi</h2>
</div>

@if(isset($transactions) && $transactions->count() > 0)
    <div class="search-box">
        <form action="{{ route('admin.transactions.index') }}" method="GET" class="search-form">
            <input type="text" name="search" class="search-input" placeholder="Cari customer..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Cari</button>
            @if(request('search'))
                <a href="{{ route('admin.transactions.index') }}" class="btn btn-secondary">Reset</a>
            @endif
        </form>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Customer</th>
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
                    <td>{{ $transaction->nama_customer }}</td>
                    <td>{{ $transaction->total_quantity }}</td>
                    <td>Rp {{ number_format($transaction->total_transaksi, 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($transaction->tanggal_transaksi)->format('d-m-Y H:i:s') }}</td>
                    <td>
                        <a href="{{ route('admin.transactions.show', $transaction) }}" class="btn btn-primary">Lihat Transaksi</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Tidak ada data transaksi</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination">
        {{ $transactions->appends(request()->query())->links() }}
    </div>
@else
    <div class="alert alert-info">Tidak ada data transaksi</div>
@endif
@endsection