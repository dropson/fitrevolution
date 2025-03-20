<?php

use App\Http\Controllers\Client\ExerciseController;
use App\Http\Controllers\Client\HomeController;

Route::middleware('auth')->group(function () {

    Route::prefix('fit')->name('clients.')->group(function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home');

        Route::prefix('exercises')->group(function () {
            Route::get('/', [ExerciseController::class, 'index'])->name('exercises.index');
        });
    });
});