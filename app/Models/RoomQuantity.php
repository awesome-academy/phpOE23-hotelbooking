<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomQuantity extends Model
{
    protected $table = 'room_quantities';

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }
}
