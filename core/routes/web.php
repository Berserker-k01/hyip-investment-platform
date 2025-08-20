<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

// Newsletter subscribe endpoint used by master.blade.js
Route::post('/subscribe', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'message' => 'Validation error',
            'errors' => $validator->errors(),
        ], 422);
    }

    // TODO: persist the email into a subscriptions table or email provider
    return response()->json([
        'message' => 'Thanks for subscribing!',
    ]);
})->name('subscribe');

// Language switcher stub used by master.blade.js (accepts ?lang=)
Route::get('/change-lang', function (Request $request) {
    $lang = $request->query('lang');
    if ($lang) {
        // Optionally set locale in session; keep minimal to avoid errors
        session(['locale' => $lang]);
        app()->setLocale($lang);
    }
    return redirect()->back();
})->name('user.changeLang');

// Minimal placeholder auth routes to avoid missing route errors
Route::get('/user/login', function () {
    // Placeholder login route. Redirect to home or show a minimal info page.
    return redirect()->route('home');
})->name('user.login');

Route::get('/user/dashboard', function () {
    // Placeholder dashboard route. Redirect to home for now.
    return redirect()->route('home');
})->name('user.dashboard');

// Batch placeholder routes for many user.* names referenced by views
// These keep the app rendering until real controllers are wired.
// Generic GET
foreach ([
    'user.withdraw.all',
    'user.withdraw.pending',
    'user.withdraw.complete',
    'user.withdraw.fetch',
    'user.transfer.money',
    'user.transfer.log',
    'user.transaction.log',
    'user.invest.all',
    'user.invest.pending',
    'user.invest.log',
    'user.deposit.log',
    'user.deposit',
    'user.interest.log',
    'user.commision',
    'user.viewall',
    'user.change.password',
    'user.profileupdate',
    'user.ticket.index',
    'user.ticket.status',
    'user.ticket.store',
    'user.ticket.show',
    'user.ticket.edit',
    'user.ticket.update',
    'user.ticket.destroy',
    'user.ticket.download',
    'user.ticket.reply',
    'user.register',
    'user.coin.pay',
] as $name) {
    // Create flexible GET route with up to 3 optional params
    Route::match(['get', 'post'], '/__stub/'.str_replace(['.', ':'], ['/', '-'], $name).'/{p1?}/{p2?}/{p3?}', function () use ($name) {
        // For POST submissions, just go back safely; for GET, go home
        if (request()->isMethod('post')) {
            return redirect()->back();
        }
        return redirect()->route('home');
    })->name($name);
}

// Non-user route used by JS in some views
Route::post('/__stub/returninterest', function () {
    return response()->json(['status' => 'ok']);
})->name('returninterest');
