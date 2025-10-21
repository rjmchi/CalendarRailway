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

        foreach($bookings as $booking){
            $booking->title = "booked";
        }
        $user = User::all();
        if ($user->count() === 0) {
            $user = User::create([
                'name' => 'Robert',
                'email' => 'robert@test.com',
                'password'=>'kether1330',
            ]);
        }
        return Inertia::render('Welcome', ['bookings'=> $bookings]);
    }
}
