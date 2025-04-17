<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Booking;

class RequestController extends Controller
{
    public function index()
    {
        $request = Booking::where('status', 'pending')->with('user', 'room')->get();
        return view('admin.request', compact('request'));
    }

    public function approve($id)
    {
        $booking = Booking::findOrFail($id);
        // 🔒 Cek apakah sudah ada request yang approved di ruangan & tanggal yang sama
        $alreadyApproved = Booking::where('room_id', $booking->room_id)
        ->where('booking_date', $booking->booking_date)
        ->where('status', 'approved')
        ->exists();                                                                                                                 

        if ($alreadyApproved) {
            return redirect()->back()->with('error', 'Ruangan ini sudah dibooking untuk tanggal tersebut.');
        }

        // ✅ Set status jadi approved
        $booking->status = 'approved';
        $booking->save();

        return redirect()->back()->with('success', 'Request berhasil disetujui.');

    }

    public function reject($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'rejected']);
        return back()->with('success', 'Request booking berhasil ditolak');
    }
}
