<?php

use App\Http\Controllers\Client\ExerciseController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\TemplateWorkoutController;
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
            Route::get('/', [TemplateWorkoutController::class, 'index'])->name('index');
            Route::get('/create', [TemplateWorkoutController::class, 'createTemplate'])->name('create');
            Route::post('/', [TemplateWorkoutController::class, 'storeTemplate'])->name('store');
            Route::get('/{template}', [TemplateWorkoutController::class, 'editTemplate'])->name('edit');
            Route::patch('/{template}', [TemplateWorkoutController::class, 'updateTemplate'])->name('update');
            Route::get('/{templateWorkout}/preview',[TemplateWorkoutController::class, 'getTempateWorkout']);
            Route::delete('/{template}', [TemplateWorkoutController::class, 'destroyTemplate'])->name('destroy');
        });

    });
});