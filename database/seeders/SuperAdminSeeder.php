<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        Team::factory()->create(['name' => 'Super Admin Team']);
        $admin = User::factory()->create([
            'name' => 'admin super',
            'email' => 'admin@super.com'
        ]);

        $teams = Team::all();
        foreach($teams as $team){
            $admin->teams()->save($team);
        }
    }
}
