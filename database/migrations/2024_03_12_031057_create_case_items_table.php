<?php

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
            $table->bigInteger('case_no');
        //  // Case Detail
        // 'case_type_id',
        // 'case_sub_type_id',
        // 'stage_of_case',
        // 'priority', // High, Medium, Low
        // 'act',
        // 'filling_no',
        // 'filling_date',
        // 'registration_no',
        // 'registration_date',
        // 'first_hearing_date',
        // 'cnr_no',
        // 'description',
        // // FIR Details
        // 'police_station',
        // 'fir_no',
        // 'fir_date',
        // // COurt Details
        // 'court_no',
        // 'court_type_id',
        // 'court_id',
        // 'judge_type_id',
        // 'judge_name',
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
