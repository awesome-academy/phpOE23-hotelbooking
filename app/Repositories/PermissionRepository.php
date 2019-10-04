<?php

namespace App\Repositories;

use App\Repositories\Base\BaseRepository;
use App\Models\Permission;

class PermissionRepository extends BaseRepository
{
    public function model()
    {
        return Permission::class;
    }
}
