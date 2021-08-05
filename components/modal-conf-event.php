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
        <h5 class="modal-title" id="adminModalLabel">Configuración de la cuenta</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="form-floating mb-3">
            <input type="text" class="form-control text-muted" id="username" disabled
                value="<?= $user->GetUsername(); ?>">
            <label for="username">Usuario</label>
        </div>
        <div class="container mb-2" style="text-align:center;">
            <div class="btn-group" role="group" aria-label="Basic example">
                <button class="btn btn-sm btn-primary my-1" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapse-password" aria-expanded="false" aria-controls="collapse-password"
                    onclick="collapsePanels('#collapse-phone,#collapse-email,#collapse-color,#collapse-connections')">
                    Contraseña
                </button>
                <button class="btn btn-sm btn-primary my-1" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapse-email" aria-expanded="false" aria-controls="collapse-email"
                    onclick="collapsePanels('#collapse-password,#collapse-phone,#collapse-color,#collapse-connections')">
                    Email
                </button>
                <button class="btn btn-sm btn-primary my-1" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapse-phone" aria-expanded="false" aria-controls="collapse-phone"
                    onclick="collapsePanels('#collapse-password,#collapse-email,#collapse-color,#collapse-connections')">
                    Teléfono
                </button>
                <button class="btn btn-sm btn-primary my-1" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapse-color" aria-expanded="false" aria-controls="collapse-color"
                    onclick="collapsePanels('#collapse-password,#collapse-email,#collapse-phone,#collapse-connections')">
                    Color
                </button>
                <button class="btn btn-sm btn-primary my-1" style="color:#fff;" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapse-connections" aria-expanded="false" aria-controls="collapse-conections"
                    onclick="collapsePanels('#collapse-password,#collapse-email,#collapse-phone,#collapse-color')">
                    Accesos
                </button>
            </div>
        </div>
        <?php include_once('modals-config/modal-password.php'); ?>
        <?php include_once('modals-config/modal-email.php'); ?>
        <?php include_once('modals-config/modal-phone.php'); ?>
        <?php include_once('modals-config/modal-color.php'); ?>
        <?php include_once('modals-config/modal-access.php'); ?>
    </div>
</body>
</html>