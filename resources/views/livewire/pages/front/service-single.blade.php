<?php

use Livewire\Volt\Component;
use App\Models\Service;

new class extends Component {
    public Service $service;
}; ?>

<div class="flex flex-col py-3 pl-3 pr-6 rounded shadow-md shadow-gray-600">
    <div class="flex justify-between">
        <h2 class="text-lg font-bold">{{ $service->name }}</h2>
        <a href="/book-service/{{$service->id}}/" class="flex items-center justify-center w-10 h-10 duration-150 bg-black border border-black rounded-full group hover:bg-white">
            <x-fas-calendar-plus class="w-5 -mt-px duration-150 fill-white group-hover:fill-black" />
        </a>
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
