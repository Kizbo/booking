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
