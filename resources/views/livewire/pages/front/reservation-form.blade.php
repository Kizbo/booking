<?php

use Livewire\Volt\Component;
use App\Models\Service;

new class extends Component {
    public ?Service $service;
}; ?>
<div>
    {{-- @isset($service)
        <div>
            <h1>{{ $service->name }}</h1>
            <p>{{ $service->description }}</p>
        </div>
    @endisset --}}
    <pre>{{ var_dump($service) }}</pre>
</div>