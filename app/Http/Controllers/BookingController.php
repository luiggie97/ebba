<?php

namespace App\Http\Controllers;

use App\Classes\Bookings;
use App\Classes\Vehicles;
use App\Http\Middleware\Admin;
use App\Vehicle;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    private $vehicle;
    /**
     * BookingsController constructor.
     * @param Bookings $booking
     */
    public function __construct(Bookings $booking)
    {
        $this->middleware('auth');
        $this->booking = $booking;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return view('vehicles.booking')->with(['bookings' => $bookings = $this->booking->access(0,$id)]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $return = $this->booking->access(1,$request);

        return response()->json(
            [
                'status' => $return['message'],
                'bookings' => $return['booking']
            ], 200);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $return = $this->booking->access(3,$request);
        return response()->json(
            [
                'status' => $return['message'],
                'bookings' => $return['booking']
            ], 200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $return = $this->booking->access(2,$request);
        return response()->json(
            [
                'status' => $return['message'],
                'bookings' => $return['booking']
            ], 200);

    }
}
