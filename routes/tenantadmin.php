<?php

use App\Http\Controllers\TenantAdmin\CategoriesController;
use App\Http\Controllers\TenantAdmin\HomeController;
use App\Http\Controllers\TenantAdmin\NotificationController;
use App\Http\Controllers\TenantAdmin\ProductsController;
use App\Http\Controllers\TenantAdmin\RestaurantController;
use App\Http\Controllers\TenantAdmin\TableController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['auth:web', 'ensure.restaurant'], 'as' => 'tenant.admin.'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::group(['prefix' => 'restaurant', 'as' => 'restaurant.'], function () {
        Route::get('/', [RestaurantController::class, 'show'])->name('show');
        Route::get('create', [RestaurantController::class, 'create'])->name('create');
        Route::post('store', [RestaurantController::class, 'store'])->name('store');
        Route::post('edit/{id}', [RestaurantController::class, 'update'])->name('update');
    });
    Route::middleware('switch.connection')->group(function () {
        Route::resource('categories', CategoriesController::class)->except('show');
        Route::resource('products', ProductsController::class)->except('show');
        Route::resource('tables', TableController::class);
        Route::resource('orders', TableController::class);
        Route::resource('notifications', NotificationController::class)->only(['index', 'destroy']);
        Route::put('notifications/mark_all_read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllRead');
        Route::delete('notifications', [NotificationController::class, 'deleteAll'])->name('notifications.deleteAll');
    });

});
Route::post('domain-check', [RestaurantController::class, 'checkDomain'])->middleware('auth:web')->name('tenant.admin.restaurant.check.domain');


