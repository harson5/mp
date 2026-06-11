<?php

namespace Tests\Unit;

use App\Models\MatchGame;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

class MatchGameResolveWinnerTest extends TestCase
{
    public function test_canada_1_italy_2_winner_is_italy(): void
    {
        $winner = MatchGame::resolveWinner('Canada', 'Italy', 1, 2);

        $this->assertSame('Italy', $winner);
    }

    public function test_canada_2_italy_1_winner_is_canada(): void
    {
        $winner = MatchGame::resolveWinner('Canada', 'Italy', 2, 1);

        $this->assertSame('Canada', $winner);
    }

    public function test_prediction_is_open_more_than_ten_minutes_before_match(): void
    {
        Carbon::setTestNow('2026-01-01 12:00:00');

        $match = new MatchGame([
            'match_datetime' => Carbon::now()->addMinutes(11),
            'results_locked' => false,
        ]);

        $this->assertTrue($match->isPredictionOpen());

        Carbon::setTestNow();
    }

    public function test_prediction_is_closed_within_ten_minutes_of_match(): void
    {
        Carbon::setTestNow('2026-01-01 12:00:00');

        $match = new MatchGame([
            'match_datetime' => Carbon::now()->addMinutes(9),
            'results_locked' => false,
        ]);

        $this->assertFalse($match->isPredictionOpen());

        Carbon::setTestNow();
    }
}
