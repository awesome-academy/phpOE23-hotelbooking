<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $table = 'currencies';

    public function prices()
    {
        return $this->hasMany(Price::class, 'currency_id');
    }

    public function bookingCardStatus()
    {
        return $this->hasMany(BookingCardStatus::class, 'currency_id');
    }
}
