<?php session_start();
date_default_timezone_set('UTC');
require_once('../config.php');
require_once('controllers/controllers.php');
if (!isset($_SESSION['AUTH'])) {
    echo Tools::printErrorAlert("Inicia sesión con tu cuenta antes de realizar esta acción.");
} else {
    $userSession = unserialize($_SESSION['AUTH']);
    $realname = $_POST['realname'];
    $realsurname = $_POST['realsurname'];
    $phone = str_replace(' ','',$_POST['phone']);
    $email = $_POST['email'];
    $usernamePart2 = explode(' ', $realsurname);
    $username = strtoupper(substr($realname, 0, 1) . $usernamePart2[0]) . (Tools::zerofill(rand(0, 999), 3));
    $password = 'SWAMDA' . (Tools::zerofill(rand(0, 999), 3));
    $passwordCrypt = Tools::cryptString($password);
    $color = Tools::randomColor();

    $newuser = new User();
    $newuser->SetId(NULL);
    $newuser->SetUsername($username);
    $newuser->SetPassword($passwordCrypt);
    $newuser->SetPhone($phone);
    $newuser->SetRealname($realname);
    $newuser->SetRealsurname($realsurname);
    $newuser->SetRol(1);
    $newuser->SetColor($color);
    $newuser->SetEmail($email);
    $newuser->SetAuthdate(NULL);

    $m = new Mail('../config/conf-swamda.json');
    $m->setTo(array($email, $realname), false);
    $m->setBody('Bienvenido a SWAMDA SG', Tools::getMailBodyContact($realname, $username, $password));
    if ($userController->persist($newuser) && $m->send()) {
        echo Tools::printSuccessAlert("Empleado dado de alta correctamente");
    } else {
        echo Tools::printErrorAlert("Ha ocurrido un error inesperado. Vuelve a intentarlo más tarde.");
    }
}
