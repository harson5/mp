<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('predictions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('match_game_id')->constrained('match_games')->cascadeOnDelete();
            $table->string('winner');
            $table->unsignedTinyInteger('opponent1_score');
            $table->unsignedTinyInteger('opponent2_score');
            $table->unsignedTinyInteger('points_earned')->default(0);
            $table->timestamps();

            $table->unique(['user_id', 'match_game_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('predictions');
    }
};
