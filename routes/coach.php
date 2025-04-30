<?php

declare(strict_types=1);

use App\Http\Controllers\Coach\ClientController;
use App\Http\Controllers\Coach\ClientWorkoutTemplatesController;
use App\Http\Controllers\Coach\CoachProfileController;
use App\Http\Controllers\Coach\HomeController;
use App\Http\Controllers\Coach\WorkoutTemplateController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::prefix('train')->name('coaches.')->namespace('App\Http\Controllers\Coach')->middleware(['role:coach'])->group(function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home');

        // Clients
        Route::prefix('clients')->name('clients.')->group(function () {
            Route::get('/create', [ClientController::class, 'createClient'])->name('create');
            Route::post('/', [ClientController::class, 'storeClient'])->name('store');
            Route::get('/{client}/home', [ClientController::class, 'showClient'])->name('show');
            Route::delete('/{client}', [ClientController::class, 'destroyClient'])->name('destroy');

            // Template Workouts
            Route::prefix('{client}')->group(function () {
                Route::prefix('templates')->name('workout_templates.')->group(function () {
                    Route::get('/', [ClientWorkoutTemplatesController::class, 'index'])->name('index');
                    Route::get('/create', [ClientWorkoutTemplatesController::class, 'createTemplate'])->name('create');
                    Route::post('/', [ClientWorkoutTemplatesController::class, 'storeTemplate'])->name('store');
                    Route::get('/{template}', [ClientWorkoutTemplatesController::class, 'editTemplate'])->name('edit');
                    Route::patch('/{template}', [ClientWorkoutTemplatesController::class, 'updateTemplate'])->name('update');
                    Route::delete('/{template}', [ClientWorkoutTemplatesController::class, 'destroyTemplate'])->name('destroy');
                });
            });
        });

        // Template Workouts
        Route::prefix('templates')->name('workout_templates.')->group(function () {
            Route::get('/', [WorkoutTemplateController::class, 'index'])->name('index');
            Route::get('/create', [WorkoutTemplateController::class, 'createTemplate'])->name('create');
            Route::post('/', [WorkoutTemplateController::class, 'storeTemplate'])->name('store');
            Route::get('/{template}', [WorkoutTemplateController::class, 'editTemplate'])->name('edit');
            Route::patch('/{template}', [WorkoutTemplateController::class, 'updateTemplate'])->name('update');
            Route::delete('/{template}', [WorkoutTemplateController::class, 'destroyTemplate'])->name('destroy');
            Route::get('/{templateWorkout}/preview', [WorkoutTemplateController::class, 'getTempateWorkout']);
        });

    });
    // Invite cliend by email
    Route::post('/invite', [ClientController::class, 'sendInvitation'])->name('send_invitation');

    Route::patch('/coach-profile', [CoachProfileController::class, 'updateInformation'])->name('coach_profile.update');

});
