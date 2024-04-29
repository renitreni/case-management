<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseClient extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'client_type',
        'respondent_name',
        'respondent_advocate',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function caseItem()
    {
        return $this->belongsTo(CaseItem::class);
    }
}
