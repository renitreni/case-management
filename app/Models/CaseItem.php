<?php

namespace App\Models;

use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CaseItem extends Model
{
    use HasFactory;

    protected $fillable = [
        // Case Detail
        'case_no',
        'case_type_id',
        'case_sub_type_id',
        'case_status_id',
        'priority', // High, Medium, Low
        'act',
        'filing_no',
        'filing_date',
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
        'remarks',
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function caseClients(): hasMany
    {
        return $this->hasMany(CaseClient::class);
    }

    public function court(): BelongsTo
    {
        return $this->belongsTo(Court::class);
    }

    public function caseType(): BelongsTo
    {
        return $this->belongsTo(CaseType::class);
    }

    public function caseStatus(): BelongsTo
    {
        return $this->belongsTo(CaseStatus::class);
    }

    public function scopeFilterByTenant()
    {
        return $this->where('team_id', Filament::getTenant()->id);
    }
}
