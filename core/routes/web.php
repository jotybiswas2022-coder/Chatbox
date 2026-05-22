<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\user\MessageController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\SiteController;

Route::controller(SiteController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/contact', 'contact')->name('contact.page');
});

Route::post('/contact', [UserController::class, 'contact'])->name('contact');

Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');

Route::middleware('auth')->get('/media/{path}', [MessageController::class, 'media'])
    ->where('path', '.*')
    ->name('media.show');

//Message
Route::middleware('auth')->prefix('/{user_id}/message')->controller(MessageController::class)->group(function () {
    Route::get('/', 'message')->name('message');
    Route::post('/send', 'sendMessage')->name('message.send');
    Route::put('/{message_id}/update', 'updateMessage')->name('message.update');
    Route::delete('/{message_id}/delete', 'deleteMessage')->name('message.destroy');
    Route::delete('/{message_id}/delete-for-me', 'deleteMessageForMe')->name('message.delete-for-me');
});

//Search
Route::get('/search-users', [App\Http\Controllers\user\UserController::class, 'search'])->name('users.search');

Auth::routes();

include('admin.php');
