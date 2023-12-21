<x-front-layout>
    <x-front.service-search />
    <x-front.service-grid />
    @push('body-scripts')
        @vite(['resources/js/fullcalendar-locale/pl.js'])
        @vite(['resources/js/booking-calendar.js'])
    @endpush
</x-front-layout>
