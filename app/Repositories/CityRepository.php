<?php

namespace App\Repositories;

use App\Repositories\Base\BaseRepository;
use App\Models\City;
use App\Repositories\Interfaces\CityContract;

class CityRepository extends BaseRepository implements CityContract
{
    public function model()
    {
        return City::class;
    }
}
