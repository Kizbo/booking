<x-app-layout>
    <x-slot name="header">
        {{ __("messages.settings") }}
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 w-full">
                    <x-admin.section-title>{{ __("messages.settings-general") }}</x-admin.section-title>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
