<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function notificationType()
    {
        return $this->belongsTo(NotificationType::class, 'user_id');
    }
}
