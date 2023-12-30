<div>
    <button type="button" wire:click="changeAvailabilityWeek(false)">Tył</button>
    <button type="button" wire:click="changeAvailabilityWeek(true)">Przód</button>
    <pre>
        {{ var_dump($availability) }}
    </pre>
    <div id="calendar"></div>
</div>