<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    private $default = [
        [
            'title' => 'admin',
        ],
        [
            'title' => 'manager',
        ],
        [
            'title' => 'developer',
        ],
        [
            'title' => 'client',
        ],
        [
            'title' => 'guest',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->default as $role) {
            Role::create($role);
        }
    }
}
