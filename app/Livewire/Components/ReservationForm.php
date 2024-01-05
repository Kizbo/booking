<?php

namespace App\Livewire\Components;

use LivewireUI\Modal\ModalComponent;

class ReservationForm extends ModalComponent
{
    public array $userIds;
    public $service;

    public function render()
    {
        return view('livewire.pages.front.reservation-form');
    }
}
