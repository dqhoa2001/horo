<?php

namespace App\Repositories;

use App\Repositories\EloquentRepository;

class ZodiacRepository extends EloquentRepository
{
    /**
     * get model
     *
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Zodiac::class;
    }
}
