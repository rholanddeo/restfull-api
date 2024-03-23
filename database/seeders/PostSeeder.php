<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 10 posts
        // \App\Models\Post::factory(10)->create();

        for ($i = 0; $i < 10; $i++) {
            $post = \App\Models\Post::factory()->create();
        }
    }
}
