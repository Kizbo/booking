<?php

namespace App\Livewire;

use Carbon\Carbon;
use LivewireUI\Modal\ModalComponent;

class ReservationSaved extends ModalComponent
{
    public string $datetime;
    public Carbon $datetimeObj;

    public function mount(string $datetime) {
        $this->datetimeObj = new Carbon($datetime);
    }

    public function render()
    {
        return view('livewire.reservation-saved');
    }
}
