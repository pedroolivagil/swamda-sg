<?php session_start();
require_once('config.php');
$component = isset($_SESSION['AUTH']) ? 'calendar-view' : 'login-card';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SWAMDA SG</title>
    <link rel="shortcut icon" type="image/jpg" href="img/favicon.ico" />
    <link href="css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap/jquery.dataTables.min.js"></script>
    <script src="third.party/jQueryMask/jquery.mask.min.js"></script>
    <script src="js/bootstrap/dataTables.bootstrap5.min.js"></script>
    <script src="js/script.js"></script>
    <link href='third.party/fullcalendar-5.9.0/lib/main.css' rel='stylesheet' />
    <script src='third.party/fullcalendar-5.9.0/lib/main.js'></script>
    <script src='third.party/fullcalendar-5.9.0/lib/locales/es.js'></script>
    <link href="css/style.css" rel="stylesheet">
    <link href="css/loader.css" rel="stylesheet">
    <script>
        $(document).ready(function() {
            reloadFrontal(<?= $component == 'calendar-view' ? "true" : "false"; ?>);
        });
    </script>
</head>

<body class="user-select-none">
    <div class="blur-bg"></div>
    <div class="center-loader text-center">
        <div class="lds-heart">
            <div></div>
        </div>
    </div>
    <div id="header"></div>
    <div id="wrapper"></div>
    <!-- Admin Modal -->
    <div class="modal fade" id="adminModal" tabindex="-1" aria-labelledby="adminModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="admin-modal-body">

            </div>
        </div>
    </div>
    <?php include_once('components/modal-recovery-pass.php'); ?>
    <div style="display: none;" data-bs-restore-blur="" id="recovery"></div>
    <script src="js/bootstrap/bootstrap.bundle.min.js"></script>
    <div class="version-app">1.0.0</div>
</body>

</html>