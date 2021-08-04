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
            <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle white" data-bs-toggle="dropdown" aria-expanded="false">
                <?= $user->GetFullName(); ?>
                &nbsp;&nbsp;<i class="bi bi-gear-fill"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end " aria-labelledby="btnGroupDrop1">
                <?php if ($rolController->isGerente($user)) { ?>
                    <li>
                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#adminModal" data-bs-whatever="add" data-bs-blur-panels="#header,#wrapper" id="add-event">
                            <i class="me-3 bi bi-person-plus-fill"></i>Añadir evento
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#adminModal" data-bs-whatever="delete" data-bs-blur-panels="#header,#wrapper" id="delete-event">
                            <i class="me-3 bi bi-person-x-fill"></i>Eliminar evento
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                <?php } ?>
                <li>
                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#adminModal" data-bs-whatever="gestion" data-bs-blur-panels="#header,#wrapper" id="gestion-event">
                        <i class="me-3 bi bi-people-fill"></i>Gestionar empleados
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#adminModal" data-bs-whatever="conf" data-bs-default-collapse-panel="#collapse-connections" data-bs-blur-panels="#header,#wrapper" id="conf-event">
                        <i class="me-3 bi bi-gear-fill"></i>Configuración
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <a class="dropdown-item" href="#" onClick="logoutNav();">
                        <i class="me-3 bi bi-key-fill"></i>Cerrar sesión
                    </a>
                </li>
            </ul>
        </div>
    </div>
</body>

</html>