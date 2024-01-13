<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserAvailability;

class AvailabilityManagement extends Controller
{
    public function edit(UserAvailability $availability)
    {
        $this->authorize("manipulate", UserAvailability::class);

        return view("pages.availability.edit", ['availability' => $availability]);
    }

    public function create(User $user)
    {
        $this->authorize("manipulate", UserAvailability::class);

        return view("pages.availability.create", ['user' => $user]);
    }

    public function delete(UserAvailability $availability)
    {
        $this->authorize("manipulate", UserAvailability::class);

        $availability->delete();

        return redirect()->route("admin.availability", ['activeUser' => $availability->user->id]);
    }
}
