<?php

use Livewire\Volt\Component;
use App\Models\Service;

new class extends Component {
    public Service $service;
}; ?>

<div class="flex flex-col py-3 pl-3 pr-6 my-3 ml-3 border-r border-black">
    <div class="flex justify-between">
        <h2 class="text-lg font-bold">{{ $service->name }}</h2>
        <button type="button" @click="$dispatch('open-modal', 'book')" class="flex items-center justify-center bg-black rounded-full w-7 h-7">
            <x-fas-calendar-plus class="w-3 fill-white" />
        </button>
    </div>
    <p>{{ $service->description }}</p>
    <div class="flex items-end justify-end flex-grow mt-1 gap-x-4">
        <div class="flex flex-col items-center">
            <x-fas-stopwatch class="w-6" />
            <p class="font-bold">{{ $service->duration }} min</p>
        </div>
        <div class="flex flex-col items-center">
            <x-fas-money-bill-1-wave class="w-6" />
            <p class="font-bold">{{ $service->price }} zł</p>
        </div>
    </div>
</div>
