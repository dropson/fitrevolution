<?php

use App\Http\Controllers\Client\ExerciseController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\WorkoutController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::prefix('fit')->name('clients.')->group(function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home');

        Route::prefix('exercises')->name('exercises.')->group(function () {
            // TODO Resource 
            Route::get('/', [ExerciseController::class, 'index'])->name('index');
            Route::get('/create', [ExerciseController::class, 'create'])->name('create');
            Route::post('/', [ExerciseController::class, 'store'])->name('store');
            Route::get('/{exercise}/edit', [ExerciseController::class, 'edit'])->name('edit');
            Route::patch('/{exercise}', [ExerciseController::class, 'update'])->name('update');
            Route::delete('/{exercise}', [ExerciseController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('workouts')->name('workouts.')->group(function() {
            // TODO Resource
            Route::get('/', [WorkoutController::class, 'index'])->name('index');
            Route::get('/create', [WorkoutController::class, 'create'])->name('create');
        });

    });
});