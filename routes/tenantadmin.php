<?php

use App\Http\Controllers\TenantAdmin\RestaurantController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['auth:web', 'ensure.restaurant'], 'as' => 'tenant.admin.'], function () {
    Route::get('/', function () {
        return view('tenantadmin.home');
    });
    Route::group(['prefix' => 'restaurant', 'as' => 'restaurant.'], function () {
        Route::get('create', [RestaurantController::class, 'create'])->name('create');
        Route::post('store', [RestaurantController::class, 'store'])->name('store');
    });
});
Route::post('domain-check', [RestaurantController::class, 'checkDomain'])->middleware('auth:web')->name('tenant.admin.restaurant.check.domain');


