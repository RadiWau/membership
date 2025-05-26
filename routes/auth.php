<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

// Route::get('/login', [LoginController::class, 'index'])->name('auth.action.login');
Route::post('act_login', [LoginController::class, 'action_login'])->name('auth.action.login');
Route::get('act_logout', [LoginController::class, 'action_logout'])->name('auth.action.logout');
