<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CustomerController;

Route::get('/', [IndexController::class, 'index'])->name('home');

Route::view('/result', 'result')->name('result'); 

Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');

Route::view('/politicas-privacidad', 'privacy-policy.privacy-policy')->name('privacy-policy');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';