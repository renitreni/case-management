<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourtType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'team_id'
    ];

    public function court()
    {
        return $this->hasMany(Court::class);
    }
}
