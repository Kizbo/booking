<?php

use Livewire\Volt\Component;

new class extends Component {

    public string $firstname;

    public string $lastname;

    public string $email;

    public string $phone_number;


    public function createWorker(): void
    {
        $this->authorize("manipulate", \App\Models\User::class);

        $this->validate([
            "firstname" => "required",
            "lastname" => "required",
            "email" => "email|required|unique:App\Models\User,email",
            "phone_number" => "required"
        ]);

        //create new worker
        $user = new \App\Models\User;
        $user->password = Hash::make(Str::random(15));
        $user->is_admin = false;

        $user->fill($this->all());
        $user->save();

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
            <x-text-input wire:model="firstname" id="firstname" name="firstname" type="text" class="mt-1 block w-full" autocomplete="given-name" />
            <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="lastname" :value="__('profile.last-name')" />
            <x-text-input wire:model="lastname" id="lastname" name="lastname" type="text" class="mt-1 block w-full" autocomplete="family-name" />
            <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="__('auth.email-field')" />
            <x-text-input wire:model="email" id="email" name="email" type="email" class="mt-1 block w-full" autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="phone_number" :value="__('profile.phone-number')" />
            <x-text-input wire:model="phone_number" id="phone_number" name="phone_number" type="text" class="mt-1 block w-full" autocomplete="tel" />
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('messages.add-entity') }}</x-primary-button>
        </div>
    </form>
</section>
