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
    $phone = $_POST['phone'];
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

    // var_dump($newuser);

    $m = new Mail('../config/conf-swamda.json');
    $m->setTo(array($email, $realname), false);
    $m->setBody('Bienvenido a SWAMDA SG', Tools::getMailBodyContact($realname, $username, $password));
    if ($m->send()) {
        echo Tools::printSuccessAlert("Empleado dado de alta correctamente");
    } else {
        echo Tools::printErrorAlert("Ha ocurrido un error inesperado. Vuelve a intentarlo más tarde.");
    }
    // if () {
    //     Tools::getDB()->query('INSERT INTO contact_form(fullname,email,phone,address,service,coments) VALUES("' . $name . '","' . $email . '","' . $phone . '","' . $address . '","' . $service . '","' . $coment . '")');
    //     header('Location: ' . _ROOT_PATH_ . 'contacto?type=success&s=' . urlencode(Tools::getLocale()->getString('SENDMAIL_SUCCESS')));
    // } else {
    //     header('Location: ' . _ROOT_PATH_ . 'contacto?type=danger&s=' . urlencode(Tools::getLocale()->getString('SENDMAIL_FAIL')));
    // }

    // $user = isset($_POST['userId']) && !empty($_POST['userId']) ? $userController->findByIdFullUser($_POST['userId']) : $userSession;
    // $color = trim(strtoupper($_POST['color']));
    // $colorPanel = isset($_POST['panelId']) && !empty($_POST['panelId']) ? $_POST['panelId'] : 'color';
    // $modalPanel = isset($_POST['modalId']) && !empty($_POST['modalId']) ? $_POST['modalId'] : 'conf';
    // if ($color == strtoupper($user->GetColor())) {
    //     echo Tools::printErrorAlert("LEl nuevo teléfono debe ser distinto.");
    // } else {
    //     $user->SetColor($color);
    //     if ($userController->updateColor($user)) {
    //         if ($user->GetId() == $userSession->GetId()) {
    //             Tools::updateSessionUser($user);
    //         }
    //         echo Tools::printSuccessAlert("Cambios actualizados.");
    //         echo '<script>updateAdminModal("' . $modalPanel . '","' . $colorPanel . '", function(){$("#wrapper").load("components/wrapper.php");})</script>';
    //     } else {
    //         echo Tools::printErrorAlert("Ha ocurrido un error inesperado. Vuelve a intentarlo más tarde.");
    //     }
    // }
}
