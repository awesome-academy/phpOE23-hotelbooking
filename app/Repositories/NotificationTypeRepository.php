<?php

namespace App\Repositories;

use App\Repositories\Base\BaseRepository;
use App\Models\NotificationType;

class NotificationTypeRepository extends BaseRepository
{
    public function model()
    {
        return NotificationType::class;
    }
}
