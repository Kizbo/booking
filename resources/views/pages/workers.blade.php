@php
    $mockHeadings = ["Imię i nazwisko", "Login", "Usługi", "Akcje"];

    $mockData = [
        ["Anna Nowak", "an@booking.pl", "Strzyżenie męskie"],
        ["Jan Kowalski", "jk@booking.pl", "Manicure, Prostowanie włosów"]
    ];

    $mockActions = [
        [
            "type" => "primary",
            "text" => "Edytuj",
            "name" => "admin.workers.edit",
            "data" => [['id' => 1], ['id' => 2]]
        ]
    ]
@endphp

<x-app-layout>
    <x-slot name="header">
        {{ __("messages.workers") }}
    </x-slot>


    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 w-full">
                    <x-admin.section-title>{{ __("messages.workers-list") }}</x-admin.section-title>
                    <x-table :data="$mockData" :headings="$mockHeadings" :actions="$mockActions" />
                </div>
            </div>
        </div>
    </div>

    @push("body-scripts")
        @vite("resources/js/admin.js")
    @endpush
</x-app-layout>
