<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\MachineNotOwned;
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

    public function registerOwner(Request $request)
    {
        if($request->method() == 'GET')
        {
            return view('auth.register-owner');
        }
        $validated = $request->validate([
            'username_owner' => 'required|min:3|unique:users,username',
            'machineid' => new MachineNotOwned,
            'password_owner' => 'required|min:3',
            'confirm_password_owner' => 'required|same:password_owner'
        ]);
        // dd($validated);
        $user = User::create([
            'username' => $validated['username_owner'],
            'password' => $validated['password_owner'],
            'role' => 'owner',
        ]);
        DB::table('machines')
        ->where('machineid', $validated['machineid'])
        ->update([
            'owner_username' => $validated['username_owner']
        ]);
        dd('successfully registered as owner');
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
