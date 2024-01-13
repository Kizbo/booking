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
use App\Notifications\ReservationSaved;
use App\Notifications\ReservationReminder;
use Illuminate\Notifications\Notifiable;

class ReservationForm extends Component
{
    use Notifiable;

    protected $listeners = ['choseUsers' => 'setUsers'];

    public Carbon $datetime;
    public bool $isSingleUser;
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
            $this->chosenUser = $this->chooseUser();
        else
            $this->chosenUser = intval($this->chosenUser);

        //TODO: double check if reservation time is available

        Reservation::create([
            'customer_id' => $customer->id,
            'user_id' => $this->chosenUser,
            'service_id' => $this->service->id,
            'reservation_datetime' => $this->datetime->toDateTime()
        ]);

        $this->notifyNow((new ReservationSaved($this->datetime, $this->service)));
        $this->datetime->subDay();
        if (Carbon::now() < $this->datetime) {
            $this->notify((new ReservationReminder($this->datetime, $this->service))->delay($this->datetime));
        }
        $this->datetime->addDay();

        $this->dispatch('openModal', 'reservation-saved', ['datetime' => $this->datetime->timestamp]);
    }

    private function chooseUser()
    {
        //TODO: Choose worker automatically if none was specified
    }

    public function render()
    {
        return view('livewire.pages.front.reservation-form');
    }
}
