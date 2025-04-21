<?php

declare(strict_types=1);

namespace App\Providers;

use App\Actions\Workouts\CreateScheduleWorkoutAction;
use App\Actions\Workouts\CreateTemplateWorkoutAction;
use App\Actions\Workouts\UpdateTemplateWorkoutAction;
use App\Actions\Workouts\UpdateWorkoutAction;
use App\Services\ExerciseService;
use App\View\Composers\ExerciseViewComposer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->when(CreateTemplateWorkoutAction::class)
            ->needs(ExerciseService::class)
            ->give(fn (): ExerciseService => new ExerciseService('template'));

        $this->app->when(UpdateTemplateWorkoutAction::class)
            ->needs(ExerciseService::class)
            ->give(fn (): ExerciseService => new ExerciseService('template'));

        $this->app->when(UpdateWorkoutAction::class)
            ->needs(ExerciseService::class)
            ->give(fn (): ExerciseService => new ExerciseService('workout'));

        $this->app->when(CreateScheduleWorkoutAction::class)
            ->needs(ExerciseService::class)
            ->give(fn (): ExerciseService => new ExerciseService('workout'));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::preventLazyLoading();

        View::composer('clients.exercises.*', ExerciseViewComposer::class);
        View::composer('clients.workout_templates.create', ExerciseViewComposer::class);
        View::composer('clients.workout_templates.edit', ExerciseViewComposer::class);
        View::composer('clients.workouts.edit', ExerciseViewComposer::class);
    }
}
