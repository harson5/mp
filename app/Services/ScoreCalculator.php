<?php

namespace App\Services;

use App\Models\MatchGame;
use App\Models\Prediction;

class ScoreCalculator
{
    public function calculate(MatchGame $match, string $predictedWinner, int $predictedO1, int $predictedO2): int
    {
        if ($match->winner === null || $match->opponent1_score === null || $match->opponent2_score === null) {
            return 0;
        }

        $actualO1 = (int) $match->opponent1_score;
        $actualO2 = (int) $match->opponent2_score;
        $o1Correct = $predictedO1 === $actualO1;
        $o2Correct = $predictedO2 === $actualO2;

        if ($match->isDrawResult()) {
            if (! MatchGame::isDrawPrediction($predictedWinner, $predictedO1, $predictedO2)) {
                return $this->calculateNonDrawOutcome($match, $predictedWinner, $o1Correct, $o2Correct);
            }

            if ($o1Correct && $o2Correct) {
                return 5;
            }

            return 2;
        }

        if (MatchGame::isDrawPrediction($predictedWinner, $predictedO1, $predictedO2)) {
            return 0;
        }

        return $this->calculateNonDrawOutcome($match, $predictedWinner, $o1Correct, $o2Correct);
    }

    private function calculateNonDrawOutcome(MatchGame $match, string $predictedWinner, bool $o1Correct, bool $o2Correct): int
    {
        $actualWinner = $match->resolvedWinner() ?? $match->winner;
        $winnerCorrect = strcasecmp($predictedWinner, $actualWinner) === 0;

        if ($winnerCorrect && $o1Correct && $o2Correct) {
            return 5;
        }

        $points = 0;
        if ($winnerCorrect) {
            $points += 2;
        }
        if ($o1Correct) {
            $points += 1;
        }
        if ($o2Correct) {
            $points += 1;
        }

        return $points;
    }

    public function recalculateForMatch(MatchGame $match): void
    {
        if ($match->winner === null || $match->opponent1_score === null || $match->opponent2_score === null) {
            return;
        }

        $predictions = Prediction::with('user')->where('match_game_id', $match->id)->get();

        foreach ($predictions as $prediction) {
            $oldPoints = $prediction->points_earned;
            $newPoints = $this->calculate(
                $match,
                $prediction->winner,
                $prediction->opponent1_score,
                $prediction->opponent2_score
            );

            if ($oldPoints !== $newPoints) {
                $prediction->user->decrement('score', $oldPoints);
                $prediction->user->increment('score', $newPoints);
                $prediction->update(['points_earned' => $newPoints]);
            }
        }
    }
}
