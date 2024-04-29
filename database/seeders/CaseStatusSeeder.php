<?php

namespace Database\Seeders;

use App\Models\CaseStatus;
use App\Models\Team;
use Illuminate\Database\Seeder;

class CaseStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Team::all() as $value) {
            CaseStatus::factory()->createMany([
                ['name' => 'trial', 'team_id' => $value->id],
                ['name' => 'arrest', 'team_id' => $value->id],
                ['name' => 'appeal', 'team_id' => $value->id],
                ['name' => 'pretrial', 'team_id' => $value->id],
                ['name' => 'sentencing', 'team_id' => $value->id],
                ['name' => 'established of charges', 'team_id' => $value->id],
                ['name' => 'arraignment and bond hearing', 'team_id' => $value->id],
            ]);

        }
    }
}
