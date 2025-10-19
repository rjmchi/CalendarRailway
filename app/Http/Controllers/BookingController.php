<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::all();
        return Inertia::render('Dashboard', ['bookings'=> $bookings, 'editable'=> true]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'=>'required',
            'start'=>'required',
            'end'=>'required',
        ]);

        $start = new Carbon($request->start);
        $end = new Carbon($request->end);
        $start->addHours(15);
        $end->addHours(11);
        Booking::create(['title'=>$request->title, 'start'=>$start, 'end'=>$end]);
        return redirect(route('dashboard'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $data = $request->validate([
            'title'=>'required',
            'start'=>'required',
            'end'=>'required',
        ]);

        $start = new Carbon($request->start);
        $end = new Carbon($request->end);

        $booking->start = $start->addHours(15);
        $booking->end = $end->addHours(11);


        $booking->title = $request->title;

        $booking->save();

        return redirect(route('dashboard'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect(route('dashboard'));

    }
}
