<?php session_start();
date_default_timezone_set('UTC');
require_once('../config.php');
require_once('controllers/controllers.php');
if (!isset($_SESSION['AUTH'])) {
    echo Tools::printErrorAlert("Inicia sesión con tu cuenta antes de realizar esta acción.");
} else {
    $userSession = unserialize($_SESSION['AUTH']);
    if (!$rolController->isAdministrador($userSession)) {
        echo Tools::printErrorAlert("Tu cuenta no dispone de privilegios para esta acción.");
    } else {
        $password = Tools::cryptString($_POST['password']);

        $userBD = $userController->findByIdDelUser($_POST['iduser']);
        if (isset($userBD) && $password == $userSession->GetPassword()) {
            $m = new Mail('../config/conf-swamda.json');
            $m->setTo(array($userBD->GetEmail(), $userBD->GetRealname()), false);
            $m->setBody('Bienvenido a SWAMDA SG', Tools::getMailBodyDelUser($userBD->GetRealname(), $userBD->GetUsername()));
            if ($userController->remove($userBD) && $m->send()) {
                echo Tools::printSuccessAlert("Empleado dado de baja correctamente.");
                echo '<script>updateAdminModal("gestion","deluser", function(){$("#wrapper").load("components/wrapper.php");})</script>';
            } else {
                echo Tools::printErrorAlert("Ha ocurrido un error inesperado. Vuelve a intentarlo más tarde.");
            }
        } else {
            echo Tools::printErrorAlert('La contraseña introducida es incorrecta.');
        }
    }
}
