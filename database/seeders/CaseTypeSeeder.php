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
            $caseTypeCriminal = CaseType::factory()->create([
                'name' => 'Criminal',
                'team_id' => $team->id,
            ]);

            CaseSubType::factory()->createMany([
                [
                    'code' => 'CR RA',
                    'name' => 'Criminal Revision Application',
                    'case_type_id' => $caseTypeCriminal->id,
                ],
                [
                    'code' => 'CRREF',
                    'name' => 'Criminal Reference',
                    'case_type_id' => $caseTypeCriminal->id,
                ],
                [
                    'code' => 'SCR A',
                    'name' => 'Special Criminal Application',
                    'case_type_id' => $caseTypeCriminal->id,
                ],
            ]);

            $caseTypeCivil = CaseType::factory()->create(
                [
                    'name' => 'Civil',
                    'team_id' => $team->id,
                ],
            );

            CaseSubType::factory()->createMany([
                [
                    'code' => 'LPA',
                    'name' => 'Letters Patent Appeal',
                    'case_type_id' => $caseTypeCivil->id,
                ],
                [
                    'code' => 'MCA',
                    'name' => 'Misc. Civil Application',
                    'case_type_id' => $caseTypeCivil->id,
                ],
                [
                    'code' => 'AO',
                    'name' => 'Appeal From Order',
                    'case_type_id' => $caseTypeCivil->id,
                ],
            ]);
        }
    }
}
