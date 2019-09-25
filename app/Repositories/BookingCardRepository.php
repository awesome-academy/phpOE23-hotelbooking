<?php

namespace App\Repositories;

use App\Repositories\Base\BaseRepository;
use App\Models\BookingCard;

class BookingCardRepository extends BaseRepository
{
    public function model()
    {
        return BookingCard::class;
    }
}
