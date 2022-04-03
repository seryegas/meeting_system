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
        return redirect(route('home'));
    }
});