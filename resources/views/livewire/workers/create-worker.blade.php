<?php

use Livewire\Volt\Component;
use App\Livewire\Forms\UserForm;

new class extends Component {

    public UserForm $form;

    public function createWorker(): void
    {
        $this->authorize("manipulate", \App\Models\User::class);

        $user = $this->form->store();

        $this->redirect(route("admin.workers.edit", ['id' => $user->id]));
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
            <x-input-label for="firstname" :value="__('profile.first-name')" />
            <x-text-input wire:model="form.firstname" id="firstname" name="firstname" type="text" class="mt-1 block w-full" autocomplete="given-name" />
            <x-input-error :messages="$errors->get('form.firstname')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="lastname" :value="__('profile.last-name')" />
            <x-text-input wire:model="form.lastname" id="lastname" name="lastname" type="text" class="mt-1 block w-full" autocomplete="family-name" />
            <x-input-error :messages="$errors->get('form.lastname')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="__('auth.email-field')" />
            <x-text-input wire:model="form.email" id="email" name="email" type="email" class="mt-1 block w-full" autocomplete="email" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="phone_number" :value="__('profile.phone-number')" />
            <x-text-input wire:model="form.phone_number" id="phone_number" name="phone_number" type="text" class="mt-1 block w-full" autocomplete="tel" />
            <x-input-error :messages="$errors->get('form.phone_number')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('messages.add-entity') }}</x-primary-button>
        </div>
    </form>
</section>
