<?php

use App\Livewire\Permissions\PermissionList;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Livewire\Livewire;



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localize', 'localeCookieRedirect', 'localeSessionRedirect', 'localeViewPath', 'localizationRedirect']
    ], function() {

        Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/livewire/update', $handle);
        });

        Route::view('/', 'welcome');

        Route::view('dashboard', 'dashboard')
            ->middleware(['auth', 'verified'])
            ->name('dashboard');

        Route::get('permissions', PermissionList::class)->name('permissions');

        Route::view('profile', 'profile')
            ->middleware(['auth'])
            ->name('profile');

        require __DIR__.'/auth.php';
    });

