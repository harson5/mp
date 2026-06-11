<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('match_games', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('match_no');
            $table->dateTime('match_datetime');
            $table->string('opponent1');
            $table->string('opponent2');
            $table->string('winner')->nullable();
            $table->unsignedTinyInteger('opponent1_score')->nullable();
            $table->unsignedTinyInteger('opponent2_score')->nullable();
            $table->boolean('results_locked')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('match_games');
    }
};
