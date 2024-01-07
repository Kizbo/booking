<div class="mx-40 my-6">
    <div class="flex justify-between mb-6">
        <div>
            <img src="#" alt="Logo">
        </div>
        <div class="flex rounded-full shadow-md shadow-gray-600">
            <input type="text" class="rounded-l-full" wire:keydown.enter="search" wire:model="searchStr">
            <button type="button" class="h-full border-r border-black rounded-r-full border-y bg-primary-gradient" wire:click="search">
                <div class="p-2 mx-2 bg-black rounded-full">
                    <x-fas-search class="w-4 fill-white" />
                </div>
            </button>
        </div>
    </div>
    <div class="p-2 border border-black rounded-t-3xl bg-primary-gradient">
        <div class="relative after:border after:border-black after:absolute after:rounded-t-3xl after:shadow-[inset_8px_8px_30px_-5px_#000] after:block after:top-0 after:w-full after:h-full">
            <picture>
                <source type="image/webp" srcset="{{ asset('images/sample_bakcground.webp') }}">
                <img class="rounded-t-3xl" src="{{ asset('images/sample_bakcground.png') }}" alt="background" >
            </picture>
        </div>
    </div>
    <div class="relative z-10 grid grid-cols-4 gap-6 p-6 shadow-md shadow-gray-600 -mt-6 border border-black rounded-3xl bg-white">
        @foreach ($services as $key => $service)
            <livewire:pages.front.service-single :$service :$key />
        @endforeach
    </div>
</div>

@push('page-styles')
    @vite(['resources/css/booking-calendar.css'])
@endpush
@push('body-scripts')
    @vite(['resources/js/booking-calendar.js'])
@endpush