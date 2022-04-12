<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'welcome')->middleware('auth')->name('home');

Route::controller(RegistrationController::class)->group(function () {
    Route::get('/reg', 'index')->name('reg');
    Route::post('/reg', 'store');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'login');
});

Route::get('/logout', function() {
    if (Auth::check())
    {
        Auth::logout();
        return redirect(route('login'));
    }
});

Route::get('/profile', function() {
    if (Auth::check())
    {
        return view('profile.profile');
    }
    return redirect(route('login'));
})->name('profile');

Route::get('/work_with_employees', function() {
    if (Auth::check())
    {
        return view('profile.work_with_employees');
    }
    return redirect(route('login'));
})->name('wwe');

Route::get('/work_with_company', function() {
    if (Auth::check())
    {
        return view('profile.work_with_company');
    }
    return redirect(route('login'));
})->name('wwc');

Route::get('/meetings', function() {
    if (Auth::check())
    {
        return view('profile.meetings');
    }
    return redirect(route('login'));
})->name('meetings');

Route::get('/tasks', function() {
    if (Auth::check())
    {
        return view('profile.tasks');
    }
    return redirect(route('login'));
})->name('tasks');

Route::get('/archive', function() {
    if (Auth::check())
    {
        return view('profile.archive');
    }
    return redirect(route('login'));
})->name('archive');