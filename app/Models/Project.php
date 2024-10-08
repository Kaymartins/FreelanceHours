<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function casts()
    {
        return[
            'tech_stack' => 'array',
        ];
    }
}
