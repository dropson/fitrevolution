<?php

declare(strict_types=1);

namespace App\Actions\Workouts;

use App\Enums\WorkoutScheduleStatusEnum;
use App\Models\Workouts\TemplateWorkout;
use App\Models\Workouts\Workout;
use App\Models\Workouts\WorkoutExercise;
use App\Models\Workouts\WorkoutSchedule;
use App\Models\Workouts\WorkoutSet;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

final class CreateScheduleWorkoutAction extends BaseWorkoutAction
{
    private const MAX_WORKOUTS_PER_DAY = 1;

    public function handle(FormRequest $request, ?Model $model = null): Model
    {
        $user = Auth::user();
        $data = $request->validated();

        return DB::transaction(function () use ($data, $user) {
            // Завантажуємо шаблон із пов’язаними вправами та підходами
            $templateWorkout = TemplateWorkout::with('templateWorkoutExercises.exercise', 'templateWorkoutExercises.templateSets')
                ->findOrFail($data['template_workout_id']);

            // Перевіряємо ліміт тренувань на день
            if (WorkoutSchedule::where('client_id', $templateWorkout->client_id)
                ->where('scheduled_date', $data['scheduled_date'])
                ->count() >= self::MAX_WORKOUTS_PER_DAY) {
                throw new Exception('Ви досягли ліміту в '.self::MAX_WORKOUTS_PER_DAY." тренувань на {$data['scheduled_date']}.");
            }

            // Створюємо нове тренування
            $workout = Workout::create([
                'client_id' => $templateWorkout->client_id,
                'template_workout_id' => $templateWorkout->id,
                'title' => $templateWorkout->title,
                'instruction' => $templateWorkout->instruction,
            ]);

            // Копіюємо вправи та підходи з шаблону в тренування
            $this->exerciseService->copyExercisesFromTemplate($workout, $templateWorkout);

            // Створюємо розклад для тренування
            return WorkoutSchedule::create([
                'client_id' => $workout->client_id,
                'workout_id' => $workout->id,
                'scheduled_date' => $data['scheduled_date'],
                'status' => WorkoutScheduleStatusEnum::Pending->value,
            ]);
        });
    }

    protected function getWorkoutExerciseModel(): string
    {
        return WorkoutExercise::class;
    }

    protected function getSetModel(): string
    {
        return WorkoutSet::class;
    }

    protected function getWorkoutModel(): string
    {
        return Workout::class;
    }
}
