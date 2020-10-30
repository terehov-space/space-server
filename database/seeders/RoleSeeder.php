<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    private $default = [
        [
            'title' => 'Администратор',
            'code' => 'admin',
        ],
        [
            'title' => 'Менеджер',
            'code' => 'manager',
        ],
        [
            'title' => 'Программист',
            'code' => 'developer',
        ],
        [
            'title' => 'Клиент',
            'code' => 'client',
        ],
        [
            'title' => 'Гость',
            'code' => 'guest',
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
