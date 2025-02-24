<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login() {
        return view('auth.login');
    }

    public function authentication(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if(Auth::user()->role == 'admin') {
                return redirect('/');
            } else {
                return redirect('/cashier');
            }
        }

        return back()->with('email', 'Email atau password salah.');
    }

    public function logout() {
        Auth::logout();
        Session::flush();
        return redirect("/login");
    }
}
