<?php
@session_start();
require_once 'FormsClass.php';
$input = new FormsClass();

include 'form_details.php';
if($smtp)
include 'phpmailer/sendmail.php';

$formname = 'Contact Us Form';
$prompt_message = '<span style="color:#ff0000;">* = Required Information</span>';

if ($_POST){
	if(empty($_POST['Name']) ||
		empty($_POST['Address']) ||
		empty($_POST['Phone']) ||				
		empty($_POST['Email']) ||	
		empty($_POST['secode'])) {
				
	
	$asterisk = '<span style="color:#FF0000; font-weight:bold;">*&nbsp;</span>';	
	$prompt_message = '<div id="error">'.$asterisk . ' Required Fields are empty</div>';
	}
	else if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i",stripslashes(trim($_POST['Email']))))
		{ $prompt_message = '<div id="error">Please enter a valid email address</div>';}
	else if($_SESSION['security_code'] != htmlspecialchars(trim($_POST['secode']), ENT_QUOTES)){
		$prompt_message = '<div id="error">Invalid Security Code</div>';
	}else{
	
		$body = '<div align="left" style="width:700px; height:auto; font-size:12px; color:#333333; letter-spacing:1px; line-height:20px;">
			<div style="border:8px double #c3c3d0; padding:12px;">
			<div align="center" style="font-size:22px; font-family:Times New Roman, Times, serif; color:#051d38;">'.$dcomp.'</div>
			<div align="center" style="color:#990000; font-style:italic; font-size:13px; font-family:Arial;">('.$formname.')</div>
			<p>&nbsp;</p>
			<table width="90%" cellspacing="2" cellpadding="5" align="center" style="font-family:Verdana; font-size:13px">
				';
		
			foreach($_POST as $key => $value){
				if($key == 'secode') continue;
				elseif($key == 'submit') continue;
				
				if(!empty($value)){
					$key2 = str_replace('_', ' ', $key);
					if($value == ':') {
						$body .= '<tr><td colspan="2" style="background:#F0F0F0; line-height:30px"><b>'.$key2.'</b></td></tr>';
					}else {				
						$body .= '<tr><td><b>'.$key2.'</b>:</td> <td>'.htmlspecialchars(trim($value), ENT_QUOTES).'</td></tr>';
					}
				}
			}
			$body .= '
			</table>

			</div>
			</div>';	
	
		$subject = $dcomp . " [" . $formname . "]";		
		
		/************** for smtp ***********/
		if($smtp) { 
			$mail = new SendMail($host, $username, $password);
			$trysend = $mail->sendNow($to_email, $to_name, $cc, $bcc, $from_email, $from_name, $subject, $body);
			if ($trysend == 'ok')
				$sent = true;
			else
				$sent = false;
		}else {
		/************** for mail function ***********/
			$headers= 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= "From: ".$from_name." <".$from_email.">\n";
			$headers .= "Cc: ".$cc."\n";
			$headers .= "Bcc: ".$bcc;
			if(mail($to_email, $subject, $body, $headers)) {
				$sent = true;				
			}else {
				$sent = false;
			}
		}
		
		if($sent) {
				$prompt_message = '<div id="success">Your message has been submitted.  We will get in touch with you as soon as possible.<br/>Thank you for your time.</div>';
				unset($_POST);
		}else {
				$prompt_message = '<div id="error">Failed to send email. Please try again.</div>';				
		}
	}
		
}
/*************declaration starts here************/

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title><?php echo $formname; ?></title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script type="text/javascript" src="js/jquery-1.4.2.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {	
	// validate signup form on keyup and submit
	$("#submitform").validate({
		rules: {
			Name: "required",
			Address: "required",
			Phone: "required",
			Email: {
				required: true,
				email: true
			},
			secode: "required"		
		},
		messages: {
			Name: "Required",
			Address: "Required",
			Phone: "Required",
			Email: "Enter a valid Email",
			secode: ""
		}
	});
	$("#submitform").submit(function(){
		if($(this).valid()){
			self.parent.$('html, body').animate(
				{ scrollTop: self.parent.$('#myframe').offset().top },
				500
			);
		}
	});	
});
</script>
</head>
<body>
	<div id="container" class="rounded-corners">
		<div id="content" class="rounded-corners">
			<form id="submitform" name="contact" method="post" action="">				
				<?php echo $prompt_message; ?>
				<hr />
				<div class="field">
					<div class="input textarea">
						<label for="Name">Name <span>*</span></label>
						<?php 
							// @param field name, class, id and attribute
							$input->fields('Name', 'text','Name','placeholder="Enter name here"'); 
						?>						
					</div>		
				</div>	
				<div class="field">				
					<div class="input textarea">
						<label for="Address">Address <span>*</span></label>
						<?php 
							// @param field name, class, id and attribute
							$input->fields('Address', 'text','Address','placeholder="Enter address here"'); 
						?>	
					</div>	
				</div>
				<div class="field">
					<div class="input textarea">
						<label for="Email">Email <span>*</span></label>
						<?php 
							// @param field name, class, id and attribute
							$input->fields('Email', 'text','Email','placeholder="Enter email here"'); 
						?>	
					</div>
				</div>	
				<div class="field">		
					<div class="input textarea">
						<label for="Phone">Phone <span>*</span></label>
						<?php 
							// @param field name, class, id and attribute
							$input->fields('Phone', 'text','Phone','placeholder="Enter phone here"'); 
						?>
					</div>		
				</div>
				<div class="field">	
					<div class="input textarea">	
						<label for="Comment">Question / Comment</label>	
						<?php 
							// @param field name, class, id and attribute
							$input->textarea('Comment', '','Comments','placeholder="Enter questions or comments here" cols="88"'); 
						?>
					</div>		
				</div>
				<div class="field">	
					<div class="verification">
						<img src="../forms/securitycode/SecurityImages.php?characters=5" border="0" id ="securiryimage" alt="Security code" />
						<?php 
							// @param field name, class, id and attribute
							$input->fields('secode', 'text','secode','placeholder="Enter security code here" title="This confirms you are a human user and not a spam-bot." maxlength="5"'); 
						?>	
						<button type='submit' class="button">Submit</button>						
					</div>	
				</div>
			</form>	
			<div class="clearfix"></div>			
		</div>
	</div>
</body>	
</html>