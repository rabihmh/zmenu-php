<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('tenantadmin.home');
})->middleware('auth:web');
