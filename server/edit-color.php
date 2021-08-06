<?php session_start();
date_default_timezone_set('UTC');
require_once('../config.php');
require_once('controllers/controllers.php');
if (!isset($_SESSION['AUTH'])) {
    echo Tools::printErrorAlert("Inicia sesión con tu cuenta antes de realizar esta acción.");
} else {
    $userSession = unserialize($_SESSION['AUTH']);
    $user = isset($_POST['userId']) && !empty($_POST['userId']) ? $userController->findByIdFullUser($_POST['userId']) : $userSession;
    $color = trim(strtoupper($_POST['color']));
    $colorPanel = isset($_POST['panelId']) && !empty($_POST['panelId']) ? $_POST['panelId'] : 'color';
    $modalPanel = isset($_POST['modalId']) && !empty($_POST['modalId']) ? $_POST['modalId'] : 'conf';
    if ($color == strtoupper($user->GetColor())) {
        echo Tools::printErrorAlert("El nuevo color debe ser distinto.");
    } else {
        $user->SetColor($color);
        if ($userController->updateColor($user)) {
            if($user->GetId() == $userSession->GetId()) {
                Tools::updateSessionUser($user);
            }
            echo Tools::printSuccessAlert("Cambios actualizados.");
            echo '<script>updateAdminModal("'. $modalPanel .'","'. $colorPanel .'", function(){$("#wrapper").load("components/wrapper.php");})</script>';
        } else {
            echo Tools::printErrorAlert("Ha ocurrido un error inesperado. Vuelve a intentarlo más tarde.");
        }
    }
}