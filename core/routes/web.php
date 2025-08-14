<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;

// Homepage
Route::get('/', [SiteController::class, 'index'])->name('home');

// Investment calculator endpoint used by home banner modal
Route::get('/user/investment-calculate/{id}', [SiteController::class, 'investmentCalculate'])
    ->name('user.investmentcalculate');

// Investment plan listing page (used by header menu)
Route::get('/investment-plan', [SiteController::class, 'allInvestmentPlan'])
    ->name('investmentplan');
