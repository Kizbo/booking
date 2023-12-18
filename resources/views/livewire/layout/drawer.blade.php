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

        $this->redirect('/');
    }
}; ?>

<div x-data="{ open: window.innerWidth >= 976 }" @toggle-drawer.window="open = !open" :class="{'left-0 lg:w-64': open, '-left-64 lg:w-0': !open}" class="z-50 fixed top-0 -left-64 h-screen bg-gray-900 transition-all w-64 overflow-hidden lg:sticky">
    <div class="absolute right-0 top-0 flex items-center lg:hidden">
        <button @click="open = !open; $dispatch('toggle-drawer-from-drawer')" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 :text-gray-400 hover:bg-gray-100 :bg-gray-900 focus:outline-none focus:bg-gray-100 :bg-gray-900 focus:text-gray-500 :text-gray-400 transition duration-150 ease-in-out">
            {{ __("Zamknij") }}
        </button>
    </div>

    <div class="flex w-full items-center justify-center py-6">
        <a href="{{ route('admin.dashboard') }}"  class="flex items-center gap-x-1">
            <x-application-logo class="h-10 w-10" />
            <span class="hidden sm:inline text-sm text-white">Booking Assistant</span>
        </a>
    </div>

    <div class="flex flex-col gap-y-4 text-white px-3">
        <p class="text-xs text-gray-500 pl-2">MENU</p>

        <div>
            <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" >
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.services')" :active="request()->routeIs('admin.services')" >
                {{ __('messages.services') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.workers')" :active="request()->routeIs('admin.workers')" >
                {{ __('messages.workers') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.settings')" :active="request()->routeIs('admin.settings')" >
                {{ __('messages.settings') }}
            </x-responsive-nav-link>
        </div>

    </div>
</div>




