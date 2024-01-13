<x-slot:title>
    Wybierz termin
</x-slot>

<div class="p-10">
    <h1 class="text-2xl font-bold">Wybierz termin rezerwacji</h1>
    <div class="flex flex-col lg:flex-row">
        <livewire:components.reservation-form :$service >
        <div class="p-6 mt-5 rounded shadow-md shadow-gray-600 flex-grow overflow-x-auto">
            <livewire:components.book-service :$service >
        </div>
    </div>
</div>

@push('body-scripts')
    @vite(['resources/js/booking-calendar.js'])
@endpush