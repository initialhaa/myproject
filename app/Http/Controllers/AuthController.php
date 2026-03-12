<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLoginForm(){
        return View('auth.login');
    }

    public function login (Request $request){
        $credential = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        if (Auth::attempt($credential)){
            $request->session()->regenerate();
        }
        if (Auth::user()->role === 'admin'){
            return redirect()->intended('/admin/products');
        }
        else {
            return redirect()->intended('/customer/transactions');
        }
        return back()->with('error!! username atau password');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
