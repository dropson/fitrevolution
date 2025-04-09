<?php

use App\Models\User;
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
        Schema::create('workouts', function (Blueprint $table) {
            $table->id();
            $table->string('title');;
            $table->text('instruction')->nullable();
            $table->foreignIdFor(TemplateWorkout::class)->constrained();
            $table->foreignIdFor(User::class)->constrained('users')->onDelete('cascade');
            $table->unsignedBigInteger('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workouts');
    }
};
