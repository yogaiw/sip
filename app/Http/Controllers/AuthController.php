<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function registerIndex() {
        return view('register',[
            'dosen' => User::where('role', 2)->get()
        ]);
    }

    public function registerStudent(Request $request) {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
            'nim' => 'required',
            'name' => 'required',
            'email' => 'required',
        ]);

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'role' => 1
        ]);

        Student::create([
            'user_id' => $user->id,
            'nim' => $request->nim,
            'name' => $request->name,
            'email' => $request->email,
            'pembimbing1_id' => $request->pembimbing1,
            'pembimbing2_id' => $request->pembimbing2,
            'penguji_id' => $request->penguji
        ]);

        return redirect()->route('home');
    }
}
