<?php

namespace Database\Seeders;

use App\Models\Role;
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
        $user = User::create([
            'name' => 'manager',
            'password' => Hash::make('default_password'),
            'email' => 'manager@terehov.space',
        ]);

        $role = Role::find(2);

        $user->roles()->save($role);

        $user = User::create([
            'name' => 'developer',
            'password' => Hash::make('default_password'),
            'email' => 'developer@terehov.space',
        ]);

        $role = Role::find(3);

        $user->roles()->save($role);

        $user = User::create([
            'name' => 'client',
            'password' => Hash::make('default_password'),
            'email' => 'client@terehov.space',
        ]);

        $role = Role::find(4);

        $user->roles()->save($role);
    }
}
