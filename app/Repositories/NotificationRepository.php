<?php

namespace App\Repositories;

use App\Repositories\Base\BaseRepository;
use App\Models\Notification;
use App\Repositories\Interfaces\NotificationContract;

class NotificationRepository extends BaseRepository implements NotificationContract
{
    public function model()
    {
        return Notification::class;
    }
}
