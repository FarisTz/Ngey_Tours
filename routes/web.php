<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('user.home');
});

Route::get('/dashboard', function () {

        return redirect()->route('admin.dashboard');

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
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/taxi', [UserController::class, 'taxi'])->name('taxi');
Route::post('/taxi/book', [UserController::class, 'bookTaxi'])->name('taxi.book');
Route::get('/blog', [UserController::class, 'blog'])->name('blog');
Route::get('/packages/{slug}', [UserController::class, 'showPackage'])->name('package.detail');
Route::resource('tours', TourController::class);
Route::view('/booking-conditions', 'user.booking-conditions')->name('booking-conditions');
Route::view('/privacy-policy', 'user.privacy-policy')->name('privacy-policy');
Route::view('/refund-policy', 'user.refund-policy')->name('refund-policy');






// User Booking Routes (accessible to everyone)
Route::prefix('bookings')->name('user.booking.')->group(function () {
    // Tour Booking Routes

    Route::post('/tour', [UserController::class, 'bookTour'])->name('tour.store');

    // Package Booking Routes

    Route::post('/package', [UserController::class, 'bookPackage'])->name('package.store');

    // Car Booking Routes

    Route::post('/car', [UserController::class, 'bookCar'])->name('car.store');

    // Confirmation and Viewing Routes
    // Route::get('/confirmation/{bookingId}', [UserController::class, 'showConfirmation'])->name('confirmation');
    // Route::get('/my-bookings', [UserController::class, 'myBookings'])->name('my-bookings');
    // Route::get('/view/{reference}', [UserController::class, 'viewBooking'])->name('view');
    // Route::post('/cancel/{id}', [UserController::class, 'cancelBooking'])->name('cancel');

   
});






Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/tours', [AdminController::class, 'tours'])->name('admin.tours');
    Route::get('/tours/create', [AdminController::class, 'createTour'])->name('admin.tours.create');
    Route::post('/tours', [AdminController::class, 'storeTour'])->name('admin.tours.store');
Route::get('/tours/{tour}', [AdminController::class, 'showTour'])->name('admin.tours.show');
Route::get('/tours/{tour}/edit', [AdminController::class, 'editTour'])->name('admin.tours.edit');
Route::put('/tours/{tour}', [AdminController::class, 'updateTour'])->name('admin.tours.update');
Route::delete('/tours/{tour}', [AdminController::class, 'destroyTour'])->name('admin.tours.destroy');
    Route::get('/contact-messages', [ContactController::class, 'index'])->name('admin.contact.messages');
    // Backwards-compatible route name expected by admin layout
    Route::get('/contacts', [ContactController::class, 'index'])->name('admin.contacts');
    Route::get('/packages', [AdminController::class, 'packages'])->name('admin.packages');
    Route::get('/packages/create', [AdminController::class, 'createPackage'])->name('admin.packages.create');
    Route::get('/packages/{package}', [AdminController::class, 'showPackage'])->name('admin.packages.show');
    Route::get('/packages/{package}/edit', [AdminController::class, 'editPackage'])->name('admin.packages.edit');
    Route::put('/packages/{package}', [AdminController::class, 'updatePackage'])->name('admin.packages.update');
    Route::delete('/packages/{package}', [AdminController::class, 'destroyPackage'])->name('admin.packages.destroy');
    Route::get('/taxi-routes', [AdminController::class, 'taxiRoutes'])->name('admin.taxi.routes');
    Route::get('/taxi-routes/create', [AdminController::class, 'createTaxiRoute'])->name('admin.taxi.routes.create');
Route::get('/taxi-routes/{route}/edit', [AdminController::class, 'editTaxiRoute'])->name('admin.taxi.routes.edit');
    Route::put('/taxi-routes/{route}', [AdminController::class, 'updateTaxiRoute'])->name('admin.taxi.routes.update');
    Route::delete('/taxi-routes/{route}', [AdminController::class, 'destroyTaxiRoute'])->name('admin.taxi.routes.destroy');

    Route::get('/taxi-vehicles', [AdminController::class, 'taxiVehicles'])->name('admin.taxi.vehicles');
    Route::get('/taxi-vehicles/create', [AdminController::class, 'createTaxiVehicle'])->name('admin.taxi.vehicles.create');
    Route::post('/taxi-vehicles', [AdminController::class, 'storeTaxiVehicle'])->name('admin.taxi.vehicles.store');
    Route::get('/taxi-vehicles/{vehicle}', [AdminController::class, 'showTaxiVehicle'])->name('admin.taxi.vehicles.show');
    Route::patch('/taxi-vehicles/{vehicle}', [AdminController::class, 'updateTaxiVehicle'])->name('admin.taxi.vehicles.update');
    Route::delete('/taxi-vehicles/{vehicle}', [AdminController::class, 'destroyTaxiVehicle'])->name('admin.taxi.vehicles.destroy');

    // User Management Routes
    Route::get('/users', [\App\Http\Controllers\AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/create', [\App\Http\Controllers\AdminUserController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [\App\Http\Controllers\AdminUserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{user}/edit', [\App\Http\Controllers\AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::patch('/users/{user}', [\App\Http\Controllers\AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{user}', [\App\Http\Controllers\AdminUserController::class, 'destroy'])->name('admin.users.destroy');



    Route::get('booking/all', [BookingController::class, 'all'])->name('admin.bookings.all');
    Route::get('booking/tour', [BookingController::class, 'tourBookings'])->name('admin.bookings.tour');
    Route::get('booking/package', [BookingController::class, 'packageBookings'])->name('admin.bookings.package');
    Route::get('booking/car', [BookingController::class, 'carBookings'])->name('admin.bookings.car');

        // View single booking
    Route::get('booking/{id}', [BookingController::class, 'show'])->name('admin.bookings.show');

     // Update booking status
        Route::put('booking/{id}/status', [BookingController::class, 'updateStatus'])->name('admin.bookings.update-status');

        // Delete booking
        Route::delete('booking/{id}', [BookingController::class, 'destroy'])->name('admin.bookings.destroy');



    // Gallery Management Route
    Route::resource('gallery', \App\Http\Controllers\GalleryController::class)->names('admin.gallery');
    // Admin Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('admin.profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('admin.profile.destroy');
Route::get('/setlocale/{locale}', function ($locale) {
    App::setLocale($locale);
    session(['locale' => $locale]);
    return redirect()->back();
})->name('admin.setlocale');
});
