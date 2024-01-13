<?php

use Livewire\Volt\Component;
use App\Models\Reservation;
use App\Livewire\Forms\ReservationForm;

new class extends Component {

    public Reservation $reservation;

    public ReservationForm $form;

    public function mount()
    {
        $this->form->setReservation($this->reservation);
    }

    public function editReservation(): void
    {
        $this->authorize("edit", $this->reservation);

        $result = $this->form->save();

        if(!$result)
            return;

        $this->reservation = $result;
        $this->dispatch("reservation-updated");
    }

}; ?>

<section>
    <header>
        <a href="{{ route("admin.dashboard", ['activeUser' => $reservation->user->id]) }}" class="flex items-center gap-2 mb-2"><x-fas-arrow-left-long class="h-4" /> {{ __("messages.back-to-calendar") }}</a>
        <h2 class="text-lg font-medium text-gray-900 ">
            {{ __('messages.edit') }} {{ $reservation->service->name }} {{ $reservation->reservation_datetime }}
        </h2>
    </header>

    <form wire:submit="editReservation" class="mt-6 space-y-6">
        <div>
            <p>
                {{ __("messages.reservation-end") }}:
                {{ \Illuminate\Support\Carbon::parse($form->reservation_datetime)->addMinutes($reservation->service->duration)->format("H:i") }}
            </p>
        </div>

        <div>
            <x-input-label for="name" :value="__('messages.reservation-datetime')"/>
            <x-text-input wire:model="form.reservation_datetime" id="reservation_datetime" name="reservation_datetime" type="datetime-local" class="mt-1 block w-full"/>
            <x-input-error :messages="$errors->get('form.reservation_datetime')" class="mt-2"/>
        </div>

        <div class="flex items-center gap-4">
            <x-action-message class="me-3" on="reservation-updated">
                {{ __('messages.saved') }}
            </x-action-message>
            <x-primary-button>{{ __('messages.save') }}</x-primary-button>
            <x-admin.delete-button :href="route('admin.reservations.delete', ['reservation' => $reservation->id])">{{ __("messages.delete") }}</x-admin.delete-button>
        </div>
    </form>
</section>
