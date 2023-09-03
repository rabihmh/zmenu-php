<?php

use App\Http\Controllers\TenantAdmin\CategoriesController;
use App\Http\Controllers\TenantAdmin\HomeController;
use App\Http\Controllers\TenantAdmin\ProductsController;
use App\Http\Controllers\TenantAdmin\RestaurantController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['auth:web', 'ensure.restaurant'], 'as' => 'tenant.admin.'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::group(['prefix' => 'restaurant', 'as' => 'restaurant.'], function () {
        Route::get('/', [RestaurantController::class, 'show'])->name('show');
        Route::get('create', [RestaurantController::class, 'create'])->name('create');
        Route::post('store', [RestaurantController::class, 'store'])->name('store');
    });
    Route::middleware('switch.connection')->group(function () {
        Route::resource('categories', CategoriesController::class)->except('show');
        Route::resource('products', ProductsController::class)->except('show');
    });

});
Route::post('domain-check', [RestaurantController::class, 'checkDomain'])->middleware('auth:web')->name('tenant.admin.restaurant.check.domain');


