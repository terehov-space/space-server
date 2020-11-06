<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::create([
            'title' => 'Default Project',
            'description' => 'Default description',
            'created_by' => 2,
            'assigned_to' => 4,
        ]);
    }
}
