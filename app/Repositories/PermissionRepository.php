<?php

namespace App\Repositories;

use App\Repositories\Base\BaseRepository;
use App\Models\Permission;
use App\Repositories\Interfaces\PermissionContract;

class PermissionRepository extends BaseRepository implements PermissionContract
{
    public function model()
    {
        return Permission::class;
    }
}
