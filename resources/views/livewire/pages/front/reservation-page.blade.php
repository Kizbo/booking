<div>
    <livewire:components.book-service :$service >
    <pre>{{$id}}</pre>
</div>

@push('page-styles')
    @vite(['resources/css/booking-calendar.css'])
@endpush
@push('body-scripts')
    @vite(['resources/js/booking-calendar.js'])
@endpush