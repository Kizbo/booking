<?php

use Livewire\Volt\Component;
use App\Models\Reservation;
use App\Livewire\Forms\ReservationForm;
use \Livewire\Attributes\Computed;

new class extends Component {

    public ReservationForm $form;

    public function saveReservation(): void
    {
        $result = $this->form->store();

        if($result)
            $this->redirectRoute("admin.dashboard", ['activeUser' => $result->user->id]);
    }

    #[Computed]
    public function users()
    {
        return \App\Models\Service::find($this->form->service_id)->users;
    }

}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 ">
            {{ __('messages.create-reservation') }}
        </h2>
    </header>

    <form wire:submit="saveReservation" class="mt-6 space-y-6">
        <div>
            <x-input-label for="name" :value="__('messages.reservation-datetime')"/>
            <x-text-input wire:model="form.reservation_datetime" id="reservation_datetime" name="reservation_datetime" type="datetime-local" class="mt-1 block w-full"/>
            <x-input-error :messages="$errors->get('form.reservation_datetime')" class="mt-2"/>
        </div>

        <div>
            <x-input-label for="first_name" :value="__('profile.first-name')" />
            <x-text-input wire:model="form.first_name" id="first_name" name="first_name" type="text" class="mt-1 block w-full" autocomplete="given-name" />
            <x-input-error :messages="$errors->get('form.first_name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="last_name" :value="__('profile.last-name')" />
            <x-text-input wire:model="form.last_name" id="last_name" name="last_name" type="text" class="mt-1 block w-full" autocomplete="family-name" />
            <x-input-error :messages="$errors->get('form.last_name')" class="mt-2" />
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

        <hr />

        <div>
            <x-input-label for="service_id" :value="__('messages.service')"/>

            <select id="service_id" wire:model.live.fill="form.service_id" class="border-gray-300 focus:border-indigo-500 :border-indigo-600 focus:ring-indigo-500 :ring-indigo-600 rounded-md shadow-sm mt-1 block w-full">
                @foreach(\App\Models\Service::all() as $service)
                    <option value="{{ $service->id }}" wire:key="{{ $service->id }}">{{ $service->name }}</option>
                @endforeach
            </select>
        </div>

        @if(isset($form->service_id))
            <div>
                <x-input-label for="user_id" :value="__('messages.worker')"/>

                <select id="user_id" wire:model.live.fill="form.user_id" class="border-gray-300 focus:border-indigo-500 :border-indigo-600 focus:ring-indigo-500 :ring-indigo-600 rounded-md shadow-sm mt-1 block w-full">
                    @foreach($this->users as $user)
                        <option value="{{ $user->id }}" wire:key="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        @endif

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('messages.save') }}</x-primary-button>

            <x-action-message class="me-3" on="reservation-updated">
                {{ __('messages.saved') }}
            </x-action-message>
        </div>
    </form>
</section>
