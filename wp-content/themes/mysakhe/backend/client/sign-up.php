<?php include 'controller/my_controller.php';
$controller = new my_controller();
$excludes = array('retype_password', 'terms_and_policy');
if($_POST){
  if($_POST["Self_Others"]){
    $_POST["Self_Others"] = $_POST["Self_Others"][0];
  }
  $user_data = $controller->exclude_unnecessary($_POST,$excludes);
  $user_data["Password"] = md5($user_data["Password"]);
  $email_exists = $controller->email_exists($_POST["Email"]);
  if(!$email_exists){
  if($controller->register_user($user_data)){
    $fullname = $user_data["First_Name"].$user_data["Last_Name"];
    $user_info = "";

    foreach($user_data as $key => $value){
        if(!empty($value)){
          $key2 = str_replace('_', ' ', $key);
          if($value == ':') {
            $user_info .= '<tr><td colspan="2" style="background:#F0F0F0; line-height:30px"><b>'.$key2.'</b></td></tr>';
          }else {       
            $user_info .= '<tr><td><b>'.$key2.'</b>:</td> <td>'.htmlspecialchars(trim($value), ENT_QUOTES).'</td></tr>';
          }
        }
      }
    $email_content = "<p>Hi ".$user_data["First_Name"].", You have successfully registered in our site with this information below:</p>";
    $email_data = array("title"=>"Registration Form", 
                        "text"=>$email_content.$user_info,
                        "to_email"=>$user_data["Email"],
                        "to_name"=>$fullname,
                        "from_name"=>"My Sakhe",
                        "subject"=>"Registration Form");

    // Send mail to client
    $controller->send_email($email_data);

    $email_data["text"] = $user_info;
    unset($email_data["to_email"]);
    unset($email_data["to_name"]);
    unset($email_data["from_name"]);


    // Send mail to admin
    $controller->send_email($email_data);

    $_SESSION["notify"] = "You successfully registered, please login to your new account.";
    echo "<script>window.location='non-medical-in-home-care-log-in';</script>";

  }
}
else{
   echo "<div class='alert alert-danger'>Sorry,  your email was already taken!</div>";
}
}

 ?>
<form class="form-horizontal form validate" method="post" id="sign-up">
  <fieldset>
  	<div class="form-group">
      <label for="inputEmail" class="col-lg-3 control-label">First Name</label>
      <div class="col-lg-9">
        <input class="form-control" id="First_Name" name="First_Name" placeholder="First Name" type="text" value="<?php echo $_POST["First_Name"] ?>" required>
      </div>
    </div>
  	<div class="form-group">
      <label for="inputEmail" class="col-lg-3 control-label">Last Name</label>
      <div class="col-lg-9">
        <input class="form-control" id="Last_Name" placeholder="Last Name" name="Last_Name" type="text" value="<?php echo $_POST["Last_Name"] ?>" required> 
      </div>
    </div>
    <div class="form-group">
      <label for="inputEmail" class="col-lg-3 control-label">Email</label>
      <div class="col-lg-9">
        <input class="form-control" id="Email" placeholder="Email" name="Email" type="text" value="<?php echo $_POST["Email"] ?>" required>
      </div>
    </div>
    <div class="form-group">
      <label for="inputEmail" class="col-lg-3 control-label" >Phone Number</label>
      <div class="col-lg-9">
        <input class="form-control" id="Phone_Number" name="Phone_Number" value="<?php echo $_POST["Phone_Number"] ?>" placeholder="Phone Number" type="text" required>
      </div>
    </div>
     <div class="form-group">
      <label for="inputEmail" class="col-lg-3 control-label">Password</label>
      <div class="col-lg-9">
        <input class="form-control" id="Password" placeholder="Password" name="Password" type="password" required>
      </div>
    </div>
     <div class="form-group">
      <label for="inputEmail" class="col-lg-3 control-label">Re-type Password</label>
      <div class="col-lg-9">
        <input class="form-control" id="inputEmail" placeholder="Password" type="password" name="retype_password" required>
      </div>
    </div>
    <div class="form-group">
      <label for="inputPassword" class="col-lg-3 control-label">Self/Others</label>
        
        <div class="col-lg-9 form-group">
        	<div class="checkbox-inline">
        	  <label>
        	    <input type="checkbox" name="Self_Others[]" value="Self"> Self
        	  </label>
        	</div>
        	<div class="checkbox-inline">
        	  <label>
        	    <input type="checkbox" name="Self_Others[]" value="Loved one"> Loved one
        	  </label>
        	      </div>
        </div>
    </div>

    <div class="form-group">
      <label for="inputEmail" class="col-lg-3 control-label">Address</label>
      <div class="col-lg-9">
        <input class="form-control" value="<?php echo $_POST["Address"] ?>" id="Address" placeholder="Address" type="text" name="Address" required>
      </div>
    </div>
    <div class="form-group">
      <label for="inputPassword" class="col-lg-3 control-label"></label>
        
        <div class="col-lg-9 form-group">
        	<div class="checkbox-inline">
        	  <label>
        	    <input type="checkbox" name="terms_and_policy"> I Agree to MySakhe Terms and Policy
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