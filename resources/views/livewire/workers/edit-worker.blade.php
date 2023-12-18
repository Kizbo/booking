<?php

use Livewire\Volt\Component;

new class extends Component {

    public string $name;
    public string $email;
    public string $login;

    public function updateWorker(): void
    {
        try {
            $validated = $this->validate([
                'name' => ['required', 'string'],
                'email' => ['required', 'email'],
                'login' => ['required', 'string']
            ]);
        } catch (ValidationException $e) {
            $this->reset();

            throw $e;
        }

        //update worker

        //reset fields

        //dispatch success event
        $this->dispatch("worker-updated");
    }
}


?>


<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 ">
            {{ __('messages.update-worker') }}
        </h2>
    </header>

    <form wire:submit="updateWorker" class="mt-6 space-y-6">
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
            <x-primary-button>{{ __('messages.save') }}</x-primary-button>

            <x-action-message class="me-3" on="worker-updated">
                {{ __('messages.saved') }}
            </x-action-message>
        </div>
    </form>
</section>
