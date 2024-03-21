<?php

use App\Http\Controllers\UserInfoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource("/user",UserInfoController::class);
