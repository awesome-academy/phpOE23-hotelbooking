<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingCardDetail extends Model
{
    protected $table = 'booking_card_details';
    
    public function booking_card()
    {
        return $this->belongsTo(BookingCard::class, 'card_id');
    }

    public function room_type()
    {
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }
}
