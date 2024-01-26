<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Thêm dòng này
use Illuminate\Support\Facades\Schema; // Thêm dòng này
use App\Models\User; // Thêm dòng này
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


    // Seed Posts
        \App\Models\Post::factory(5)->create();
    }
}
