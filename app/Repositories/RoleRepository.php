<?php

namespace App\Repositories;

use App\Repositories\Base\BaseRepository;
use App\Models\Role;
use App\Repositories\Interfaces\RoleContract;

class RoleRepository extends BaseRepository implements RoleContract
{
    public function model()
    {
        return Role::class;
    }
}
