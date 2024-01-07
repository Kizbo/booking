<div>
    <button type="button" wire:click="changeAvailabilityWeek(false)">Tył</button>
    <button type="button" wire:click="changeAvailabilityWeek(true)">Przód</button>
    <div id="calendar" class="w-full"></div>
</div>

@script
<script>
    const calendar = document.getElementById("calendar");
    // TODO: fix intersection observer to fire addional time after availability range change
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            const evt = new CustomEvent('displayCalendar', {
                detail: {
                    wire: $wire,
                    service: "{{$service}}"
                }
            });

            document.dispatchEvent(evt);
        });
    }, {threshold: 1});
    observer.observe(calendar);
</script>
@endscript