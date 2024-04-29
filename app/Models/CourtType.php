<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourtType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'team_id',
    ];

    public function court()
    {
        return $this->hasMany(Court::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
