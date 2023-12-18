<?php

use Livewire\Volt\Component;

new class extends Component {
    public function createWorker(): void
    {
        //create new worker

        $this->redirect(route("workers.edit", ['id' => 1]));
    }
}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 ">
            {{ __('messages.create-worker') }}
        </h2>
    </header>

    <form wire:submit="createWorker" class="mt-6 space-y-6">
        <div>
            <x-input-label for="name" :value="__('messages.name')" />
            <x-text-input wire:model="name" id="name" name="name" type="text" class="mt-1 block w-full" autocomplete="" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="__('auth.email-field')" />
            <x-text-input wire:model="email" id="email" name="email" type="email" class="mt-1 block w-full" autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="login" :value="__('messages.login')" />
            <x-text-input wire:model="login" id="login" name="login" type="text" class="mt-1 block w-full" autocomplete="login" />
            <x-input-error :messages="$errors->get('login')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('messages.add-entity') }}</x-primary-button>
        </div>
    </form>
</section>
