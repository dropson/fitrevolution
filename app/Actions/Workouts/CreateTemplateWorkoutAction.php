<?php

namespace App\Actions\Workouts;

use App\Http\Requests\Client\StoreTempaleteWorkoutRequest;
use App\Models\Workouts\TemplateWorkout;
use App\Services\TemplateWorkoutExerciseService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CreateTemplateWorkoutAction
{
    public function __construct(protected TemplateWorkoutExerciseService $exerciseService)
    {
    }

    public function handle(StoreTempaleteWorkoutRequest $request): TemplateWorkout
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        return DB::transaction(function () use ($data) {
            $templateWorkout = TemplateWorkout::create($data);

            $this->processExercises($templateWorkout, $data);

            return $templateWorkout;
        });
    }

    private function processExercises(TemplateWorkout $templateWorkout, array $data): void
    {
        if (! isset($data['exercises'])) {
            return;
        }

        foreach ($data['exercises'] as $index => $exerciseData) {
            $this->exerciseService->addExerciseWithSets($templateWorkout, $exerciseData, $index);
        }

    }
}
