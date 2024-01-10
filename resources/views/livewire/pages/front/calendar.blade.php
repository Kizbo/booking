<div wire:ignore>
    <div id="calendar" class="w-full"></div>
</div>

@script
<script>
    moment.updateLocale("pl", {
        months: [
            "Styczeń",
            "Luty",
            "Marzec",
            "Kwiecień",
            "Maj",
            "Czerwiec",
            "Lipiec",
            "Sierpień",
            "Wrzesień",
            "Październik",
            "Listopad",
            "Grudzień",
        ],
        monthsShort: [
            "Sty",
            "Lut",
            "Mar",
            "Kwi",
            "Maj",
            "Cze",
            "Lip",
            "Sie",
            "Wrz",
            "Paź",
            "Lis",
            "Gru",
        ],
        weekdays: [
            "Poniedziałek",
            "Wtorek",
            "Środa",
            "Czwartek",
            "Piątek",
            "Sobota",
            "Niedziela",
        ],
        weekdaysShort: ["Pon", "Wt", "Śr", "Czw", "Pt", "Sob", "Niedz"],
        weekdaysMin: ["Pn", "Wt", "Śr", "Cz", "Pt", "So", "Nd"],
        buttonText: {
            today: "Dziś",
            month: "Miesiąc",
            week: "Tydzień",
            day: "Dzień",
            list: "Lista",
        },
        allDayText: "Cały dzień",
        eventLimitText: "więcej",
        noEventsMessage: "Brak wydarzeń do wyświetlenia",
    });
    
    const mapAvailability = () => {
        const availability = [];
        for (const [date, dateData] of Object.entries($wire.availability)) {
            for (const [hour, hourData] of Object.entries(dateData)) {
                availability.push({
                    interactive: true,
                    start: date + "T" + hour,
                    end: date + "T" + hourData.endTime,
                    availabilityObj: {{ Illuminate\Support\Js::from($userAvailability) }},
                    userIds: hourData.users !== undefined ? hourData.users : null,
                    service:  {{ Illuminate\Support\Js::from($service) }},
                });
            }
        }

        return availability;
    };
    
    const calendarEl = document.getElementById("calendar");
    const today = new Date();
    let calendarObj;
    
    calendarObj = new Calendar(calendarEl, {
        initialView: "timeGridWeek",
        locale: "pl",
        buttonText: {
            today: "Dzisiaj",
        },
        slotMinTime: "08:00:00",
        slotMaxTime: "22:00:00",
        contentHeight: "auto",
        eventClick: (info) => {
            $wire.chooseEvent({
                userIds: info.event.extendedProps.userIds,
                service: info.event.extendedProps.service,
                availabilityObj: info.event.extendedProps.availabilityObj,
                timestamp: new Date(info.event.start).valueOf(),
            });
        },
        allDaySlot: false,
        slotLabelFormat: {
            hour: "numeric",
            minute: "2-digit",
            omitZeroMinute: false,
        },
        validRange: {
            start: today.toISOString().substring(0, 10), 
        },
        initialDate: $wire.getJsStartWeek(),
        firstDay: today.getDay(),
        events: mapAvailability(),
    });
    calendarObj.render();

    calendarEl.querySelector(".fc-prev-button").addEventListener("click", ()=>{$wire.changeAvailabilityWeek(false)});
    calendarEl.querySelector(".fc-next-button").addEventListener("click", ()=>{$wire.changeAvailabilityWeek(true)});

    document.addEventListener("refreshCalendar", ()=>{
        // Reset events
        console.log($wire.availability);
        calendarObj.removeAllEvents();
        for (const event of mapAvailability()) {
            calendarObj.addEvent(event);
        }
    });

</script>
@endscript