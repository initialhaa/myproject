@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div style="max-width: 400px; margin: 50px auto;">
    <div style="background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <h1 style="margin-bottom: 1.5rem; text-align: center;">Toko Hanafi</h1>
        <h2 style="margin-bottom: 1.5rem; text-align: center;">Login </h2>
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control" value="{{ old('username') }}" required autofocus>
                @error('username')
                    <small style="color: red;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
                @error('password')
                    <small style="color: red;">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;">Login</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
@if(session('error'))
<script>
    alert('{{ session('error') }}');
</script>
@endif

@if($errors->any())
<script>
    alert('Login gagal: {{ $errors->first() }}');
</script>
@endif
@endsection