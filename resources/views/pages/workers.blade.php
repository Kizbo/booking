<x-app-layout>
    <x-slot name="header">
        {{ __("messages.workers") }}
    </x-slot>

    <div class="w-full sm:px-6 lg:px-8 pt-12">
        <x-admin.primary-button :href="route('admin.workers.create')">{{ __("messages.create-worker") }}</x-admin.primary-button>
    </div>

    <div class="py-4">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 w-full">
                    <x-admin.section-title>{{ __("messages.workers-list") }}</x-admin.section-title>
                    <x-table :data="$tableData" :headings="$tableHeaders" :actions="$tableActions" />
                </div>
            </div>
        </div>
    </div>

    @push("body-scripts")
        @vite("resources/js/admin.js")
    @endpush
</x-app-layout>
