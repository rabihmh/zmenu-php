<?php

use Illuminate\Support\Facades\Route;

Route::middleware('tenant')->group(function () {
    Route::get('/', function ($tenant) {
        return app()->make('restaurant.active');
    });

});
