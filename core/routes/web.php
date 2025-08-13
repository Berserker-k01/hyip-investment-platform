<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;

// Homepage
Route::get('/', [SiteController::class, 'index'])->name('home');
