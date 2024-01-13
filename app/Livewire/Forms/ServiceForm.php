<?php

namespace App\Livewire\Forms;

use App\Models\Service;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class ServiceForm extends Form
{
    public ?Service $service = null;

    public string $name = '';

    public string $description = '';

    public int $duration = 20;

    public float $price = 0;


    public function rules(): array
    {
        return [
            'name' => "string|required",
            'description' => 'string|required',
            'duration' => 'int|required|min:1',
            'price' => 'numeric|required|min:0'
        ];
    }

    public function setService(Service $service): void
    {
        $this->service = $service;
        $this->fill($service);
    }

    public function store(): Service
    {
        $service = new Service;
        $service->fill($this->only(["name", "description", "duration", "price"]));

        $service->save();

        return $service;
    }

    public function save(): void
    {
        $this->validate();

        if($this->service->reservations->isNotEmpty())
            throw ValidationException::withMessages([$this->getPropertyName() . '.duration' => __("messages.cannot-edit-service-time-if-reservations-exists")]);

        $this->service->update($this->only(["name", "description", "duration", "price"]));
    }
}
