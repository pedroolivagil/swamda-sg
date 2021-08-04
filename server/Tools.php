<?php
# Almacena todas las herramientas para dar formato a la web, obtener datos, etc.
# cada método tiene su propio comentario sobre su función

abstract class Tools {	
	private static $db;
	public static $lang;
	
	public static function init($lang = 'es', $upkeep = false){
		// inicializa las opciones
		Tools::DB();
		Tools::$lang = $lang;
		Tools::isUpkeep($upkeep);
	}
	public static function getRealIP() {
		if (!empty($_SERVER['HTTP_CLIENT_IP']))
			return $_SERVER['HTTP_CLIENT_IP'];
		   
		if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
			return $_SERVER['HTTP_X_FORWARDED_FOR'];
	   
		return $_SERVER['REMOTE_ADDR'];
	}
	private static function isUpkeep($bool){
		// si bool es True, la pagina se queda en mantenimiento y solo visible para las ip disponibles
		$ips = array('79.156.144.44','146.66.253.232');
		if($bool){
			if(!array_search(Tools::getRealIP(), $ips)){
				header('Location: mantenimiento');
				exit;
			}
		}
	}
	private static function DB(){
		// establece la conexion a la base de datos
		Tools::$db = new mysqli(dbhost, dbuser, dbpass, dbname);
		if (Tools::$db->connect_error) {
			die('Error de Conexión ('.Tools::$db->connect_errno.') '.Tools::$db->connect_error);
		}
		Tools::$db->query("SET NAMES 'utf8'");
		Tools::$db->set_charset("utf8");
	}
	public static function getDB(){
		// devuelve la base de datos
		return Tools::$db;
	}
	public static function closeDB(){
		// cierra la conexion de la base de datos
		Tools::$db->close();
	}
	public static function cryptString($str){
		// encripta un string con codificación blowfish
		if (CRYPT_BLOWFISH == 1) {
			return crypt($str,'$2a$07$SwamDAsG52570b6fcf2eb$');
		}
	}	
	public static function setCookie($id, $value){
		setcookie($id, $value, EXPIRE, '/');
	}	
	public static function getCookie($id){
		return $_COOKIE[$id];
	}
	public static function setNewCart(){
		if(Tools::isEmpty(Tools::getCookie(_CART_)) or Tools::getCookie(_CART_) == NULL ){
			$cesta = new Cart();
			Tools::setCart($cesta);
		}
	}
	public static function setCart($cesta){
		Tools::setCookie(_CART_, base64_encode(serialize($cesta)));
	}	
	public static function getCart(){
		return unserialize(base64_decode($_COOKIE[_CART_]));
	}
	public static function uniqID($leng){
		// genera un ID único basándose en la hora
		return substr(md5(microtime()),0,$leng);
	}
	public static function getMonth($number){
		// retorna un string del mes del año segun el idioma escogido
		$m = Tools::getLocale()->getString('MONTH');
		return $m[$number-1];
	}
	public static function separator(){
		return "\n<div class='line'></div>";
	}
	public static function perms($url){
		return substr(sprintf('%o', fileperms($url)),-4);
	}
	public static function ch_mod777($url){
		chmod($url,0777);
	}
	public static function ch_mod755($url){
		chmod($url,0755);
	}
	public static function newDir($url){
		// crea y/o da permisos 777 al directorio $url
		return (is_dir($url))? Tools::ch_mod777($url) : mkdir($url,0777);
	}	
	public static function rmDots($str){
		// quita los puntos de un string
		$char=array(',','.',';',':','·');
		return trim(str_replace($char,'',$str));
	}	
	public static function rmIlegalChars($str){
		// quita los carácteres especiales de un string
		$char=array('/','<','>','º','ª','\\','&','!','"','·','$','%','(',')','\'','?','¡','¿','|','#','~','€','¬','{','}','[',']','`','´');
		return trim(str_replace($char,'',$str));
	}	
	public static function cleanArrIlegalChars($arr){
		// quita los carácteres especiales de un string
		foreach($arr as $key => $val){
			$arr[$key] = Tools::rmIlegalChars($arr[$key]);
		}
		return $arr;
	}	
	public static function startsWith($haystack, $needle) {
		// search backwards starting from haystack length characters from the end
		return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
	}	
	public static function endsWith($haystack, $needle) {
		// search forward starting from end minus needle length characters
		return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
	}
	public static function cutOutput($str, $limite){
		$longWeight=strlen($str);
		if($longWeight>$limite){
			$frase=substr($str,0,$limite).'...';
		}else{
			$frase=$str;
		}
		return $frase;
	}
	public static function fillArray($sql){
		// rellena un array a partir de una consulta sql de varios resultados
		$array = array();
		if($res = $sql->fetch_array()){
			do{
				array_push($array, $res);
			}while($res = $sql->fetch_array());
		}
		return $array;
	}
	public static function is_number($mixed){
		return is_numeric($mixed);
	}
	public static function zerofill($str, $zero = 11){
		$z = '';
		for($x = 0; strlen($z) < ($zero - strlen($str)); $x++){
			$z.= '0';
		}
		return $z.$str;
	}
	public static function phonef($phone){
		$phone = str_replace(' ', '',trim($phone));
		return substr($phone,0,3).' '.substr($phone,3,2).' '.substr($phone,5,2).' '.substr($phone,7,2);
	}
	public static function isPhone($phone){
		return preg_match('/^[6-9]{1}[0-9]{8}$/',$phone);
	}
	public static function isEmpty($var){
		/* Devuelve TRUE si variable es NULL o esta vacía */
		if($var != '' or $var != NULL){
			return false;
		}
		return true;
	}
	public static function num_format_euro($num, $decimals=0){
		// añade el símbolo euro
		// windows-1252
		// ISO-8859-1//TRANSLIT
		return Tools::num_format($num, $decimals).iconv('UTF-8', 'windows-1252','€');
	}
	public static function num_format($num, $decimals=0){
		// da formato a un número con X decimales
		return number_format($num, $decimals,',','.');
	}
	public static function getExtension($url){
		$info = pathinfo($url);
		return $info['extension'];
	}
	public static function getimagesizefromstring($url){
		if (!function_exists('getimagesizefromstring')) {
			function getimagesizefromstring($url)
			{
				$uri = 'data://application/octet-stream;base64,'.base64_encode($url);
				return getimagesize($uri);
			}
		}else{
			return getimagesizefromstring($url);
		}
	}
    public static function resizeImg($anchoOriginal, $altoOriginal, $anchoDeseado) {
        return ($anchoDeseado * $altoOriginal) / $anchoOriginal;
    }
	public static function redimensionar($img,$ruta,$tipo,$tam){
		// redimensiona una imagen proporcionalmente
		switch($tipo){
			case 'jpg':
				$original=imagecreatefromjpeg($ruta.$img);
			break;
			case 'gif':
				$original=imagecreatefromgif($ruta.$img);
			break;
			case 'png':
				$original=imagecreatefrompng($ruta.$img);
			break;
		}
		if($original){		
			$numero=$tam;
			$ancho = imagesx($original);
			$alto = imagesy($original);
			if($alto>=$ancho){
				$proporcion=$ancho/$alto;
				$thumbalto=$numero;
				$thumbancho=ceil($numero*$proporcion);
			}else{
				//Mas ancho q largo
				$proporcion=$alto/$ancho;
				$thumbancho=$numero;
				$thumbalto=ceil($numero*$proporcion);
			}
			$rutathumb=$ruta.'thumb/';
			$thumb = imagecreatetruecolor($thumbancho,$thumbalto);
							
			imagealphablending($thumb,false);
			$tranparente=imagecolorallocatealpha($thumb,0,0,0,0);
			imagefilledrectangle($thumb,0,0,0,0,$tranparente);
			imagecopyresampled($thumb,$original,0,0,0,0,$thumbancho,$thumbalto,$ancho,$alto);
			imagesavealpha($thumb,true);
					
			switch($tipo){
				case 'jpg':
					return imagejpeg($thumb,$rutathumb.$img,100);
				break;
				case 'png':
					return imagepng($thumb,$rutathumb.$img,9);
				break;
				case 'gif':
					return imagegif($thumb,$rutathumb.$img);
				break;
			}
		}
	}
	public static function cleanToDB($obj, $quotes = false) {
		$obj = self::rmIlegalChars($obj);
		return (self::isEmpty($obj)) ? 'NULL' : (($quotes) ? '"'.$obj.'"' : $obj);
	}
	public static function formatDate($date, $pattern) {
		return date_format(date_create($date), $pattern);
	}
	public static function validatePassSecurity($pass) {
		$nuevaPassOk = preg_match('@[a-a]@', $pass);
		$nuevaPassOk = $nuevaPassOk && preg_match('@[A-Z]@', $pass);
		$nuevaPassOk = $nuevaPassOk && preg_match('@[0-9]@', $pass);
		return $nuevaPassOk;
	}
	public static function printSuccessAlert($text, $dissmisable = true) {
		$msg = '<div class="alert alert-success alert-dismissible fade show" role="alert">';
		$msg .= $text;
		if ($dissmisable) {
			$msg .= '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
		}
		$msg .= '</div>';
		return $msg;
	}
	public static function printErrorAlert($text, $dissmisable = true) {
		$msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
		$msg .= $text;
		if ($dissmisable) {
			$msg .= '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
		}
		$msg .= '</div>';
		return $msg;
	}
	public static function updateSessionUser(User $user) {
    	$_SESSION['AUTH'] = serialize($user);
	}
	public static function getToday(){
		return date('Y-m-d');
	}
}
?>