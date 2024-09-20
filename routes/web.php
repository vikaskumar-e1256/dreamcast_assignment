<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)->as('users.')->group(function(){
    Route::get('/', 'create')->name('home');
});
