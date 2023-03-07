<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthenticationController extends Controller
{
    // Login
    public function loginForm()
    {
        return view('auth/login');
    }

    public function login(Request $request)
    {
        if(Auth::attempt($request->only('email','password')))
        {
            return redirect('/');
        }

        return \redirect('login');      
    }

    // Register
    public function registerForm() {
        return view('auth/register');
    }

    public function register(Request $request) {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect('/login');
    }

    // Logout
    public function logout(Request $request) {
        Auth::logout();
        return \redirect('login');
    }
}
