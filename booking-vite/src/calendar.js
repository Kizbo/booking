import { DayPilot } from "@daypilot/daypilot-lite-javascript";

var dp = new DayPilot.Calendar("calendar");

// view
dp.startDate = "2022-06-25";
dp.viewType = "Week";

// event creating
dp.onTimeRangeSelected = function (args) {
    var name = prompt("New event name:", "Event");
    if (!name) return;
    var e = new DayPilot.Event({
        start: args.start,
        end: args.end,
        id: DayPilot.guid(),
        text: name,
    });
    dp.events.add(e);
    dp.clearSelection();
};

dp.onEventClick = function (args) {
    alert("clicked: " + args.e.id());
};

dp.init();

var e = new DayPilot.Event({
    start: new DayPilot.Date("2022-06-21T12:00:00"),
    end: new DayPilot.Date("2022-06-21T12:00:00").addHours(3),
    id: DayPilot.guid(),
    text: "Special event",
});
dp.events.add(e);
