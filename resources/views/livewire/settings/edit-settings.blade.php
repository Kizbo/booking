<?php

use Livewire\Volt\Component;
use App\Livewire\Forms\ServiceForm;
use App\Models\Setting;
use Illuminate\Support\Collection;

new class extends Component {

    public array $settings;

    public function mount(): void
    {
        $this->settings = Setting::all()->toArray();
    }

    public function saveSettings(): void
    {
        $this->authorize("is-admin");
        foreach ($this->settings as $setting)
            Setting::where("id", "=", $setting['id'])->update(['value' => $setting['value']]);

        $this->dispatch("settings-updated");
    }

}; ?>

<section>
    <form wire:submit="saveSettings" class="mt-6 space-y-6">
        @foreach($settings as $index => $setting)
            <div>
                <x-input-label :for="$setting['name']" :value="__('messages.label-' . $setting['name'])"/>
                <x-text-input wire:model="settings.{{ $loop->index }}.value" :id="$setting['name']" :name="$setting['name']" type="text" class="mt-1 block w-full"/>
            </div>
        @endforeach


        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('messages.save') }}</x-primary-button>

            <x-action-message class="me-3" on="settings-updated">
                {{ __('messages.saved') }}
            </x-action-message>
        </div>
    </form>
</section>
