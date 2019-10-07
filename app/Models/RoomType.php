<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    protected $table = 'room_types';

    public function roomQuantities()
    {
        return $this->hasMany(RoomQuantity::class, 'room_type_id');
    }

    public function prices()
    {
        return $this->hasMany(Price::class, 'room_type_id');
    }

    public function bookingCardDetails()
    {
        return $this->hasMany(BookingCardDetail::class, 'room_type_id');
    }
}
