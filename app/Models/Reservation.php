<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $guarded = [];

    protected static function boot(){
        parent::boot();
    }

    public function roomReservations() {
        return $this->hasMany(RoomReservation::Class);
    }
}
