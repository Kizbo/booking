<?php

use Livewire\Volt\Component;
use App\Models\Service;

new class extends Component {
    public Service $service;
}; ?>

<div>
    <h1>bebe</h1>
    <h2>{{ $service->name }}</h2>
</div>
