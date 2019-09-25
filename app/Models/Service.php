<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';

    public function hotels()
    {
        return $this->belongsToMany(Service::class, 'hotel_service');
    }
}
