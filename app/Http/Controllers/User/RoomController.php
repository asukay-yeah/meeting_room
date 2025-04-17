<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Room;
use App\Booking;
use Auth;

class RoomController extends Controller
{

    public function show($id)
    {
        $room = Room::findOrFail($id);
    
        // Fetch all bookings for this room
        $bookings = $room->bookings()->where('status', 'approved')->get();
        
        // Format the dates as strings that JavaScript can parse
        $bookedDates = $bookings->pluck('booking_date')->map(function($date) {
            // Ensure dates are in YYYY-MM-DD format for JS to parse correctly
            return date('Y-m-d', strtotime($date));
        })->toArray();
        
        return view('user.1a_room', compact('room', 'bookedDates'));
    }

    public function book(Request $request, $id)
    {
        $request->validate([
            'booking_date' => 'required|date|after_or_equal:today',
            'purpose' => 'required|string',
            'nama_kantor' => 'required|string',
        ]);

        $room = Room::findOrFail($id);
        $exists = Booking::where('room_id', $id)
                         ->where('booking_date', $request->booking_date)
                         ->where('status', 'approved')
                         ->exists();

        if ($exists) {
            return back()->with('error', 'Untuk', $room->name . ' Tanggal ini sudah di-booking. Silakan pilih tanggal atau ruangan lain.');
        }

        Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $id,
            'booking_date' => $request->booking_date,
            'purpose' => $request->purpose,
            'nama_kantor' => $request->nama_kantor,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Booking berhasil dikirim, menunggu persetujuan');
    }
}