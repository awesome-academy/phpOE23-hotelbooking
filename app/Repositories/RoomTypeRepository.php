<?php

namespace App\Repositories;

use App\Repositories\Base\BaseRepository;
use App\Models\RoomType;

class RoomTypeRepository extends BaseRepository
{
    public function model()
    {
        return RoomType::class;
    }
}
