<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxiBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'pickup_location',
        'destination',
        'travel_date',
        'travel_time',
        'passengers',
        'vehicle_type',
        'whatsapp_number',
    ];
}
