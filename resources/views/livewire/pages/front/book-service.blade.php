<style>
    /* .fc-timegrid-slots tr {
        height: 50px;
    } */
    .fc-event-time::after {
        display: none; /* hides event title */
    }
</style>
<div>
    <button type="button" wire:click="changeAvailabilityWeek(false)">Tył</button>
    <button type="button" wire:click="changeAvailabilityWeek(true)">Przód</button>
    <div id="calendar" class="w-full"></div>
</div>

@script
<script>
    const calendarEv = () => {
        // console.log(document.getElementById("calendar").offsetWidth);
        
    }

    const calendar = document.getElementById("calendar");
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            console.log(entry.target.offsetWidth);
            
            const availability = [
                @php
                    foreach( $availability as $date => $hours ) {
                        foreach( $hours as $hour => $value ) {
                            echo "{";
                            echo "interactive: true,";
                            echo "start: '{$date}T{$hour}',";
                            echo "end: '{$date}T{$value['endTime']}',";
                            echo "customData: [{$value['users']}],";
                            echo "},";
                        }
                    }
                @endphp
            ];

            const evt = new CustomEvent('displayCalendar', {detail: availability});
            document.dispatchEvent(evt);

            if( !entry.isIntersecting ) {
                observer.unobserve(entry.target);
            }
        });
    }, {threshold: 1});
    observer.observe(calendar);
</script>
@endscript