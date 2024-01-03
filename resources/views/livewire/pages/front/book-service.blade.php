<div>
    <button type="button" wire:click="changeAvailabilityWeek(false)">Tył</button>
    <button type="button" wire:click="changeAvailabilityWeek(true)">Przód</button>
    <div id="calendar"></div>
</div>

@script
<script>
    const availability = [
        @php
            foreach( $availability as $date => $hours ) {
                foreach( $hours as $hour => $value ) {
                    echo "{";
                    echo "interactive: true,";
                    echo "title: 'Rezerwuj',";
                    echo "start: '{$date}T{$hour}',";
                    echo "end: '{$date}T{$value['endTime']}',";
                    echo "customData: [{$value['users']}],";
                    echo "},";
                }
            }
        @endphp
    ];
    const evt = new CustomEvent("displayCalendar", {detail: availability});

    // Dispatch the event.
    document.dispatchEvent(evt);
</script>
@endscript