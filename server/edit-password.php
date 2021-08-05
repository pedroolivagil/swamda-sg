<?php session_start();
date_default_timezone_set('UTC');
require_once('../config.php');
require_once('controllers/controllers.php');
if (!isset($_SESSION['AUTH'])) {
    echo Tools::printErrorAlert("Inicia sesión con tu cuenta antes de realizar esta acción.");
} else {
    $user = unserialize($_SESSION['AUTH']);
    $currentPass = $_POST['oldPass'];
    $newPass = $_POST['newPass'];
    $newPassVerif = $_POST['newPassVerif'];

    if ($newPass != $newPassVerif){
        echo Tools::printErrorAlert("Error en la verificación de la nueva contraseña.");
    } else if ($user->GetPassword() != Tools::cryptString($currentPass)) {
        echo Tools::printErrorAlert("Contraseña actual incorrecta");
    } else if (Tools::validatePassSecurity($newPass)) {
        $user->SetPassword(Tools::cryptString($newPass));
        if ($userController->updatePassword($user)) {
            Tools::updateSessionUser($user);
            echo Tools::printSuccessAlert("Contraseña actualizada.");
            echo "<script>updateAdminModal('conf','pass')</script>";
        } else {
            echo Tools::printErrorAlert("Ha ocurrido un error inesperado. Vuelve a intentarlo más tarde.");
        }
    } else {
        $text = 'La nueva contraseña debe ajustarse a los parámetros de seguridad: 
                <ul>
                    <li>Entre 8 y 20 caracteres.</li>
                    <li>Almenos 1 letra mayúscula</li>
                    <li>Almenos 1 letra minúscula</li>
                    <li>Almenos 1 número</li>
                </ul>';
        echo Tools::printErrorAlert($text);
    }
}