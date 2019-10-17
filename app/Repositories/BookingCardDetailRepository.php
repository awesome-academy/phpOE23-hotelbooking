<?php

namespace App\Repositories;

use App\Repositories\Base\BaseRepository;
use App\Models\NotificationType;
use App\Repositories\Interfaces\BookingCardDetailContract;

class BookingCardDetailRepository extends BaseRepository implements BookingCardDetailContract
{
    public function model()
    {
        return BookingCardDetail::class;
    }
}
