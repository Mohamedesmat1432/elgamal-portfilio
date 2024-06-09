<?php

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use App\Http\Controllers\Pages\{
    HomeController, 
    DashboardController, 
    PermissionController, 
    ProfileController, 
    RoleController, 
    UserController
};

Route::prefix(LaravelLocalization::setLocale())
    ->middleware(['web', 'localize', 'localeCookieRedirect', 'localeSessionRedirect', 'localeViewPath', 'localizationRedirect'])
    ->group(function () {
        
        Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/livewire/update', $handle);
        });

        Route::get('/', HomeController::class)->name('home');

        Route::group(['middleware' => ['auth', 'verified']], function () {
            Route::get('dashboard', DashboardController::class)->name('dashboard');
            Route::get('permissions', PermissionController::class)->name('permissions');
            Route::get('roles', RoleController::class)->name('roles');
            Route::get('users', UserController::class)->name('users');
            Route::get('profile', ProfileController::class)->name('profile');
        });

        require __DIR__ . '/auth.php';
    });
