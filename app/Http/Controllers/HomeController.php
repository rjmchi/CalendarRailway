<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index() {
        $bookings = Booking::all();

        // foreach($bookings as $booking){
        //     $booking->title = "booked";
        // }
        $user = User::where('email', 'robert@test.com')->get();
        if (!$user) {
            User::create([
                'name' => 'Robert',
                'email' => 'robert@test.com',
                'password'=>'kether1330',
            ]);
        }
        return Inertia::render('Welcome', ['bookings'=> $bookings]);
    }
}
