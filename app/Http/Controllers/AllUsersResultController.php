<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AllUsersResultController extends Controller
{
    public function index(Request $request): View
    {
        $users = User::query()
            ->with(['predictions' => fn ($query) => $query->with('matchGame')])
            ->whereNot('role',100)
            ->orderByDesc('score')
            ->orderBy('name')
            ->get()
            ->map(function (User $user) {
                $user->predictions = $user->predictions
                    ->sortBy(fn ($p) => $p->matchGame->match_datetime)
                    ->values();

                return $user;
            });

        $selectedUser = null;
        $selectedUserId = (int) $request->query('user');

        if ($selectedUserId > 0) {
            $selectedUser = $users->firstWhere('id', $selectedUserId);
        }

        return view('all-users-results.index', [
            'users' => $users,
            'selectedUser' => $selectedUser,
            'totalScore' => $request->user()->score,
        ]);
    }
}
