<?php

declare(strict_types=1);

use App\Http\Controllers\Coach\ClientController;
use App\Http\Controllers\Coach\CoachProfileController;
use App\Http\Controllers\Coach\HomeController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::prefix('train')->name('coaches.')->namespace('App\Http\Controllers\Coach')->middleware(['role:coach'])->group(function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home');

        Route::prefix('clients')->name('clients.')->group(function () {
            Route::get('/create', [ClientController::class, 'createClient'])->name('create');
            Route::post('/', [ClientController::class, 'storeClient'])->name('store');
        });
    });
    // Invite cliend by email
    Route::post('/invite', [ClientController::class, 'sendInvitation'])->name('send_invitation');

    Route::patch('/coach-profile', [CoachProfileController::class, 'updateInformation'])->name('coach_profile.update');

});
