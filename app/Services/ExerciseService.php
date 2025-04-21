<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Exercise;
use App\Models\Workouts\TemplateSet;
use App\Models\Workouts\TemplateWorkoutExercise;
use App\Models\Workouts\WorkoutExercise;
use App\Models\Workouts\WorkoutSet;
use Exception;
use Illuminate\Database\Eloquent\Model;

final readonly class ExerciseService
{
    private string $workoutExerciseModel;

    private string $setModel;

    public function __construct(private string $type)
    {
        $this->workoutExerciseModel = $this->type === 'workout' ? WorkoutExercise::class : TemplateWorkoutExercise::class;
        $this->setModel = $this->type === 'workout' ? WorkoutSet::class : TemplateSet::class;
    }

    public function addExerciseWithSets(Model $workout, array $exerciseData, int $index): Model
    {
        $exerciseId = $exerciseData['exercise_id'] ?? null;
        if (! $exerciseId) {
            throw new Exception('ID вправи відсутній у даних.');
        }

        $exercise = null;
        $actualExerciseId = $exerciseId;

        // Перевіряємо, чи exercise_id — це ID із проміжної таблиці
        $workoutExercise = $this->workoutExerciseModel::where('id', $exerciseId)->first();
        if ($workoutExercise) {
            $actualExerciseId = $workoutExercise->exercise_id;
            $exercise = Exercise::find($actualExerciseId);
        } else {
            $exercise = Exercise::find($exerciseId);
        }

        if (! $exercise) {
            throw new Exception("Вправа з ID {$actualExerciseId} не існує в таблиці вправ.");
        }

        // Прив’язуємо вправу до тренування/шаблону
        $workout->exercises()->attach($exercise->id, ['order' => $index]);

        // Отримуємо щойно створену вправу
        $newWorkoutExercise = $this->workoutExerciseModel::where('exercise_id', $exercise->id)
            ->where($this->getWorkoutForeignKey(), $workout->id)
            ->orderBy('id', 'desc')
            ->first();

        if (! $newWorkoutExercise) {
            throw new Exception("Не вдалося створити вправу для ID {$exercise->id}.");
        }

        return $newWorkoutExercise;
    }

    /**
     * Оновлює або створює підходи для вправи.
     *
     * @param  Model  $workoutExercise  Вправа, для якої оновлюються підходи.
     * @param  array  $sets  Дані підходів.
     * @return array ID підходів, які залишилися.
     */
    public function updateOrCreateSets(Model $workoutExercise, array $sets): array
    {
        // Видаляємо всі існуючі підходи для цієї вправи
        $setModel = $this->setModel;
        $setModel::where($this->getExerciseForeignKey(), $workoutExercise->id)->delete();

        $remainingSetIds = [];

        // Додаємо нові підходи
        foreach ($sets as $setData) {
            $set = $setModel::create([
                $this->getExerciseForeignKey() => $workoutExercise->id,
                'sets_number' => $setData['sets_number'],
                'repetitions' => $setData['repetitions'],
                'weight' => $setData['weight'] ?? null,
            ]);
            $remainingSetIds[] = $set->id;
        }

        return $remainingSetIds;
    }

    /**
     * Копіює вправи з шаблону в тренування.
     *
     * @param  Model  $workout  Тренування.
     * @param  Model  $templateWorkout  Шаблон.
     */
    public function copyExercisesFromTemplate(Model $workout, Model $templateWorkout): void
    {
        foreach ($templateWorkout->templateWorkoutExercises as $index => $templateExercise) {
            $workoutExercise = $this->addExerciseWithSets($workout, [
                'exercise_id' => $templateExercise->exercise_id,
            ], $index);

            $sets = $templateExercise->templateSets->map(fn($set): array => [
                'sets_number' => $set->sets_number,
                'repetitions' => $set->repetitions,
                'weight' => $set->weight,
            ])->toArray();

            $this->updateOrCreateSets($workoutExercise, $sets);
        }
    }

    /**
     * Повертає зовнішній ключ для тренування/шаблону.
     *
     * @return string Назва зовнішнього ключа.
     */
    public function getWorkoutForeignKey(): string
    {
        return $this->type === 'workout' ? 'workout_id' : 'template_workout_id';
    }

    /**
     * Повертає зовнішній ключ для вправи.
     *
     * @return string Назва зовнішнього ключа.
     */
    public function getExerciseForeignKey(): string
    {
        return $this->type === 'workout' ? 'workout_exercise_id' : 'template_workout_exercise_id';
    }
}
