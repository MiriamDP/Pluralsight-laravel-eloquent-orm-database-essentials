<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login() {
        if (Auth::user()) {
            return redirect(route('home'));
        } else {
            return view('auth.login');
        }
    }

    public function loginHandler(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('home'));
        } else {
            return redirect(route('login'))
                ->with('error', 'Invalid login');
        }
    }

    public function logout() {
        Auth::logout();
        return redirect(route('home'));
    }
}
