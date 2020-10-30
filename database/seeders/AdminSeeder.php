<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'admin',
            'password' => Hash::make('default_password'),
            'email' => 'maxim@terehov.space',
        ]);

        $role = Role::find(1);

        $user->roles()->save($role);
    }
}
