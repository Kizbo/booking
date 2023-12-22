<?php

use Livewire\Volt\Component;
use App\Models\Service;
use \App\Models\User;

new class extends Component
{
    public User $user;

    public array $selected = [];

    public function mount($userId)
    {
        $this->user = User::findOrFail($userId);
        $this->selected = $this->user->services->pluck("id")->toArray();
    }

    #[\Livewire\Attributes\Computed]
    public function services()
    {
        return Service::all(["id", "name"]);
    }

    public function updateWorkerServices()
    {
        $this->authorize("manipulate", User::class);

        $this->user->services()->detach();
        $this->user->services()->attach($this->selected);

        $this->dispatch("worker-services-saved");
    }
}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 ">
            {{ __('messages.update-worker-services') }}
        </h2>
    </header>

    <form wire:submit="updateWorkerServices" class="mt-6 space-y-6">

        <div class="flex flex-col gap-2">
            @foreach($this->services as $service)
                <x-input-label :for="$service->name" class="flex items-center gap-x-2">
                    <x-text-input
                        type="checkbox"
                        wire:model="selected"
                        :value="$service->id"
                        :checked="in_array($service->id, $selected)"
                        name="selected"
                        :id="$service->name"
                        class="h-8 w-8"
                    />
                    {{ $service->name }}
                </x-input-label>
            @endforeach
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('messages.save') }}</x-primary-button>

            <x-action-message class="me-3" on="worker-services-saved">
                {{ __('messages.saved') }}
            </x-action-message>
        </div>
    </form>
</section>
