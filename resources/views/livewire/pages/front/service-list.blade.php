<div class="mx-40 my-6">
    <div class="relative after:absolute after:shadow-[inset_0px_0px_8px_16px_#FFF] after:block after:-top-1 after:-bottom-1 after:-left-1 after:-right-1">
        <picture>
            <source type="image/webp" srcset="{{ asset('images/sample_bakcground.webp') }}">
            <img src="{{ asset('images/sample_bakcground.png') }}" alt="background" >
        </picture>
        <div class="absolute z-10 py-8 px-4 md:px-8 lg:px-20 backdrop-blur-md rounded-3xl text-center text-white -translate-x-1/2 -translate-y-1/2 bg-black/25 top-2/3 left-1/2">
            <div class="flex mb-6 relative mx-auto rounded-full w-full">
                <input type="text" class="rounded-full w-full pr-11 text-black" wire:keydown.enter="search" wire:model="searchStr">
                <button type="button" class="absolute p-2 top-1/2 right-2 -translate-y-1/2 bg-black rounded-full" wire:click="search">
                    <x-fas-search class="w-4 fill-white" />
                </button>
            </div>
            <p>Wyszukaj usługę z poniższej listy</p>
        </div>
    </div>
    <div class="relative grid grid-cols-1 p-6 lg:grid-cols-2 xl:grid-cols-3 gap-14">
        @foreach ($services as $key => $service)
            <livewire:pages.front.service-single :$service :$key />
        @endforeach
    </div>
</div>