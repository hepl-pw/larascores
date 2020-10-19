<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 6 Premier League teams
        $t = Team::create([
            'name' => 'Liverpool',
            'slug' => 'LIV',
        ]);
        $t->addMediaFromUrl('https://upload.wikimedia.org/wikipedia/fr/5/54/Logo_FC_Liverpool.svg')
            ->toMediaCollection('clubs');

        $t = Team::create([
            'name' => 'Chelsea FC',
            'slug' => 'CHE',
        ]);
        $t->addMediaFromUrl('https://upload.wikimedia.org/wikipedia/fr/5/51/Logo_Chelsea.svg')
            ->toMediaCollection('clubs');

        $t = Team::create([
            'name' => 'Arsenal',
            'slug' => 'ARS',
        ]);
        $t->addMediaFromUrl('https://upload.wikimedia.org/wikipedia/fr/5/53/Arsenal_FC.svg')
            ->toMediaCollection('clubs');

        $t = Team::create([
            'name' => 'Manchester City',
            'slug' => 'MCI',
        ]);
        $t->addMediaFromUrl('https://upload.wikimedia.org/wikipedia/fr/b/ba/Logo_Manchester_City_2016.svg')
            ->toMediaCollection('clubs');

        $t = Team::create([
            'name' => 'Manchester United',
            'slug' => 'MUN',
        ]);
        $t->addMediaFromUrl('https://upload.wikimedia.org/wikipedia/fr/b/b9/Logo_Manchester_United.svg')
            ->toMediaCollection('clubs');

        $t = Team::create([
            'name' => 'Tottenham',
            'slug' => 'TOT',
        ]);
        $t->addMediaFromUrl('https://upload.wikimedia.org/wikipedia/fr/5/5c/Logo_Tottenham_Hotspur.svg')
            ->toMediaCollection('clubs');

        // 4 Serie A teams
        $t = Team::create([
            'name' => 'Juventus',
            'slug' => 'JUV',
        ]);

        $t->addMediaFromUrl('https://upload.wikimedia.org/wikipedia/commons/b/bc/Juventus_FC_2017_icon_%28black%29.svg')
            ->toMediaCollection('clubs');
        $t = Team::create([
            'name' => 'Inter Milan',
            'slug' => 'INT',
        ]);

        $t->addMediaFromUrl('https://upload.wikimedia.org/wikipedia/commons/8/89/FC_Internazionale_Milano_2014.svg')
            ->toMediaCollection('clubs');
        $t = Team::create([
            'name' => 'Napoli',
            'slug' => 'NAP',
        ]);
        $t->addMediaFromUrl('https://upload.wikimedia.org/wikipedia/commons/2/2d/SSC_Neapel.svg')
            ->toMediaCollection('clubs');

        $t = Team::create([
            'name' => 'Lazio Roma',
            'slug' => 'LAZ',
        ]);
        $t->addMediaFromUrl('https://upload.wikimedia.org/wikipedia/fr/4/4f/Logo_Lazio.svg')
            ->toMediaCollection('clubs');

        // 4 La Liga teams
        $t = Team::create([
            'name' => 'Real Madrid',
            'slug' => 'RMA',
        ]);
        $t->addMediaFromUrl('https://upload.wikimedia.org/wikipedia/fr/c/c7/Logo_Real_Madrid.svg')
            ->toMediaCollection('clubs');

        $t = Team::create([
            'name' => 'Barcelona FC',
            'slug' => 'BAR',
        ]);
        $t->addMediaFromUrl('https://upload.wikimedia.org/wikipedia/fr/a/a1/Logo_FC_Barcelona.svg')
            ->toMediaCollection('clubs');

        $t = Team::create([
            'name' => 'Sevilla',
            'slug' => 'SEV',
        ]);
        $t->addMediaFromUrl('https://upload.wikimedia.org/wikipedia/fr/f/f1/Logo_Sevilla_FC.svg')
            ->toMediaCollection('clubs');

        $t = Team::create([
            'name' => 'Atletico Madrid',
            'slug' => 'ATL',
        ]);
        $t->addMediaFromUrl('https://upload.wikimedia.org/wikipedia/fr/9/93/Logo_Atl%C3%A9tico_Madrid_2017.svg')
            ->toMediaCollection('clubs');

    }
}
