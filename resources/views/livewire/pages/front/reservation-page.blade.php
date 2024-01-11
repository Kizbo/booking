<div class="p-10 flex">
    <livewire:components.book-service :$service >
    <livewire:components.reservation-form :$service >
</div>

@push('body-scripts')
    @vite(['resources/js/booking-calendar.js'])
@endpush