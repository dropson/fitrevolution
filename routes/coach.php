<?php

declare(strict_types=1);

use App\Http\Controllers\Coach\CoachProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::patch('/coach-profile', [CoachProfileController::class, 'updateInformation'])->name('coach_profile.update');

});
