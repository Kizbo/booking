<?php

namespace App\Livewire\Components;

use LivewireUI\Modal\ModalComponent;
use App\Models\Service;
use App\Models\UserAvailability;
use App\Models\User;
use App\Models\Reservation;
use \Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use \Illuminate\Database\Eloquent\Collection;

class BookService extends ModalComponent
{
    public Service $service;
    public array $availability;
    public Carbon $startWeek;
    public array $timeSlots = [];

    public static function modalMaxWidth(): string
    {
        return '7xl';
    }

    public function mount()
    {
        $this->startWeek = Carbon::now();
        $this->availability = $this->getAvailability();
    }

    public function render()
    {
        return view('livewire.pages.front.book-service');
    }

    public function changeAvailabilityWeek(bool $next = true)
    {
        if ($next) {
            $this->startWeek = $this->startWeek->addWeek();
        } else {
            $this->startWeek = $this->startWeek->subWeek();
        }

        $this->availability = $this->getAvailability();
    }

    private function findUsersAvailbaility(Carbon $start)
    {
        $users = User::whereHas('services', function (Builder $query) {
            $query->where('service_id', $this->service->id);
        })->get();

        /** @var \App\Models\User $user */
        foreach ($users as $user) {
            $this->getUserAvailabilityByDate($start, $user->id);
        }
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
            $this->timeSlots[$format]["users"] .= ", " . $userId;
        } else {
            $this->timeSlots[$format]["users"] = $userId;
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

    private function getAvailability()
    {
        $availabilities = [];
        $now = Carbon::now();
        $start = $now > $this->startWeek ? $now : $this->startWeek;
        $end = clone $start;
        $end->addWeek();

        while ($start < $end) {
            $this->findUsersAvailbaility($start);
            if (!empty($this->timeSlots))
                $availabilities[$start->toDateString()] = $this->timeSlots;

            $this->timeSlots = [];

            $start->addDay();
        }

        return $availabilities;
    }
}
