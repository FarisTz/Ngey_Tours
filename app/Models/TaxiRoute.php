<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxiRoute extends Model
{
    use HasFactory;

    protected $fillable = [
        'pickup_location',
        'destination',
        'distance',
        'duration',
        'price',
        'status',
    ];
}
