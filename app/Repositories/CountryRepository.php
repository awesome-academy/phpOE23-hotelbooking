<?php

namespace App\Repositories;

use App\Repositories\Base\BaseRepository;
use App\Models\Country;
use App\Repositories\Interfaces\CountryContract;

class CountryRepository extends BaseRepository implements CountryContract
{
    public function model()
    {
        return Country::class;
    }
}
