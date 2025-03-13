<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    function login() 
    {
        return view('dashboard.auth.login');
    }

    function store(Request $request)
    {
        // login user using email or username or phone
        $credentials = $request->validate([
            'user' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->user)
            ->orWhere('username', $request->user)
            ->orWhere('phone', $request->user)
            ->first();

        if (!$user) {
            return back()->withErrors([
                'user' => 'The provided credentials do not match our records.',
            ])->onlyInput('user');
        }else{
            if(Hash::check($user->password, $request->password)){
                Auth::login($user, $request->remember);
                return redirect()->intended('admin.index');
            }else {
                return back()->withErrors([
                    'password' => 'The provided credentials do not match our records.',
                ])->onlyInput('password');
            }
        }
    }

    function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
