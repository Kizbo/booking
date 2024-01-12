<?php

namespace App\Policies;

use App\Models\Reservation;
use App\Models\User;

class ReservationPolicy
{
    public function edit(User $user, Reservation $reservation): bool
    {
        return $user->is_admin || $reservation->user->id === $user->id;
    }
}
