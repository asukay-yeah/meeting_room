<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Booking;
use App\Room;
use Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $bookings = Booking::where('user_id', Auth::id())->with('room')->orderBy('booking_date', 'desc')->get();
        $rooms = Room::all();
        

        return view('user.history', compact('bookings', 'rooms'));
    }
}
