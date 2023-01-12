<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function changeUsername(Request $request) {
        $request->validate([
            'username' => 'required|unique:users,username'
        ]);

        $user = User::find(Auth::user()->id);
        $user->username = $request->username;
        $user->save();

        return back()->with('success_edit_profile', 'Username berhasil diubah');
    }

    public function changePassword(Request $request) {
        $request->validate([
            'oldPassword' => 'required|current_password:web',
            'newPassword' => 'required|confirmed|min:8'
        ]);

        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->newPassword);
        $user->save();

        return back()->with('success_edit_profile', 'Password berhasil diubah');
    }
}
