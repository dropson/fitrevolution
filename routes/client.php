<?php

use App\Http\Controllers\Client\CalendarController;
use App\Http\Controllers\Client\ExerciseController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ScheduleWorkoutController;
use App\Http\Controllers\Client\TemplateWorkoutController;
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

        Route::prefix('templates')->name('workout_templates.')->group(function() {
            // TODO Resource
            Route::get('/', [TemplateWorkoutController::class, 'index'])->name('index');
            Route::get('/create', [TemplateWorkoutController::class, 'createTemplate'])->name('create');
            Route::post('/', [TemplateWorkoutController::class, 'storeTemplate'])->name('store');
            Route::get('/{template}', [TemplateWorkoutController::class, 'editTemplate'])->name('edit');
            Route::patch('/{template}', [TemplateWorkoutController::class, 'updateTemplate'])->name('update');
            Route::delete('/{template}', [TemplateWorkoutController::class, 'destroyTemplate'])->name('destroy');
            Route::get('/{templateWorkout}/preview',[TemplateWorkoutController::class, 'getTempateWorkout']);
        });
        
        Route::prefix('workouts')->name('workouts.')->group(function() {
            // TODO Resource
            Route::get('/{workout}', [WorkoutController::class, 'editWorkout'])->name('edit');
            Route::patch('/{workout}', [WorkoutController::class, 'updateWorkout'])->name('update');
            // Route::delete('/{workout}', [WorkoutController::class, 'destroyWorkout'])->name('destroy');
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
});