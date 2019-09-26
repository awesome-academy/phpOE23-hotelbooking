<?php

namespace App\Repositories;

use App\Repositories\Base\BaseRepository;
use App\Models\Service;

class ServiceRepository extends BaseRepository
{
    public function model()
    {
        return Service::class;
    }
}
