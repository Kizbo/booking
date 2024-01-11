<?php

use Livewire\Volt\Component;
use App\Models\Service;
use Illuminate\Support\Number;

new class extends Component {
    public Service $service;
}; ?>

<div class="flex flex-col p-6 rounded shadow-md shadow-gray-600">
    <div class="flex justify-between">
        <h2 class="text-lg font-bold">{{ $service->name }}</h2>
    </div>
    <p class="mb-4">{{ $service->description }}</p>
    <div class="flex flex-row items-center text-gray-600 mb-1">
        <x-fas-stopwatch class="w-4 mr-4 fill-gray-600" />
        <p class="font-bold text-sm">{{ $service->duration }} min</p>
    </div>
    <div class="flex flex-row items-center mb-5 text-gray-600">
        <x-fas-money-bill-1-wave class="w-4 mr-4 fill-gray-600" />
        <p class="font-bold text-sm">{{ Number::currency($service->price, in: 'PLN', locale: 'pl') }}</p>
    </div>
    <div>
        <a href="/book-service/{{$service->id}}/" class="flex px-6 py-2 mx-auto rounded-md w-fit items-center justify-center duration-150 bg-gray-900 border border-gray-900 hover:bg-white text-white hover:text-gray-900">
            ZAREZERWUJ
        </a>
    </div>
</div>
