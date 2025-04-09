<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function isAvailableToday()
    {
        $today = Carbon::today()->format('Y-m-d');
        return !$this->bookings()
            ->where('booking_date', $today)
            ->where('status', 'approved')
            ->exists();
    }

    public function isAvailable($date)
    {
        return !$this->bookings()
            ->where('booking_date', $date)
            ->where('status', 'approved')
            ->exists();
    }

    public function getBookedDates()
    {
        return $this->bookings()
            ->where('status', 'approved')
            ->pluck('booking_date')
            ->toArray();
    }
}
