<?php

use Livewire\Volt\Component;
use App\Models\Service;

new class extends Component {
    public Service $service;

    public function setService() {
        $this->dispatch('set-service', service: $this->service);
        return $this->service->name;
    }
}; ?>

<div class="flex flex-col py-3 pl-3 pr-6 my-3 ml-3 border-r border-black">
    <div class="flex justify-between">
        <h2 class="text-lg font-bold">{{ $service->name }}</h2>
        <button wire:click="$dispatch('openModal', { component: 'components.book-service', arguments: { service: {{ $service }} } })" type="button" class="group flex items-center justify-center bg-black hover:bg-white border border-black rounded-full duration-150 w-10 h-10">
            <x-fas-calendar-plus class="w-5 -mt-px fill-white group-hover:fill-black duration-150" />
        </button>
    </div>
    <p>{{ $service->description }}</p>
    <div class="flex items-end justify-around flex-grow mt-7">
        <div class="flex flex-col items-center">
            <x-fas-stopwatch class="w-5" />
            <p class="font-bold">{{ $service->duration }} min</p>
        </div>
        <div class="flex flex-col items-center">
            <x-fas-money-bill-1-wave class="w-5" />
            <p class="font-bold">{{ $service->price }} zł</p>
        </div>
    </div>
</div>
