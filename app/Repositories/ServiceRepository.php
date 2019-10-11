<?php

namespace App\Repositories;

use App\Repositories\Base\BaseRepository;
use App\Models\Service;
use App\Repositories\Interfaces\ServiceContract;

class ServiceRepository extends BaseRepository implements ServiceContract
{
    public function model()
    {
        return Service::class;
    }
}
