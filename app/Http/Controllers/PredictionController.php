<?php

namespace App\Http\Controllers;

use App\Models\MatchGame;
use App\Models\Prediction;
use App\Services\ScoreCalculator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PredictionController extends Controller
{
    public function store(Request $request, MatchGame $match, ScoreCalculator $calculator): RedirectResponse
    {
        if (! $match->isPredictionOpen()) {
            return back()->withErrors(['prediction' => 'Predictions are closed for this match.']);
        }

        $validated = $request->validate([
            'opponent1_score' => ['required', 'integer', 'min:0', 'max:99'],
            'opponent2_score' => ['required', 'integer', 'min:0', 'max:99'],
        ]);

        $score1 = (int) $validated['opponent1_score'];
        $score2 = (int) $validated['opponent2_score'];
        $winner = MatchGame::resolveWinner($match->opponent1, $match->opponent2, $score1, $score2);

        $user = $request->user();
        $existing = Prediction::where('user_id', $user->id)
            ->where('match_game_id', $match->id)
            ->first();

        if ($existing && ! $match->isPredictionOpen()) {
            return back()->withErrors(['prediction' => 'Your prediction can no longer be changed for this match.']);
        }

        $points = $match->hasResults()
            ? $calculator->calculate($match, $winner, $score1, $score2)
            : 0;

        if ($existing) {
            $existing->update([
                'winner' => $winner,
                'opponent1_score' => $score1,
                'opponent2_score' => $score2,
                'points_earned' => $points,
            ]);

            $action = 'updated';
        } else {
            Prediction::create([
                'user_id' => $user->id,
                'match_game_id' => $match->id,
                'winner' => $winner,
                'opponent1_score' => $score1,
                'opponent2_score' => $score2,
                'points_earned' => $points,
            ]);

            if ($points > 0) {
                $user->increment('score', $points);
            }

            $action = 'saved';
        }

        $label = $winner === MatchGame::DRAW
            ? 'Draw ('.$score1.'-'.$score2.')'
            : $winner.' ('.$score1.'-'.$score2.')';

        return back()->with('success', 'Prediction saved: '.$label);
    }
}
