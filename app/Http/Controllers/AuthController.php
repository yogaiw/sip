<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginPage() {
        return view('login');
    }

    public function authenticate(Request $request) {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if(Auth::user()->role == 1) {
                return redirect()->intended(route('dashboard.student'));
            } else if(Auth::user()->role == 2) {
                return redirect()->intended(route('dashboard.lecturer'));
            }
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout() {
        Auth::logout();

        return redirect('/');
    }
}
