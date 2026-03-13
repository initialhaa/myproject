@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
<div style="max-width: 600px; margin: 0 auto;">
    <div style="background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <h2 style="margin-bottom: 1.5rem;">Tambah Produk Baru</h2>
        
        <form method="POST" action="{{ route('admin.products.store') }}">
            @csrf
            
            <div class="form-group">
                <label for="nama_produk">Nama Produk</label>
                <input type="text" id="nama_produk" name="nama_produk" class="form-control" value="{{ old('nama_produk') }}" required>
                @error('nama_produk')
                    <small style="color: red;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" id="harga" name="harga" class="form-control" value="{{ old('harga') }}" min="0" required>
                @error('harga')
                    <small style="color: red;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Buat Produk</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection