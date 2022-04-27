<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;
use App\Models\Question;
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
})->name('logout');

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

Route::get('/work_with_company', [CompanyController::class, 'GetInfoAboutCompany'])->name('wwc');
Route::get('/make_secretary', [CompanyController::class, 'GetSecretary'])->name('make_secretary');
Route::post('/make_secretary', [CompanyController::class, 'StoreNewSecretary'])->name('store_secretary');

Route::get('/create_employee', [UserController::class, 'create'])->middleware('auth')->name('create_employee');
Route::post('/create_employee', [UserController::class, 'store'])->middleware('auth')->name('store_employee');
Route::get('/work_with_employees', [UserController::class, 'index'])->middleware('auth')->name('wwe');
Route::get('/profile/{id}', [UserController::class, 'show'])->middleware('auth')->name('profile');
Route::get('/edit/{id}', [UserController::class, 'edit'])->middleware('auth')->name('profile_edit');
Route::put('/edit', [UserController::class, 'update'])->middleware('auth')->name('update_user');
Route::get('/newpassword/{id}', [UserController::class, 'ResetPassword'])->middleware('auth')->name('new_password');

Route::get('/meetings', [MeetingController::class, 'index'])->middleware('auth')->name('meetings');
Route::get('/create_meeting', [MeetingController::class, 'create'])->middleware('auth')->name('create_meeting');
Route::post('/create_meeting', [MeetingController::class, 'store'])->middleware('auth')->name('store_meeting');
Route::get('/meeting/{id}', [MeetingController::class, 'show'])->middleware('auth')->name('show_meeting');
Route::get('/change_meeting_status/{id}/{type}',[MeetingController::class, 'change_status'])->middleware('auth')->name('change_status');

Route::post('/question',[QuestionController::class, 'store'])->middleware('auth')->name('store_question');
Route::delete('/question/{id}', [QuestionController::class, 'destroy'])->middleware('auth')->name('delete_question');

