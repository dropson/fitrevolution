<?php

declare(strict_types=1);

use App\Models\User;
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
        Schema::create('template_workouts', function (Blueprint $table): void {
            $table->id();
            $table->string('title');
            $table->text('instruction')->nullable();
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
        Schema::dropIfExists('template_workouts');
    }
};
