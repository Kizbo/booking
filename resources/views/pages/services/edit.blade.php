<x-app-layout>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white  shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <livewire:services.edit-service :id="request()->id">
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
