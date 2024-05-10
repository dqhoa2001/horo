<?php

namespace App\Repositories;

use App\Repositories\EloquentRepository;

class PlanetRepository extends EloquentRepository
{
    /**
     * get model
     *
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Planet::class;
    }
}
