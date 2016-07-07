<script>
	$("#changepassform").submit(function(e){
		e.preventDefault();
		 formdata = $(this).serialize();
		$.ajax({
			url: ajaxUrl,
			method: "POST",
			data: formdata,
			beforeSend: function(){
				start_loader("Loading...");
			},
			success: function(data){
				data = JSON.parse(data);
				if(data.success){
					loader_complete(data.msg);
				}
			}
		});
	});
</script>
<div class="user-dashboard-title">
	<i class="fa fa-lock"></i>&nbsp;Change Password
</div>
<form action="" id="changepassform" method="post">
					<div class="mismatch"></div>
					<input type="hidden" name="action" value="change_password">
					<div class="form-group">
						<label for="inputEmail" class="control-label">Old Password</label>
							<input class="form-control" id="password" name="old_password" placeholder="Password" name="Password" type="password" required>
					</div>
					<div class="form-group">
						<label for="inputEmail" class="control-label">New Password</label>
							<input class="form-control" id="password" name="new_password" placeholder="Password" name="Password" type="password" required>
					</div>
					<div class="form-group">
						<label for="inputEmail" class="control-label">Re-type New Password</label>
							<input class="form-control" id="retype_password" name="retype_password" placeholder="Re-type Password" name="Password" type="password" required>
					</div>
					<div class="form-group text-right">
						<div class="col-lg-10 col-lg-offset-2">
							<button type="submit" id="change_pass" name="action" class="btn btn-success">Change</button>
						</div>
					</div>
				</form>