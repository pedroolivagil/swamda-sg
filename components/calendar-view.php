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
        initialDate: '2021-07-28',
        navLinks: true, // can click day/week names to navigate views
        dayMaxEvents: true,
        events: {
            url: 'server/get-events.php',
            failure: function() {
                alert("Error al recuperar datos del calendario");
            }
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