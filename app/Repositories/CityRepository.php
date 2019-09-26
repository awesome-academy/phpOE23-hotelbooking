<?php

namespace App\Repositories;

use App\Repositories\Base\BaseRepository;
use App\Models\City;

class CityRepository extends BaseRepository
{
    public function model()
    {
        return City::class;
    }
}
