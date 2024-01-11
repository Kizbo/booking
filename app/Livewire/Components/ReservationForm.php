<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Service;
use App\Models\User;
use App\Models\Customer;
use App\Models\Reservation;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationSaved;
use App\Notifications\ReservationReminder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Redis;

class ReservationForm extends Component
{
    use Notifiable;

    protected $listeners = ['choseUsers' => 'setUsers'];

    public Carbon $datetime;
    public bool $isSingleUser;
    public bool $saved = false;
    public Service $service;
    public $users;
    private ReservationReminder $notification;
    public $chosenUser;
    public ?int $timestamp;

    //Form
    #[Validate('required')]
    public string $firstName;
    #[Validate('required')]
    public string $lastName;
    #[Validate('required|phone_number')]
    public string $phoneNumber;
    #[Validate('required|email')]
    public string $email;

    public function mount(ReservationReminder $notification)
    {
        $this->notification = $notification;
    }

    public function setUsers($data)
    {
        $this->users = User::whereIn('id', $data['data']['users'])->get();

        $this->datetime = Carbon::createFromTimestampMs($data['timestamp']);
        $this->isSingleUser = count($this->users) < 2;

        if ($this->isSingleUser && $this->users)
            $this->chosenUser = $this->users->first()->id;
        else {
            $this->chosenUser = 'any';
        }
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

        Mail::to($this->email)->send(new ReservationSaved());
        $delay = now()->addMinutes(2);
        $this->notify((new ReservationReminder())->delay($delay));
    }

    private function chooseUser()
    {
    }

    public function render()
    {
        return view('livewire.pages.front.reservation-form');
    }
}
