<?php

namespace App\Repositories;

use App\Repositories\EloquentRepository;

class AspectAngleRepository extends EloquentRepository
{
    /**
     * get model
     *
     * @return string
     */
    public function getModel()
    {
        return \App\Models\AspectAngle::class;
    }
}
