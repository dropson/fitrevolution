<?php

declare(strict_types=1);

namespace App\Actions\Workouts;

use App\Services\ExerciseService;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

abstract class BaseWorkoutAction
{
    public function __construct(protected ExerciseService $exerciseService) {}

    abstract protected function getWorkoutExerciseModel(): string;

    abstract protected function getSetModel(): string;

    abstract protected function getWorkoutModel(): string;

    protected function checkOwnership(Model $model, int $userId): void
    {
        $user = Auth::user();
        // Перевіряємо, чи користувач має роль тренера
        if ($user->hasRole('coach')) {
            // Для тренера перевіряємо coach_id
            if ($model->coach_id !== $userId) {
                throw new Exception('Ви не є власником цього об’єкта.');
            }
        }
        // Перевіряємо, чи користувач має роль клієнта
        elseif ($user->hasRole('client')) {
            // Для клієнта перевіряємо client_id
            if ($model->client_id !== $userId) {
                throw new Exception('Ви не є власником цього об’єкта.');
            }
        }
        // Якщо користувач не має жодної з ролей, кидаємо виняток
        else {
            throw new Exception('У вас немає прав для доступу до цього об’єкта.');
        }
    }

    /**
     * Обробляє вправи для тренування або шаблону: створює, оновлює або видаляє їх.
     *
     * @param  Model  $model  Модель тренування або шаблону.
     * @param  array  $data  Валідовані дані з вправами.
     */
    protected function processExercises(Model $model, array $data): void
    {
        if (! isset($data['exercises'])) {
            // Якщо вправ немає, видаляємо всі існуючі
            $exerciseModel = $this->getWorkoutExerciseModel();
            $exerciseModel::where($this->getWorkoutForeignKey(), $model->id)->delete();

            return;
        }

        $exerciseModel = $this->getWorkoutExerciseModel();
        $remainingWorkoutExerciseIds = [];

        foreach ($data['exercises'] as $index => $exerciseData) {
            $exerciseId = $exerciseData['exercise_id'] ?? null;
            $isDeleted = isset($exerciseData['deleted']) && $exerciseData['deleted'] === '1';

            if ($isDeleted && $exerciseId) {
                // Видаляємо вправу, якщо вона позначена як видалена
                $exerciseModel::where('id', $exerciseId)
                    ->where($this->getWorkoutForeignKey(), $model->id)
                    ->delete();

                continue;
            }

            $workoutExercise = null;

            // Шукаємо вправу, якщо це оновлення
            if ($exerciseId) {
                $workoutExercise = $exerciseModel::where('id', $exerciseId)
                    ->where($this->getWorkoutForeignKey(), $model->id)
                    ->first();
            }

            // Якщо вправи немає (або це створення), додаємо нову
            if (! $workoutExercise) {
                $workoutExercise = $this->exerciseService->addExerciseWithSets($model, $exerciseData, $index);
            }

            // Зберігаємо ID вправи, щоб не видалити її
            $remainingWorkoutExerciseIds[] = $workoutExercise->id;

            // Оновлюємо підходи (видаляємо старі, додаємо нові)
            $this->exerciseService->updateOrCreateSets($workoutExercise, $exerciseData['sets'] ?? []);
        }
        // Видаляємо вправи, які не були передані в запиті
        $exerciseModel::where($this->getWorkoutForeignKey(), $model->id)
            ->whereNotIn('id', $remainingWorkoutExerciseIds)
            ->delete();
    }

    /**
     * Повертає зовнішній ключ для моделі тренування/шаблону.
     *
     * @return string Назва зовнішнього ключа.
     */
    protected function getWorkoutForeignKey(): string
    {
        return (new ($this->getWorkoutModel()))->getForeignKey();
    }
}
