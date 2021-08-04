<?php session_start(); 
date_default_timezone_set('UTC');
require_once('../config.php');
require_once('controllers/controllers.php');
if (!isset($_SESSION['AUTH'])) {
    echo '[]';
} else {
    $user = unserialize($_SESSION['AUTH']);
    $users = ($rolController->isGerente($user)) ? $userController->findAllCalendarData() : array($user);

    $calendarData = array();
    foreach($users as $current){
        $array = $calendarController->findByUser($current);
        foreach ($array as $curr){
            $curr->SetColor($current->GetColor());
        }
        $calendarData = array_merge($calendarData, $array);
    }
    $json = '[';
    foreach ($calendarData as $key => $current){
        $json .= ($key == 0) ? '' : ',';
        $unserial = array('auth', 'startTime', 'endTime');
        $current->SetFullDate();
        if (is_null($current->GetUrl())){
            array_push($unserial, 'url');
        }
        if (is_null($current->GetEndDate())){
            array_push($unserial, 'end');
        }
        $json .= $current->serialize($unserial);
    }
    $json .= ']';

    $time_zone = null;
    if (isset($_GET['timeZone'])) {
        $time_zone = new DateTimeZone($_GET['timeZone']);
    }
    $input_arrays = json_decode($json, true);
    // Accumulate an output array of event data arrays.
    $output_arrays = array();
    foreach ($input_arrays as $array) {
    $event = new Event($array, $time_zone);
        $output_arrays[] = $event->toArray();
    }
    // Send JSON to the client.
    echo json_encode($output_arrays);
}