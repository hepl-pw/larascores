<?php

namespace Database\Seeders;

use App\Models\Competition;
use App\Models\Country;
use Illuminate\Database\Seeder;

class CompetitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Competition::create([
            'name' => 'Premier League',
            'slug' => 'EPL',
            'country_id' => Country::where('name', 'England')->first()->id
        ]);
        Competition::create([
            'name' => 'Serie A',
            'slug' => 'ISA',
            'country_id' => Country::where('name', 'Italy')->first()->id
        ]);
        Competition::create([
            'name' => 'La Liga',
            'slug' => 'SLL',
            'country_id' => Country::where('name', 'Spain')->first()->id
        ]);
        Competition::create([
            'name' => 'FA Cup',
            'slug' => 'FAC',
            'country_id' => Country::where('name', 'England')->first()->id
        ]);
    }
}
