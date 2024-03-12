<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseItem extends Model
{
    use HasFactory;

    protected $fillable = [
        // Case Detail
        'case_no',
        'case_type_id',
        'case_sub_type_id',
        'stage_of_case',
        'priority', // High, Medium, Low
        'act',
        'filling_no',
        'filling_date',
        'registration_no',
        'registration_date',
        'first_hearing_date',
        'cnr_no',
        'description',
        // FIR Details
        'police_station',
        'fir_no',
        'fir_date',
        // COurt Details
        'court_no',
        'court_type_id',
        'court_id',
        'judge_type_id',
        'judge_name',
    ];
}
