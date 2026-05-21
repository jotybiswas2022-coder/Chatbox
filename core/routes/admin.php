<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\AccountController;
use App\Http\Controllers\admin\ContactController;
use App\Http\Controllers\admin\DonorController;

Route::prefix('admin')->middleware('admin')->group(function () {

    // ===============================
    // Dashboard
    // ===============================
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'index')->name('dashboard.index');
    });

    // ===============================
    // Account
    // ===============================
    Route::prefix('account')->controller(AccountController::class)->group(function () {
        Route::get('/', 'index')->name('account.index');
        Route::get('/edit', 'edit')->name('account.edit');
        Route::post('/update', 'update')->name('account.update');
    });

    // ===============================
    // Contact
    // ===============================
    Route::prefix('contact')->controller(ContactController::class)->group(function () {
        Route::get('/', 'index')->name('contact.index');
    });

    // ===============================
    // Donor List CRUD
    // ===============================
    Route::prefix('donor_list')->controller(DonorController::class)->group(function () {
        Route::get('/', 'index')->name('donor.index');
        Route::get('/create', 'create')->name('donor.create');
        Route::post('/store', 'store')->name('donor.store');
        Route::get('/edit/{id}', 'edit')->name('donor.edit');
        Route::post('/update/{id}', 'update')->name('donor.update');
        Route::delete('/delete/{id}', 'delete')->name('donor.delete');
    });
});