<?php

declare(strict_types=1);

namespace App\Actions\Workouts;

use App\Enums\UserRoleEnum;
use App\Models\User;
use App\Models\Workouts\TemplateSet;
use App\Models\Workouts\TemplateWorkout;
use App\Models\Workouts\TemplateWorkoutExercise;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

final class CreateTemplateWorkoutAction extends BaseWorkoutAction
{
    public function handle(FormRequest $request, ?Model $model = null, ?User $client = null): Model
    {

        $data = $request->validated();
        $user = Auth::user();

        $data['author_id'] = $user->id;
        if ($client instanceof \App\Models\User) {
            $data['client_id'] = $client->id;
        } elseif ($user->hasRole(UserRoleEnum::Client->value)) {
            $data['client_id'] = $user->id;
        }

        return DB::transaction(function () use ($data) {
            $templateWorkout = TemplateWorkout::create($data);
            $this->processExercises($templateWorkout, $data);

            return $templateWorkout;
        });
    }

    protected function getWorkoutExerciseModel(): string
    {
        return TemplateWorkoutExercise::class;
    }

    protected function getSetModel(): string
    {
        return TemplateSet::class;
    }

    protected function getWorkoutModel(): string
    {
        return TemplateWorkout::class;
    }
}
