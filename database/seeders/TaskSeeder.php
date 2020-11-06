<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Task::create([
            'title' => 'Default Title',
            'description' => 'default Description',
            'project_id' => 1,
            'created_by' => 2,
            'assigned_to' => 3,
        ]);
    }
}
