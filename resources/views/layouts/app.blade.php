<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Punya Hanafi - @yield('title')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            min-height: 100vh;
        }
        .navbar {
            background: #2c3e50;
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
            text-decoration: none;
        }
        .nav-menu {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }
        .nav-menu a {
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            transition: background 0.3s;
        }
        .nav-menu a:hover {
            background: #34495e;
        }
        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .btn-logout {
            background: #e74c3c;
            border: none;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            cursor: pointer;
        }
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        .alert {
            padding: 1rem;
            border-radius: 4px;
            margin-bottom: 1rem;
        }
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .table-responsive {
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }
        th {
            background: #f8f9fa;
            font-weight: 600;
        }
        .btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 0.9rem;
            margin: 0 0.25rem;
        }
        .btn-primary {
            background: #3498db;
            color: white;
        }
        .btn-warning {
            background: #f39c12;
            color: white;
        }
        .btn-danger {
            background: #e74c3c;
            color: white;
        }
        .btn-success {
            background: #2ecc71;
            color: white;
        }
        .btn-secondary {
            background: #95a5a6;
            color: white;
        }
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }
        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }
        
        /* Pagination Styles - Improved */
        .pagination {
            margin-top: 2rem;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 0.25rem;
        }
        
        .pagination > * {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            height: 40px;
            padding: 0 0.5rem;
            border: 1px solid #dee2e6;
            background: white;
            color: #3498db;
            text-decoration: none;
            border-radius: 4px;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }
        
        .pagination a:hover {
            background: #e9ecef;
            border-color: #adb5bd;
            color: #2c3e50;
        }
        
        .pagination .active {
            background: #3498db;
            color: white;
            border-color: #3498db;
            font-weight: bold;
        }
        
        .pagination .disabled {
            color: #6c757d;
            pointer-events: none;
            background: #f8f9fa;
            border-color: #dee2e6;
        }
        
        .pagination .dots {
            border: none;
            background: transparent;
            color: #6c757d;
            min-width: auto;
            padding: 0 0.25rem;
        }
        
        .pagination-info {
            text-align: center;
            margin-top: 1rem;
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        nav[role="navigation"] {
            margin-top: 2rem;
        }
        
        nav[role="navigation"] div:first-child {
            display: none; /* Menyembunyikan teks "Showing X to Y of Z results" jika tidak diinginkan */
        }
        
        nav[role="navigation"] div:last-child {
            display: flex;
            justify-content: center;
        }
        
        nav[role="navigation"] svg {
            width: 20px;
            height: 20px;
        }
        
        /* Styling untuk pagination tailwind/laravel default */
        .pagination-links {
            display: flex;
            justify-content: center;
            gap: 0.25rem;
            flex-wrap: wrap;
        }
        
        .pagination-links a,
        .pagination-links span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            height: 40px;
            padding: 0 0.5rem;
            border: 1px solid #dee2e6;
            background: white;
            color: #3498db;
            text-decoration: none;
            border-radius: 4px;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }
        
        .pagination-links span[aria-current="page"] {
            background: #3498db;
            color: white;
            border-color: #3498db;
            font-weight: bold;
        }
        
        .search-box {
            margin-bottom: 1rem;
            display: flex;
            justify-content: flex-end;
        }
        .search-form {
            display: flex;
            gap: 0.5rem;
            max-width: 300px;
        }
        .search-input {
            flex: 1;
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                gap: 1rem;
            }
            .nav-menu {
                flex-wrap: wrap;
                justify-content: center;
            }
            table {
                font-size: 0.9rem;
            }
            th, td {
                padding: 0.75rem;
            }
            .pagination > * {
                min-width: 35px;
                height: 35px;
                font-size: 0.8rem;
            }
        }
        @media (max-width: 480px) {
            .btn {
                display: block;
                width: 100%;
                margin: 0.5rem 0;
                text-align: center;
            }
            .pagination {
                gap: 0.15rem;
            }
            .pagination > * {
                min-width: 32px;
                height: 32px;
                font-size: 0.75rem;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    @if(Auth::check())
    <nav class="navbar">
        <h1 class="navbar-brand">Toko Hanafi</h1>
        <div class="nav-menu">
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.products.index') }}">Produk</a>
                <a href="{{ route('admin.transactions.index') }}">Transaksi</a>
            @else
                <a href="{{ route('customer.transactions.index') }}">Transaksi Saya</a>
                <a href="{{ route('customer.transactions.create') }}">Buat Transaksi</a>
            @endif
            <div class="user-info">
                <span>Halo, {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-logout">Logout</button>
                </form>
            </div>
        </div>
    </nav>
    @endif

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        @yield('content')
    </div>

    @yield('scripts')
</body>
</html>