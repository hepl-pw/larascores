<?php

namespace Database\Seeders;

use App\Models\Competition;
use App\Models\Tournament;
use Illuminate\Database\Seeder;

class TournamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $t = Tournament::create([
            'competition_id' => Competition::whereName('Premier League')->first()->id,
            'span_years' => '2020-2021',
        ]);
        $t->addMediaFromUrl('https://upload.wikimedia.org/wikipedia/fr/f/f2/Premier_League_Logo.svg')
            ->toMediaCollection('tournaments');

        $t = Tournament::create([
            'competition_id' => Competition::whereName('Serie A')->first()->id,
            'span_years' => '2020-2021',
        ]);
        $t->addMediaFromUrl('https://upload.wikimedia.org/wikipedia/commons/b/b4/Serie_A_Logo_%28ab_2019%29.svg')
            ->toMediaCollection('tournaments');


        $t = Tournament::create([
            'competition_id' => Competition::whereName('La Liga')->first()->id,
            'span_years' => '2020-2021',
        ]);
        $t->addMediaFromUrl('https://upload.wikimedia.org/wikipedia/commons/9/92/LaLiga_Santander.svg')
            ->toMediaCollection('tournaments');

        $t = Tournament::create([
            'competition_id' => Competition::whereName('FA Cup')->first()->id,
            'span_years' => '2020-2021',
        ]);
        $t->addMediaFromUrl('https://upload.wikimedia.org/wikipedia/fr/6/68/FA_Cup_logo.svg')
            ->toMediaCollection('tournaments');

        $t = Tournament::create([
            'competition_id' => Competition::whereName('Premier League')->first()->id,
            'span_years' => '2000-2001',
        ]);
        $t->addMediaFromUrl('https://static.wikia.nocookie.net/logopedia/images/2/21/Premier_League_1992.svg')
            ->toMediaCollection('tournaments');

    }
}
