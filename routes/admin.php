<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.home');
})->middleware('auth:admin');

