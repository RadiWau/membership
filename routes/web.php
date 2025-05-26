<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrasiController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Member\UserController;
use App\Http\Controllers\Member\MemberController;
use App\Http\Controllers\GeneralController;
use Illuminate\Support\Facades\Route;


Route::get('/', [LoginController::class, 'index'])->name('login');
Route::get('/logout', [LoginController::class, 'actionLogout'])->name('auth.logout');
Route::get('/register', [RegistrasiController::class, 'index'])->name('auth.regis');
Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->name('auth.forgot');
Route::get('/form-forgot-password/{code}', [ForgotPasswordController::class, 'formForgotPassword'])->name('auth.form-forgot');
Route::post('action/login', [LoginController::class, 'actionLogin'])->name('auth.action.login');
Route::post('action/register', [RegistrasiController::class, 'action_registrasi'])->name('auth.action.register');
Route::post('action/forgot', [ForgotPasswordController::class, 'actionForget'])->name('auth.action.forgot.password');
Route::post('action/form-forgot-password', [ForgotPasswordController::class, 'actionFormForgetPassword'])->name('auth.action.form.forgot.password');

Route::get('/testEmail', [RegistrasiController::class, 'TestEmail']);


// GENERAL AKSES
Route::post('provinsi',  [GeneralController::class, 'getProvinsi'])->name('data.provinsi');
Route::post('kabupaten',  [GeneralController::class, 'getKabupaten'])->name('data.kabupaten');
Route::post('Kecamatan',  [GeneralController::class, 'getKecamatan'])->name('data.kecamatan');
Route::post('Kelurahan',  [GeneralController::class, 'getKelurahan'])->name('data.kelurahan');
Route::post('bank',  [GeneralController::class, 'getBank'])->name('data.bank');

// HOME
Route::get('dashboard',  [DashboardController::class, 'DashboardPage']);
Route::get('member',  [MemberController::class, 'index']);
Route::post('topup_gold',  [MemberController::class, 'topupGold'])->name('member.topup');
Route::get('/referal/{id}',  [RegistrasiController::class, 'regisReferal']);
Route::get('/profile/{id}',  [UserController::class, 'Profile']);
Route::post('/profile/check_password',  [UserController::class, 'checkPassword'])->name('profile.action.cek.password');
Route::post('/profile/action_password',  [UserController::class, 'actionPassword'])->name('profile.action.ganti.password');



