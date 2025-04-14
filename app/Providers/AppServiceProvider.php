<?php

declare(strict_types=1);

namespace App\Providers;

use App\View\Composers\ExerciseViewComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('clients.exercises.*', ExerciseViewComposer::class);
        View::composer('clients.workout_templates.create', ExerciseViewComposer::class);
        View::composer('clients.workout_templates.edit', ExerciseViewComposer::class);
        View::composer('clients.workouts.edit', ExerciseViewComposer::class);
    }
}
