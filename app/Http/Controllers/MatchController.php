<?php

namespace App\Http\Controllers;

use App\Models\MatchGame;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MatchController extends Controller
{
    public function index(Request $request): View
    {
        $matches = MatchGame::query()
            // ->whereDate('match_datetime', today())
                ->whereBetween('match_datetime', [
                    now()->startOfDay(),
                    now()->addDay()->endOfDay()
                ])
            ->orderBy('results_locked')
            ->orderBy('match_datetime')
            ->get();

        $userPredictions = $request->user()
            ->predictions()
            ->whereIn('match_game_id', $matches->pluck('id'))
            ->get()
            ->keyBy('match_game_id');
        $topUsers = User::orderByDesc('score')->take(5)->get(['name', 'score']);

        return view('matches.index', [
            'matches' => $matches,
            'userPredictions' => $userPredictions,
            'totalScore' => $request->user()->score,
            'topUsers' =>   $topUsers,
            'todayLabel' => today()->format('l, F j, Y'),
        ]);
    }
}
