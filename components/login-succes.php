<?php session_start();
require_once('../config.php');
require_once('../server/controllers/controllers.php');
$user = unserialize($_SESSION['AUTH']);
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>SWAMDA SG</title>
</head>

<body>
    <!-- Botón de usuario -->
    <div id="user-btn-nav" class="btn-group" role="group" aria-label="Button group with nested dropdown">
        <div class="btn-group" role="group">
            <button id="btnGroupDrop1" type="button" class="btn btn-info dropdown-toggle white" data-bs-toggle="dropdown" aria-expanded="false">
                <?=$user->GetFullName();?>
                &nbsp;&nbsp;<i class="bi bi-gear-fill"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="btnGroupDrop1">
                <?php if($rolController->isGerente($user)){?>
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#adminModal" data-bs-whatever="add"><i class="bi bi-person-plus-fill"></i>&nbsp;&nbsp;Añadir evento</a></li>
                    <!-- <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#adminModal" data-bs-whatever="edit"><i class="bi bi-person-check-fill"></i>&nbsp;&nbsp;Modificar evento</a></li> -->
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#adminModal" data-bs-whatever="delete"><i class="bi bi-person-x-fill"></i>&nbsp;&nbsp;Eliminar evento</a></li>
                    <li><hr class="dropdown-divider"></li>
                <?php } ?>
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#adminModal" data-bs-whatever="conf"><i class="bi bi-gear-fill"></i>&nbsp;&nbsp;Configuración</a></li>
                <li><hr class="dropdown-divider"></li>
                <li id="exit"><a class="dropdown-item" href="#" onClick="logoutNav();"><i class="bi bi-key-fill"></i>&nbsp;&nbsp;Cerrar sesión</a></li>
            </ul>
        </div>
    </div>
</body>
</html>