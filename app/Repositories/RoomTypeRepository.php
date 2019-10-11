<?php

namespace App\Repositories;

use App\Repositories\Base\BaseRepository;
use App\Models\RoomType;
use App\Repositories\Interfaces\RoomTypeContract;

class RoomTypeRepository extends BaseRepository implements RoomTypeContract
{
    public function model()
    {
        return RoomType::class;
    }
}
