<?php

namespace App\Livewire\Components;

use LivewireUI\Modal\ModalComponent;
use App\Models\Service;

class BookService extends ModalComponent
{
    public Service $service;

    public function render()
    {
        return view('livewire.pages.front.book-service');
    }
}