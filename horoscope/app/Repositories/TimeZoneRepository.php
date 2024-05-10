<?php

namespace App\Repositories;

use App\Repositories\EloquentRepository;

class TimeZoneRepository extends EloquentRepository
{
    /**
     * get model
     *
     * @return string
     */
    public function getModel()
    {
        return \App\Models\TimeZone::class;
    }
}
