<?php

namespace App\Repositories;

use App\Repositories\EloquentRepository;

class HistoryRepository extends EloquentRepository
{
    /**
     * get model
     *
     * @return string
     */
    public function getModel()
    {
        return \App\Models\History::class;
    }
}
