<x-app-layout>
    <x-slot name="header">
        {{ __("messages.calendar-dates") }}
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 ">
                    @can("is-admin")
                        <livewire:worker-calendar-selector calendar-type="components.admin.reservations-calendar" />
                    @else
                        <livewire:components.admin.reservations-calendar :user-id="Auth::user()->id" />
                    @endcan
                </div>
            </div>
        </div>
    </div>

    @push("body-scripts")
        @vite("resources/js/admin.js")
    @endpush
</x-app-layout>
