<?php session_start();
require_once('../config.php');
require_once('controllers/controllers.php');
$data = $_POST;
$passCrypted = Tools::cryptString($data['pass']);
$userBD = $userController->findByUsernameLogin($data['user']);
if (isset($userBD) && $passCrypted == $userBD->GetPassword()){
    $user = $userController->findByUsername($data['user']);
    $userController->signLogin($user);
    Tools::updateSessionUser($user);
    echo Tools::printSuccessAlert("Iniciando sesión...");
    echo '<script>reloadFrames(1500)</script>';
} else {
    echo Tools::printErrorAlert('Error, el usuario no existe o la contraseña es incorrecta.');
}