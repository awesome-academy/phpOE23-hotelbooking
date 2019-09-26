<?php

namespace App\Repositories;

use App\Repositories\Base\BaseRepository;
use App\Models\Hotel;

class HotelRepository extends BaseRepository
{
    public function model()
    {
        return Hotel::class;
    }
}
