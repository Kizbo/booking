<div wire:ignore>
    <div id="calendar"></div>
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
                    data: hourData.data,
                    title: hourData.title ?? ""
                });
            }
        }

        return availability;
    };

    const calendarEl = document.getElementById("calendar");
    const today = new Date();
    const calendarObj = new Calendar(calendarEl, {
        initialView: "timeGridWeek",
        locale: "pl",
        buttonText: {
            today: "Dzisiaj",
        },
        slotMinTime: "08:00:00",
        slotMaxTime: "22:00:00",
        selectable: {{var_export($isSelectable, true)}},
        select: (selectionInfo) => {
            $wire.selectCallback(selectionInfo);
        },
        contentHeight: "auto",
        eventClick: (info) => {
            $wire.chooseEvent({
                data: info.event.extendedProps.data,
                timestamp: new Date(info.event.start).valueOf(),
            });
        },
        allDaySlot: false,
        selectConstraint: {
            startTime: "08:00:00",
            endTime: "22:00:00",
            daysOfWeek: [0, 1, 2, 3, 4, 5, 6]
        },
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

    document.addEventListener("changeDates", () => {
        calendarObj.removeAllEvents();
        for (const event of mapAvailability()) {
            calendarObj.addEvent(event);
        }
    });

</script>
@endscript
