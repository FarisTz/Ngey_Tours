<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    //

     public function all(Request $request)
    {
          $query = Booking::with(['tour', 'package']);

        // Apply filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('booking_type')) {
            $query->where('booking_type', $request->booking_type);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('start_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('start_date', '<=', $request->date_to);
        }

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('booking_reference', 'like', '%' . $request->search . '%')
                  ->orWhere('Full_name', 'like', '%' . $request->search . '%')
                  ->orWhere('Email', 'like', '%' . $request->search . '%');
            });
        }

        $bookings = $query->orderBy('created_at', 'desc')
            ->paginate(15)
            ->withQueryString();

        $statuses = ['pending', 'confirmed', 'ongoing', 'completed', 'cancelled'];
        $bookingTypes = ['tour', 'package', 'car'];

        return view('admin.bookings.all', compact('bookings', 'statuses', 'bookingTypes'));
    }

    /**
     * Display tour bookings only
     */
    public function tourBookings(Request $request)
    {
        $query = Booking::with(['tour'])
            ->where('booking_type', 'tour');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('start_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('start_date', '<=', $request->date_to);
        }

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('booking_reference', 'like', '%' . $request->search . '%')
                  ->orWhere('Full_name', 'like', '%' . $request->search . '%')
                  ->orWhere('Email', 'like', '%' . $request->search . '%');
            });
        }

        $bookings = $query->orderBy('start_date', 'desc')
            ->paginate(15)
            ->withQueryString();

        $totalRevenue = Booking::where('booking_type', 'tour')
            ->where('status', 'completed')
            ->sum('total_price');
        $pendingCount = Booking::where('booking_type', 'tour')
            ->where('status', 'pending')
            ->count();

        return view('admin.bookings.tour', compact('bookings', 'totalRevenue', 'pendingCount'));
    }

    /**
     * Display package bookings only
     */
    public function packageBookings(Request $request)
    {
        $query = Booking::with(['package'])
            ->where('booking_type', 'package');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('start_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('start_date', '<=', $request->date_to);
        }

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('booking_reference', 'like', '%' . $request->search . '%')
                  ->orWhere('Full_name', 'like', '%' . $request->search . '%')
                  ->orWhere('Email', 'like', '%' . $request->search . '%');
            });
        }

        $bookings = $query->orderBy('start_date', 'desc')
            ->paginate(15)
            ->withQueryString();

        $totalRevenue = Booking::where('booking_type', 'package')
            ->where('status', 'completed')
            ->sum('total_price');
        $pendingCount = Booking::where('booking_type', 'package')
            ->where('status', 'pending')
            ->count();

        return view('admin.bookings.package', compact('bookings', 'totalRevenue', 'pendingCount'));
    }

    /**
     * Display car bookings only
     */
    public function carBookings(Request $request)
    {
        $query = Booking::where('booking_type', 'car');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('start_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('start_date', '<=', $request->date_to);
        }

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('booking_reference', 'like', '%' . $request->search . '%')
                  ->orWhere('Full_name', 'like', '%' . $request->search . '%')
                  ->orWhere('Email', 'like', '%' . $request->search . '%');
            });
        }

        $bookings = $query->orderBy('start_date', 'desc')
            ->paginate(15)
            ->withQueryString();

        $totalRevenue = Booking::where('booking_type', 'car')
            ->where('status', 'completed')
            ->sum('total_price');
        $pendingCount = Booking::where('booking_type', 'car')
            ->where('status', 'pending')
            ->count();

        return view('admin.bookings.car', compact('bookings', 'totalRevenue', 'pendingCount'));
    }

    /**
     * Display single booking details
     */

        public function show($id)
    {
        $booking = Booking::with(['tour', 'package'])->findOrFail($id);

        // Calculate duration in days if end_date exists
        $duration = null;
        if ($booking->start_date && $booking->end_date) {
            $duration = $booking->start_date->diffInDays($booking->end_date) + 1;
        }

        return view('admin.bookings.show', compact('booking', 'duration'));
    }


    /**
     * Update booking status
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,ongoing,completed,cancelled',
            'admin_notes' => 'nullable|string'
        ]);

        $booking = Booking::findOrFail($id);
        $oldStatus = $booking->status;
        $booking->status = $request->status;

        if ($request->filled('admin_notes')) {
            $booking->admin_notes = $request->admin_notes;
        }

        $booking->save();

        // Optional: Send email notification to customer about status change
        // if ($oldStatus != $request->status) {
        //     Mail::to($booking->Email)->send(new BookingStatusUpdated($booking));
        // }

        return redirect()->back()->with('success', 'Booking status updated successfully!');
    }

    /**
     * Delete booking
     */
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('admin.bookings.all')
            ->with('success', 'Booking deleted successfully!');
    }
    

}
