<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    //
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate(['username' => 'required', 'password' => 'required']);

        if (Auth::attempt($credentials)) {
            if (Auth::user()->status !== 'active') {
                Auth::logout();
                return back()->withErrors(['username' => 'Your account is not active.']);
            }
            $request->session()->regenerate();
            switch (Auth::user()->role) {
                case 'admin':
                    return redirect()->intended('/admin');
                case 'pembina':
                    return redirect()->intended('/pembina');
                default:
                    Auth::logout();
                    return back()->withErrors(['username' => 'Invalid role.']);
            }
        }

        return back()->withErrors(['username' => 'Invalid credentials.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
