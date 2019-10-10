<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'statuses';

    public function bookingCardStatuses()
    {
        return $this->hasMany(BookingCardStatus::class, 'status_id');
    }
}
