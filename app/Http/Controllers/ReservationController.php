<?php

namespace App\Http\Controllers;

use App\Models;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    public function create(Request $request) {
        $group = $request->input('group');
        $reservation = $request->input('reservation');
        //insert reservation
        $reservation = Models\Reservation::create($reservation);
        //insert room_reservations
        $roomReservations = [];
        foreach ($group as $room) {
            $roomReservations[] = Models\RoomReservation::create([
                'room_id' => $room['id'],
                'reservation_id' => $reservation->id,
            ]);
        }

        if ($reservation && $roomReservations) {
            return 'success';
        }
        return 'failed';
    }
}
