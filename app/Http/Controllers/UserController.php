<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('user.destination');}


    public function contact()
    {
        return view('user.contact');
    }
    public function blog()
    {
        return view('user.blog');
    }
    public function testimonials()
    {
        return view('user.testimonial');
    }
    public function gallery()
    {
        return view('user.gallery');
    }





}
