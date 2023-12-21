<x-app-layout>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white  shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <livewire:workers.edit-worker :id="request()->id" />
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white  shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <livewire:workers.edit-services />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
