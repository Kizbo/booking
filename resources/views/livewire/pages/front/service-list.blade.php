<div>
    <input type="text" wire:model="searchStr">
    <button type="button" wire:click="search">ser</button>
    @foreach ($services as $key => $service)
        <livewire:pages.front.service-single :$service :key="$key" />
        {{ $service->name }}
    @endforeach
</div>

@push('body-scripts')
    @vite(['resources/js/fullcalendar-locale/pl.js'])
    {{-- @vite(['resources/js/booking-calendar.js']) --}}
@endpush
