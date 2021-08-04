<?php session_start();
date_default_timezone_set('UTC');
require_once('../config.php');
require_once('controllers/controllers.php');
if (!isset($_SESSION['AUTH'])) {
    echo Tools::printErrorAlert("Inicia sesión con tu cuenta antes de realizar esta acción.");
} else {
    $user = unserialize($_SESSION['AUTH']);
    $color = trim(strtoupper($_POST['color']));
    if ($color == strtoupper($user->GetColor())) {
        echo Tools::printErrorAlert("LEl nuevo teléfono debe ser distinto.");
    } else {
        $user->SetColor($color);
        if ($userController->updateColor($user)) {
            Tools::updateSessionUser($user);
            echo Tools::printSuccessAlert("Cambios actualizados.");
            echo '<script>updateAdminModal("color", function(){$("#wrapper").load("components/wrapper.php");})</script>';
        } else {
            echo Tools::printErrorAlert("Ha ocurrido un error inesperado. Vuelve a intentarlo más tarde.");
        }
    }
}