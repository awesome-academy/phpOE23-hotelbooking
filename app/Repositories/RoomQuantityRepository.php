<?php

namespace App\Repositories;

use App\Repositories\Base\BaseRepository;
use App\Models\RoomQuantity;

class RoomQuantityRepository extends BaseRepository
{
    public function model()
    {
        return RoomQuantity::class;
    }
}
