<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MatchGame;

use Illuminate\Support\Str;
class MatchGameSeeder extends Seeder
{
    /**
     * FIFA World Cup 2026 — All 104 Matches
     * All match_datetime values are in Nepal Time (NPT = UTC+5:45)
     */
    public function run(): void
    {
        $matches = [

            // ============================================================
            // GROUP STAGE — June 11 to June 27, 2026
            // ============================================================

            // --- June 11 (ET) ---
            ['match_no' => 1,   'match_datetime' => '2026-06-12 00:45:00', 'opponent1' => 'Mexico',               'opponent2' => 'South Africa'],
            ['match_no' => 2,   'match_datetime' => '2026-06-12 07:45:00', 'opponent1' => 'South Korea',          'opponent2' => 'Czechia'],

            // --- June 12 (ET) ---
            ['match_no' => 3,   'match_datetime' => '2026-06-13 00:45:00', 'opponent1' => 'Canada',               'opponent2' => 'Bosnia & Herzegovina'],
            ['match_no' => 4,   'match_datetime' => '2026-06-13 06:45:00', 'opponent1' => 'USA',                  'opponent2' => 'Paraguay'],

            // --- June 13 (ET) ---
            ['match_no' => 5,   'match_datetime' => '2026-06-14 00:45:00', 'opponent1' => 'Qatar',                'opponent2' => 'Switzerland'],
            ['match_no' => 6,   'match_datetime' => '2026-06-14 03:45:00', 'opponent1' => 'Brazil',               'opponent2' => 'Morocco'],
            ['match_no' => 7,   'match_datetime' => '2026-06-14 06:45:00', 'opponent1' => 'Haiti',                'opponent2' => 'Scotland'],

            // --- June 14 (ET) ---
            ['match_no' => 8,   'match_datetime' => '2026-06-14 09:45:00', 'opponent1' => 'Australia',            'opponent2' => 'Türkiye'],
            ['match_no' => 9,   'match_datetime' => '2026-06-14 22:45:00', 'opponent1' => 'Germany',              'opponent2' => 'Curaçao'],
            ['match_no' => 10,  'match_datetime' => '2026-06-15 01:45:00', 'opponent1' => 'Netherlands',          'opponent2' => 'Japan'],
            ['match_no' => 11,  'match_datetime' => '2026-06-15 04:45:00', 'opponent1' => 'Ivory Coast',          'opponent2' => 'Ecuador'],
            ['match_no' => 12,  'match_datetime' => '2026-06-15 07:45:00', 'opponent1' => 'Sweden',               'opponent2' => 'Tunisia'],

            // --- June 15 (ET) ---
            ['match_no' => 13,  'match_datetime' => '2026-06-15 21:45:00', 'opponent1' => 'Spain',                'opponent2' => 'Cape Verde'],
            ['match_no' => 14,  'match_datetime' => '2026-06-16 00:45:00', 'opponent1' => 'Belgium',              'opponent2' => 'Egypt'],
            ['match_no' => 15,  'match_datetime' => '2026-06-16 03:45:00', 'opponent1' => 'Saudi Arabia',         'opponent2' => 'Uruguay'],
            ['match_no' => 16,  'match_datetime' => '2026-06-16 06:45:00', 'opponent1' => 'Iran',                 'opponent2' => 'New Zealand'],

            // --- June 16 (ET) ---
            ['match_no' => 17,  'match_datetime' => '2026-06-17 00:45:00', 'opponent1' => 'France',               'opponent2' => 'Senegal'],
            ['match_no' => 18,  'match_datetime' => '2026-06-17 03:45:00', 'opponent1' => 'Iraq',                 'opponent2' => 'Norway'],
            ['match_no' => 19,  'match_datetime' => '2026-06-17 06:45:00', 'opponent1' => 'Argentina',            'opponent2' => 'Algeria'],

            // --- June 17 (ET) ---
            ['match_no' => 20,  'match_datetime' => '2026-06-17 09:45:00', 'opponent1' => 'Austria',              'opponent2' => 'Jordan'],
            ['match_no' => 21,  'match_datetime' => '2026-06-17 22:45:00', 'opponent1' => 'Portugal',             'opponent2' => 'DR Congo'],
            ['match_no' => 22,  'match_datetime' => '2026-06-18 01:45:00', 'opponent1' => 'England',              'opponent2' => 'Croatia'],
            ['match_no' => 23,  'match_datetime' => '2026-06-18 04:45:00', 'opponent1' => 'Ghana',                'opponent2' => 'Panama'],
            ['match_no' => 24,  'match_datetime' => '2026-06-18 07:45:00', 'opponent1' => 'Uzbekistan',           'opponent2' => 'Colombia'],

            // --- June 18 (ET) ---
            ['match_no' => 25,  'match_datetime' => '2026-06-18 21:45:00', 'opponent1' => 'Czechia',              'opponent2' => 'South Africa'],
            ['match_no' => 26,  'match_datetime' => '2026-06-19 00:45:00', 'opponent1' => 'Switzerland',          'opponent2' => 'Bosnia & Herzegovina'],
            ['match_no' => 27,  'match_datetime' => '2026-06-19 03:45:00', 'opponent1' => 'Canada',               'opponent2' => 'Qatar'],
            ['match_no' => 28,  'match_datetime' => '2026-06-19 06:45:00', 'opponent1' => 'Mexico',               'opponent2' => 'South Korea'],

            // --- June 19 (ET) ---
            ['match_no' => 29,  'match_datetime' => '2026-06-20 00:45:00', 'opponent1' => 'USA',                  'opponent2' => 'Australia'],
            ['match_no' => 30,  'match_datetime' => '2026-06-20 03:45:00', 'opponent1' => 'Scotland',             'opponent2' => 'Morocco'],
            ['match_no' => 31,  'match_datetime' => '2026-06-20 06:15:00', 'opponent1' => 'Brazil',               'opponent2' => 'Haiti'],
            ['match_no' => 32,  'match_datetime' => '2026-06-20 08:45:00', 'opponent1' => 'Türkiye',              'opponent2' => 'Paraguay'],

            // --- June 20 (ET) ---
            ['match_no' => 33,  'match_datetime' => '2026-06-20 22:45:00', 'opponent1' => 'Netherlands',          'opponent2' => 'Sweden'],
            ['match_no' => 34,  'match_datetime' => '2026-06-21 01:45:00', 'opponent1' => 'Germany',              'opponent2' => 'Ivory Coast'],
            ['match_no' => 35,  'match_datetime' => '2026-06-21 05:45:00', 'opponent1' => 'Ecuador',              'opponent2' => 'Curaçao'],

            // --- June 21 (ET) ---
            ['match_no' => 36,  'match_datetime' => '2026-06-21 09:45:00', 'opponent1' => 'Tunisia',              'opponent2' => 'Japan'],
            ['match_no' => 37,  'match_datetime' => '2026-06-21 21:45:00', 'opponent1' => 'Spain',                'opponent2' => 'Saudi Arabia'],
            ['match_no' => 38,  'match_datetime' => '2026-06-22 00:45:00', 'opponent1' => 'Belgium',              'opponent2' => 'Iran'],
            ['match_no' => 39,  'match_datetime' => '2026-06-22 03:45:00', 'opponent1' => 'Uruguay',              'opponent2' => 'Cape Verde'],
            ['match_no' => 40,  'match_datetime' => '2026-06-22 06:45:00', 'opponent1' => 'New Zealand',          'opponent2' => 'Egypt'],

            // --- June 22 (ET) ---
            ['match_no' => 41,  'match_datetime' => '2026-06-22 22:45:00', 'opponent1' => 'Argentina',            'opponent2' => 'Austria'],
            ['match_no' => 42,  'match_datetime' => '2026-06-23 02:45:00', 'opponent1' => 'France',               'opponent2' => 'Iraq'],
            ['match_no' => 43,  'match_datetime' => '2026-06-23 05:45:00', 'opponent1' => 'Norway',               'opponent2' => 'Senegal'],
            ['match_no' => 44,  'match_datetime' => '2026-06-23 08:45:00', 'opponent1' => 'Jordan',               'opponent2' => 'Algeria'],

            // --- June 23 (ET) ---
            ['match_no' => 45,  'match_datetime' => '2026-06-23 22:45:00', 'opponent1' => 'Portugal',             'opponent2' => 'Uzbekistan'],
            ['match_no' => 46,  'match_datetime' => '2026-06-24 01:45:00', 'opponent1' => 'England',              'opponent2' => 'Ghana'],
            ['match_no' => 47,  'match_datetime' => '2026-06-24 04:45:00', 'opponent1' => 'Panama',               'opponent2' => 'Croatia'],
            ['match_no' => 48,  'match_datetime' => '2026-06-24 07:45:00', 'opponent1' => 'Colombia',             'opponent2' => 'DR Congo'],

            // --- June 24 Final Matchday Groups A, B, C (ET) ---
            ['match_no' => 49,  'match_datetime' => '2026-06-25 00:45:00', 'opponent1' => 'Switzerland',          'opponent2' => 'Canada'],
            ['match_no' => 50,  'match_datetime' => '2026-06-25 00:45:00', 'opponent1' => 'Bosnia & Herzegovina', 'opponent2' => 'Qatar'],
            ['match_no' => 51,  'match_datetime' => '2026-06-25 03:45:00', 'opponent1' => 'Scotland',             'opponent2' => 'Brazil'],
            ['match_no' => 52,  'match_datetime' => '2026-06-25 03:45:00', 'opponent1' => 'Morocco',              'opponent2' => 'Haiti'],
            ['match_no' => 53,  'match_datetime' => '2026-06-25 06:45:00', 'opponent1' => 'Czechia',              'opponent2' => 'Mexico'],
            ['match_no' => 54,  'match_datetime' => '2026-06-25 06:45:00', 'opponent1' => 'South Africa',         'opponent2' => 'South Korea'],

            // --- June 25 Final Matchday Groups D, E, F (ET) ---
            ['match_no' => 55,  'match_datetime' => '2026-06-26 01:45:00', 'opponent1' => 'Curaçao',              'opponent2' => 'Ivory Coast'],
            ['match_no' => 56,  'match_datetime' => '2026-06-26 01:45:00', 'opponent1' => 'Ecuador',              'opponent2' => 'Germany'],
            ['match_no' => 57,  'match_datetime' => '2026-06-26 04:45:00', 'opponent1' => 'Japan',                'opponent2' => 'Sweden'],
            ['match_no' => 58,  'match_datetime' => '2026-06-26 04:45:00', 'opponent1' => 'Tunisia',              'opponent2' => 'Netherlands'],
            ['match_no' => 59,  'match_datetime' => '2026-06-26 07:45:00', 'opponent1' => 'Türkiye',              'opponent2' => 'USA'],
            ['match_no' => 60,  'match_datetime' => '2026-06-26 07:45:00', 'opponent1' => 'Paraguay',             'opponent2' => 'Australia'],

            // --- June 26 Final Matchday Groups G, H, I (ET) ---
            ['match_no' => 61,  'match_datetime' => '2026-06-27 00:45:00', 'opponent1' => 'Norway',               'opponent2' => 'France'],
            ['match_no' => 62,  'match_datetime' => '2026-06-27 00:45:00', 'opponent1' => 'Senegal',              'opponent2' => 'Iraq'],
            ['match_no' => 63,  'match_datetime' => '2026-06-27 05:45:00', 'opponent1' => 'Cape Verde',           'opponent2' => 'Saudi Arabia'],
            ['match_no' => 64,  'match_datetime' => '2026-06-27 05:45:00', 'opponent1' => 'Uruguay',              'opponent2' => 'Spain'],
            ['match_no' => 65,  'match_datetime' => '2026-06-27 08:45:00', 'opponent1' => 'Egypt',                'opponent2' => 'Iran'],
            ['match_no' => 66,  'match_datetime' => '2026-06-27 08:45:00', 'opponent1' => 'New Zealand',          'opponent2' => 'Belgium'],

            // --- June 27 Final Matchday Groups J, K, L (ET) ---
            ['match_no' => 67,  'match_datetime' => '2026-06-28 02:45:00', 'opponent1' => 'Panama',               'opponent2' => 'England'],
            ['match_no' => 68,  'match_datetime' => '2026-06-28 02:45:00', 'opponent1' => 'Croatia',              'opponent2' => 'Ghana'],
            ['match_no' => 69,  'match_datetime' => '2026-06-28 05:15:00', 'opponent1' => 'Colombia',             'opponent2' => 'Portugal'],
            ['match_no' => 70,  'match_datetime' => '2026-06-28 05:15:00', 'opponent1' => 'DR Congo',             'opponent2' => 'Uzbekistan'],
            ['match_no' => 71,  'match_datetime' => '2026-06-28 07:45:00', 'opponent1' => 'Algeria',              'opponent2' => 'Austria'],
            ['match_no' => 72,  'match_datetime' => '2026-06-28 07:45:00', 'opponent1' => 'Jordan',               'opponent2' => 'Argentina'],

            // // ============================================================
            // // ROUND OF 32 — June 28 to July 3, 2026
            // // ============================================================

            // ['match_no' => 73,  'match_datetime' => '2026-06-29 00:45:00', 'opponent1' => 'Runner-up Group A',    'opponent2' => 'Runner-up Group B'],
            // ['match_no' => 74,  'match_datetime' => '2026-06-29 22:45:00', 'opponent1' => 'Winner Group C',       'opponent2' => 'Runner-up Group F'],
            // ['match_no' => 75,  'match_datetime' => '2026-06-30 02:15:00', 'opponent1' => 'Winner Group E',       'opponent2' => 'Best 3rd (A/B/C/D/F)'],
            // ['match_no' => 76,  'match_datetime' => '2026-06-30 06:45:00', 'opponent1' => 'Winner Group F',       'opponent2' => 'Runner-up Group C'],
            // ['match_no' => 77,  'match_datetime' => '2026-06-30 22:45:00', 'opponent1' => 'Runner-up Group E',    'opponent2' => 'Runner-up Group I'],
            // ['match_no' => 78,  'match_datetime' => '2026-07-01 02:45:00', 'opponent1' => 'Winner Group I',       'opponent2' => 'Best 3rd (C/D/F/G/H)'],
            // ['match_no' => 79,  'match_datetime' => '2026-07-01 06:45:00', 'opponent1' => 'Winner Group A',       'opponent2' => 'Best 3rd (C/E/F/H/I)'],
            // ['match_no' => 80,  'match_datetime' => '2026-07-01 21:45:00', 'opponent1' => 'Winner Group L',       'opponent2' => 'Best 3rd (E/H/I/J/K)'],
            // ['match_no' => 81,  'match_datetime' => '2026-07-02 01:45:00', 'opponent1' => 'Winner Group G',       'opponent2' => 'Best 3rd (A/E/H/I/J)'],
            // ['match_no' => 82,  'match_datetime' => '2026-07-02 05:45:00', 'opponent1' => 'Winner Group D',       'opponent2' => 'Best 3rd (B/E/F/I/J)'],
            // ['match_no' => 83,  'match_datetime' => '2026-07-03 00:45:00', 'opponent1' => 'Winner Group H',       'opponent2' => 'Runner-up Group J'],
            // ['match_no' => 84,  'match_datetime' => '2026-07-03 04:45:00', 'opponent1' => 'Runner-up Group K',    'opponent2' => 'Runner-up Group L'],
            // ['match_no' => 85,  'match_datetime' => '2026-07-03 08:45:00', 'opponent1' => 'Winner Group B',       'opponent2' => 'Best 3rd (E/F/G/I/J)'],
            // ['match_no' => 86,  'match_datetime' => '2026-07-03 23:45:00', 'opponent1' => 'Runner-up Group D',    'opponent2' => 'Runner-up Group G'],
            // ['match_no' => 87,  'match_datetime' => '2026-07-04 03:45:00', 'opponent1' => 'Winner Group J',       'opponent2' => 'Runner-up Group H'],
            // ['match_no' => 88,  'match_datetime' => '2026-07-04 07:15:00', 'opponent1' => 'Winner Group K',       'opponent2' => 'Best 3rd (D/E/I/J/L)'],

            // // ============================================================
            // // ROUND OF 16 — July 4 to July 7, 2026
            // // ============================================================

            // ['match_no' => 89,  'match_datetime' => '2026-07-04 22:45:00', 'opponent1' => 'Winner Match 73',      'opponent2' => 'Winner Match 75'],
            // ['match_no' => 90,  'match_datetime' => '2026-07-05 02:45:00', 'opponent1' => 'Winner Match 74',      'opponent2' => 'Winner Match 77'],
            // ['match_no' => 91,  'match_datetime' => '2026-07-06 01:45:00', 'opponent1' => 'Winner Match 76',      'opponent2' => 'Winner Match 78'],
            // ['match_no' => 92,  'match_datetime' => '2026-07-06 05:45:00', 'opponent1' => 'Winner Match 79',      'opponent2' => 'Winner Match 80'],
            // ['match_no' => 93,  'match_datetime' => '2026-07-07 00:45:00', 'opponent1' => 'Winner Match 83',      'opponent2' => 'Winner Match 84'],
            // ['match_no' => 94,  'match_datetime' => '2026-07-07 05:45:00', 'opponent1' => 'Winner Match 81',      'opponent2' => 'Winner Match 82'],
            // ['match_no' => 95,  'match_datetime' => '2026-07-07 21:45:00', 'opponent1' => 'Winner Match 86',      'opponent2' => 'Winner Match 88'],
            // ['match_no' => 96,  'match_datetime' => '2026-07-08 01:45:00', 'opponent1' => 'Winner Match 85',      'opponent2' => 'Winner Match 87'],

            // // ============================================================
            // // QUARTERFINALS — July 9 to July 11, 2026
            // // ============================================================

            // ['match_no' => 97,  'match_datetime' => '2026-07-10 01:45:00', 'opponent1' => 'Winner Match 89',      'opponent2' => 'Winner Match 90'],
            // ['match_no' => 98,  'match_datetime' => '2026-07-11 00:45:00', 'opponent1' => 'Winner Match 93',      'opponent2' => 'Winner Match 94'],
            // ['match_no' => 99,  'match_datetime' => '2026-07-12 02:45:00', 'opponent1' => 'Winner Match 91',      'opponent2' => 'Winner Match 92'],
            // ['match_no' => 100, 'match_datetime' => '2026-07-12 06:45:00', 'opponent1' => 'Winner Match 95',      'opponent2' => 'Winner Match 96'],

            // // ============================================================
            // // SEMIFINALS — July 14 to July 15, 2026
            // // ============================================================

            // ['match_no' => 101, 'match_datetime' => '2026-07-15 00:45:00', 'opponent1' => 'Winner Match 97',      'opponent2' => 'Winner Match 98'],
            // ['match_no' => 102, 'match_datetime' => '2026-07-16 00:45:00', 'opponent1' => 'Winner Match 99',      'opponent2' => 'Winner Match 100'],

            // // ============================================================
            // // THIRD-PLACE MATCH — July 18, 2026
            // // ============================================================

            // ['match_no' => 103, 'match_datetime' => '2026-07-19 02:45:00', 'opponent1' => 'Loser Match 101',      'opponent2' => 'Loser Match 102'],

            // // ============================================================
            // // WORLD CUP FINAL — July 19, 2026
            // // ============================================================

            // ['match_no' => 104, 'match_datetime' => '2026-07-20 00:45:00', 'opponent1' => 'Winner Match 101',     'opponent2' => 'Winner Match 102'],
        ];

        foreach ($matches as $match) {

            $matchNo = $match['match_no'];

            // Normalize names → match your storage format
            $opponent1Slug = Str::slug($match['opponent1'], '_');
            $opponent2Slug = Str::slug($match['opponent2'], '_');

            $match['opponent1_flag'] = "flags/{$opponent1Slug}_{$matchNo}.png";
            $match['opponent2_flag'] = "flags/{$opponent2Slug}_{$matchNo}.png";

            MatchGame::create($match);
        }
    }
}