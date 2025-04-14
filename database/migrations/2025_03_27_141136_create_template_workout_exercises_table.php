<?php

declare(strict_types=1);

use App\Models\Exercise;
use App\Models\Workouts\TemplateWorkout;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('template_workout_exercises', function (Blueprint $table): void {
            $table->id();
            $table->foreignIdFor(TemplateWorkout::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Exercise::class)->constrained()->onDelete('cascade');
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('template_workout_exercises');
    }
};
