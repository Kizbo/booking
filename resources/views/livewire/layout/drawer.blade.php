<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div x-data="{ open: window.innerWidth >= 976 }" @toggle-drawer.window="open = !open" :class="{'w-64': open, 'w-0': !open}" class="bg-white h-[calc(100vh-80px)] transition-all w-64 overflow-hidden">
    <div class="pt-2 pb-3 space-y-1">
        <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" wire:navigate>
            {{ __('Dashboard') }}
        </x-responsive-nav-link>
    </div>
</div>




