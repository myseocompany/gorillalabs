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
Route::view('/promo/thanks', 'promo')->name('promo-thanks');


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
    Route::get('/quotations/{qid}', [QuotationController::class, 'show'])->name('quotations.show');
});




Route::get('/labs/edit', [LabController::class, 'edit'])->name('labs.edit')->middleware('auth');
Route::post('/labs/{lab}/update', [LabController::class, 'update'])->middleware(['auth'])->name('labs.update');
Route::get('/labs', [LabController::class, 'show'])->name('labs.show')->middleware('auth');
Route::post('/labs/update', [LabController::class, 'update'])->name('labs.update');



/*
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/labs/index', [LabController::class, 'index'])->name('labs.index');
});
*/
/*
Route::get('/labs/index',  [LabController::class, 'index'])->name('labs.index')->middleware('role:admin');
Route::get('/labs/create',  [LabController::class, 'create'])->name('labs.create')->middleware('role:admin');
Route::get('/labs/{lab}/assign-user', [LabController::class, 'assignUser'])->name('labs.assign-user')->middleware('role:admin');
Route::delete('/labs/{lab}', [LabController::class, 'destroy'])->name('labs.destroy')->middleware('role:admin');
Route::post('/labs/{lab}/update-user', [LabController::class, 'updateUser'])->name('labs.update-user')->middleware('role:admin');
*/


Route::middleware(['role:admin'])->group(function () {
    Route::get('/labs/index', [LabController::class, 'index'])->name('labs.index');
    Route::get('/labs/create', [LabController::class, 'create'])->name('labs.create');
    Route::get('/labs/{lab}/assign-user', [LabController::class, 'assignUser'])->name('labs.assign-user');
    Route::delete('/labs/{lab}', [LabController::class, 'destroy'])->name('labs.destroy');
    Route::post('/labs/update-user', [LabController::class, 'updateUser'])->name('labs.update-user');
    Route::post('/labs', [LabController::class, 'store'])->name('labs.store');
});

Route::get('/labs/{lab}/create-user', [LabController::class, 'createUserForm'])
    ->name('labs.create-user-form')
    ->middleware('role:admin');

Route::post('/labs/store-user', [LabController::class, 'storeUser'])
    ->name('labs.store-user')
    ->middleware('role:admin');


Route::post('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');

    return back()->with('success', '✅ Caché limpiada correctamente.');
});



