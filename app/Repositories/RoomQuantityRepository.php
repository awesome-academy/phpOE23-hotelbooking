<?php

namespace App\Repositories;

use App\Repositories\Base\BaseRepository;
use App\Models\RoomQuantity;
use App\Repositories\Interfaces\RoomQuantityContract

class RoomQuantityRepository extends BaseRepository implements RoomQuantityContract
{
    public function model()
    {
        return RoomQuantity::class;
    }
}
