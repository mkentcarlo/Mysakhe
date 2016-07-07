<?php
include 'controller/my_controller.php';
$controller = new my_controller();
 ?>
<div class="login-body">
	<article class="container-login center-block">
		<?php 
	if(isset($_SESSION['notify'])){
		echo "<div class='alert alert-success'>$_SESSION[notify]</div>";
		unset($_SESSION['notify']);
	}

	if(isset($_POST['login'])){
		if($controller->login_user($_POST)){
			echo "<script>window.location='non-medical-in-home-care-dashboard';</script>";
		}
		else{
			echo "<div class='alert alert-danger'>Unable to login, invalid password/username.</div>";
		}
	}
?>
		<section>
			<ul id="top-bar" class="nav nav-tabs nav-justified">
				<li class="active"><a href="#login-access" data-toggle="tab">Login</a></li>
				<li><a href="#sign-up" data-toggle="tab">Sign-Up</a></li>
			</ul>
			<div class="tab-content tabs-login col-lg-12 col-md-12 col-sm-12 cols-xs-12">
				<div id="sign-up" class="tab-pane">
					<form class="form-horizontal form">
						<fieldset>
							<div class="form-group">
								<label for="inputEmail" class="col-lg-3 control-label">First Name</label>
								<div class="col-lg-9">
									<input class="form-control" id="inputEmail" placeholder="First Name" type="text">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail" class="col-lg-3 control-label">Last Name</label>
								<div class="col-lg-9">
									<input class="form-control" id="inputEmail" placeholder="Last Name" type="text">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail" class="col-lg-3 control-label">Email</label>
								<div class="col-lg-9">
									<input class="form-control" id="inputEmail" placeholder="Email" type="text">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail" class="col-lg-3 control-label">Phone Number</label>
								<div class="col-lg-9">
									<input class="form-control" id="inputEmail" placeholder="Phone Number" type="text">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail" class="col-lg-3 control-label">Password</label>
								<div class="col-lg-9">
									<input class="form-control" id="inputEmail" placeholder="Password" type="text">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail" class="col-lg-3 control-label">Re-type Password</label>
								<div class="col-lg-9">
									<input class="form-control" id="inputEmail" placeholder="Password" type="text">
								</div>
							</div>
							<div class="form-group">
								<label for="inputPassword" class="col-lg-3 control-label">Self/Others</label>

								<div class="col-lg-9 form-group">
									<div class="checkbox-inline">
										<label>
											<input type="checkbox"> Self
										</label>
									</div>
									<div class="checkbox-inline">
										<label>
											<input type="checkbox"> Loved one
										</label>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label for="inputEmail" class="col-lg-3 control-label">Address</label>
								<div class="col-lg-9">
									<input class="form-control" id="inputEmail" placeholder="Password" type="text">
								</div>
							</div>
							<div class="form-group">
								<label for="inputPassword" class="col-lg-3 control-label">Self/Others</label>

								<div class="col-lg-9 form-group">
									<div class="checkbox-inline">
										<label>
											<input type="checkbox"> I Agree to MySakhe Terms and Policy
										</label>
									</div>
								</div>
							</div>
							<div class="form-group text-right">
								<div class="col-lg-10 col-lg-offset-2">
									<button type="submit" class="btn btn-success">Sign Up</button> or already have an account? <a href="non-medical-in-home-care-log-in">Login</a>
								</div>
							</div>
							<div class="form-group text-right">
								<div class="col-lg-10 col-lg-offset-2">

								</div>
							</div>
						</fieldset>
					</form>
				</div>
				<div id="login-access" class="tab-pane fade active in">					
					<form method="post" accept-charset="utf-8" autocomplete="off" role="form" class="form-horizontal">
						<div class="form-group ">
							<label for="login" class="sr-only">Email</label>
							<input type="email" class="form-control" name="email" id="login_value" placeholder="Email" tabindex="1" value="<?php echo $_POST["email"] ?>" required />
						</div>
						<div class="form-group ">
							<label for="password" class="sr-only">Password</label>
							<input type="password" class="form-control" name="password" id="password"
							placeholder="Password" value="" tabindex="2" />
						</div>
						<div class="checkbox">
							<label class="control-label" for="remember_me">
								<a href="non-medical-in-home-care-reset-password">Forget password?</a>
							</label>
						</div>
						<br/>
						<div class="form-group">				
							<button type="submit" name="login" id="submit" tabindex="5" class="btn btn-block btn-success">Login</button>
						</div>
					</form>			
				</div>
			</div>
		</section>
	</article>
</div>