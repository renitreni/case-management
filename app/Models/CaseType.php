<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseType extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'team_id',
        'is_active'
    ];
}
