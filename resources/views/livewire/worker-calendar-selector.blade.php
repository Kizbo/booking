<?php

use function \Livewire\Volt\{state};

state(['active', 'calendarType']);

$setActive = function ($newValue) {
    $this->active = intval($newValue);
    $this->dispatch("refreshCalendar");
};

?>

<div class="relative">
    <div wire:loading.flex class="absolute top-0 left-0 w-full h-full bg-gray-600/70 items-center justify-center">
        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
    </div>

    <div class="pb-10">
        <label>
            <p class="mb-4">{{ __("messages.choose-worker") }}</p>

            <select wire:change="setActive($event.target.value)" class="border-gray-300 focus:border-indigo-500 :border-indigo-600 focus:ring-indigo-500 :ring-indigo-600 rounded-md shadow-sm mt-1 block w-full">
                <option value="null" disabled selected>---</option>

                @foreach(\App\Models\User::all() as $user)
                    <option value="{{ $user->id }}" wire:key="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </label>
    </div>

    @if($active)
        <div class="max-w-full" wire:transition>
            <livewire:dynamic-component :is="$calendarType" :userId="$active" />
        </div>
    @endif

    @push("body-scripts")
        @vite("resources/js/admin.js")
    @endpush
</div>


