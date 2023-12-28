<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Service;

#[Layout('layouts.front')]
class ServiceList extends Component
{
    public $services;
    public string $searchStr;

    public function mount()
    {
        $this->services = Service::all();
    }

    public function render()
    {
        return view('livewire.pages.front.service-list');
    }

    public function search()
    {
        $this->services = Service::where("name", "LIKE", "%{$this->searchStr}%")->get();
    }
}
//TODO: Get calendar slots
/**
 * get all users from `service_user` that perform given service
 * get all those users availabilities in range of a given week (default current week)
 * check exact dates of the given availabilities to put the min correct date slots in the calendar
 * divide days to slots based on the services duration
 */