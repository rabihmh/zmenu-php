<?php

use App\Http\Controllers\Tenant\MenuController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'tenant.'], function () {
    Route::get('menu', [MenuController::class, 'index']);
    Route::post('/items', [MenuController::class, 'list'])->name('menu.items');
});
