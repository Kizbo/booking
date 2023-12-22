<?php

use Livewire\Volt\Component;
use App\Livewire\Forms\ServiceForm;

new class extends Component {

    public ServiceForm $form;

    public function createService(): void
    {
        $this->authorize("manipulate", \App\Models\Service::class);

        $service = $this->form->store();

        $this->redirect(route("admin.services.edit", ['id' => $service->id]));
    }

}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 ">
            {{ __('messages.create-service') }}
        </h2>
    </header>

    <form wire:submit="createService" class="mt-6 space-y-6">
        <div>
            <x-input-label for="name" :value="__('messages.name')" />
            <x-text-input wire:model="form.name" id="name" name="name" type="text" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('form.name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="description" :value="__('messages.description')" />
            <x-text-input wire:model="form.description" id="description" name="description" type="text" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('form.description')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="price" :value="__('messages.price')" />
            <div class="w-full flex items-center gap-x-2">
                <x-text-input wire:model="form.price" id="price" name="price" type="number" min="0.00" step="0.01" class="mt-1 block w-24" />
                <p>PLN</p>
            </div>

            <x-input-error :messages="$errors->get('form.price')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="duration" :value="__('messages.duration')" />
            <div class="w-full flex items-center gap-x-2">
                <x-text-input wire:model="form.duration" id="duration" name="duration" type="number" min="1" step="1" class="mt-1 block w-24" />
                <p>min</p>
            </div>
            <x-input-error :messages="$errors->get('form.duration')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('messages.add-entity') }}</x-primary-button>
        </div>
    </form>
</section>
