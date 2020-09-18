<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomReservation extends Model
{

    protected $fillable = ['room_id', 'reservation_id'];

    public function room() {
        return $this->belongsTo(Room::Class);
    }

    public function reservation() {
        return $this->belongsTo(Reservation::Class);
    }
}
