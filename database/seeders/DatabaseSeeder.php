<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if(app()->environment('local', 'develop')) {
            Team::factory(5)->has(User::factory(10))->create();
        }

        $this->call([
            SuperAdminSeeder::class,
            CaseTypeSeeder::class
        ]);
    }
}
