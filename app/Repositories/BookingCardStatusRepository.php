<?php

namespace App\Repositories;

use App\Repositories\Base\BaseRepository;
use App\Models\BookingCardStatus;
use App\Repositories\Interfaces\BookingCardStatusContract;

class BookingCardStatusRepository extends BaseRepository implements BookingCardStatusContract
{
    public function model()
    {
        return BookingCardStatus::class;
    }
}
