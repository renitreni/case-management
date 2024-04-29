<?php

namespace Database\Seeders;

use App\Models\JudgeType;
use App\Models\Team;
use Illuminate\Database\Seeder;

class JudgeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Team::all() as $value) {
            JudgeType::factory()
                ->createMany([
                    ['name' => 'Supreme Court Judge', 'team_id' => $value->id],
                    ['name' => 'Court of Appeal Judge', 'team_id' => $value->id],
                    ['name' => 'High Court Judge', 'team_id' => $value->id],
                    ['name' => 'Circuit Judge', 'team_id' => $value->id],
                    ['name' => 'District Judge', 'team_id' => $value->id],
                ]);
        }
    }
}
