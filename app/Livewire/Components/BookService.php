<?php

namespace App\Livewire\Components;

use LivewireUI\Modal\ModalComponent;
use App\Models\Service;
use App\Models\UserAvailability;
use \Carbon\Carbon;

class BookService extends ModalComponent
{
    public Service $service;
    public array $availability;
    public Carbon $startWeek;

    public function mount()
    {
        $this->startWeek = Carbon::now()->startOfWeek();
        $this->availability = $this->getAvailability();
    }

    public function render()
    {
        return view('livewire.pages.front.book-service');
    }

    public function changeAvailabilityWeek(bool $next = true)
    {
        if ($next) {
            $this->startWeek = $this->startWeek->addWeek();
        } else {
            $this->startWeek = $this->startWeek->subWeek();
        }

        $this->availability = $this->getAvailability();
    }

    private function getAvailability()
    {
        $now = Carbon::now();
        $start = $now > $this->startWeek ? $now : $this->startWeek;
        $end = clone $start;
        $end->endOfWeek();
        return ["start" => $start->toDateTime(), "end" => $end->toDateTime()];
    }
}
