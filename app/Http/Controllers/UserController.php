<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('company_id', session('company_id'))->get();
        return view('profile.work_with_employees',compact('users'));
    }

    public function create()
    {
        return view('profile.create_employee');
    }

    public function show($user_id)
    {
        $user = User::find($user_id);
        $path = Storage::path('public/images/');
        return view('profile.profile', compact('user', 'path'));
    }

    public function edit($user_id)
    {
        $user = User::find($user_id);
        $path = Storage::path('public/images/');
        return view('profile.profile_edit', compact('user', 'path'));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:150',
            'email' => 'required|min:6|max:50',
            'profession' => 'required|min:6|max:50',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
        ]);
        $user = User::find($request->get('id'));
        if ($request->hasFile('image'))
        {
            $request->file('image')->storeAs('public/images/', $request->get('id') . '.jpg');
            $user->update([
                'user_avatar' => 1,
            ]);
        }
        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'user_profession' => $validatedData['profession']
        ]);
        return redirect(route('profile_edit', $user->id))->with('success', 'Данные изменены');
    }

    public function ResetPassword($user_id)
    {
        $user = User::find($user_id);
        $newPassword = self::GeneratePassword();
        $user->update(['password' => Hash::make($newPassword)]);
        $message = 'Новый пароль сотрудника ' . $user->name . ': ' . $newPassword;
        return redirect(route('profile_edit', $user_id))->with('success', $message);
    }

    public static function GeneratePassword()
    {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        return substr(str_shuffle($permitted_chars), 0, 5);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:150',
            'email' => 'required|min:6|max:50',
            'profession' => 'required|min:2|max:50'
        ]);
        $password = self::GeneratePassword();
        if (User::where('email', $request->input('email'))->exists())
        {
            return redirect(route('create_employee'))->withErrors([
                'any' => 'Эта почта занята'
            ]);
        }
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($password),
            'user_role' => 1,
            'user_profession' => $validatedData['profession'],
            'company_id' => session('company_id'),
        ]);
        if (!$user)
        {
            return redirect(route('create_employee'))->withErrors([
                'any' => 'Произошла ошибка при регистрации пользователя'
            ]);        
        }
        $message = 'Добавлен сотрудник: ' . $validatedData['email'] . ' Пароль: ' . $password;
        return redirect(route('create_employee'))->with('success', $message);
    }
}
