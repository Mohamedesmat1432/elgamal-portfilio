<?php

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use App\Http\Controllers\Pages\{
    CategoryController,
    HomeController,
    DashboardController,
    PermissionController,
    ProfileController,
    RoleController,
    SubcategoryController,
    UserController
};
use App\Http\Controllers\Pages\Trash\{
    CategoryTrashController,
    PermissionTrashController,
    RoleTrashController,
    SubcategoryTrashController,
    UserTrashController
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
            Route::get('categories', CategoryController::class)->name('categories');
            Route::get('subcategories', SubcategoryController::class)->name('subcategories');
            Route::get('profile', ProfileController::class)->name('profile');
            Route::get('trash-permissions', PermissionTrashController::class)->name('trash.permissions');
            Route::get('trash-roles', RoleTrashController::class)->name('trash.roles');
            Route::get('trash-users', UserTrashController::class)->name('trash.users');
            Route::get('trash-categories', CategoryTrashController::class)->name('trash.categories');
            Route::get('trash-subcategories', SubcategoryTrashController::class)->name('trash.subcategories');
        });

        require __DIR__ . '/auth.php';
    });
