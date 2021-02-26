<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';
include './sql_driver.php';
include './tools.php';
include './global.php';

session_start();

if(isset($_POST['submit'])){
		
		$ime = isset($_POST['name'])?$_POST['name']:false;
		$email = isset($_POST['email'])?$_POST['email']:false;
		$predmet = isset($_POST['subject'])?$_POST['subject']:false;
		$poruka = isset($_POST['comment'])?$_POST['comment']:false;
		
		$mail = new PHPMailer(true);
		
		try {
		//Server settings
		//$mail->SMTPDebug = SMTP::DEBUG_SERVER;                    // Enable verbose debug output
		$mail->isSMTP();                                            // Send using SMTP
		$mail->Host       = $config['email_host'];                  // Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
		$mail->Username   = $config['email_username'];				// SMTP username
		$mail->Password   = $config['email_password'];				// SMTP password
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
		$mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

		$mail->From = $email;
		$mail->FromName =  'Kontakt forma';
		
		$mail->addAddress($config['email_username'],$config['naziv']);

		// Content
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject = $predmet;
		$mail->Body    = "od: $ime<br>email: <a>$email</a><br>proruka:<br>".$poruka;
		//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		$mail->send();
		$_SESSION['msg'] = 'Vasa poruka je uspjesno poslata.';
		header("Location: " . $_SERVER["HTTP_REFERER"]);
	} catch (Exception $e) {
		$_SESSION['msg'] = 'Greska pri slanju, provjerite ispravnost vasih unosa.';
		header("Location: " . $_SERVER["HTTP_REFERER"]);
	}

	}
	
/* 	if(isset($_POST['submit'])){
		
		$ime = isset($_POST['name'])?$_POST['name']:false;
		$email = isset($_POST['email'])?$_POST['email']:false;
		$predmet = isset($_POST['subject'])?$_POST['subject']:false;
		$poruka = isset($_POST['comment'])?$_POST['comment']:false;
		
		$mail = new PHPMailer(true);
		
		try {
		//Server settings
		//$mail->SMTPDebug = SMTP::DEBUG_SERVER;                    // Enable verbose debug output
		$mail->isSMTP();                                            // Send using SMTP
		$mail->Host       = $config['email_host'];                  // Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
		$mail->Username   = $config['email_username'];				// SMTP username
		$mail->Password   = $config['email_password'];				// SMTP password
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
		$mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

		$mail->From = $config['email_username'];
		$mail->FromName = $config['naziv'];

		$mail->addAddress($email, $ime);

		// Content
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject = $predmet;
		$mail->Body    = $poruka;
		//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		$mail->send();
		$_SESSION['msg'] = 'Vasa poruka je uspjesno poslata.';
		header("Location: " . $_SERVER["HTTP_REFERER"]);
	} catch (Exception $e) {
		$_SESSION['msg'] = 'Greska pri slanju, provjerite ispravnost vasih unosa.';
		header("Location: " . $_SERVER["HTTP_REFERER"]);
	}

	} */
?>