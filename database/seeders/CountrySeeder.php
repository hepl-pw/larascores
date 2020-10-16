<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Slugs according to https://en.wikipedia.org/wiki/List_of_FIFA_country_codes
        Country::create(['name' => 'England', 'slug' => 'ENG']);
        Country::create(['name' => 'Italy', 'slug' => 'ITA']);
        Country::create(['name' => 'Spain', 'slug' => 'ESP']);

        //Special case, could be leading to a change from 'country' to 'region'
        Country::create(['name' => 'Europe', 'slug' => 'EUR']);
        Country::create(['name' => 'World', 'slug' => 'WOR']);
    }
}
