<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Family;

class FamilyPolicy {
    // 家族のホロスコープはそのユーザーしか見れない
    public function view(User $user, Family $family): bool
    {
        return $user->id === $family->user_id;
    }
}
