<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationsManagement extends Controller
{
    public function edit(Reservation $reservation)
    {
        $this->authorize("edit", $reservation);

        return view("pages.reservations.edit", ['reservation' => $reservation]);
    }
}
