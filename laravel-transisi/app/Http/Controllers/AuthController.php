<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function proses_login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/home');
        } else {
            return redirect('/')->with(['warning' => 'Email / Password Salah']);
        }
    }

    public function proses_logout()
    {
        if (Auth::check()) {
            Auth::logout();
            return redirect('/');
        }
    }
}