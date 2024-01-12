<?php

use Livewire\Volt\Component;
use App\Models\Service;

new class extends Component {
    public Service $service;
}; ?>

<div class="flex flex-col p-6 rounded shadow-md shadow-gray-600">
    <div class="flex justify-between">
        <h2 class="text-lg font-bold">{{ $service->name }}</h2>
    </div>
    <p class="flex-grow mb-4">{{ $service->description }}</p>
    <div class="flex flex-row items-center mb-1 text-gray-600">
        <x-fas-stopwatch class="w-4 mr-4 fill-gray-600" />
        <p class="text-sm font-bold">{{ $service->duration }} min</p>
    </div>
    <div class="flex flex-row items-center mb-5 text-gray-600">
        <x-fas-money-bill-1-wave class="w-4 mr-4 fill-gray-600" />
        <p class="text-sm font-bold">{{ Number::currency($service->price, in: 'PLN', locale: 'pl') }}</p>
    </div>
    <div>
        <a href="/book-service/{{$service->id}}/" class="flex items-center justify-center px-6 py-2 mx-auto text-white duration-150 bg-gray-900 border border-gray-900 rounded-md w-fit hover:bg-white hover:text-gray-900">
            ZAREZERWUJ
        </a>
    </div>
</div>
