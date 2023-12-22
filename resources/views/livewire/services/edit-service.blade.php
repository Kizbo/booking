<?php

use Livewire\Volt\Component;
use App\Livewire\Forms\ServiceForm;
use App\Models\Service;

new class extends Component {

    public ServiceForm $form;

    public Service $service;

    public function mount($id): void
    {
        $this->service = Service::findOrFail($id);
        $this->form->setService($this->service);
    }

    public function editService(): void
    {
        $this->authorize("manipulate", Service::class);

        $this->form->save();

        $this->dispatch("service-updated");
    }

}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 ">
            {{ __('messages.edit') }} "{{ $service->name }}" (#{{ $service->id }})
        </h2>
    </header>

    <form wire:submit="editService" class="mt-6 space-y-6">
        <div>
            <x-input-label for="name" :value="__('messages.name')"/>
            <x-text-input wire:model="form.name" id="name" name="name" type="text" class="mt-1 block w-full"/>
            <x-input-error :messages="$errors->get('form.name')" class="mt-2"/>
        </div>

        <div>
            <x-input-label for="description" :value="__('messages.description')"/>
            <x-text-input wire:model="form.description" id="description" name="description" type="text"
                          class="mt-1 block w-full"/>
            <x-input-error :messages="$errors->get('form.description')" class="mt-2"/>
        </div>

        <div>
            <x-input-label for="price" :value="__('messages.price')"/>
            <div class="w-full flex items-center gap-x-2">
                <x-text-input wire:model="form.price" id="price" name="price" type="number" min="0.00" step="0.01"
                              class="mt-1 block w-24"/>
                <p>PLN</p>
            </div>

            <x-input-error :messages="$errors->get('form.price')" class="mt-2"/>
        </div>

        <div>
            <x-input-label for="duration" :value="__('messages.duration')"/>
            <div class="w-full flex items-center gap-x-2">
                <x-text-input wire:model="form.duration" id="duration" name="duration" type="number" min="1" step="1"
                              class="mt-1 block w-24"/>
                <p>min</p>
            </div>
            <x-input-error :messages="$errors->get('form.duration')" class="mt-2"/>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('messages.save') }}</x-primary-button>

            <x-action-message class="me-3" on="service-updated">
                {{ __('messages.saved') }}
            </x-action-message>
        </div>
    </form>
</section>
