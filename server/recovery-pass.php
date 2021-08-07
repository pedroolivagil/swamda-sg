<?php session_start();
date_default_timezone_set('UTC');
require_once('../config.php');
require_once('controllers/controllers.php');
if (isset($_SESSION['AUTH'])) {
    echo Tools::printErrorAlert("No puedes realizar esta acción con tu cuenta.");
} else {
    $email = $_POST['email'];
    $password = 'SWAMDA' . (Tools::zerofill(rand(0, 999), 3));
    $passwordCrypt = Tools::cryptString($password);
    $userBD = $userController->findByUsernameOrMail($email);
    if (!is_null($userBD)) {
        // enviamos email de recuperación
        $m = new Mail('../config/conf-swamda.json');
        $m->setTo(array($userBD->GetEmail(), $userBD->GetRealname()), false);
        $m->setBody('Recuperación de cuenta SWAMDA SG', Tools::getMailBodyRecoveryPass($userBD->GetRealname(), $userBD->GetUsername(), $password));
        $userBD->SetPassword($passwordCrypt);
        if ($userController->updatePasword($userBD)) {
            $m->send();
        }
    }
    // Mostramos texto de confirmación
    echo Tools::printSuccessAlert("Se ha enviado un email a la dirección de la cuenta. Si los datos eran correctos, lo recibirás en breve.");
}
