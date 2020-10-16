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
        Tournament::create([
            'competition_id' => Competition::whereName('Premier League')->first()->id,
            'span_years' => '2020-2021',
            'file_name' => ''
        ]);
        Tournament::create([
            'competition_id' => Competition::whereName('Serie A')->first()->id,
            'span_years' => '2020-2021',
            'file_name' => ''
        ]);
        Tournament::create([
            'competition_id' => Competition::whereName('La Liga')->first()->id,
            'span_years' => '2020-2021',
            'file_name' => ''
        ]);
        Tournament::create([
            'competition_id' => Competition::whereName('FA Cup')->first()->id,
            'span_years' => '2020-2021',
            'file_name' => ''
        ]);
    }
}
