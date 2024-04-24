<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseClient extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_type',
        'respondent_name',
        'respondent_advocate'
    ];
}
