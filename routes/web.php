<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationEmailController;

Route::get('/', function () {
    return view('welcome');
});
