<?php

use Illuminate\Support\Facades\Route;
use App\Models\MasterPangan;

Route::get('/', function () {
    return view('welcome');
});
