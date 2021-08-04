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
        $users = explode(',', $_POST['users']);

        // Creamos un registro por cada usuario seleccionado
        if (count($users) > 0 && !empty($_POST['users'])) {
            foreach ($users as $current){
                $calendarData = new CalendarData();
                $calendarData->SetTitle($_POST['title']);
                $calendarData->SetAuth($current);
                $calendarData->SetStartDate($_POST['start']);
                $calendarData->SetEndDate((isset($_POST['end']) && !empty($_POST['end'])) ? $_POST['end'] : null);
                $calendarData->SetStartTime((isset($_POST['startTime']) && !empty($_POST['startTime'])) ? $_POST['startTime'] : null);
                $calendarData->SetEndTime((isset($_POST['endTime']) && !empty($_POST['endTime'])) ? $_POST['endTime'] : null);
                $calendarData->SetUrl((isset($_POST['url']) && !empty($_POST['url'])) ? $_POST['url'] : null);
                if (!empty($calendarData->GetTitle()) && !empty($calendarData->GetStartDate()) && !empty($calendarData->GetAuth())) {
                    array_push($collection, $calendarData);
                }
            }
        }
        // var_dump($collection);
        // persistimos los registros
        if (count($collection) > 0) {
            $inserted = array();
            $errors = array();
            foreach ($collection as $key => $calendarData) {
                if ($calendarController->addCalendarEvent($calendarData)){
                    array_push($inserted, $key);
                } else {
                    array_push($errors, $key);
                }
            }
            if (count($errors) == 0 && count($inserted) > 0) {
                echo '<div class="alert alert-success alert-dismissible fade show no-border-radius" role="alert">Evento registrado correctamente.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                echo '<script>hideAdminModal();</script>';
            } elseif (count($errors) > 0 && count($inserted) > 0) {
                $affectedUsers = array();
                foreach($errors as $key){
                    $user = $userController->findById($key);
                    if (!empty($user)) {
                        array_push($affectedUsers, $user->GetFullName());
                    } else {
                        array_push($affectedUsers, '[Desconocido('.$key.')]');                 
                    }
                }
                echo '<div class="alert alert-warning alert-dismissible fade show no-border-radius" role="alert">Algunos elementos no se han podido registrar. Inténtalo de nuevo para los usuarios '.json_encode($affectedUsers, JSON_HEX_AMP | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE).'.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show no-border-radius" role="alert">No se podido ha registrar nada.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';                
            }
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show no-border-radius" role="alert">No hay elementos que registrar.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        }
    }
}