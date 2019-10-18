<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomQuantity extends Model
{
    protected $table = 'room_quantities';

    protected $fillable = [
    	'hotel_id',
    	'room_type_id',
    	'total_quantity',
    	'vacancy_quantity',
    	
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }
}
