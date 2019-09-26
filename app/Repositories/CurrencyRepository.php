<?php

namespace App\Repositories;

use App\Repositories\Base\BaseRepository;
use App\Models\Currency;

class CurrencyRepository extends BaseRepository
{
    public function model()
    {
        return Currency::class;
    }
}
