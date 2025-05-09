<?php

declare(strict_types=1);

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
            $table->foreignId('client_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('author_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->unsignedBigInteger('order')->default(0);
            $table->boolean('is_visible_to_client')->default(true);
            $table->boolean('is_editable_by_client')->default(true);
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
