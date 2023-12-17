import "./bootstrap.js";

import { Calendar } from "fullcalendar";

document.addEventListener("DOMContentLoaded", function () {
    const calendarEl = document.getElementById("calendar");
    const calendar = new Calendar(calendarEl, {
        initialView: "timeGridWeek",
        locale: "pl",
        buttonText: {
            today: "Dzisiaj",
        },
        slotMinTime: "08:00:00", // Set the start hour (e.g., 8:00 AM)
        slotMaxTime: "17:00:00",
        slotEventOverlap: false,
        contentHeight: "auto",
        eventClick: (info) => {
            console.log(info.event.extendedProps.customData);
        },
        slotLabelFormat: {
            hour: "numeric", // Display hours as numbers (e.g., 1, 2, 3)
            minute: "2-digit", // Display minutes as two digits (e.g., 01, 02)
            omitZeroMinute: false, // Include zero minutes (e.g., 01:00)
        },
        firstDay: 1,

        events: [
            {
                interactive: true,
                title: "My event",
                start: "2023-12-18T12:30:00",
                end: "2023-12-18T14:30:00",
                customData: ["abc", "def"],
            },
            {
                title: "event1",
                start: "2010-01-01",
            },
            {
                title: "event2",
                start: "2010-01-05",
                end: "2010-01-07",
            },
            {
                title: "event3",
                start: "2010-01-09T12:30:00",
                allDay: false, // will make the time show
            },
        ],
    });
    calendar.render();
});
