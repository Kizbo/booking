<?php

namespace App\Livewire;

use Carbon\Carbon;
use LivewireUI\Modal\ModalComponent;

class ReservationSaved extends ModalComponent
{
    public string $datetime;
    public Carbon $datetimeObj;

    public function mount(string $datetime)
    {
        $this->datetimeObj = Carbon::createFromTimestamp($datetime);
    }

    /**
     * Supported: 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl'
     */
    public static function modalMaxWidth(): string
    {
        return 'xl';
    }

    //TODO: don't allow closing the modal, redirect user to homepage

    public function render()
    {
        return view('livewire.reservation-saved');
    }
}
