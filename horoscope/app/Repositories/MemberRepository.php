<?php

namespace App\Repositories;

use App\Repositories\EloquentRepository;

class MemberRepository extends EloquentRepository
{
    /**
     * get model
     *
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Member::class;
    }
}
