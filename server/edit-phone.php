<?php session_start();
date_default_timezone_set('UTC');
require_once('../config.php');
require_once('controllers/controllers.php');
if (!isset($_SESSION['AUTH'])) {
    echo Tools::printErrorAlert("Inicia sesión con tu cuenta antes de realizar esta acción.");
} else {
    $user = unserialize($_SESSION['AUTH']);
    $phone = trim(strtolower($_POST['phone']));
    if ($phone == $user->GetPhone()) {
        echo Tools::printErrorAlert("El nuevo teléfono debe ser distinto.");
    } else {
        $user->SetPhone($phone);
        if ($userController->updatePhone($user)) {
            Tools::updateSessionUser($user);
            echo Tools::printSuccessAlert("Cambios actualizados.");
            echo "<script>updateAdminModal('phone')</script>";
        } else {
            echo Tools::printErrorAlert("Ha ocurrido un error inesperado. Vuelve a intentarlo más tarde.");
        }
    }
}
