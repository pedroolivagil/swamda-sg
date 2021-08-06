<?php session_start(); 
date_default_timezone_set('UTC');
require_once('../config.php');
require_once('controllers/controllers.php');
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');
if (!isset($_SESSION['AUTH'])) {
    echo Tools::printErrorAlert("Inicia sesión con tu cuenta antes de realizar esta acción.");
} else {
    $user = unserialize($_SESSION['AUTH']);
    if (!$rolController->isGerente($user)) {
        echo Tools::printErrorAlert("Tu cuenta no dispone de privilegios para esta acción.");
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
                echo Tools::printSuccessAlert("Evento eliminado correctamente.");
            } else {
                echo Tools::printErrorAlert("Ha ocurrido un error inesperado. Vuelve a intentarlo más tarde.");
            }
        } else {
            echo Tools::printErrorAlert("No hay elementos que eliminar.");
        }
    }
}