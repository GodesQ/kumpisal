<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\AdminController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\ChurchController;
use App\Http\Controllers\Web\Auth\AdminAuthController;
use App\Http\Controllers\Web\Auth\UserAuthController;
use App\Http\Controllers\Web\ConfessionScheduleController;

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
Route::post('login', [UserAuthController::class, 'saveLogin'])->name('login.user');
Route::post('register', [UserAuthController::class, 'saveRegister'])->name('register.user');
Route::get('/user_verify_email', [UserAuthController::class, 'verifyEmail'])->name('user.verify_email');
Route::post('/resend_email_verification', [UserAuthController::class, 'resendEmailVerification'])->name('user.resend_email_verification')->middleware('auth');

Route::get('/verify_email', [UserAuthController::class, 'verifyEmailMessage'])->name('user.verify_email_message');

Route::get('/', function () {
    return view('user-page.home');
})->name('home');

Route::get('churches', [ChurchController::class, 'searchPage'])->name('churches.searchPage')->middleware('auth', 'auth.user.verify_email');
Route::get('churches/fetch', [ChurchController::class, 'fetchData'])->name('churches.fetchData')->middleware('auth', 'auth.user.verify_email');
Route::get('church/{uuid}/{name}', [ChurchController::class, 'detailPage'])->name('churches.detailPage')->middleware('auth', 'auth.user.verify_email');


Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => ['auth', 'auth.user.verify_email']], function() {
    Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('profile', [UserController::class, 'profile'])->name('profile');
    Route::post('profile/{uuid}', [UserController::class, 'saveProfile'])->name('profile.post');
    Route::post('change_password/{uuid}', [UserController::class, 'changePassword'])->name('change_password.post');
});

Route::post('user/logout', [UserAuthController::class, 'logout'])->name('user.logout')->middleware('auth');

Route::get('admin/login', [AdminAuthController::class, 'login'])->name('admin.login');
Route::post('admin/login', [AdminAuthController::class, 'saveLogin'])->name('admin.post.login');

Route::group(['prefix'=> 'admin', 'as' => 'admin.', 'middleware' => ['auth.admin']], function(){
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::post('/profile/{id}', [AdminController::class, 'saveProfile'])->name('profile.post');
    Route::post('/change_password/{id}', [AdminController::class, 'changePassword'])->name('change_password.post');

    Route::get('/users', [UserController::class, 'lists'])->name('users.list');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/edit/{uuid}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/user/update/{uuid}', [UserController::class, 'update'])->name('user.update');

    Route::get('/churches', [ChurchController::class, 'lists'])->name('churches.list');
    Route::get('/church/create', [ChurchController::class, 'create'])->name('church.create');
    Route::post('/church/store', [ChurchController::class, 'store'])->name('church.store');
    Route::get('/church/edit/{uuid}', [ChurchController::class, 'edit'])->name('church.edit');
    Route::post('/church/update/{uuid}', [ChurchController::class, 'update'])->name('church.update');

    Route::get('/confession_schedules', [ConfessionScheduleController::class, 'lists'])->name('confession_schedules.list');
    Route::get('/confession_schedule/create', [ConfessionScheduleController::class, 'create'])->name('confession_schedule.create');
    Route::post('/confession_schedule/store', [ConfessionScheduleController::class, 'store'])->name('confession_schedule.store');
    Route::get('/confession_schedule/edit/{id}', [ConfessionScheduleController::class, 'edit'])->name('confession_schedule.edit');
    Route::post('/confession_schedule/update/{id}', [ConfessionScheduleController::class, 'update'])->name('confession_schedule.update');

    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
});
