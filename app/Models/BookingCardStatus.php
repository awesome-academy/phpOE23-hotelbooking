<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingCardStatus extends Model
{
    protected $table = 'booking_card_statuses';

    public function bookingCard()
    {
        return $this->belongsTo(BookingCard::class, 'card_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }
}
