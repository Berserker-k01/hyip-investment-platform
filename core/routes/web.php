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

// Dynamic CMS pages (header menu loop)
Route::get('/pages/{pages}', [SiteController::class, 'page'])->name('pages');

// Blog listing (header link)
Route::get('/blog', [SiteController::class, 'allblog'])->name('allblog');

// Minimal placeholder auth routes to avoid missing route errors
Route::get('/user/login', function () {
    // Placeholder login route. Redirect to home or show a minimal info page.
    return redirect()->route('home');
})->name('user.login');

Route::get('/user/dashboard', function () {
    // Placeholder dashboard route. Redirect to home for now.
    return redirect()->route('home');
})->name('user.dashboard');
