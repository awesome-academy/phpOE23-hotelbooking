<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingCard extends Model
{
    protected $table = 'booking_cards';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bookingCardStatus()
    {
        return $this->hasOne(BookingCardStatus::class, 'card_id');
    }

    public function bookingCardDetails()
    {
        return $this->hasMany(BookingCardDetail::class, 'card_id');
    }
}
