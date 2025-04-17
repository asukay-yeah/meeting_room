<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Booking;


class HistoryController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('user','room')->orderBy('booking_date', 'desc')->get();

        return view('admin.history', compact('bookings'));
    }
}
