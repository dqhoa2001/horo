<?php

namespace App\Repositories;

use App\Repositories\EloquentRepository;

class HouseRepository extends EloquentRepository
{
    /**
     * get model
     *
     * @return string
     */
    public function getModel()
    {
        return \App\Models\House::class;
    }
}
