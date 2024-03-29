<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SolutionController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminAccess;
use App\Models\Notification;
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



Route::get('/archive', function() {
    if (Auth::check())
    {
        return view('profile.archive');
    }
    return redirect(route('login'));
})->name('archive');

Route::middleware([Auth::class])->group(function () {

});


Route::get('/work_with_company', [CompanyController::class, 'GetInfoAboutCompany'])->middleware('auth')->name('wwc');
Route::get('/make_secretary', [CompanyController::class, 'GetSecretary'])->middleware('auth', 'admin')->name('make_secretary');
Route::post('/make_secretary', [CompanyController::class, 'StoreNewSecretary'])->middleware('auth', 'admin')->name('store_secretary');

Route::get('/create_employee', [UserController::class, 'create'])->middleware('auth', 'admin')->name('create_employee');
Route::post('/create_employee', [UserController::class, 'store'])->middleware('auth', 'admin')->name('store_employee');
Route::get('/work_with_employees', [UserController::class, 'index'])->middleware('auth')->name('wwe');
Route::get('/profile/{id}', [UserController::class, 'show'])->middleware('auth')->name('profile');
Route::get('/edit/{id}', [UserController::class, 'edit'])->middleware('auth', 'admin')->name('profile_edit');
Route::put('/edit_user', [UserController::class, 'update'])->middleware('auth', 'admin')->name('update_user');
Route::get('/newpassword/{id}', [UserController::class, 'ResetPassword'])->middleware('auth', 'admin')->name('new_password');

Route::get('/meetings', [MeetingController::class, 'index'])->middleware('auth')->name('meetings');

Route::get('/create_meeting', [MeetingController::class, 'create'])->middleware('auth', 'admin')->name('create_meeting');
Route::post('/create_meeting', [MeetingController::class, 'store'])->middleware('auth', 'admin')->name('store_meeting');
Route::get('/meeting/{id}', [MeetingController::class, 'show'])->middleware('auth')->name('show_meeting');
Route::get('/change_meeting_status/{id}/{type}',[MeetingController::class, 'change_status'])->middleware('auth', 'admin')->name('change_status');
Route::delete('/meeting/{id}', [MeetingController::class, 'destroy'])->middleware('auth', 'admin')->name('delete_meeting');

Route::get('/question/{id}',[QuestionController::class, 'show'])->middleware('auth')->name('show_question');
Route::post('/question',[QuestionController::class, 'store'])->middleware('auth', 'admin')->name('store_question');
Route::put('/edit', [QuestionController::class, 'update'])->middleware('auth', 'admin')->name('update_question');
Route::delete('/question/{id}', [QuestionController::class, 'destroy'])->middleware('auth', 'admin')->name('delete_question');

Route::post('/solution',[SolutionController::class, 'store'])->middleware('auth', 'admin')->name('store_solution');
Route::delete('/solution/{id}', [SolutionController::class, 'destroy'])->middleware('auth', 'admin')->name('delete_solution');

Route::get('/protocol/{id}',[DocumentController::class, 'create_protocol'])->middleware('auth')->name('get_protocol');
Route::get('/botd/{id}',[DocumentController::class, 'create_business_of_the_day'])->middleware('auth')->name('get_botd');

Route::get('/notifications', [NotificationController::class, 'index'])->middleware('auth')->name('show_notes');
Route::post('/change_note_status/{id}', [NotificationController::class, 'change_status'])->middleware('auth')->name('change_note_status');
Route::delete('/note_delete/{id}', [NotificationController::class, 'destroy'])->middleware('auth')->name('delete_note');
Route::delete('/clear_notes_list', [NotificationController::class, 'destroy_all'])->middleware('auth')->name('delete_all_notes');

Route::get('/tasks', [TaskController::class, 'index'])->middleware('auth')->name('tasks');
Route::post('/change_task_status/{id}/{type}', [TaskController::class, 'change_status'])->middleware('auth')->name('accept_task');
Route::get('/create_task', [TaskController::class, 'create'])->middleware('auth', 'admin')->name('create_task');
Route::post('/create_task', [TaskController::class, 'store'])->middleware('auth', 'admin')->name('store_task');
Route::get('/get_task_help_file/{id}', [TaskController::class, 'download_file'])->middleware('auth')->name('get_task_help_file');
Route::get('/tasks_on_check',[TaskController::class, 'index_check'])->middleware('auth', 'admin')->name('show_tasks_on_check');
Route::delete('/delete_task/{id}',[TaskController::class, 'destroy'])->middleware('auth', 'admin')->name('close_task');
