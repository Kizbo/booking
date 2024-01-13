<?php

namespace App\Livewire\Forms;

use App\Models\Customer;
use App\Models\Reservation;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Form;

class ReservationForm extends Form
{
    public Reservation $reservation;

    public string $reservation_datetime;

    public int $service_id;

    public int $user_id;

    public string $first_name;

    public string $last_name;

    public string $phone_number;

    public string $email;

    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required|phone_number',
            'email' => 'required|email'
        ];
    }

    public function setReservation(Reservation $reservation)
    {
        $this->reservation = $reservation;
        $this->reservation_datetime = $reservation->reservation_datetime->format("Y-m-d\TH:i");
    }

    public function store()
    {
        $this->validate();

        $this->reservation = new Reservation();
        $this->reservation->user_id = $this->user_id;
        $this->reservation->service_id = $this->service_id;

        return $this->save(createCustomer: true);
    }

    public function save(bool $createCustomer = false)
    {
        $this->resetErrorBag();

        $newReservationEnd = Carbon::parse($this->reservation_datetime)->addMinutes($this->reservation->service->duration);

        $isWorkerAvailable = $this->reservation->user->availability
            ->where("available_end_datetime", ">=", $newReservationEnd)
            ->where("available_start_datetime", "<=", $this->reservation_datetime)
            ->first();

        if(!$isWorkerAvailable){
            $this->addError("reservation_datetime", __("messages.worker-unavailable"));
            return;
        }


        $overlappingReservation = Reservation::whereNot("id", "=", $this->reservation->id)
            ->where("reservation_datetime", ">=", $this->reservation_datetime)
            ->where("reservation_datetime", "<=", $newReservationEnd)
            ->first();

        if($overlappingReservation){
            $this->addError("reservation_datetime", __("messages.worker-busy"));
            return;
        }

        $this->reservation->reservation_datetime = $this->reservation_datetime;

        if($createCustomer){
            $client = new Customer();
            $client->fill($this->only('first_name', 'last_name', 'phone_number', 'email'));
            $client->save();
            $this->reservation->customer_id = $client->id;
        }

        $this->reservation->save();
        $customer = Customer::find($this->reservation->id);
        $customer->reservation_id = $this->reservation->id;
        $customer->save();

        return $this->reservation;
    }
}
