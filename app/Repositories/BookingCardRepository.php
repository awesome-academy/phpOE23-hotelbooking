<?php

namespace App\Repositories;

use App\Repositories\Base\BaseRepository;
use App\Models\BookingCard;
use App\Repositories\Interfaces\BookingCardContract;

class BookingCardRepository extends BaseRepository implements BookingCardContract
{
    public function model()
    {
        return BookingCard::class;
    }
}
