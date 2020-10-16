<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'dominique.vilain@hepl.be')->first();

        $roleId = Role::where('name', 'admin')
            ->first()
            ->id;

        $user->roles()->attach($roleId);

        User::where('email', 'dominique.vilain@hepl.be')
            ->first()
            ->roles()
            ->attach(Role::where('name', 'team-manager')
                ->first()
                ->id);

        $otherUsers = User::where('email', '!=', 'dominique.vilain@hepl.be')
            ->get();

        $otherUsers = $otherUsers->skip(3);

        foreach ($otherUsers as $user) {
            $user->roles()
                ->attach(Role::where('name', 'team-manager')
                    ->first()
                    ->id);
        }

    }
}
