<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MatchGame;
use App\Models\Prediction;
use App\Models\User;
use App\Services\ScoreCalculator;


class TestController extends Controller
{
    public function reCalculateScores( ScoreCalculator $calculator)
    {
        $matches = MatchGame::all();

        // Set all users' score to 0
        User::query()->update([
            'score' => 0
        ]);

        // Set all predictions' points_earned to 0
        Prediction::query()->update([
            'points_earned' => 0
        ]);

        foreach ($matches as $match) {
            $calculator->recalculateForMatchNew($match);
        }

        return 'Scores recalculated successfully.';
    }





}
