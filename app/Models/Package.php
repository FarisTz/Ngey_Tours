<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'short',
        'image',
        'description',
        'highlights',
        'price',
        'duration',
        'location',
    ];

    protected $casts = [
        'highlights' => 'array',
    ];
}
