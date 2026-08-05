<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DepositTransactionController;
use App\Http\Controllers\WithdrawalTransactionController;
use App\Http\Controllers\DashboardController;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Customers resource CRUD
    Route::resource('customers', CustomerController::class);

    // Deposit & Withdrawal transactions
    Route::resource('deposit-transactions', DepositTransactionController::class);
    Route::resource('withdrawal-transactions', WithdrawalTransactionController::class);
});

require __DIR__.'/settings.php';
