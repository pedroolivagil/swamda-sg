<?php session_start(); 
require_once('../config.php');
$component = isset($_SESSION['AUTH']) ? 'calendar-view' : 'login-card';
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>SWAMDA SG</title>
    <script>
    $('#calendar-wrapper').load('components/<?=$component;?>.php')
    </script>
</head>

<body>
    <div id="calendar-wrapper"></div>
</body>

</html>