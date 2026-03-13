@extends('layouts.app')

@section('title', 'Buat Transaksi')

@section('styles')
<style>
    .product-row {
        background: #f8f9fa;
        padding: 1rem;
        margin-bottom: 0.5rem;
        border-radius: 4px;
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    .product-info {
        flex: 1;
    }
    .product-name {
        font-weight: 600;
    }
    .product-price {
        color: #666;
        font-size: 0.9rem;
    }
    .product-quantity {
        width: 100px;
    }
    .product-subtotal {
        min-width: 150px;
        text-align: right;
        font-weight: 600;
    }
    .summary {
        background: #e9ecef;
        padding: 1.5rem;
        border-radius: 4px;
        margin-top: 1rem;
    }
    .summary-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.5rem;
    }
    .total {
        font-size: 1.2rem;
        font-weight: 600;
        border-top: 2px solid #dee2e6;
        padding-top: 0.5rem;
    }
    @media (max-width: 768px) {
        .product-row {
            flex-direction: column;
            align-items: flex-start;
        }
        .product-quantity {
            width: 100%;
        }
        .product-subtotal {
            text-align: left;
            width: 100%;
        }
    }
</style>
@endsection

@section('content')
<div style="background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Buat Transaksi Baru</h2>
        <a href="{{ route('customer.transactions.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <form method="POST" action="{{ route('customer.transactions.store') }}" id="transactionForm">
        @csrf

        <h3 class="mb-3">Pilih Produk</h3>

        <div id="products-container">
            @foreach($products as $product)
            <div class="product-row" data-product-id="{{ $product->id }}" data-price="{{ $product->harga }}">
                <div class="product-info">
                    <div class="product-name">{{ $product->nama_produk }}</div>
                    <div class="product-price">Rp {{ number_format($product->harga, 0, ',', '.') }}</div>
                </div>
                <div class="product-quantity">
                    <input type="number" 
                           name="quantities[{{ $product->id }}]" 
                           class="form-control quantity-input" 
                           value="0" 
                           min="0"
                           data-product-id="{{ $product->id }}">
                </div>
                <div class="product-subtotal" id="subtotal-{{ $product->id }}">
                    Rp 0
                </div>
            </div>
            @endforeach
        </div>

        <div class="summary">
            <h4>Ringkasan Belanja</h4>
            <div class="summary-item">
                <span>Total Quantity:</span>
                <span id="total-quantity">0</span>
            </div>
            <div class="summary-item">
                <span>Total Belanja:</span>
                <span id="total-amount">Rp 0</span>
            </div>
            <div class="summary-item total">
                <span>Grand Total:</span>
                <span id="grand-total">Rp 0</span>
            </div>
        </div>

        <div class="form-group" style="margin-top: 1rem;">
            <button type="submit" class="btn btn-success" style="width: 100%;">Buat Transaksi</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const quantityInputs = document.querySelectorAll('.quantity-input');
    
    function formatRupiah(number) {
        return 'Rp ' + number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    function calculateTotals() {
        let totalQuantity = 0;
        let totalAmount = 0;

        quantityInputs.forEach(input => {
            const productId = input.dataset.productId;
            const price = parseFloat(input.closest('.product-row').dataset.price);
            const quantity = parseInt(input.value) || 0;
            const subtotal = price * quantity;
            document.getElementById(`subtotal-${productId}`).textContent = formatRupiah(subtotal);

            if (quantity > 0) {
                totalQuantity += quantity;
                totalAmount += subtotal;
            }
        });
        document.getElementById('total-quantity').textContent = totalQuantity;
        document.getElementById('total-amount').textContent = formatRupiah(totalAmount);
        document.getElementById('grand-total').textContent = formatRupiah(totalAmount);
    }

    // Add event listeners to all quantity inputs
    quantityInputs.forEach(input => {
        input.addEventListener('input', calculateTotals);
    });
    calculateTotals();
});
</script>
@endsection