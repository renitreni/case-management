<?php

namespace Database\Seeders;

use App\Models\CaseSubType;
use App\Models\CaseType;
use App\Models\Team;
use Illuminate\Database\Seeder;

class CaseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = Team::all();
        foreach ($teams as $team) {
            CaseType::factory()->createMany([
                [
                    'name' => 'Criminal',
                    'team_id' => $team->id,
                ],
                [
                    'name' => 'Civil',
                    'team_id' => $team->id,
                ],
            ]);
        }

        $criminalCase = CaseType::where('name', 'Criminal')->first();
        CaseSubType::factory()->createMany([
            [
                'code' => 'CR RA',
                'name' => 'Criminal Revision Application',
                'case_type_id' => $criminalCase->id,
            ],
            [
                'code' => 'CRREF',
                'name' => 'Criminal Reference',
                'case_type_id' => $criminalCase->id,
            ],
            [
                'code' => 'SCR A',
                'name' => 'Special Criminal Application',
                'case_type_id' => $criminalCase->id,
            ],
        ]);

        $civilCase = CaseType::where('name', 'Civil')->first();
        CaseSubType::factory()->createMany([
            [
                'code' => 'LPA',
                'name' => 'Letters Patent Appeal',
                'case_type_id' => $civilCase->id,
            ],
            [
                'code' => 'MCA',
                'name' => 'Misc. Civil Application',
                'case_type_id' => $civilCase->id,
            ],
            [
                'code' => 'AO',
                'name' => 'Appeal From Order',
                'case_type_id' => $civilCase->id,
            ],
        ]);
    }
}
