<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth/register');
    }

    public function registerSave(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ])->validate();

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login');
    }

    public function login()
    {
        return view('auth/login');
    }


    public function loginAction(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $user = User::where('email', $request->email)->first();

        if ($user && $user->userCanLogin()) {
            if (Auth::attempt($credentials, $request->boolean('remember'))) {
                $request->session()->regenerate();

                // Remove the remember_token from the user object if remember me was not selected
                if (!$request->boolean('remember')) {
                    Auth::user()->setRememberToken(null);
                    Auth::user()->save();
                }

                // Redirect to the dashboard based on the user's role
                if ($user->role === 'Admin') {
                    return redirect()->route('adminDashboard');
                } else if ($user->role === 'Cashier') {
                    return redirect()->route('cashierDashboard');
                } else {
                    return redirect()->route('kitchenDashboard');
                }
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        return redirect('/login');
    }

    public function profile()
    {
        return view('profile');
    }
}