<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingCardDetail extends Model
{
    protected $table = 'booking_card_details';
    
    public function bookingCard()
    {
        return $this->belongsTo(BookingCard::class, 'card_id');
    }

    public function roomType()
    {
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }
}
