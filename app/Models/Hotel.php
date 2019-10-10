<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $table = 'hotels';

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function roomQuantities()
    {
        return $this->hasMany(RoomQuantity::class, 'hotel_id');
    }

    public function prices()
    {
        return $this->hasMany(Price::class, 'hotel_id');
    }

    public function services()
    {
        return $this->belongsToMany(Hotel::class, 'hotel_service');
    }
}
