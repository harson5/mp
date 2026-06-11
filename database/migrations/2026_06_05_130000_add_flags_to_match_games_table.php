<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('match_games', function (Blueprint $table) {
            $table->string('opponent1_flag')->nullable()->after('opponent1');
            $table->string('opponent2_flag')->nullable()->after('opponent2');
        });
    }

    public function down(): void
    {
        Schema::table('match_games', function (Blueprint $table) {
            $table->dropColumn(['opponent1_flag', 'opponent2_flag']);
        });
    }
};
