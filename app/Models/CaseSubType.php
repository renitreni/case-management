<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseSubType extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'case_type_id',
    ];
}
