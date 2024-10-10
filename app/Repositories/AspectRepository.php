<?php

namespace App\Repositories;

use App\Repositories\EloquentRepository;

class AspectRepository extends EloquentRepository
{
    /**
     * get model
     *
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Aspect::class;
    }
}
