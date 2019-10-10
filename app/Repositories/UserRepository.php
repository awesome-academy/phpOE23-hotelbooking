<?php

namespace App\Repositories;

use App\Repositories\Base\BaseRepository;
use App\Models\User;
use App\Repositories\Interfaces\UserContract;

class UserRepository extends BaseRepository implements UserContract
{
    public function model()
    {
        return User::class;
    }
}
