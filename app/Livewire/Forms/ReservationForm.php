<?php

namespace App\Livewire\Forms;

use App\Models\Reservation;
use Carbon\Carbon;
use Livewire\Form;

class ReservationForm extends Form
{
    public Reservation $reservation;

    public string $reservation_datetime;

    public function setReservation(Reservation $reservation)
    {
        $this->reservation = $reservation;
        $this->reservation_datetime = $reservation->reservation_datetime->format("Y-m-d\TH:i");
    }

    public function save()
    {
        $this->resetErrorBag();

        $newReservationEnd = Carbon::parse($this->reservation_datetime)->addMinutes($this->reservation->service->duration);

        $isWorkerAvailable = $this->reservation->user->availability
            ->where("available_end_datetime", ">=", $newReservationEnd)
            ->where("available_start_datetime", "<=", $this->reservation_datetime)
            ->first();

        if(!$isWorkerAvailable){
            $this->addError("reservation_datetime", __("messages.worker-unavailable"));
            return;
        }


        $overlappingReservation = Reservation::whereNot("id", "=", $this->reservation->id)
            ->where("reservation_datetime", ">=", $this->reservation_datetime)
            ->where("reservation_datetime", "<=", $newReservationEnd)
            ->first();

        if($overlappingReservation){
            $this->addError("reservation_datetime", __("messages.worker-busy"));
            return;
        }

        $this->reservation->reservation_datetime = $this->reservation_datetime;
        $this->reservation->save();

        return $this->reservation;
    }
}
