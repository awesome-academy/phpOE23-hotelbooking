<?php

namespace App\Repositories;

use App\Repositories\Base\BaseRepository;
use App\Models\User;

class UserRepository extends BaseRepository
{
    public function model()
    {
        return User::class;
    }
}
