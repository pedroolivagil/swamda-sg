<?php require_once('../config.php');
require_once('../model/tools/_EntitySerialize.php');
require_once('../model/users/User.php');
require_once('../model/users/UserLogin.php');
require_once('../model/users/CalendarData.php');
require_once('../model/tools/Event.php');
require_once('UserController.php');
require_once('CalendarDataController.php');
require_once('RolController.php');
$userController = new UserController();
$calendarController = new CalendarDataController();
$rolController = new RolController();