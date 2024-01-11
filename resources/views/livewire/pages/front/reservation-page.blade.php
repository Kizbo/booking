<div>
    <livewire:components.book-service :$service >
    <livewire:components.reservation-form :$service >
        {{-- {{var_dump(\Queue::getRedis()->connection($connection)->zrange('queues:'.$default.':delayed', 0, -1))}} --}}
</div>

@push('body-scripts')
    @vite(['resources/js/booking-calendar.js'])
@endpush