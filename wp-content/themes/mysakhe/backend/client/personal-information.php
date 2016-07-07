<?php global $controller;
$userdata = $controller->get_userdata();
 ?>
<div class="user-dashboard-title">
	<i class="fa fa-user"></i>&nbsp;Personal Information
</div>
<div class="text-right">
	<button class="btn btn-default clearfix edit" type="button"><i class="fa fa-pencil"></i>&nbsp;Edit</button>
</div>
<form class="form-horizontal form validate" method="post" id="personal_info">
	<input type="hidden" value="update_profile" name="action" />
  <fieldset>
  	<div class="form-group row clearfix">
      <label for="inputEmail" class="col-lg-3 control-label">First Name</label>
      <div class="col-lg-9">
        <input class="form-control" id="First_Name" name="First_Name" placeholder="First Name" type="text" value="<?php echo $userdata["First_Name"] ?>" required>
      </div>
    </div>
  	<div class="form-group row clearfix">
      <label for="inputEmail" class="col-lg-3 control-label">Last Name</label>
      <div class="col-lg-9">
        <input class="form-control" id="Last_Name" placeholder="Last Name" name="Last_Name" type="text" value="<?php echo $userdata["Last_Name"] ?>" required> 
      </div>
    </div>
    <div class="form-group row clearfix">
      <label for="inputEmail" class="col-lg-3 control-label">Email</label>
      <div class="col-lg-9">
        <input class="form-control" id="Email" placeholder="Email" name="Email" type="text" value="<?php echo $userdata["Email"] ?>" required>
      </div>
    </div>
    <div class="form-group row clearfix">
      <label for="inputEmail" class="col-lg-3 control-label" >Phone Number</label>
      <div class="col-lg-9">
        <input class="form-control" id="Phone_Number" name="Phone_Number" value="<?php echo $userdata["Phone_Number"] ?>" placeholder="Phone Number" type="text" required>
      </div>
    </div>
<!--     <div class="form-group row clearfix">
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
    </div> -->

    <div class="form-group row clearfix">
      <label for="inputEmail" class="col-lg-3 control-label">Address</label>
      <div class="col-lg-9">
        <input class="form-control" value="<?php echo $userdata["Address"] ?>" id="Address" placeholder="Address" type="text" name="Address" required>
      </div>
    </div>
    <div class="form-group text-right">
      <div class="col-lg-10 col-lg-offset-2">
        
      </div>
    </div>
    <div class="text-right save-update" style="display: none">
    	<button class="btn btn-success" type="submit">Save Changes</button>
    </div>
  </fieldset>
</form>
<script>
	$(document).ready(function(){
			$("#personal_info input").attr("disabled", true);
			$(".edit").click(function(){
				$("#personal_info input").attr("disabled", false);
				$(".save-update").show();
				setTimeout(function(){
					$("#First_Name").focus(); }, 0
				);
				
			});
			$("#personal_info").submit(function(e){
				e.preventDefault();
				var formdata = $(this).serialize();
				$.ajax({
					method: "POST",
					url: ajaxUrl,
					data: formdata,
					beforeSend: function(){
						start_loader("Loading...");
					},
					success: function(data){
						data = JSON.parse(data);
						userdata = data.userdata;
						loader_complete(data.msg);
						$("#personal_info input").attr("disabled", true);
						$(".save-update").hide();
					}
				});
			});
	});
</script>