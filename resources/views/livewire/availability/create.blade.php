<?php

use Livewire\Volt\Component;
use \App\Livewire\Forms\UserAvailabilityForm;
use \Illuminate\Support\Carbon;

new class extends Component {

    public UserAvailabilityForm $form;

    public \App\Models\User $user;

    public function mount()
    {
        $this->form->setAvailability(new \App\Models\UserAvailability());
        $this->form->setUser($this->user);

        if(request()->has("start"))
            $this->form->available_start_datetime = Carbon::parse(request()->get("start"))->format("Y-m-d\TH:i:s");

        if(request()->has("end"))
            $this->form->available_end_datetime = Carbon::parse(request()->get("end"))->format("Y-m-d\TH:i:s");
    }

    public function create(): void
    {
        $this->authorize("manipulate", \App\Models\UserAvailability::class);

        $result = $this->form->store();

        if($result)
            $this->redirectRoute("admin.availability", ['activeUser' => $this->user->id]);
    }


}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 ">
            {{ __('messages.create-availability') }}
        </h2>
        <p>{{ __("messages.for-user") }} {{ $user->name }}</p>
    </header>

    <form wire:submit="create" class="mt-6 space-y-6">
        <div>
            <x-input-label for="name" :value="__('messages.availability-start')"/>
            <x-text-input wire:model="form.available_start_datetime" id="available_start_datetime" name="available_start_datetime" type="datetime-local" class="mt-1 block w-full"/>
            <x-input-error :messages="$errors->get('form.available_start_datetime')" class="mt-2"/>
        </div>

        <div>
            <x-input-label for="name" :value="__('messages.availability-end')"/>
            <x-text-input wire:model="form.available_end_datetime" id="available_end_datetime" name="available_end_datetime" type="datetime-local" class="mt-1 block w-full"/>
            <x-input-error :messages="$errors->get('form.available_end_datetime')" class="mt-2"/>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('messages.save') }}</x-primary-button>
        </div>
    </form>
</section>
