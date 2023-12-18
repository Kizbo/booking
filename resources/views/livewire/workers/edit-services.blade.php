<?php

use Livewire\Volt\Component;

new class extends Component {
    public function updateWorkerServices()
    {
        //update worker services

        $this->dispatch("worker-services-saved");
    }
}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 ">
            {{ __('messages.update-worker-services') }}
        </h2>
    </header>

    <form wire:submit="updateWorkerServices" class="mt-6 space-y-6">

        <p>Tu będzie jakiś wybór usług</p>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('messages.save') }}</x-primary-button>

            <x-action-message class="me-3" on="worker-services-saved">
                {{ __('messages.saved') }}
            </x-action-message>
        </div>
    </form>
</section>
