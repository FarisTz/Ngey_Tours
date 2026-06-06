<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxiVehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'capacity',
        'type',
        'tag',
        'image',
        'status',
    ];
}
