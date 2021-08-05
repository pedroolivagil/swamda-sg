<?php
/*******************************/
/*   SWAMDA SG Config    */
/*******************************/

// define('EXPIRE', time() + (2 * 24 * 60 * 60));					// 2 dias; 24 horas; 60 min; 60 s
// define('MAXFILESIZE', ini_get('upload_max_filesize')*1024); 	// En KB -> 3MB
// define('MAXDIRSIZE', 20480);  		// en KB -> 20MB
// define('CONTRATO', 'contrato');
define('MAILTECNIC', 'pedroolivagil@gmail.com');

// DB Constants
define('dbhost', 'localhost');
define('dbname', 'swamda-sg');
define('dbuser', 'swamda-sg');
define('dbpass', 'tY5ia3&0_Ab21swamdasg');

// '/epic-telecom' solo para ámbito local
$root = ($_SERVER['SERVER_NAME']=='localhost')? '/swamda-sg':'';
// define('MAILBODY_NEWUSER',  $_SERVER['DOCUMENT_ROOT'].$root.'/forms/newuser.txt');
// define('MAILBODY_NEWORDER', $_SERVER['DOCUMENT_ROOT'].$root.'/forms/neworder.txt');
define('MAILBODY_CONTACT',  $_SERVER['DOCUMENT_ROOT'] . $root . '/config/contact.txt');
// define('MAILBODY_RECOVERY',  $_SERVER['DOCUMENT_ROOT'].$root.'/forms/recovery.txt');
// define('_LEGAL_FILE_','legal.txt');

define('_CLASS_PATH_', 	$_SERVER['DOCUMENT_ROOT'].$root.'/model/');
define('_PAGES_PATH_',  $_SERVER['DOCUMENT_ROOT'].$root.'/components/');
define('_PHP_PATH_',	$_SERVER['DOCUMENT_ROOT'].$root.'/server/');
// define('_TEMP_PATH_',	$_SERVER['DOCUMENT_ROOT'].$root.'/temp/');
// define('_FORM_PATH_',  	$_SERVER['DOCUMENT_ROOT'].$root.'/forms/');
// define('_USER_PATH_',  	$_SERVER['DOCUMENT_ROOT'].$root.'/users/clientes/');
define('_ROOT_PATH_',	'http://'.$_SERVER['SERVER_NAME'].$root.'/');
define('_IMAGE_PATH_',	'http://'.$_SERVER['SERVER_NAME'].$root.'/img/');
define('_CSS_PATH_',	'http://'.$_SERVER['SERVER_NAME'].$root.'/css/');
define('_JS_PATH_',		'http://'.$_SERVER['SERVER_NAME'].$root.'/js/');
// define('_BSTP_PATH_',	'http://'.$_SERVER['SERVER_NAME'].$root.'/bootstrap/');
// define('_DOCS_PATH_',	'http://'.$_SERVER['SERVER_NAME'].$root.'/docs/');

//session_start(); // no hace falta gracias al .htaccess
//error_reporting(E_ALL ^ E_NOTICE);
//ini_set('display_errors',1);
header('Content-type: text/html; charset=utf-8');
//Load Composer's autoloader
require_once('third.party/vendor/autoload.php');
require_once('server/Tools.php');
require_once('server/Mail.php');
?>