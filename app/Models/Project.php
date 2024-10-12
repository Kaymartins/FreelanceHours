<?php

namespace App\Models;

use App\ProjectStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'ends_at',
        'status',
        'tech_stack',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function proposals(): HasMany
    {
        return $this->hasMany(Proposal::class, 'project_id', 'id');
    }

    public function casts()
    {
        return[
            'tech_stack' => 'array',
            'status' => ProjectStatus::class,
            'ends_at' => 'datetime'
        ];
    }
}
