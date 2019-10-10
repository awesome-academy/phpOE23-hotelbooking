<?php

namespace App\Repositories;

use App\Repositories\Base\BaseRepository;
use App\Models\Status;
use App\Repositories\Interfaces\StatusContract;

class StatusRepository extends BaseRepository implements StatusContract
{
    public function model()
    {
        return Status::class;
    }
}
