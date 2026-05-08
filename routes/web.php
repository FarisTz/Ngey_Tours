<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('user.home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/home', [UserController::class, 'index'])->name('home');
Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
Route::get('/gallery', [UserController::class, 'gallery'])->name('gallery');
Route::get('/about', [UserController::class, 'about'])->name('about');
Route::get('/destination', [UserController::class, 'destination'])->name('destination');
Route::get('/testimonials', [UserController::class, 'testimonials'])->name('testimonials');
Route::get('/contact', [UserController::class, 'contact'])->name('contact');
Route::get('/blog', [UserController::class, 'blog'])->name('blog');
