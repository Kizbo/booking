<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Service;

#[Layout('layouts.front')]
class ReservationPage extends Component
{
    public int $id;
    public Service $service;

    public function mount(int $id): void
    {
        $this->service = Service::where('id', $id)->first();
    }

    public function render()
    {
        return view('livewire.pages.front.reservation-page');
    }
}
