<?php

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
        Schema::create('reviews', function (Blueprint $table) {

            $table->id();

            // Event yang direview
            $table->foreignId('event_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // User yang memberi review
            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Rating 1 - 5
            $table->tinyInteger('rating');

            // Ulasan
            $table->text('review')->nullable();

            $table->timestamps();

            // Satu user hanya boleh review satu kali untuk satu event
            $table->unique(['event_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};