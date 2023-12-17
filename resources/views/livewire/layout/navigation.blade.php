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

<nav x-data="Navigation()" @toggle-drawer-from-drawer.window="open = !open;" class="bg-white border-b border-gray-100 ">
    <!-- Primary Navigation Menu -->
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center h-20">
            <!-- Hamburger -->
            <div class="flex items-center">
                <button @click="toggleDrawer($dispatch)" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 :text-gray-400 hover:bg-gray-100 :bg-gray-900 focus:outline-none focus:bg-gray-100 :bg-gray-900 focus:text-gray-500 :text-gray-400 transition duration-150 ease-in-out">
                    <svg x-cloak class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Settings Dropdown -->
            <div class="flex sm:items-center ml-auto">
                <x-dropdown-menu align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-slate-300 text-sm leading-4 font-medium rounded-md text-gray-500  bg-white  hover:text-gray-700 :text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div x-data="{ name: '{{ auth()->user()->name }}' }" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('admin.profile')" >
                            {{ __('auth.profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <button wire:click="logout" class="w-full text-start">
                            <x-dropdown-link>
                                {{ __('auth.log-out') }}
                            </x-dropdown-link>
                        </button>
                    </x-slot>
                </x-dropdown-menu>
            </div>
        </div>
    </div>
</nav>

<script>
    function Navigation(){
        return {
            open: window.innerWidth >= 976,
            toggleDrawer($dispatch){
                this.open = !this.open;
                $dispatch('toggle-drawer')
            }
        }
    }
</script>
