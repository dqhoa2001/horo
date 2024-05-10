<?php

namespace App\Repositories;

use App\Repositories\EloquentRepository;

class CodeRepository extends EloquentRepository
{
    /**
     * get model
     *
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Code::class;
    }
}
