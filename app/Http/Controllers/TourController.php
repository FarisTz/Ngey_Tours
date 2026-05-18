<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;

class TourController extends Controller
{
    public function index()
    {
        $tours = Tour::orderBy('created_at', 'desc')->get();
        return view('user.tours', compact('tours'));
    }
}