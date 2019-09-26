<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationType extends Model
{
    protected $table = 'notification_types';

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'notification_type_id');
    }
}
