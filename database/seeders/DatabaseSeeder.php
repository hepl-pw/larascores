<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        collect(Storage::allDirectories())->each(function ($d) {
            Storage::deleteDirectory($d);
        });
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(RoleUserSeeder::class);
        //$this->call(CountrySeeder::class);
        $this->call(TeamSeeder::class);
        $this->call(CompetitionSeeder::class);
        $this->call(TournamentSeeder::class);
        $this->call(MatchSeeder::class);
        $this->call(StatsSeeder::class);
    }
}
