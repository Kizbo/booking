<div>
    <style>
        .fc .fc-event-time::after {
            display: none;
        }
        
        .fc .fc-event:hover {
            background-color: #2966a1;
            cursor: pointer;
        }

        .calendar-wrapper {
            min-width: 720px;
        }
    </style>
    <div class="calendar-wrapper">
        <div id="calendar" wire:ignore></div>
    </div>
    <div wire:loading.flex style="{{$displayLoader}}" class="absolute top-0 left-0 z-10 items-center justify-center w-full h-full bg-gray-600/70">
        <svg class="w-5 h-5 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
    </div>
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
                    title: hourData.title ? ('\u00A0\u2014\u00A0' + hourData.title) : ""
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
        slotMaxTime: "21:00:00",
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
        eventDidMount: function(info) {
            if( info.event.title !== undefined && info.event.title !== "" ) {
                tippy(info.el, {
                    content: info.event.title.substring(3),
                });
            }
        },
        selectConstraint: {
            startTime: "08:00:00",
            endTime: "21:00:00",
            daysOfWeek: [0, 1, 2, 3, 4, 5, 6]
        },
        slotLabelFormat: {
            hour: "numeric",
            minute: "2-digit",
            omitZeroMinute: false,
        },
        validRange: {
            start: $wire.startWeek,
        },
        initialDate: $wire.startWeek,
        firstDay: today.getDay(),
        events: mapAvailability(),
    });
    calendarObj.render();
    $wire.hideLoader();

    calendarEl.querySelector(".fc-prev-button").addEventListener("click", ()=>{$wire.changeAvailabilityWeek("prev")});
    calendarEl.querySelector(".fc-next-button").addEventListener("click", ()=>{$wire.changeAvailabilityWeek("next")});
    calendarEl.querySelector(".fc-today-button").addEventListener("click", ()=>{$wire.changeAvailabilityWeek("curr")});

    document.addEventListener("changeDates", () => {
        calendarObj.removeAllEvents();
        for (const event of mapAvailability()) {
            calendarObj.addEvent(event);
        }
    });

</script>
@endscript