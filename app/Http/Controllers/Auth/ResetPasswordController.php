<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function forgot()
    {
        return view('dashboard.auth.forgot-password');
    }

    public function email(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status = Password::ResetLinkSent ? back()->with(['status'=> __($status)]) : back()->withErrors(['email' => __($status)]);
    }

    public function reset($token)
    {
        return view('dashboard.auth.reset-password', ['token' => $token]);
    }
    
    public function update(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $status = Password::reset(
    $request->only('email', 'password', 'password_confirmation', 'token'),
    function (User $user, string  $password)  {
                    $user->forceFill([
                        'password' => Hash::make($password),
                    ])->setRememberToken(Str::random(60));

                    $user->save();

                    event(new PasswordReset($user));
            }
        );

        return $status == Password::PasswordReset ? redirect()->route('login')->with(['status' => __($status)]) : back()->withErrors(['email' => [__($status)]]);
    }
}
