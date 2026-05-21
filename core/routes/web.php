<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\user\ProfileController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\SiteController;

Route::controller(SiteController::class)->group(function () {
    Route::get('/', 'index');
});

Route::post('/contactus', [UserController::class, 'contactus']);

Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');

//Profile
Route::middleware('auth')->prefix('/profile')->controller(ProfileController::class)->group(function () {
    Route::get('/', 'index');               
    Route::get('/edit',  'edit');
    Route::post('/update', 'update');
});

//Donor List
Route::middleware('auth')->prefix('/donor_list')->controller(SiteController::class)->group(function () {
    Route::get('/{bloodGroup?}', 'donorList'); 
});


Auth::routes();

include('admin.php');
