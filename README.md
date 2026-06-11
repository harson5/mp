# Match Predictor (Laravel)

Web app where users register, log in, and predict match winners and scores. Points are added when actual results are entered.

## Features

- **Register / Login** using name and password
- **Today's matches** only on the main page (with team flags)
- **Admin CRUD** for matches (team names, flags, datetime, results) — role `100` only
- **Predictions**: winner, opponent 1 score, opponent 2 score (before match time)
- **My Results** tab: all your predictions with actual results and points earned
- **Scoring** (when results are saved):
  - Correct winner: **2 points**
  - Correct opponent 1 score: **1 point**
  - Correct opponent 2 score: **1 point**
  - All three correct: **5 points** total

## Database layout

| Table | Purpose |
|-------|---------|
| `users` | `name`, `password`, `role` (`1` = user, `100` = admin), `score` (total points) |
| `match_games` | `match_no`, `match_datetime`, `opponent1`, `opponent2`, actual results |
| `predictions` | Per user per match: `winner`, `opponent1_score`, `opponent2_score`, `points_earned` |

## Setup

```bash
cd match-predictor
composer install
cp .env.example .env   # if needed
php artisan key:generate
php artisan migrate:fresh --seed
php artisan storage:link
php artisan serve
```

Open http://127.0.0.1:8000

1. Register a new account
2. Submit predictions for upcoming matches
3. Log in as **admin** (`admin` / `admin123`) → **Manage Matches** tab to add/edit/delete matches, upload flags, and set results

## Sample matches

The seeder adds 3 future matches. Use the results form after predicting to test scoring.
