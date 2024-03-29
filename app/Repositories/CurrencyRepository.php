<?php

namespace App\Repositories;

use App\Repositories\Base\BaseRepository;
use App\Models\Currency;
use App\Repositories\Interfaces\CurrencyContract;

class CurrencyRepository extends BaseRepository implements CurrencyContract
{
    public function model()
    {
        return Currency::class;
    }

    public function getRatio($id)
    {
        $currency = $this->getById($id)->first();

        return $currency->exchange_ratio;
    }
}
