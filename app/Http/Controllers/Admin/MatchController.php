<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MatchGame;
use App\Services\ScoreCalculator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class MatchController extends Controller
{
    public function index(Request $request): View
    {
        $query = MatchGame::query();

        if ($request->boolean('today')) {
            $query->whereDate('match_datetime', today());
        }
        if ($request->boolean('result_locked')) {
            $query->where('results_locked', true);
        }

        $matches = $query->orderBy('id')->get();

        return view('admin.matches.index', [
            'matches' => $matches,
            'totalScore' => auth()->user()->score,
        ]);
    }

    public function create(): View
    {
        return view('admin.matches.form', [
            'match' => new MatchGame,
            'totalScore' => auth()->user()->score,
        ]);
    }

    public function store(Request $request, ScoreCalculator $calculator): RedirectResponse
    {
        $validated = $this->validatedMatch($request);
        $match = MatchGame::create($this->matchAttributes($validated));

        $this->storeFlags($request, $match);
        $winnerNotice = $this->applyResults($request, $match, $calculator);

        return redirect()
            ->route('admin.matches.index')
            ->with('success', 'Match created successfully.')
            ->with('warning', $winnerNotice);
    }

    public function edit(MatchGame $match): View
    {
        return view('admin.matches.form', [
            'match' => $match,
            'totalScore' => auth()->user()->score,
        ]);
    }

    public function update(Request $request, MatchGame $match, ScoreCalculator $calculator): RedirectResponse
    {
        $validated = $this->validatedMatch($request, $match);
        $match->update($this->matchAttributes($validated));

        $this->storeFlags($request, $match);
        $winnerNotice = $this->applyResults($request, $match, $calculator);

        return redirect()
            ->route('admin.matches.index')
            ->with('success', 'Match updated successfully.')
            ->with('warning', $winnerNotice);
    }

    public function destroy(MatchGame $match): RedirectResponse
    {
        $this->deleteFlag($match->opponent1_flag);
        $this->deleteFlag($match->opponent2_flag);
        $match->delete();

        return redirect()
            ->route('admin.matches.index')
            ->with('success', 'Match deleted.');
    }

    private function validatedMatch(Request $request, ?MatchGame $match = null): array
    {
        return $request->validate([
            'match_no' => ['required', 'integer', 'min:1'],
            'match_datetime' => ['required', 'date'],
            'opponent1' => ['required', 'string', 'max:255'],
            'opponent2' => ['required', 'string', 'max:255', 'different:opponent1'],
            'opponent1_flag' => ['nullable', 'image', 'max:2048'],
            'opponent2_flag' => ['nullable', 'image', 'max:2048'],
            'winner' => ['nullable', 'string', 'max:255'],
            'opponent1_score' => ['nullable', 'integer', 'min:0', 'max:99'],
            'opponent2_score' => ['nullable', 'integer', 'min:0', 'max:99'],
            'results_locked' => ['nullable', 'boolean'],
        ]);
    }

    private function matchAttributes(array $validated): array
    {
        return [
            'match_no' => $validated['match_no'],
            'match_datetime' => $validated['match_datetime'],
            'opponent1' => $validated['opponent1'],
            'opponent2' => $validated['opponent2'],
            'results_locked' => (bool) ($validated['results_locked'] ?? false),
        ];
    }

    private function storeFlags(Request $request, MatchGame $match): void
    {
        $updates = [];

        // if ($request->hasFile('opponent1_flag')) {
        //     $this->deleteFlag($match->opponent1_flag);
        //     $updates['opponent1_flag'] = $request->file('opponent1_flag')->store('flags', 'public');
        // }

        // if ($request->hasFile('opponent2_flag')) {
        //     $this->deleteFlag($match->opponent2_flag);
        //     $updates['opponent2_flag'] = $request->file('opponent2_flag')->store('flags', 'public');
        // }
         if ($request->hasFile('opponent1_flag')) {
        $this->deleteFlag($match->opponent1_flag);

        $file = $request->file('opponent1_flag');
        $extension = $file->getClientOriginalExtension();

        // convert opponent name to safe filename
        $name = strtolower(str_replace(' ', '_', $match->opponent1));

        // $filename = $name . '.' . $extension;
        $filename = $name . '_' . $match->match_no . '.' . $extension;

        $updates['opponent1_flag'] = $file->storeAs('flags', $filename, 'public');
    }

    if ($request->hasFile('opponent2_flag')) {
        $this->deleteFlag($match->opponent2_flag);

        $file = $request->file('opponent2_flag');
        $extension = $file->getClientOriginalExtension();

        $name = strtolower(str_replace(' ', '_', $match->opponent2));

        // $filename = $name . '.' . $extension;
        $filename = $name . '_' . $match->match_no . '.' . $extension;

        $updates['opponent2_flag'] = $file->storeAs('flags', $filename, 'public');
    }

        if ($updates !== []) {
            $match->update($updates);
        }
    }

    private function applyResults(Request $request, MatchGame $match, ScoreCalculator $calculator): ?string
    {
        $score1 = $request->input('opponent1_score');
        $score2 = $request->input('opponent2_score');

        if ($score1 === null || $score2 === null || $score1 === '' || $score2 === '') {
            return null;
        }

        $score1 = (int) $score1;
        $score2 = (int) $score2;

        $winner = MatchGame::resolveWinner($match->opponent1, $match->opponent2, $score1, $score2);
        $selectedWinner = $request->input('winner');

        $notice = null;
        if ($selectedWinner && $selectedWinner !== $winner && $winner !== MatchGame::DRAW) {
            $notice = "Winner was set to {$winner} based on the score ({$score1}-{$score2}). It did not match your selection.";
        }

        if ($selectedWinner && $selectedWinner !== MatchGame::DRAW && $winner === MatchGame::DRAW) {
            $notice = 'Equal scores — result saved as Draw.';
        }

        $match->update([
            'winner' => $winner,
            'opponent1_score' => $score1,
            'opponent2_score' => $score2,
            'results_locked' => (bool) $request->boolean('results_locked', true),
        ]);

        $calculator->recalculateForMatch($match->fresh());

        return $notice;
    }

    private function deleteFlag(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
