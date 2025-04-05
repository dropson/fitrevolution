<?php

namespace App\Actions\Workouts;

use App\Http\Requests\Client\StoreTempaleteWorkoutRequest;
use App\Models\Workouts\TemplateSet;
use App\Models\Workouts\TemplateWorkout;
use App\Services\TemplateWorkoutExerciseService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CreateTemplateWorkoutAction
{
    protected $exerciseService;

    public function __construct(TemplateWorkoutExerciseService $exerciseService)
    {
        $this->exerciseService = $exerciseService;
    }

    public function handle(StoreTempaleteWorkoutRequest $request): TemplateWorkout
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        $templateWorkout = DB::transaction(function () use ($data) {
            $templateWorkout = TemplateWorkout::create($data);

            $this->processExercises($templateWorkout, $data);

            return $templateWorkout;
        });

        return $templateWorkout;
    }

    private function processExercises(TemplateWorkout $templateWorkout, array $data): void
    {
        if (!isset($data['exercises'])) {
            return;
        }

        foreach ($data['exercises'] as $index => $exerciseData) {
            $this->exerciseService->addExerciseWithSets($templateWorkout, $exerciseData, $index);
        }

    }
}
