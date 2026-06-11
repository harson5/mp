<?php

namespace Tests\Unit;

use App\Models\MatchGame;
use App\Services\ScoreCalculator;
use PHPUnit\Framework\TestCase;

class ScoreCalculatorTest extends TestCase
{
    public function test_all_correct_gives_five_points(): void
    {
        $match = new MatchGame([
            'opponent1' => 'Team A',
            'opponent2' => 'Team B',
            'winner' => 'Team A',
            'opponent1_score' => 2,
            'opponent2_score' => 1,
        ]);

        $calculator = new ScoreCalculator();
        $points = $calculator->calculate($match, 'Team A', 2, 1);

        $this->assertSame(5, $points);
    }

    public function test_partial_correct_points(): void
    {
        $match = new MatchGame([
            'opponent1' => 'Team A',
            'opponent2' => 'Team B',
            'winner' => 'Team A',
            'opponent1_score' => 2,
            'opponent2_score' => 1,
        ]);

        $calculator = new ScoreCalculator();
        $points = $calculator->calculate($match, 'Team A', 2, 0);

        $this->assertSame(3, $points);
    }

    public function test_draw_exact_score_gives_five_points(): void
    {
        $match = new MatchGame([
            'opponent1' => 'Canada',
            'opponent2' => 'Italy',
            'winner' => MatchGame::DRAW,
            'opponent1_score' => 1,
            'opponent2_score' => 1,
        ]);

        $calculator = new ScoreCalculator();
        $points = $calculator->calculate($match, MatchGame::DRAW, 1, 1);

        $this->assertSame(5, $points);
    }

    public function test_draw_wrong_score_gives_two_points(): void
    {
        $match = new MatchGame([
            'opponent1' => 'Canada',
            'opponent2' => 'Italy',
            'winner' => MatchGame::DRAW,
            'opponent1_score' => 1,
            'opponent2_score' => 1,
        ]);

        $calculator = new ScoreCalculator();
        $points = $calculator->calculate($match, MatchGame::DRAW, 2, 2);

        $this->assertSame(2, $points);
    }

    public function test_draw_predicted_with_equal_scores_but_not_draw_winner_label(): void
    {
        $match = new MatchGame([
            'opponent1' => 'Canada',
            'opponent2' => 'Italy',
            'winner' => MatchGame::DRAW,
            'opponent1_score' => 0,
            'opponent2_score' => 0,
        ]);

        $calculator = new ScoreCalculator();
        $points = $calculator->calculate($match, MatchGame::DRAW, 2, 2);

        $this->assertSame(2, $points);
    }
}
