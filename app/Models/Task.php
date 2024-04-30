<?php

namespace App\Models;

use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_name',
        'case_item_id',
        'start_date',
        'end_date',
        'status', // completed, not started, in progress
        'priority', // High, Medium, Low
    ];

    public function case(): BelongsTo
    {
        return $this->belongsTo(CaseItem::class, 'case_item_id');
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'task_members', 'task_id', 'user_id');
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function scopeFilterByTenant()
    {
        return $this->where('team_id', Filament::getTenant()->id);
    }
}
