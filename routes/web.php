<?php

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use App\Http\Controllers\Pages\{
    HomeController,
    DashboardController,
    PermissionController,
    ProfileController
};



Route::group([
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localize', 'localeCookieRedirect', 'localeSessionRedirect', 'localeViewPath', 'localizationRedirect']
    ], function() {

        Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/livewire/update', $handle);
        });

        Route::get('/', [HomeController::class, 'index'])->name('home');

        Route::group(['middleware' => ['auth', 'verified']], function() {
            Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
            Route::get('permissions', [PermissionController::class, 'index'])->name('permissions');
            Route::get('profile', [ProfileController::class, 'index'])->name('profile');
        });

        require __DIR__.'/auth.php';
    });

