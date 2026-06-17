<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class UserResultController extends Controller
{
    public function index(Request $request): View
    {
        $predictions = $request->user()
            ->predictions()
            ->with('matchGame')
            ->get()
            ->sortByDesc(fn ($prediction) => $prediction->matchGame->match_datetime)
            ->values();

        return view('user-results.index', [
            'predictions' => $predictions,
            'totalScore' => $request->user()->score,
        ]);
    }
}
