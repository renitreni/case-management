<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'email',
        'phone_no',
        'phone_no_other',
        'address',
        'city',
        'state',
        'country'
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
