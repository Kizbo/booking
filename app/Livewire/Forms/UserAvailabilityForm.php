<?php

namespace App\Livewire\Forms;

use App\Models\User;
use App\Models\UserAvailability;
use Illuminate\Support\Carbon;
use Livewire\Form;

class UserAvailabilityForm extends Form
{
    public UserAvailability $availability;

    public User $user;

    public string $available_start_datetime;

    public string $available_end_datetime;

    public function rules()
    {
        return [
            'available_start_datetime' => 'required',
            'available_end_datetime' => 'required'
        ];
    }

    public function setAvailability(UserAvailability $availability)
    {
        $this->availability = $availability;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function save()
    {
        $this->resetErrorBag();
        $this->validate();

        $start = Carbon::parse($this->available_start_datetime);
        $end = Carbon::parse($this->available_end_datetime);

        if($start->day !== $end->day){
            $this->addError("available_start_datetime", __("messages.shift-must-be-one-day"));
            return;
        }

        if($start >= $end){
            $this->addError("available_start_datetime", __("messages.start-later-than-end"));
            return;
        }

        $overlappingShift = $this->user->availability
            ->where("available_start_datetime", "<=", $this->available_end_datetime)
            ->where("available_end_datetime", ">=", $this->available_start_datetime)
            ->first();

        if($overlappingShift){
            $this->addError("available_start_datetime", __("messages.overlapping-shift-exists"));
            return;
        }

        $this->availability->fill($this->only(['available_end_datetime', 'available_start_datetime']));
        $this->availability->user()->associate($this->user);

        $this->availability->save();

        return $this->availability;
    }

    public function create()
    {
        $this->save();
    }
}
