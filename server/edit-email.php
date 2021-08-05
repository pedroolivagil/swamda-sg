<?php session_start();
date_default_timezone_set('UTC');
require_once('../config.php');
require_once('controllers/controllers.php');
if (!isset($_SESSION['AUTH'])) {
    echo Tools::printErrorAlert("Inicia sesión con tu cuenta antes de realizar esta acción.");
} else {
    $user = unserialize($_SESSION['AUTH']);
    $email = trim(strtolower($_POST['email']));
    $emailVerify = trim(strtolower( $_POST['emailVerify']));
    if ($email != $emailVerify) {
        echo Tools::printErrorAlert("Las direcciones email no coinciden.");
    } else if ($email == $user->GetEmail()) {
        echo Tools::printErrorAlert("La nueva dirección debe ser distinta.");
    } else {
        $user->SetEmail($email);
        if ($userController->updateEmail($user)) {
            Tools::updateSessionUser($user);
            echo Tools::printSuccessAlert("Cambios actualizados.");
            echo "<script>updateAdminModal('conf','email')</script>";
        } else {
            echo Tools::printErrorAlert("Ha ocurrido un error inesperado. Vuelve a intentarlo más tarde.");
        }
    }
}