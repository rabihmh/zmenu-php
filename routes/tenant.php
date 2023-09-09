<?php

use App\Http\Controllers\Tenant\MenuController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'tenant.'], function ($tenant) {
    Route::get('menu', [MenuController::class, 'index']);
    Route::post('items', [MenuController::class, 'list'])->name('menu.items');
    Route::get('items', [MenuController::class, 'show'])->name('menu.items.show');
});
