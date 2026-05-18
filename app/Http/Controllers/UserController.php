<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\Package;

class UserController extends Controller
{
    //
    public function index()
    {
        return view('home');
    }
    public function dashboard()
    {
        return view('dashboard');
    }

    public function about()
    {
        return view('user.about');
    }
    public function destination()
    {
            $packages = Package::orderBy('created_at', 'desc')->get();
            return view('user.destination', compact('packages'));
        }


    public function contact()
    {
        return view('user.contact');
    }
    public function blog()
    {
        return view('user.blog');
    }
    public function tours()
    {
        $tours = Tour::orderBy('created_at', 'desc')->get();
        return view('user.tours', compact('tours'));
    }

    public function showTour($slug)
    {
        $tour = Tour::where('slug', $slug)->firstOrFail();
        return view('user.tour-detail', compact('tour'));
    }
    public function gallery()
    {
        return view('user.gallery');
    }





}
