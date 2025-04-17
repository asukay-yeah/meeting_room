<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Room;
use App\Booking;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $today = Carbon::now()->toDateString();
        $rooms = Room::with(['bookings' => function ($query) use ($today) {
            $query->where('booking_date', $today)->where('status', 'approved');
        }])->get();

        $totalRequest = Booking::where('status', 'pending')->count();
        $totalBookToday = Booking::where('booking_date', $today)
        ->where('status', 'approved')
        ->pluck('room_id')
        ->unique()
        ->count();

        $totalRooms = Room::all()->count();

        return view('admin.home', compact('rooms', 'totalBookToday', 'totalRequest', 'totalRooms'));
    }
}
