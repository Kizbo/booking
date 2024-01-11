import { DataTable } from "simple-datatables";
import { Calendar } from "fullcalendar";
import moment from "moment";
import "./app.js";
import tippy from "tippy.js";
import "tippy.js/dist/tippy.css";

window.DataTable = DataTable;
window.moment = moment;
window.Calendar = Calendar;
window.tippy = tippy;
