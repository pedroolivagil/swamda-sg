<?php session_start();
require_once('../config.php');
require_once('controllers/controllers.php');
$data = $_POST;
$passCrypted = Tools::cryptString($data['pass']);
$userBD = $userController->findByUsernameLogin($data['user']);
if (isset($userBD) && $passCrypted == $userBD->GetPassword()){
    $user = $userController->findByUsername($data['user']);
    $_SESSION['AUTH'] = serialize($user);
    $userController->signLogin($user);
} else {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Error, el usuario no existe o la contraseña es incorrecta.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
}