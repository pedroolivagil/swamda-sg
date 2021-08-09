<?php session_start();
date_default_timezone_set('UTC');
require_once('../config.php');
require_once('../server/controllers/controllers.php');
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>SWAMDA SG</title>
    <script>
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            timeZone: 'UTC',
            initialView: 'dayGridMonth',
            locale: 'es',
            headerToolbar: {
                right: 'prev,next today,dayGridMonth,dayGridDay',
                left: 'title',
            },
            initialDate: getToday(),
            navLinks: true,
            dayMaxEvents: true,
            events: {
                url: 'server/get-events.php',
                failure: function() {
                    alert("Error al recuperar datos del calendario");
                }
            },
            eventDisplay: 'block', //para ver las fechas con fondo de color
            eventTimeFormat: {
                hour: '2-digit',
                minute: '2-digit',
                meridiem: false
            },
            displayEventTime: true,
            displayEventEnd: true,
            dateClick: function(info) {
                calendar.changeView('dayGridDay', info.dateStr);
            },
            moreLinkClassNames: 'btn btn-sm btn-info text-white p-0 px-1 m-0',
            moreLinkContent: 'más...',
            popupDetailDate: function(isAllDay, start, end) {
                var isSameDate = moment(start).isSame(end);
                var endFormat = (isSameDate ? '' : 'YYYY.MM.DD ') + 'hh:mm a';

                if (isAllDay) {
                    return moment(start).format('YYYY.MM.DD') + (isSameDate ? '' : ' - ' + moment(end).format(
                        'YYYY.MM.DD'));
                }

                return (moment(start).format('YYYY.MM.DD hh:mm a') + ' - ' + moment(end).format(endFormat));
            },
        });
        calendar.render();
    </script>
</head>

<body>
    <div id="calendar-parent">
        <div id="calendar"></div>
    </div>
</body>

</html>