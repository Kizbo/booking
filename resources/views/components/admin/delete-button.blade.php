<div x-data="{openModal: false}">
    <a x-on:click="$event.preventDefault(); openModal = true" {{ $attributes->merge(['class' => 'inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white  uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 :ring-offset-gray-800 transition ease-in-out duration-150']) }}>
        {{ $slot }}
    </a>

    <div x-cloak x-show="openModal" class="fixed top-0 left-0 bg-gray-700/40 w-full h-full z-50">
        <div x-show="openModal" class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 max-w-full bg-white p-5">
            <p class="text-lg mb-4">{{ __("messages.are-you-sure-to-delete") }}</p>

            <div class="flex items-center justify-between">
                <button x-on:click="window.location.replace('{{ $attributes->get('href') }}')" class="inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white  uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 :ring-offset-gray-800 transition ease-in-out duration-150">
                    {{ __("messages.confirm") }}
                </button>
                <button x-on:click="openModal = false" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white  uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 :ring-offset-gray-800 transition ease-in-out duration-150">
                    {{ __("messages.cancel") }}
                </button>
            </div>
        </div>
    </div>
</div>
