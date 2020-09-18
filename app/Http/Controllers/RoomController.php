<?php

namespace App\Http\Controllers;

use App\Models;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class RoomController extends Controller
{
    public function show(Request $request) {
        $check_in = $request->input('check_in');
        $check_out = $request->input('check_out');
        $bed_qty = $request->input('bed_qty');
        $budget = $request->input('budget');

        //not a valid request, out date can't be before in date
        if (Carbon::parse($check_out) <= Carbon::parse($check_in)){
            return false;
        }

        $rooms = Models\Room::all()->where('bed_qty', '<=', $bed_qty)->where('price','<=', $budget);
        $rooms = $rooms->filter(function ($room) use ($check_out, $check_in)  {
            //auto pass any room without reservations
            if ($room->roomReservations->isEmpty()) {
                return true;
            } else {
                //filter rooms with overlapping reservations
                return $room->roomReservations->every(function ($roomRes) use ($check_out, $check_in) {
                    $inDate = Carbon::parse($roomRes->reservation->check_in);
                    $outDate = Carbon::parse($roomRes->reservation->check_out);
                    return !($inDate->lessThan(Carbon::parse($check_out)) && $outDate->greaterThan(Carbon::parse($check_in)));
                });
            }
        })->sortByDesc('bed_qty')->values();
        $groups = [];
        $done = false;
        do {
            $beds_left = $bed_qty;
            $total = 0;
            $group = array();
            //create room groups according to bed qty
            foreach ($rooms as $key => $room) {
                if ($beds_left >= $room->bed_qty) {
                    $beds_left = $beds_left - $room->bed_qty;
                    $total += $room->price;
                    $group[] = $rooms->pull($key);
                }
                if ($beds_left == 0) {
                    break;
                } else {
                    continue;
                }
            }
            if ($beds_left == 0 && $total <= $budget) {
                $groups[] = $group;
            }
            if ($rooms->isEmpty()) {
                $done = true;
            }
        } while (!$done);
        return $groups;
    }
}
