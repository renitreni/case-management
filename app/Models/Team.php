<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function caseItems()
    {
        return $this->hasMany(CaseItem::class);
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
