<?php

declare(strict_types=1);

use App\Enums\EquipmentEnum;
use App\Enums\MuscleGroupEnum;
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
        Schema::create('exercises', function (Blueprint $table): void {
            $table->id();
            $table->string('title');
            $table->enum('muscle_group', MuscleGroupEnum::values());
            $table->enum('equipment', EquipmentEnum::values());
            $table->text('instruction')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};
