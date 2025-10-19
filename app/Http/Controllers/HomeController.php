<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index() {
        $bookings = Booking::all();

        // foreach($bookings as $booking){
        //     $booking->title = "booked";
        // }
        return Inertia::render('Welcome', ['bookings'=> $bookings]);
    }
}
