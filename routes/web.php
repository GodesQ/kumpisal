<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Web\AdminController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\ChurchController;
use App\Http\Controllers\Web\Auth\AdminAuthController;
use App\Http\Controllers\Web\Auth\UserAuthController;
use App\Http\Controllers\Web\ConfessionScheduleController;
use App\Http\Controllers\Web\RepresentativeController;
use App\Http\Controllers\Web\ContactMessageController;
use App\Http\Controllers\Web\AdminLogController;

use App\Models\Church;
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

Route::get('about-us', function() {
    return view('user-page.misc.about-us');
})->name('about-us');

Route::get('contact-us', function() {
    return view('user-page.misc.contact-us');
})->name('contact-us');

Route::post('/contact-message/store', [ContactMessageController::class, 'store'])->name('contact-message.store');


Route::post('/resend_email_verification', [UserAuthController::class, 'resendEmailVerification'])->name('user.resend_email_verification')->middleware('auth');
Route::get('/verify_email', [UserAuthController::class, 'verifyEmailMessage'])->name('user.verify_email_message');

Route::get('/', function () {
    $user = Auth::user();
    $near_churches = Church::select('*')
    ->active(1)
    ->when(optional($user)->latitude and optional($user)->longitude && optional($user)->address, function ($q) use ($user) {
        return $q->addSelect(DB::raw('6371 * acos(cos(radians(' . $user->latitude ."))
                * cos(radians(churches.latitude)) * cos(radians(churches.longitude) - radians(" .  $user->longitude . ")) + sin(radians(" .  $user->latitude . "))
                * sin(radians(churches.latitude))) AS distance"))
            ->having('distance', '<=', '2')
            ->orderBy('distance', 'asc');
    })
    ->latest()
    ->limit(8)
    ->get();
    return view('user-page.home', compact('near_churches'));

})->name('home');

Route::get('churches', [ChurchController::class, 'searchPage'])->name('churches.searchPage');
Route::get('churches/fetch', [ChurchController::class, 'fetchData'])->name('churches.fetchData');
Route::get('church/{uuid}/{name}', [ChurchController::class, 'detailPage'])->name('churches.detailPage');

Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => ['auth', 'auth.user.verify_email']], function() {
    Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('profile', [UserController::class, 'profile'])->name('profile');
    Route::post('profile/{uuid}', [UserController::class, 'saveProfile'])->name('profile.post');
    Route::post('change_password/{uuid}', [UserController::class, 'changePassword'])->name('change_password.post');
});

Route::group(['prefix' => 'representative', 'as' => 'representative.', 'middleware' => ['auth', 'auth.user.verify_email']], function() {
    Route::get('dashboard', [RepresentativeController::class, 'dashboard'])->name('dashboard');
    Route::get('profile', [RepresentativeController::class, 'profile'])->name('profile');
    Route::post('profile/{id}', [RepresentativeController::class, 'saveProfile'])->name('profile.post');

    Route::get('church-profile/{uuid}', [ChurchController::class, 'churchProfile'])->name('church_profile');
    Route::post('church-profile/{uuid}', [ChurchController::class, 'saveChurchProfile'])->name('church_profile.post');

    Route::post('change_password/{uuid}', [RepresentativeController::class, 'changePassword'])->name('change_password.post');
    Route::post('save_schedule', [ConfessionScheduleController::class, 'save_schedule'])->name('save_schedule');
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

    Route::get('/representatives', [RepresentativeController::class, 'lists'])->name('representatives.list');
    Route::get('/representative/create', [RepresentativeController::class, 'create'])->name('representative.create');
    Route::post('/representative/store', [RepresentativeController::class, 'store'])->name('representative.store');
    Route::get('/representative/edit/{id}', [RepresentativeController::class, 'edit'])->name('representative.edit');
    Route::post('/representative/update/{id}', [RepresentativeController::class, 'update'])->name('representative.update');

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

    Route::get('/contact_messages', [ContactMessageController::class, 'lists'])->name('contact_messages.list');
    Route::get('/contact_message/show/{id}', [ContactMessageController::class, 'show'])->name('contact_message.show');

    Route::get('/logs', [AdminLogController::class, 'lists'])->name('logs.list');

    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
});
