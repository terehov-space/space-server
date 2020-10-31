<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create([
            'title' => 'Новый',
            'type' => 0,
        ]);
        Tag::create([
            'title' => 'В разработке',
            'type' => 0,
        ]);
        Tag::create([
            'title' => 'Завершен',
            'type' => 0,
        ]);

        Tag::create([
            'title' => 'Новая',
            'type' => 1,
        ]);
        Tag::create([
            'title' => 'В разработке',
            'type' => 1,
        ]);
        Tag::create([
            'title' => 'Завершена',
            'type' => 1,
        ]);
    }
}
