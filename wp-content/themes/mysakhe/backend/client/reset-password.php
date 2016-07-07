<?php
	include 'controller/my_controller.php';
	$controller = new my_controller();
	if($_POST){
		if(isset($_POST["submit_email"])){
			if($controller->email_exists($_POST["Email"])){
			$encrypt = $controller->email_exists($_POST["Email"]);
			$link = get_site_url()."/non-medical-in-home-care-reset-password?encrypt=".$encrypt."&action=reset";
			$link = "<a href='$link'>$link</a>";
			$message='Hi, <br/> <br/>Click here to reset your password '. $link .' <br/> <br/>--<br>MySakhe.com<br>Solve your problems.';
			$email_content = $message;
    			$email_data = array("title"=>"Reset Password", 
                        "text"=>$email_content.$user_info,
                        "to_email"=>$user_data["Email"],
                        "to_name"=>'',
                        "from_name"=>"My Sakhe",
                        "subject"=>"Reset Password");
    			if($controller->send_email($email_data)){
    				echo "<div class='alert alert-success'>We have already send you a link to change your password, please check it in your email.</div>";
    			}
		}
		else{
			echo "<br><div class='alert alert-danger'>Sorry, your email is not yet registered in this site.</div>";
		}
		}
	}
		if($_GET['action']=='reset'){
			if($controller->get_encrypted_id($_GET['encrypt'])){
				?>
				<script>
					$(document).ready(function(){
						
						$("#change_pass").click(function(e){
							var pass1 = $("#password").val();
							var pass2 = $("#retype_password").val();
							if(pass1!=pass2){
								$(".mismatch").html('<div class="alert alert-danger">Password Mismatch</div>');
							}
							else{
								$(".mismatch").html('');
								$("#resetform").submit();
							}
						});
							
						
					});
				</script>
				<form action="?action=change_pass" id="resetform" method="post">
					<div class="mismatch"></div>
					<input type="hidden" name="encrypt" value="<?php echo $_GET["encrypt"] ?>">
					<div class="form-group">
						<label for="inputEmail" class="col-lg-3 control-label">Password</label>
						<div class="col-lg-9">
							<input class="form-control" id="password" name="password" placeholder="Password" name="Password" type="password" required>
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail" class="col-lg-3 control-label">Re-type Password</label>
						<div class="col-lg-9">
							<input class="form-control" id="retype_password" name="retype_password" placeholder="Re-type Password" name="Password" type="password" required>
						</div>
					</div>
					<div class="form-group text-right">
						<div class="col-lg-10 col-lg-offset-2">
							<button type="button" id="change_pass" name="action" class="btn btn-success">Reset</button>
						</div>
					</div>
				</form>
				
				<?php
			}
			else{
				echo "Invalid key please try again.";
			}	
		}
		elseif($_GET["action"]=="change_pass"){
			$id = $controller->get_encrypted_id($_POST['encrypt']);
			if(isset($id)){
				if($controller->reset_password($id, $_POST["password"])){
					echo "password changed!";
				}
			}
		}
		else
{ ?>
<form action="?a=s" method="post">
	<div class="form-group">
		<label for="inputEmail" class="control-label">Email:</label>
			<input class="form-control" id="password" name="Email" placeholder="Email" name="Password" type="text" required>
	</div>	
<div class="text-right">
	<input type="submit" class="btn btn-success" value="Submit" name="submit_email">
</div>
</form>
<?php } ?>