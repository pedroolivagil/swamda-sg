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
        $users = explode(',', $_POST['users']);

        // Creamos un registro por cada usuario seleccionado
        if (count($users) > 0 && !empty($_POST['users'])) {
            foreach ($users as $current) {
                $startDate = date_create($_POST['start']);
                $endDate = date_create(!is_null($_POST['end']) ? $_POST['end'] : $_POST['start']);
                $interval = date_diff($startDate, $endDate);

                if ($interval->invert == 0) {
                $currentStartDate = $startDate;
                    for ($x = 0; $x < $interval->days; $x++) {

date_add($currentStartDate, date_interval_create_from_date_string('1 day'));
                    }
                }

                $startDateTime = strtotime($startDate);
                $endDateTime = strtotime($endDate);
                if ($startDateTime < $endDateTime) {
                }

                /// Modelos
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
        if (count($collection) > 0) {
            $inserted = array();
            $errors = array();
            // print_r($collection);
            // foreach ($collection as $key => $calendarData) {
            //     if ($calendarController->addCalendarEvent($calendarData)){
            //         array_push($inserted, $key);
            //     } else {
            //         array_push($errors, $key);
            //     }
            // }
            if (count($errors) == 0 && count($inserted) > 0) {
                echo Tools::printSuccessAlert("Evento registrado correctamente.");
                echo '<script>hideAdminModal();</script>';
            } elseif (count($errors) > 0 && count($inserted) > 0) {
                $affectedUsers = array();
                foreach ($errors as $key) {
                    $user = $userController->findById($key);
                    if (!empty($user)) {
                        array_push($affectedUsers, $user->GetFullName());
                    } else {
                        array_push($affectedUsers, '[Desconocido(' . $key . ')]');
                    }
                }
                echo Tools::printWarnAlert("Algunos elementos no se han podido registrar. Inténtalo de nuevo para los usuarios " . json_encode($affectedUsers, JSON_HEX_AMP | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE) . '.');
            } else {
                echo Tools::printErrorAlert("Ha ocurrido un error inesperado. Vuelve a intentarlo más tarde.");
            }
        } else {
            echo Tools::printErrorAlert("No hay elementos que registrar.");
        }
    }
}
