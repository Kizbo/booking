<?php

namespace App\Livewire\Components;

use LivewireUI\Modal\ModalComponent;
use App\Models\Service;
use App\Models\User;
use App\Models\Customer;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Validate;

class ReservationForm extends ModalComponent
{
    public array $userIds;
    public Service $service;
    /** @var Collection<User> $users */
    public Collection $users;
    public int $timestamp;
    public Carbon $datetime;
    public bool $isSingleUser;
    public bool $saved = false;

    //Form
    #[Validate('required')]
    public string $firstName;
    #[Validate('required')]
    public string $lastName;
    #[Validate('required')]
    public string $phoneNumber;
    #[Validate('required')]
    public string $email;
    public $chosenUser;

    public function mount()
    {
        $this->users = User::whereIn('id', $this->userIds)->get();
        $this->datetime = Carbon::createFromTimestampMs($this->timestamp);
        $this->isSingleUser = count($this->users) < 2;

        if ($this->isSingleUser)
            $this->chosenUser = $this->users->first()->id;
        else
            $this->chosenUser = 'any';
    }

    public function save()
    {
        $this->validate();

        $customerData = [
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'phone_number' => $this->phoneNumber,
            'email' => $this->email
        ];

        /** @var Customer $customer */
        $customer = Customer::create($customerData);

        if ($this->chosenUser == 'any')
            $this->chooseUser();
        else
            $this->chosenUser = intval($this->chosenUser);

        Reservation::create([
            'customer_id' => $customer->id,
            'user_id' => $this->chosenUser,
            'service_id' => $this->service->id,
            'reservation_datetime' => $this->datetime->toDateTime()
        ]);

        $this->saved = true;
    }

    private function chooseUser()
    {
    }

    public function render()
    {
        return view('livewire.pages.front.reservation-form');
    }
}
