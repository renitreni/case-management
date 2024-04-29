<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Court extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'team_id',
        'court_type_id',
    ];

    public function teams()
    {
        return $this->belongsTo(Team::class);
    }

    public function courtType()
    {
        return $this->belongsTo(CourtType::class);
    }
}
