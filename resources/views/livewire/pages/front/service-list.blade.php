<div class="mx-40 my-6">
    <div class="flex justify-between mb-6 bg-gray-300">
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
    {{-- //TODO: pasek z logo i wyszukiwarką - style --}}
    <div class="relative after:absolute after:shadow-[inset_0px_0px_8px_16px_#FFF] after:block after:-top-1 after:-bottom-1 after:-left-1 after:-right-1">
        <picture>
            <source type="image/webp" srcset="{{ asset('images/sample_bakcground.webp') }}">
            <img src="{{ asset('images/sample_bakcground.png') }}" alt="background" >
        </picture>
        <div class="absolute p-8 text-center text-white -translate-x-1/2 bg-black/50 bottom-16 left-1/2">
            <p class="text-xl font-bold">Lista usług salonu {{env('APP_NAME')}}</p>
            <p>Poniżej znajduje się lista wszystkich usług dostepnych online</p>
        </div>
    </div>
    <div class="relative grid grid-cols-1 p-6 lg:grid-cols-2 xl:grid-cols-3 gap-14">
        @foreach ($services as $key => $service)
            <livewire:pages.front.service-single :$service :$key />
        @endforeach
    </div>
</div>