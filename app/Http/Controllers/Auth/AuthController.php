<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login (Request $request)
    {
        if($request->method() == 'GET')
        {
            return view('auth.login');
        }


        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'error' => 'Login gagal. silahkan coba lagi',
        ]);
    }

    public function register (Request $request)
    {
        if($request->method() == 'GET')
        {
            return view('auth.register');
        }

        $user = User::create($request->validate([
            'username' => 'required|min:3|unique:users',
            'password' => 'required|min:3',
            'password_confirmation' => 'required|same:password'
        ]));

        auth()->login($user);

        return redirect('dashboard');
    }

    public function logout (Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
