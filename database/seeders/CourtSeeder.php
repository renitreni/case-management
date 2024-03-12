<?php

namespace Database\Seeders;

use App\Models\CourtType;
use App\Models\Team;
use Illuminate\Database\Seeder;

class CourtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = Team::all();

        foreach ($teams as $team) {
            $courtTypes = CourtType::factory()->createMany([
                ['name' => 'Law Court', 'team_id' => $team->id],
                ['name' => 'District Court', 'team_id' => $team->id],
                ['name' => 'High Court', 'team_id' => $team->id],
            ]);

            $courts = [
                ['name' => 'Law district court', 'team_id' => $team->id],
                ['name' => 'Domestic violence court', 'team_id' => $team->id],
                ['name' => 'Special court', 'team_id' => $team->id],
            ];
            foreach ($courtTypes as $key => $courtType) {
                $courtType->court()->create($courts[$key]);
            }
        }
    }
}
