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
use App\Http\Controllers\Web\RoleController;
use App\Http\Controllers\Web\PermissionController;
use App\Http\Controllers\Web\SaveChurchController;
use App\Http\Controllers\Web\ForgotPasswordController;

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

Route::get('forgot-password', [ForgotPasswordController::class, 'forgot_password'])->name('user.forgot_password');
Route::post('forgot-password', [ForgotPasswordController::class, 'post_forgot_password'])->name('user.forgot_password.post');
Route::get('forgot-password/message', [ForgotPasswordController::class, 'message'])->name('user.forgot_password.message');
Route::get('reset-password-form', [ForgotPasswordController::class, 'reset_password_form'])->name('user.reset_password_form');
Route::post('reset-password-form', [ForgotPasswordController::class, 'post_reset_password_form'])->name('user.reset_password_form.post');

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

Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => ['auth', 'auth.user.verify_email', 'auth.user']], function() {
    Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('profile', [UserController::class, 'profile'])->name('profile');
    Route::post('profile/{uuid}', [UserController::class, 'saveProfile'])->name('profile.post');
    Route::post('change_password/{uuid}', [UserController::class, 'changePassword'])->name('change_password.post');

    Route::post('save-church', [SaveChurchController::class, 'save_church'])->name('save_church');

    Route::get('saved-churches/list', [SaveChurchController::class, 'user_list'])->name('saved_churches.list');
});

Route::group(['prefix' => 'representative', 'as' => 'representative.', 'middleware' => ['auth', 'auth.user.verify_email', 'auth.representative']], function() {
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

Route::group(['prefix'=> 'admin', 'as' => 'admin.', 'middleware' => ['auth.admin', 'auth:admin']], function(){
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::post('/profile/{id}', [AdminController::class, 'saveProfile'])->name('profile.post');
    Route::post('/change_password/{id}', [AdminController::class, 'changePassword'])->name('change_password.post');

    Route::get('/users', [UserController::class, 'lists'])->name('users.list')->middleware('can:view_users_list');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create')->middleware('can:create_user');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store')->middleware('can:create_user');
    Route::get('/user/edit/{uuid}', [UserController::class, 'edit'])->name('user.edit')->middleware('can:edit_user');
    Route::post('/user/update/{uuid}', [UserController::class, 'update'])->name('user.update')->middleware('can:edit_user');
    Route::delete('/user/delete', [UserController::class, 'delete'])->name('user.delete')->middleware('can:delete_user');

    Route::get('/representatives', [RepresentativeController::class, 'lists'])->name('representatives.list')->middleware('can:view_representatives_list');
    Route::get('/representative/create', [RepresentativeController::class, 'create'])->name('representative.create')->middleware('can:create_representative');
    Route::post('/representative/store', [RepresentativeController::class, 'store'])->name('representative.store')->middleware('can:create_representative');
    Route::get('/representative/edit/{id}', [RepresentativeController::class, 'edit'])->name('representative.edit')->middleware('can:edit_representative');
    Route::post('/representative/update/{id}', [RepresentativeController::class, 'update'])->name('representative.update')->middleware('can:edit_representative');
    Route::delete('/representative/delete', [RepresentativeController::class, 'delete'])->name('representative.delete')->middleware('can:delete_representative');

    Route::get('/churches', [ChurchController::class, 'lists'])->name('churches.list')->middleware('can:view_churches_list');
    Route::get('/church/create', [ChurchController::class, 'create'])->name('church.create')->middleware('can:create_church');
    Route::post('/church/store', [ChurchController::class, 'store'])->name('church.store')->middleware('can:create_church');
    Route::get('/church/edit/{uuid}', [ChurchController::class, 'edit'])->name('church.edit')->middleware('can:edit_church');
    Route::post('/church/update/{uuid}', [ChurchController::class, 'update'])->name('church.update')->middleware('can:edit_church');

    Route::get('/confession_schedules', [ConfessionScheduleController::class, 'lists'])->name('confession_schedules.list');
    Route::get('/confession_schedule/create', [ConfessionScheduleController::class, 'create'])->name('confession_schedule.create');
    Route::post('/confession_schedule/store', [ConfessionScheduleController::class, 'store'])->name('confession_schedule.store');
    Route::get('/confession_schedule/edit/{id}', [ConfessionScheduleController::class, 'edit'])->name('confession_schedule.edit');
    Route::post('/confession_schedule/update/{id}', [ConfessionScheduleController::class, 'update'])->name('confession_schedule.update');

    Route::get('/admins', [AdminController::class, 'lists'])->name('admins.list');
    Route::get('/create', [AdminController::class, 'create'])->name('create');
    Route::post('/store', [AdminController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [AdminController::class, 'update'])->name('update');

    Route::get('/roles', [RoleController::class, 'lists'])->name('roles.list');
    Route::get('/role/create', [RoleController::class, 'create'])->name('role.create');
    Route::post('/role/store', [RoleController::class, 'store'])->name('role.store');
    Route::get('/role/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
    Route::post('/role/update/{id}', [RoleController::class, 'update'])->name('role.update');

    Route::get('/permissions', [PermissionController::class, 'lists'])->name('permissions.list');
    Route::get('/permission/create', [PermissionController::class, 'create'])->name('permission.create');
    Route::post('/permission/store', [PermissionController::class, 'store'])->name('permission.store');
    Route::get('/permission/edit/{id}', [PermissionController::class, 'edit'])->name('permission.edit');
    Route::post('/permission/update/{id}', [PermissionController::class, 'update'])->name('permission.update');

    Route::get('/contact_messages', [ContactMessageController::class, 'lists'])->name('contact_messages.list');
    Route::get('/contact_message/show/{id}', [ContactMessageController::class, 'show'])->name('contact_message.show');

    Route::get('/logs', [AdminLogController::class, 'lists'])->name('logs.list');
    Route::get('/log/show/{id}', [AdminLogController::class, 'show'])->name('log.show');

    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
});
