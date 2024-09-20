<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(UserController::class)->as('users.')->group(function () {
    Route::post('/store', 'store')->name('store');
    Route::get('/users', 'index')->name('all');
});
