<?php

use App\Http\Controllers\Administrator\Auth\LoginController;
use App\Http\Controllers\Administrator\Dashboard\DashboardController;
use App\Http\Controllers\Administrator\Member\MemberController;
use App\Http\Controllers\Administrator\User\UserController;
use App\Http\Controllers\Administrator\Role\RoleController;
use App\Http\Controllers\Administrator\Laporan\LaporanController;
use Illuminate\Support\Facades\Route;


Route::get('/admin/login', [LoginController::class, 'index'])->name('admin.login');
Route::post('/admin/action_login', [LoginController::class, 'actionLogin'])->name('admin.action.login'); // action logout
Route::get('/admin/logout', [LoginController::class, 'actionLogout'])->name('admin.logout'); // action logout

Route::prefix('admin')->group(function () {

    // DASHBOARD
    Route::group(['prefix' => 'dashboard'], function () {
        // VIEW
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('/summary_box', [DashboardController::class, 'countMemberPaket'])->name('dashboard.count.paket.member');


    });

    // MEMBER
    Route::group(['prefix' => 'member'], function () {
        // VIEW
        Route::get('/', [MemberController::class, 'index'])->name('member.index');
        Route::get('/count_mamber', [MemberController::class, 'countMemberPaket'])->name('member.count.paket.member');
        Route::get('/detil_member/{member}', [MemberController::class, 'detilMember'])->name('member.detil');
        Route::get('/lihat_topup/{user}/{paket}/', [MemberController::class, 'showTopUp'])->name('member.view.topup');
        
        Route::post('/action_validate_topup', [MemberController::class, 'actionTopup'])->name('member.action.toptup');
        Route::post('/action_input_memeber_card', [MemberController::class, 'actionMemberCard'])->name('member.action.member.card');
        Route::post('/action_ganti_password', [MemberController::class, 'actionGantiPassword'])->name('member.action.ganti.password');
        Route::post('/list_member', [MemberController::class, 'showAll'])->name('member.list');
        
    });

    // USER
    Route::group(['prefix' => 'user'], function () {
        // VIEW
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        
        // PROCESS
        // Route::post('/showAll', [UserManagementController::class, 'showAll'])->name('apps.users.show.all');
    });

    // ROLE
    Route::group(['prefix' => 'role'], function () {
        // VIEW
        Route::get('/', [RoleController::class, 'index'])->name('role.index');
        
        // PROCESS
        // Route::post('/showAll', [UserManagementController::class, 'showAll'])->name('apps.users.show.all');
    });

    
    // LAPORAN
    Route::group(['prefix' => 'laporan'], function () {
        // VIEW
        Route::get('/', [LaporanController::class, 'index'])->name('laporan.index');
        
        // PROCESS
        // Route::post('/showAll', [UserManagementController::class, 'showAll'])->name('apps.users.show.all');
    });


   
});



