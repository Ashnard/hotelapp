<?php

namespace App\Http\Controllers;

use App\Models;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $reservations = Models\Reservation::all();
        foreach ($reservations as $key => $reservation) {
            $roomReservations = $reservation->roomReservations()->get();
            $rooms = "";
            foreach ($roomReservations as $roomRes) {
                 $rooms = $rooms . $roomRes->room->room_num . ",";
            }
            $reservations[$key]['rooms'] = substr($rooms, 0, -1);;
        }
        return view('dashboard', ['reservations' => $reservations]);
    }
}
