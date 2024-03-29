<?php

namespace App\Livewire\Components\Admin;

use App\Livewire\Components\Calendar;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Reactive;

class AvailabilityCalendar extends Calendar
{

    #[Reactive]
    #[Locked]
    public $userId;

    /**
     * @inheritDoc
     */
    public function chooseEvent(array $data): void
    {
        $this->redirectRoute("admin.availability.edit", ['availability' => $data['data']['availabilityId']]);
    }

    protected function getTimeSlots(Carbon $day)
    {
        $user = User::find($this->userId);
        $dayStart = (clone $day)->startOfDay();
        $dayEnd = (clone $day)->endOfDay();

        $availability = $user->availability
            ->where("available_start_datetime", "<=", $dayEnd)
            ->where("available_end_datetime", ">=", $dayStart);

        return $availability->mapWithKeys(function ($slot) {
            return [$slot->available_start_datetime->format("H:i:s") => [
                'endTime' => $slot->available_end_datetime->format("H:i:s"),
                'data' => [
                    'availabilityId' => $slot->id,
                ]
            ]];
        })->toArray();
    }

    /**
     * @inheritDoc
     */
    public function selectCallback(array $data): void
    {
        $this->redirectRoute(
            "admin.availability.create",
            [
                'user' => $this->userId,
                'start' => $data['startStr'],
                'end' => $data['endStr']
            ]
        );
    }
}
