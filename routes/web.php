<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\LabController;
use Illuminate\Support\Facades\Artisan;

Route::get('/', [IndexController::class, 'index'])->name('home');

Route::view('/result', 'result')->name('result');
Route::view('/promo', 'promo')->name('promo');


Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');

Route::view('/politicas-privacidad', 'privacy-policy.privacy-policy')->name('privacy-policy');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';



Route::middleware(['auth'])->group(function () {
    Route::get('/quotations', [QuotationController::class, 'index'])->name('quotations.index');
    Route::get('/quotations/create', [QuotationController::class, 'create'])->name('quotations.create');
    Route::post('/quotations', [QuotationController::class, 'store'])->name('quotations.store');
    Route::get('/quotations/{quotation}', [QuotationController::class, 'show'])->name('quotations.show');
});




Route::get('/labs/edit', [LabController::class, 'edit'])->name('labs.edit')->middleware('auth');
Route::post('/labs/{lab}/update', [LabController::class, 'update'])->middleware(['auth'])->name('labs.update');
Route::get('/labs', [LabController::class, 'show'])->name('labs.show')->middleware('auth');

Route::post('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');

    return back()->with('success', '✅ Caché limpiada correctamente.');
});

