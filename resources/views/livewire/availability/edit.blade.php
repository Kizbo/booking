<?php

use Livewire\Volt\Component;
use App\Livewire\Forms\UserAvailabilityForm;
use Illuminate\Support\Carbon;
use App\Models\UserAvailability;
use App\Models\User;

new class extends Component {

    public UserAvailabilityForm $form;

    public UserAvailability $availability;

    public function mount()
    {
        $this->form->setAvailability($this->availability);
        $this->form->setUser($this->availability->user);
        $this->form->available_start_datetime = $this->availability->available_start_datetime->format("Y-m-d\TH:i:s");
        $this->form->available_end_datetime = $this->availability->available_end_datetime->format("Y-m-d\TH:i:s");
    }

    public function edit(): void
    {
        $this->authorize("manipulate", UserAvailability::class);

        $result = $this->form->save();

        if($result)
            $this->redirectRoute("admin.availability", ['activeUser' => $this->availability->user->id]);
    }

}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 ">
            {{ __('messages.edit-availability') }} | {{ $availability->user->name }} {{ $availability->available_start_datetime->format("d-m-Y") }} {{ $availability->available_start_datetime->format("H:i") }} - {{ $availability->available_end_datetime->format("H:i") }}
        </h2>
    </header>

    <form wire:submit="edit" class="mt-6 space-y-6">
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
            <x-action-message class="me-3" on="reservation-updated">
                {{ __('messages.saved') }}
            </x-action-message>
            <x-primary-button>{{ __('messages.save') }}</x-primary-button>
            <x-admin.delete-button :href="route('admin.availability.delete', ['availability' => $availability->id])">{{ __("messages.delete") }}</x-admin.delete-button>
        </div>
    </form>
</section>
