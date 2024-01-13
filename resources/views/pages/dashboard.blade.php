<x-app-layout>
    <x-slot name="header">
        {{ __("messages.calendar-dates") }}
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 ">
                    <a class="inline-flex mb-4 items-center px-4 py-2 bg-gray-800  border border-transparent rounded-md font-semibold text-xs text-white  uppercase tracking-widest hover:bg-gray-700 :bg-white focus:bg-gray-700 :bg-white active:bg-gray-900 :bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 :ring-offset-gray-800 transition ease-in-out duration-150"
                       href="{{ route('admin.reservations.create') }}"
                    >
                        {{ __("messages.create-reservation") }}
                    </a>

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
