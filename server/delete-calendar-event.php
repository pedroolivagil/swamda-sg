<?php session_start(); 
date_default_timezone_set('UTC');
require_once('../config.php');
require_once('controllers/controllers.php');
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');
if (!isset($_SESSION['AUTH'])) {
    echo '<div class="alert alert-danger alert-dismissible fade show no-border-radius" role="alert">Inicia sesión con tu cuenta antes de realizar esta acción.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
} else {
    $user = unserialize($_SESSION['AUTH']);
    if (!$rolController->isGerente($user)){
        echo '<div class="alert alert-danger alert-dismissible fade show no-border-radius" role="alert">Tu cuenta no dispone de privilegios para esta acción<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    } else {
        $collection = array();
        $idItem = $_POST['idItem'];

        if (!empty($idItem)) {
            $deleted = array();
            $errors = array();
            $calendarData = new CalendarData();
            $calendarData->SetId($idItem);
            if ($calendarController->removeCalendarEvent($calendarData)){
                array_push($deleted, $idItem);
            } else {
                array_push($errors, $idItem);
            }

            if (count($errors) == 0 && count($deleted) > 0) {
                echo '<div class="alert alert-success alert-dismissible fade show no-border-radius" role="alert">Evento eliminado correctamente.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                // echo '<script>hideAdminModal();</script>';
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show no-border-radius" role="alert">No se podido ha eliminar nada.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';                
            }
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show no-border-radius" role="alert">No hay elementos que eliminar.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        }
    }
}