<?php

namespace App\Repositories;

use App\Repositories\Base\BaseRepository;
use App\Models\Price;

class PriceRepository extends BaseRepository
{
    public function model()
    {
        return Price::class;
    }
}
