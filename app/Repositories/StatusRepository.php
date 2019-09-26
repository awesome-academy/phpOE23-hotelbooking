<?php

namespace App\Repositories;

use App\Repositories\Base\BaseRepository;
use App\Models\Status;

class StatusRepository extends BaseRepository
{
    public function model()
    {
        return Status::class;
    }
}
