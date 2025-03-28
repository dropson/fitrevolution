<?php

namespace App\Providers;

use App\View\Composers\ExerciseViewComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
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
        View::composer('clients.workouts.create', ExerciseViewComposer::class);
    }
}
