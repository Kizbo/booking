<?php

use function \Livewire\Volt\{state};

state(['calendarType']);
state(['active'])->url('activeUser');

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
                <option value="null" disabled {{ $active ? null : 'selected' }}>---</option>

                @foreach(\App\Models\User::all() as $user)
                    <option value="{{ $user->id }}" wire:key="{{ $user->id }}" {{ $active === $user->id ? 'selected' : null }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </label>
    </div>

    @if($active)
        @can("is-admin")
            @if($calendarType === 'components.admin.availability-calendar')
                <a class="inline-flex mb-4 items-center px-4 py-2 bg-gray-800  border border-transparent rounded-md font-semibold text-xs text-white  uppercase tracking-widest hover:bg-gray-700 :bg-white focus:bg-gray-700 :bg-white active:bg-gray-900 :bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 :ring-offset-gray-800 transition ease-in-out duration-150"
                   href="{{ route('admin.availability.create', ['user' => $active]) }}"
                >
                    {{ __("messages.create-availability") }}
                </a>
            @endif
        @endcan
        <div class="max-w-full" wire:transition>
            <livewire:dynamic-component :is="$calendarType" :userId="$active" />
        </div>
    @endif
</div>


