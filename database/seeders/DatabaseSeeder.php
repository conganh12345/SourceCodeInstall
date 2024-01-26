<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Insert default admin user
        DB::table('users')->insert([
            'first_name' => 'Admin',
            'last_name' => 'Super',
            'email' => 'superadmin@khgc.com',
            'password' => bcrypt('Abcd@1234'),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
