<?php

namespace Database\Factories;

use App\Enums\CasePriority;
use App\Models\CaseStatus;
use App\Models\CaseType;
use App\Models\CourtType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CaseItem>
 */
class CaseItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $caseType = CaseType::with('caseSubType')->whereHas('caseSubType')->inRandomOrder()->first();
        $caseSubType = collect($caseType->caseSubType)->first();

        $courtType = CourtType::with('court')->whereHas('court')->inRandomOrder()->first();
        $court = collect($courtType->court)->first();

        $caseStatus = CaseStatus::inRandomOrder()->first();

        return [
            'team_id' => null,
            // Case Detail
            'case_no' => $this->faker->swiftBicNumber(),
            'case_type_id' => $caseType->id,
            'case_sub_type_id' => $caseSubType->id,
            'case_status_id' => $caseStatus->id,
            'priority' => $this->faker->randomElement(array_map(fn ($x) => $x->value, CasePriority::cases())), // High, Medium, Low
            'act' => $this->faker->numberBetween(1000, 5000),
            'filling_no' => $this->faker->numberBetween(1000, 5000),
            'filling_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'registration_no' => $this->faker->numberBetween(1000, 5000),
            'registration_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'first_hearing_date' => $this->faker->dateTimeBetween('-1 month', '3 months'),
            'cnr_no' => $this->faker->numberBetween(1000, 5000),
            'description' => $this->faker->paragraph(),
            // FIR Details
            'police_station' => $this->faker->address(),
            'fir_no' => $this->faker->numberBetween(1000, 5000),
            'fir_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            // Court Details
            'court_no' => $this->faker->numberBetween(1000, 5000),
            'court_type_id' => $courtType->id,
            'court_id' => $court->id,
            // 'judge_type_id',
            // 'judge_name',
        ];
    }
}
