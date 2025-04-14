<?php

namespace App\View\Composers;

use App\Enums\EquipmentEnum;
use App\Enums\MuscleGroupEnum;
use Illuminate\View\View;

class ExerciseViewComposer
{
    public function compose(View $view): void
    {
        $muscleGroups = cache()->remember('muscle_groups', now()->addDays(7), fn(): array => MuscleGroupEnum::cases());

        $equipments = cache()->remember('equipments', now()->addDays(7), fn(): array => EquipmentEnum::cases());

        $view->with('muscleGroups', $muscleGroups);
        $view->with('equipments', $equipments);
    }
}
