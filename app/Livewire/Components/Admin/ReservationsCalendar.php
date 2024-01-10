<?php

namespace App\Livewire\Components\Admin;

use App\Livewire\Components\Calendar;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Attributes\Reactive;

class ReservationsCalendar extends Calendar
{

    #[Reactive]
    public $userId;

    public bool $isSelectable = false;

    protected function getTimeSlots(Carbon $day)
    {
        $user = User::find($this->userId);

        $dayStart = (clone $day)->startOfDay();
        $dayEnd = (clone $day)->endOfDay();

        $reservations = $user->reservations->whereBetween("reservation_datetime", [$dayStart, $dayEnd]);

        return $reservations->mapWithKeys(function ($reservation){
            return [$reservation->reservation_datetime->format("H:i:s") => [
                'endTime' => $reservation->reservation_datetime->addMinutes($reservation->service->duration)->format("H:i:s"),
                'title' => $reservation->service->name . " " . $reservation->customer->first_name . " " . $reservation->customer->last_name,
                'data' => [
                    'reservationId' => $reservation->id,
                ]
            ]];
        })->toArray();
    }

    public function chooseEvent(array $data)
    {
        dump($data);
    }

    public function selectCallback(array $data)
    {
        return null;
    }
}
