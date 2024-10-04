<?php

use App\Http\Controllers\dashboard\CategoriesController;
use App\Http\Controllers\dashboard\ProductsController;
use App\Http\Controllers\dashboard\ProfileController;
use App\Http\Controllers\dashboard\RoleController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\CheckUserType;
use Illuminate\Support\Facades\Route;




Route::group([
    'middleware' => ['auth:admin,web'],
    'verified',
    'as' => 'dashboard.',
    'prefix' => 'admin/dashboard'
], function () {

    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::get('/categories.trash', [CategoriesController::class, 'trash'])
        ->name('categories.trash');

    Route::put('/categories.restore/{id}', [CategoriesController::class, 'restore'])
        ->name('categories.restore');
    Route::delete('/categories.forceDelete', [CategoriesController::class, 'forceDelete'])
        ->name('categories.forceDelete');


    Route::resource('/categories', CategoriesController::class);
    Route::resource('/products', ProductsController::class);
    Route::resource('/roles', RoleController::class);
});
