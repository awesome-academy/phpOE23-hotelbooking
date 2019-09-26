<?php

namespace App\Repositories;

use App\Repositories\Base\BaseRepository;
use App\Models\Notification;

class NotificationRepository extends BaseRepository
{
    public function model()
    {
        return Notification::class;
    }
}
