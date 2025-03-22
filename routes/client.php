<?php

use App\Http\Controllers\Client\ExerciseController;
use App\Http\Controllers\Client\HomeController;

Route::middleware('auth')->group(function () {

    Route::prefix('fit')->name('clients.')->group(function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home');

        Route::prefix('exercises')->group(function () {
            Route::get('/', [ExerciseController::class, 'index'])->name('exercises.index');
            Route::get('/create', [ExerciseController::class, 'create'])->name('exercises.create');
            Route::post('/', [ExerciseController::class, 'store'])->name('exercises.store');
            Route::get('/{exercise}/edit', [ExerciseController::class, 'edit'])->name('exercises.edit');
            Route::patch('/{exercise}', [ExerciseController::class, 'update'])->name('exercises.update');
            Route::delete('/{exercise}', [ExerciseController::class, 'destroy'])->name('exercises.destroy');
        });
    });
});