<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'statuses';

    public function booking_card_statuses()
    {
        return $this->hasMany(BookingCardStatus::class, 'status_id');
    }
}
