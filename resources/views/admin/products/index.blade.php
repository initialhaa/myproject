{{-- resources/views/admin/products/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
    <h2>Daftar Produk</h2>
    <a href="{{ route('admin.products.create') }}" class="btn btn-success">Tambah Produk</a>
</div>

<div class="search-box">
    <form action="{{ route('admin.products.index') }}" method="GET" class="search-form">
        <input type="text" name="search" class="search-input" placeholder="Cari produk..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">Cari</button>
        @if(request('search'))
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Reset</a>
        @endif
    </form>
</div>

<div class="table-responsive">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $index => $product)
            <tr>
                <td>{{ $products->firstItem() + $index }}</td>
                <td>{{ $product->nama_produk }}</td>
                <td>Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning">Update</a>
                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus produk ini?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align: center;">Tidak ada data produk</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="pagination">
    {{ $products->appends(request()->query())->links() }}
</div>
@endsection