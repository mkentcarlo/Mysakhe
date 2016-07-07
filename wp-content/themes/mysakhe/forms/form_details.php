<?php
//-------------------------------------------
// default smtp(phpmailer)
// change to clients smtp settings when launched
//-------------------------------------------
$host 		= 'secure.emailsrvr.com';
$username 	= 'onlineform8@proweaver.net';
$password 	= '0n&in#f0RwOQ16';
// set to false when using mail() function
$smtp = true;
// set true for testing otherwise for live
$testform = true;

if($testform){	
	$to_email 	= 'qa@proweaver.net';
	$cc 		= '';
}else{
	$to_email 	= 'kappu.rama@gmail.com';
	$cc 		= '';
}

$dcomp = 'My Sakhe';
$to_name 	= 'Info';
$bcc 		= '';
$from_email = (!empty($_POST['Email'])) ? $_POST['Email'] : $to_email;
$from_name 	= 'Message From Your Site';
/*
	If not hosted by us and email not send or receive uncomment code below.
	Note: If still does not send or receive $from_email value should the same on domain name.
		e.g. Website Link: www.mydomain.com, $from_email value should be email@mydomain.com
*/
//ini_set('sendmail_from', $from_email);
?>