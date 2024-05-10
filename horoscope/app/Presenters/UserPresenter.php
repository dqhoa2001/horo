<?php

namespace App\Presenters;
use App\Models\User;
class UserPresenter
{
    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function displayName(): string
    {
        if (mb_strlen($this->user->full_name) >= 13) {
            if (mb_strlen($this->user->name2) >= 12) {
                return mb_substr($this->user->name2, 0, 11) . '...';
            }  
                return $this->user->name2;
            
        }

        return $this->user->full_name;
    }
}
