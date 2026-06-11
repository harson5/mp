<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MatchGame extends Model
{
    public const DRAW = 'Draw';

    protected $fillable = [
        'match_no',
        'match_datetime',
        'opponent1',
        'opponent1_flag',
        'opponent2',
        'opponent2_flag',
        'winner',
        'opponent1_score',
        'opponent2_score',
        'results_locked',
    ];

    protected function casts(): array
    {
        return [
            'match_datetime' => 'datetime',
            'results_locked' => 'boolean',
        ];
    }

    public function predictions(): HasMany
    {
        return $this->hasMany(Prediction::class);
    }

    public function hasResults(): bool
    {
        return $this->winner !== null
            && $this->opponent1_score !== null
            && $this->opponent2_score !== null;
    }

    public function isPredictionOpen(): bool
    {
        return ! $this->results_locked
            && $this->match_datetime
            && $this->match_datetime->greaterThan(now()->addMinutes(10));
    }

    public function isToday(): bool
    {
        return $this->match_datetime->isToday();
    }

    public function flagUrl(?string $path): ?string
    {
        return $path ? asset('storage/'.$path) : null;
    }

    public function isDrawResult(): bool
    {
        return $this->opponent1_score !== null
            && $this->opponent2_score !== null
            && (int) $this->opponent1_score === (int) $this->opponent2_score;
    }

    public static function isDrawWinner(string $winner): bool
    {
        return strcasecmp($winner, self::DRAW) === 0;
    }

    public static function isDrawPrediction(string $winner, int $score1, int $score2): bool
    {
        return self::isDrawWinner($winner) || $score1 === $score2;
    }

    public static function resolveWinner(string $opponent1, string $opponent2, int $score1, int $score2): string
    {
        if ($score1 === $score2) {
            return self::DRAW;
        }

        return $score1 > $score2 ? $opponent1 : $opponent2;
    }

    public function resolvedWinner(): ?string
    {
        if ($this->opponent1_score === null || $this->opponent2_score === null) {
            return $this->winner;
        }

        if ($this->opponent1 === null || $this->opponent2 === null) {
            return $this->winner;
        }

        return self::resolveWinner(
            $this->opponent1,
            $this->opponent2,
            (int) $this->opponent1_score,
            (int) $this->opponent2_score
        );
    }

    public function resultLabel(): ?string
    {
        if (! $this->hasResults()) {
            return null;
        }

        $winner = $this->resolvedWinner();

        return $winner.' ('.$this->opponent1_score.'-'.$this->opponent2_score.')';
    }
}
