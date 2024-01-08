<div>
    <div id="calendar" class="w-full"></div>
</div>

@script
<script>
    const calendarEl = document.getElementById("calendar");
    
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

    const today = new Date();

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            renderCalendar();
        });
    }, {threshold: 1});
    observer.observe(calendarEl);

    window.addEventListener('refreshCalendar', event => {
        observer.unobserve(calendarEl);
        observer.observe(calendarEl);
    });

    function renderCalendar(message) {
        const availability = [];

        for (const [date, dateData] of Object.entries($wire.availability)) {
            for (const [hour, hourData] of Object.entries(dateData)) {
                availability.push({
                    interactive: true,
                    start: date + "T" + hour,
                    end: date + "T" + hourData.endTime,
                    userIds: hourData.users,
                    service:  {{ Illuminate\Support\Js::from($service) }},
                });
            }
        }

        const calendar = new Calendar(calendarEl, {
            initialView: "timeGridWeek",
            locale: "pl",
            buttonText: {
                today: "Dzisiaj",
            },
            slotMinTime: "08:00:00",
            slotMaxTime: "22:00:00",
            contentHeight: "auto",
            eventClick: (info) => {
                $wire.dispatch("openModal", {
                    component: "components.reservation-form",
                    arguments: {
                        userIds: info.event.extendedProps.userIds,
                        service: info.event.extendedProps.service,
                        timestamp: new Date(info.event.start).valueOf(),
                    },
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
            initialDate: $wire.startWeek, //TODO Fix timezones
            firstDay: today.getDay(),
        });
        calendar.render();

        calendarEl.querySelector(".fc-prev-button").setAttribute('wire:click', "changeAvailabilityWeek(false)");
        calendarEl.querySelector(".fc-next-button").setAttribute('wire:click', "changeAvailabilityWeek()");
    }
</script>
@endscript