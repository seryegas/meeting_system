<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Industry;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function index()
    {
        if (Auth::check())
        {
            return redirect(route('home'));
        }
        $industryList = Industry::all();
        return view('registration', compact('industryList'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:150',
            'email' => 'required|min:6|max:50',
            'password' => 'required|min:5',
            'company_name' => 'required',
            'industry_type' => 'required'
        ]);
        if (User::where('email', $request->input('email'))->exists())
        {
            return redirect(route('reg'))->withErrors([
                'any' => 'Эта почта занята'
            ]);
        }

        if ($request->input('password') != $request->input('password_confirm'))
        {
            return redirect(route('reg'))->withErrors([
                'any' => 'Пароли не совпадают'
            ]);
        }

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'user_role' => 3,
            'user_profession' => 'Руководитель компании',
            'company_id' => 0,
        ]);
        if ($user)
        {
            Auth::login($user);
            $company = Company::create([
                'company_name' => $validatedData['company_name'],
                'industry_id' => $validatedData['industry_type'],
                'supervisor_id' => $user->id,
                'secretary_id' => 0
            ]);
            $user->update(['company_id' => $company->id]);
            $user->SetSessionData();
            return redirect(route('profile', $user->id));
        }

        return redirect(route('reg'))->withErrors([
            'any' => 'Произошла ошибка при регистрации пользователя'
        ]);
    }
}
