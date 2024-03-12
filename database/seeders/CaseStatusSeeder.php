<?php

namespace Database\Seeders;

use App\Models\CaseStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CaseStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CaseStatus::factory()->createMany([
            ['name' => 'trial'],
            ['name' => 'arrest'],
            ['name' => 'appeal'],
            ['name' => 'pretrial'],
            ['name' => 'sentencing'],
            ['name' => 'established of charges'],
            ['name' => 'arraignment and bond hearing'],
        ]);
    }
}
