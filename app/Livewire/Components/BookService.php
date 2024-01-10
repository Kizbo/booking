<?php

namespace App\Livewire\Components;

use App\Models\Service;
use App\Models\UserAvailability;
use App\Models\User;
use App\Models\Reservation;
use \Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use \Illuminate\Database\Eloquent\Collection;

class BookService extends Calendar
{
    public array $timeSlots = [];

    protected function getTimeSlots(Carbon $start)
    {
        $this->timeSlots = [];
        $users = User::whereHas('services', function (Builder $query) {
            $query->where('service_id', $this->service->id);
        })->get();

        /** @var \App\Models\User $user */
        foreach ($users as $user) {
            $this->getUserAvailabilityByDate($start, $user->id);
        }

        return $this->timeSlots;
    }

    private function getUserAvailabilityByDate(Carbon $start, int $userId)
    {
        $availability = UserAvailability::where('user_id', $userId)->where('available_end_datetime', '>=', $start->toDateTimeString());
        $start->endOfDay();
        /** @var UserAvailability $availability */
        $availability = $availability->where('available_start_datetime', '<=', $start->toDateTimeString())->first();
        $start->startOfDay();

        if ($availability) {
            $this->generateTimeSlots($availability, $userId);
        }
    }

    private function saveIfNotOccupied(Collection $reservations, Carbon $operationTime, int $userId)
    {
        if ($operationTime < Carbon::now()) {
            $operationTime->addMinutes($this->service->duration);
            return;
        }

        $occupied = false;
        $operationTimeEnd = clone $operationTime;
        $operationTimeEnd->addMinutes($this->service->duration - 1);

        /** @var Reservation $reservation */
        foreach ($reservations as $reservation) {
            $reservationStartTime = Carbon::parse($reservation->reservation_datetime);
            $reservationEndTime = clone $reservationStartTime;
            $reservationEndTime->addMinutes($reservation->service->duration - 1);

            if ($reservationStartTime <= $operationTimeEnd && $operationTime <= $reservationEndTime) {
                $occupied = true;
                break;
            }
        }

        if ($occupied) {
            $operationTime->addMinutes($this->service->duration);
            return;
        }

        $format = $operationTime->format("H:i:s");
        if (isset($this->timeSlots[$format])) {
            $this->timeSlots[$format]["users"][] = $userId;
        } else {
            $this->timeSlots[$format]["users"] = [$userId];
            $this->timeSlots[$format]["endTime"] = $operationTimeEnd->addMinute()->format("H:i:s");
        }

        $operationTime->addMinutes($this->service->duration);
    }

    private function generateTimeSlots(UserAvailability $availability, int $userId)
    {
        $operationTime = Carbon::instance($availability->available_start_datetime);
        /** @var Collection<Reservation> $reservations */
        $reservations = Reservation::where('reservation_datetime', '>=', $availability->available_start_datetime)
            ->where('reservation_datetime', '<=', $availability->available_end_datetime)
            ->where('user_id', $userId)->get();

        while ($availability->available_end_datetime > $operationTime->toDateTime()) {
            $this->saveIfNotOccupied($reservations, $operationTime, $userId);
        }
    }
}
