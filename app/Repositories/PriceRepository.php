<?php

namespace App\Repositories;

use App\Repositories\Base\BaseRepository;
use App\Models\Price;
use App\Repositories\Interfaces\PriceContract;

class PriceRepository extends BaseRepository implements PriceContract
{
    public function model()
    {
        return Price::class;
    }
}
