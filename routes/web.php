<?php

use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminTeamController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\WaitingListController;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\StatusController;
use App\Http\Middleware\AdminAuth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [LandingController::class, 'index'])->name('landing');

Route::get('/competition/{slug}', [CompetitionController::class, 'show'])->name('competition.show');

Route::get('/register', [RegistrationController::class, 'create'])->name('register');
Route::post('/register', [RegistrationController::class, 'store'])->name('register.store');
Route::get('/register/success/{code}', [RegistrationController::class, 'success'])->name('register.success');

Route::get('/status', [StatusController::class, 'index'])->name('status');
Route::post('/status', [StatusController::class, 'search'])->name('status.search');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {
    // Auth
    Route::get('/login', [AdminLoginController::class, 'showForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');

    // Protected
    Route::middleware(AdminAuth::class)->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/teams', [AdminTeamController::class, 'index'])->name('teams.index');
        Route::get('/teams/{id}', [AdminTeamController::class, 'show'])->name('teams.show');
        Route::post('/teams/{id}/approve', [AdminTeamController::class, 'approve'])->name('teams.approve');
        Route::post('/teams/{id}/reject', [AdminTeamController::class, 'reject'])->name('teams.reject');
        Route::get('/teams/{id}/download/{type}', [AdminTeamController::class, 'downloadFile'])->name('teams.download');

        Route::get('/waiting-list', [WaitingListController::class, 'index'])->name('waiting-list');
        Route::post('/waiting-list/{id}/promote', [WaitingListController::class, 'promote'])->name('waiting-list.promote');
    });
});
