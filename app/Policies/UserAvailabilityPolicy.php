<?php

namespace App\Policies;

use App\Models\User;

class UserAvailabilityPolicy
{
    public function manipulate(User $user): bool
    {
        return $user->can("is-admin");
    }
}
