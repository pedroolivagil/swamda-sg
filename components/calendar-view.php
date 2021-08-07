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
                right: 'dayGridMonth,dayGridDay today',
                center: 'title',
                left: 'prev,next'
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
            eventColor: '#378006',
            eventTimeFormat: {
                hour: '2-digit',
                minute: '2-digit',
                meridiem: false
            }
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