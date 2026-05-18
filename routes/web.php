<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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
Route::get('/gallery', [UserController::class, 'gallery'])->name('gallery');
Route::get('/about', [UserController::class, 'about'])->name('about');
Route::get('/destination', [UserController::class, 'destination'])->name('destination');
Route::get('/tours', [UserController::class, 'tours'])->name('tours');
Route::get('/tours/{slug}', [UserController::class, 'showTour'])->name('tour.detail');
Route::get('/safari-blue', function () {
    return view('user.safari-blue-detail');
})->name('safari-blue.detail');

Route::get('/contact', [UserController::class, 'contact'])->name('contact');
Route::get('/blog', [UserController::class, 'blog'])->name('blog');
Route::resource('tours', TourController::class);
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/tours', [AdminController::class, 'tours'])->name('admin.tours');
    Route::get('/tours/create', [AdminController::class, 'createTour'])->name('admin.tours.create');
    Route::post('/tours', [AdminController::class, 'storeTour'])->name('admin.tours.store');
    Route::get('/packages', [AdminController::class, 'packages'])->name('admin.packages');
    Route::get('/packages/create', [AdminController::class, 'createPackage'])->name('admin.packages.create');
    Route::post('/packages', [AdminController::class, 'storePackage'])->name('admin.packages.store');
});
