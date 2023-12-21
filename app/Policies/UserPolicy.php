<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{

    /** Only admins can manipulate app users in any way */
    public function manipulate(User $user): bool
    {
        return $user->is_admin;
    }
}
