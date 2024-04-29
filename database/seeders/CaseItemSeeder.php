<?php

namespace Database\Seeders;

use App\Models\CaseItem;
use App\Models\Team;
use Illuminate\Database\Seeder;

class CaseItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = Team::all();

        foreach ($teams as $team) {
            CaseItem::factory(10)
                ->create(
                    ['team_id' => $team->id]
                );
        }
    }
}
