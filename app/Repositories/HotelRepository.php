<?php

namespace App\Repositories;

use App\Repositories\Base\BaseRepository;
use App\Models\Hotel;
use App\Repositories\Interfaces\HotelContract;

class HotelRepository extends BaseRepository implements HotelContract
{
    public function model()
    {
        return Hotel::class;
    }
}
