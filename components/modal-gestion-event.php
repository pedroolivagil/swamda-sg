<?php session_start();
date_default_timezone_set('UTC');
require_once('../config.php');
require_once('../server/controllers/controllers.php');
$user = unserialize($_SESSION['AUTH']);
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>SWAMDA SG</title>
    <script>
        $(document).ready(function() {
            $('.telephone').mask("999 999 999");
        });
    </script>
</head>

<body>
    <div class="modal-header">
        <h5 class="modal-title" id="adminModalLabel">Gestion de empleados</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="container mb-2" style="text-align:center;">
            <div class="btn-group" role="group" aria-label="Basic example">
                <button class="btn btn-sm btn-primary my-1" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-colors" aria-expanded="false" aria-controls="collapse-colors" onclick="collapsePanels('#collapse-newuser,#collapse-deluser')">
                    Colores
                </button>
                <button class="btn btn-sm btn-primary my-1" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-newuser" aria-expanded="false" aria-controls="collapse-newuser" onclick="collapsePanels('#collapse-deluser,#collapse-colors')">
                    Alta nueva
                </button>
                <button class="btn btn-sm btn-primary my-1" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-deluser" aria-expanded="false" aria-controls="collapse-deluser" onclick="collapsePanels('#collapse-colors,#collapse-newuser')">
                    Ejecutar baja
                </button>
            </div>
        </div>
        <?php include_once('modals-management/modal-colors.php'); ?>
        <?php include_once('modals-management/modal-newuser.php'); ?>
        <?php include_once('modals-management/modal-deluser.php'); ?>
    </div>
</body>

</html>