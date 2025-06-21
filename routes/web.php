<?php

use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\InvoiceController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['check.user:guest']], function () {
    Route::get('/', [AuthController::class, 'getLoginPage'])->name('login.page');
    Route::post('/', [AuthController::class, 'postLoginPage'])->middleware('throttle:5,1')->name('post.login.page');
});

Route::prefix('user')->as('user.')->group(function () {
    Route::group(['middleware' => ['check.user:user']], function () {
        Route::get('/dashboard', [DashboardController::class, 'getDashboard'])->name('dashboard');
        Route::get('/logout', [DashboardController::class, 'userLogout'])->name('logout');
        Route::get('/invoice', [InvoiceController::class, 'getInvoice'])->name('invoice');
        Route::get('/create-invoice', [InvoiceController::class, 'getCreateInvoiceForm'])->name('create.invoice');
        Route::post('/invoice/store', [InvoiceController::class, 'store'])->name('store.invoice');
    });
});
