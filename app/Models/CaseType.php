<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CaseType extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'team_id',
        'is_active',
    ];

    public function caseSubType()
    {
        return $this->hasMany(CaseSubType::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
