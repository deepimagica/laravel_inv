<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\SubscriptionPlanController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\InvoiceController;
use App\Http\Controllers\User\UserController;
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
        Route::get('/invoice/item-row-template', [InvoiceController::class, 'getItemRow'])->name('invoice.item_row');
        Route::get('/invoice/list', [InvoiceController::class, 'index'])->name('invoice.list');
        Route::get('/invoice/download/{id}', [InvoiceController::class, 'downloadInvoice'])->name('invoice.download');
        Route::get('/profile', [UserController::class, 'getProfilePage'])->name('profile');
        Route::post('/user/change-password', [UserController::class, 'changePassword'])->name('changePassword');
        Route::get('/invoice/edit/{id}', [InvoiceController::class, 'edit'])->name('invoice.edit');
        Route::post('/invoice/update/{id}', [InvoiceController::class, 'update'])->name('invoice.update');
        Route::delete('/invoice/delete/{id}', [InvoiceController::class, 'destroy'])->name('invoice.delete');
    });
});

Route::prefix('admin')->as('admin.')->group(function () {
    Route::group(['middleware' => ['check.admin:guest']], function () {
        Route::get('/', [LoginController::class, 'getLoginPage'])->name('login.page');
        Route::post('/', [LoginController::class, 'postLoginPage'])->middleware('throttle:5,1')->name('post.login.page');
    });
    Route::group(['middleware' => ['check.admin:admin']], function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'getDashboardPage'])->name('dashboard');
        Route::get('/users-list', [AdminDashboardController::class, 'getUsers'])->name('users');
        Route::get('logout', [AdminDashboardController::class, 'adminLogOut'])->name('logout');
        Route::resource('subscription-plans', SubscriptionPlanController::class);
    });
});
