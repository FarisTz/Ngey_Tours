<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
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
     public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
