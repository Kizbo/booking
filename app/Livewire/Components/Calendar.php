<?php

namespace App\Livewire\Components;

use App\Models\Service;
use App\Models\UserAvailability;
use \Carbon\Carbon;
use Livewire\Component;

abstract class Calendar extends Component
{
    /**
     * Callback for clicking calendar event
     * 
     * array['timestamp'] Start of the event.
     * 
     * array['data'] All additional data send to calendar.
     * 
     * @param array $data (See above)
     */
    abstract public function chooseEvent(array $data);
    abstract protected function getTimeSlots(Carbon $day);
    /**
     * Callback when selecting empty fields in the calendar
     * 
     * @param array $data Fullcalendar selectionInfo object
     */
    abstract public function selectCallback(array $data);

    public array $availability;
    public Carbon $startWeek;
    public array $timeSlots = [];
    public bool $isSelectable = true;

    public function mount()
    {
        $this->startWeek = Carbon::now();
        $this->availability = $this->getAvailability();
    }

    public function render()
    {
        return view('livewire.pages.front.calendar');
    }

    public function getJsStartWeek()
    {
        return $this->startWeek->format('Y-m-d\TH:i:s.uP');
    }

    public function changeAvailabilityWeek(bool $next = true)
    {
        if ($next) {
            $this->startWeek = $this->startWeek->addWeek();
        } else {
            $this->startWeek = $this->startWeek->subWeek();
        }

        $this->availability = $this->getAvailability();
        $this->dispatch('refreshCalendar');
    }

    private function getAvailability()
    {
        $availabilities = [];
        $now = Carbon::now();
        $start = clone $this->startWeek;
        $start->startOfDay();
        $start = $now > $start ? $now : $start;
        $end = clone $start;
        $end->startOfDay()->addWeek();

        while ($start < $end) {
            $timeSlots = $this->getTimeSlots($start);
            if (!empty($timeSlots))
                $availabilities[$start->toDateString()] = $timeSlots;

            $start->addDay();
        }

        return $availabilities;
    }
}
