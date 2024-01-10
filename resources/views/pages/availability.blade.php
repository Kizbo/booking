<x-app-layout>
    <x-slot name="header">
        {{ __("messages.calendar-availability") }}
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 ">
                    <livewire:worker-calendar-selector calendar-type="components.admin.availability-calendar">
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
