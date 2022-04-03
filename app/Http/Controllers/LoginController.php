<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check())
        {
            return redirect(route('home'));
        }
        return view('login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::check())
        {
            return redirect(route('home'));
        }

        if (Auth::attempt($data))
        {
            return redirect()->intended('/');
        }
        
        return redirect(route('login'))->withErrors([
            'logError' => 'Неверные логин или пароль'
        ]);
    }
}
