<?php

use App\Models\CaseStatus;
use App\Models\CaseSubType;
use App\Models\CaseType;
use App\Models\Court;
use App\Models\CourtType;
use App\Models\JudgeType;
use App\Models\Team;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('case_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Team::class);
            $table->string('case_no');
            // Case Detail
            $table->foreignIdFor(CaseType::class)->constrained(); // 'case_type_id',
            $table->foreignIdFor(CaseSubType::class)->constrained(); // 'case_sub_type_id',
            $table->foreignIdFor(CaseStatus::class)->constrained(); // 'stage_of_case',
            $table->string('priority'); // 'priority', // High, Medium, Low
            $table->string('act'); // 'act',
            $table->string('filing_no'); // 'filling_no',
            $table->date('filing_date'); // 'filling_date',
            $table->string('registration_no'); // 'registration_no',
            $table->date('registration_date'); // 'registration_date',
            $table->dateTime('first_hearing_date'); // 'first_hearing_date',
            $table->string('cnr_no'); // 'cnr_no',
            $table->longText('description'); // 'description',
            // FIR Details
            $table->string('police_station'); // 'police_station',
            $table->string('fir_no'); // 'fir_no',
            $table->date('fir_date'); // 'fir_date',
            // Court Details
            $table->string('court_no'); // 'court_no',
            $table->foreignIdFor(Court::class)->constrained(); // 'court_id',
            $table->foreignIdFor(CourtType::class)->constrained(); // 'court_type_id',
            $table->foreignIdFor(JudgeType::class)->constrained(); // 'judge_type_id',
            $table->string('judge_name')->nullable(); // 'judge_name',
            $table->text('remarks')->nullable(); // 'judge_name',
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('case_items');
    }
};
