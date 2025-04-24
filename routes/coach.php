<?php

declare(strict_types=1);

use App\Http\Controllers\Coach\ClientController;
use App\Http\Controllers\Coach\CoachProfileController;
use App\Http\Controllers\Coach\HomeController;
use App\Http\Controllers\Coach\WorkoutTemplateController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::prefix('train')->name('coaches.')->namespace('App\Http\Controllers\Coach')->middleware(['role:coach'])->group(function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home');

        Route::prefix('clients')->name('clients.')->group(function () {
            // Clients
            Route::get('/create', [ClientController::class, 'createClient'])->name('create');
            Route::post('/', [ClientController::class, 'storeClient'])->name('store');
        });

        Route::prefix('templates')->name('workout_templates.')->group(function () {
            // Template Workouts
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
