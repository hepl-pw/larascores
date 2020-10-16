<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Dominique Vilain',
            'email' => 'dominique.vilain@hepl.be',
            'password' => Hash::make('dominique')
        ]);

        User::factory(5)->create();
    }
}
