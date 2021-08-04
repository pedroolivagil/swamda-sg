<?php session_start();
require_once('config.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SWAMDA SG</title>
    <link rel="shortcut icon" type="image/jpg" href="img/favicon.ico" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="third.party/jQueryMask/jquery.mask.min.js"></script>
    <script src="js/dataTables.bootstrap5.min.js"></script>
    <script src="js/script.js"></script>
    <link href='third.party/fullcalendar-5.9.0/lib/main.css' rel='stylesheet' />
    <script src='third.party/fullcalendar-5.9.0/lib/main.js'></script>
    <script src='third.party/fullcalendar-5.9.0/lib/locales/es.js'></script>
    <link href="css/style.css" rel="stylesheet">
    <link href="css/loader.css" rel="stylesheet">
    <script>
        $(document).ready(function() {
            $('#header').load('components/nav.php');
            $('#wrapper').load('components/wrapper.php');
        });
    </script>
</head>

<body class="user-select-none">
    <div class="center-loader text-center">
        <div class="lds-heart">
            <div></div>
        </div>
    </div>
    <div id="header"></div>
    <div id="wrapper"></div>
    <div class="login-error-mesages" id="modal-info-wrapper"></div>
    <!-- Admin Modal -->
    <div class="modal fade" id="adminModal" tabindex="-1" aria-labelledby="adminModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="admin-modal-body">

            </div>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>