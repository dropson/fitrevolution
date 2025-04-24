<?php

declare(strict_types=1);

use App\Http\Controllers\Client\CalendarController;
use App\Http\Controllers\Client\ClientProfileController;
use App\Http\Controllers\Client\ExerciseController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ScheduleWorkoutController;
use App\Http\Controllers\Client\WorkoutController;
use App\Http\Controllers\Client\WorkoutTemplateController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::prefix('fit')->name('clients.')->namespace('App\Http\Controllers\Client')->middleware(['role:client'])->group(function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home');

        Route::prefix('exercises')->name('exercises.')->group(function () {
            // Exercises
            Route::get('/', [ExerciseController::class, 'index'])->name('index');
            Route::get('/create', [ExerciseController::class, 'create'])->name('create');
            Route::post('/', [ExerciseController::class, 'store'])->name('store');
            Route::get('/{exercise}/edit', [ExerciseController::class, 'edit'])->name('edit');
            Route::patch('/{exercise}', [ExerciseController::class, 'update'])->name('update');
            Route::delete('/{exercise}', [ExerciseController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('templates')->name('workout_templates.')->group(function () {
            // Template Workouts
            Route::get('/', [WorkoutTemplateController::class, 'index'])->name('index');
            Route::get('/create', [WorkoutTemplateController::class, 'createTemplate'])->name('create');
            Route::post('/', [WorkoutTemplateController::class, 'storeTemplate'])->name('store');
            Route::get('/{template}', [WorkoutTemplateController::class, 'editTemplate'])->name('edit');
            Route::patch('/{template}', [WorkoutTemplateController::class, 'updateTemplate'])->name('update');
            Route::delete('/{template}', [WorkoutTemplateController::class, 'destroyTemplate'])->name('destroy');
        });
        Route::get('/{templateWorkout}/preview', [WorkoutTemplateController::class, 'getTempateWorkout']);
        Route::prefix('workouts')->name('workouts.')->group(function () {
            // Workouts
            Route::get('/{workout}', [WorkoutController::class, 'editWorkout'])->name('edit');
            Route::patch('/{workout}', [WorkoutController::class, 'updateWorkout'])->name('update');
            // Route::delete('/{workout}', [WorkoutController::class, 'destroyWorkout'])->name('destroy');
            Route::get('/{workout}/preview', [WorkoutController::class, 'getWorkout']);
        });

        Route::prefix('calendar')->name('calendar.')->group(function () {
            Route::get('/', [CalendarController::class, 'index'])->name('index');
            Route::get('/events', [CalendarController::class, 'getSchedule']);
        });

        Route::prefix('schedule')->name('schedule.')->group(function () {
            Route::post('/', [ScheduleWorkoutController::class, 'storeSchedule'])->name('store');
            Route::delete('/{schedule}', [ScheduleWorkoutController::class, 'destroySchedule'])->name('destroy');
            Route::post('/{schedule}/complete', [ScheduleWorkoutController::class, 'markAsDone'])->name('done');
            Route::post('/{schedule}/skip', [ScheduleWorkoutController::class, 'markAsSkipped'])->name('skipped');
        });

    });

    Route::patch('/client-profile', [ClientProfileController::class, 'updateInformation'])->name('client_profile.update');

});
