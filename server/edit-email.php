<?php session_start();
date_default_timezone_set('UTC');
require_once('../config.php');
require_once('controllers/controllers.php');
if (!isset($_SESSION['AUTH'])) {
    echo '<div class="alert alert-danger alert-dismissible fade show no-border-radius" role="alert">
        Inicia sesión con tu cuenta antes de realizar esta acción.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
} else {
    $user = unserialize($_SESSION['AUTH']);
    // $currentPass = $_POST['oldPass'];
    // $newPass = $_POST['newPass'];

    // if ($newPass != $newPassVerif){
    //     echo '<div class="alert alert-danger alert-dismissible fade show no-border-radius" role="alert">
    //         Error en la verificación de la nueva contraseña.
    //         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    //     </div>';
    // } else if ($user->GetPassword() != Tools::cryptString($currentPass)) {
    //     echo '<div class="alert alert-danger alert-dismissible fade show no-border-radius" role="alert">
    //         Contraseña actual incorrecta.
    //         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    //     </div>';
    // } else if (Tools::validatePassSecurity($newPass)) {
    //     $user->SetPassword(Tools::cryptString($newPass));
    //     if ($userController->updatePassword($user)) {
    //         $_SESSION['AUTH'] = serialize($user);
    //         echo '<div class="alert alert-success alert-dismissible fade show no-border-radius" role="alert">
    //                 Contraseña actualizada.
    //                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    //             </div>';
    //     } else {
    //         echo '<div class="alert alert-danger alert-dismissible fade show no-border-radius" role="alert">
    //                 Ha ocurrido un error inesperado. Vuelve a intentarlo más tarde.
    //                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    //             </div>';
    //     }
    // } else {
    //     echo '<div class="alert alert-danger alert-dismissible fade show no-border-radius" role="alert">
    //             La nueva contraseña debe ajustarse a los parámetros de seguridad: 
    //             <ul>
    //                 <li>Entre 8 y 20 caracteres.</li>
    //                 <li>Almenos 1 letra mayúscula</li>
    //                 <li>Almenos 1 letra minúscula</li>
    //                 <li>Almenos 1 número</li>
    //             </ul>
    //             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    //         </div>';
    // }
}