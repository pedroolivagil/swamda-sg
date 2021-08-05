<?php
# Genera un email y lo envía.
// require_once('PHPMailerAutoload.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mail {
	private $email;
	public function __construct($fileconf){
		/* Enviar por email la copia del contrato al usuario y al correo de epic. */
		$data = Tools::readConfig($fileconf);
		$this->email = new PHPMailer();	
		$this->email->IsSMTP(); 							// usamos SMTP
		$this->email->SMTPAuth  = true;                  	// enable SMTP authentication
		$this->email->Host      = $data['host'];			// sets the SMTP server
		$this->email->Username  = $data['username']; 		// SMTP account username
		$this->email->Password  = $data['password'];		// SMTP account password
		$this->email->From		= $data['from']; 			// direccion de salida
		$this->email->FromName 	= $data['fromname'];		// nombre origen
		$this->email->CharSet 	= 'UTF-8';
		$this->email->isHTML(true);							// Set email format to HTML
		$this->email->Port      = 587;						// Set email format to HTML
	}
	public function setTo($arrTo, $boolBCC = false){
		$this->email->addAddress($arrTo[0], $arrTo[1]);		// correo, nombre destino
		if($boolBCC){
			$this->email->addBCC(MAILTECNIC);				// copia oculta		
		}
	}
	public function setBody($subj, $body){
		$this->email->Subject = $subj;
		$this->email->Body = $body;							// cuerpo de mail
	}
	public function addAttachment($url){
		$this->email->addAttachment($url);					// adjuntamos el pdf
	}
	public function send(){
		if(!$this->email->send()){
			echo '<br />'.$this->email->ErrorInfo;
			return false;
		}
		return true;
	}
	public function clear(){
		$this->email->clearAttachments();
	}
}
