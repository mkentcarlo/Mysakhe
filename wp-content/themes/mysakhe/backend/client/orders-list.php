<?php 
global $controller;
$service_types = $controller->get_service_types();
$userdata = json_encode($controller->get_userdata());
?>
<script>
	$("div#status-bar").on('click', 'a', function(e){
		$("div#status-bar a").removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
		var query = "action=load_orders&" + $(this).attr('href');
		var table = "#table_orders";
		load_table_data(table, query);
	});
		$("input[name=For_Whom]").change(function(){
			if($(this).val()=="Myself"){
				$("#First_Name").val(userdata.First_Name);
				$("#Last_Name").val(userdata.Last_Name);
				$("#Address").val(userdata.Address);
				$("#Phone_Number").val(userdata.Phone_Number);
				$("#Email").val(userdata.Email);
			}
			else{
				$("#First_Name").val("");
				$("#Last_Name").val("");
				$("#Address").val("");
				$("#Phone_Number").val("");
				$("#Email").val("");
			}
		});
		$("#service_type").change(function(e){
			jQuery.ajax({
			type:"POST",
			url: ajaxUrl,
			data: { action: "load_services", 
			service_type_id: $(this).val() },
			success: function(data){
				parsed_data = JSON.parse(data);
                load_services = "";
				for (var i = 0; i < parsed_data.length; i++) {
					load_services = load_services + "<option data-price='" + parsed_data[i].Price + "' value='" + parsed_data[i].Service_type_id + "'>" + parsed_data[i].Service_Name + "</option>";
				};
				$("#Service").html(load_services);
                var price = parseInt($("#Service option:selected").attr('data-price'));
                var service = $("#Service option:selected").text();
                var service_type = $("#service_type option:selected").text();
                $("td.amount").html("$" + price.toFixed(2));
                $("td.selected_service").html(service);
                $("td.selected_type").html(service_type);
			},
			error: function(errorThrown){
    			  error = JSON.stringify(errorThrown);
    			  alert(error);
  			} 
		});
		});
	$(".enable_edit").on('click', function(){
		$("#new_order_form input, #new_order_form select").attr("disabled", false);
   		$("#new_order_form button[type=submit]").show();
	});
   $("#new_order_form").submit(function(e){
            e.preventDefault();
            formdata = $(this).serialize();
            jQuery.ajax({
            type:"POST",
            url: ajaxUrl,
            data: formdata,
		  beforeSend: function(){
			  start_loader("Loading...");
		  },
            success: function(data){
                parsed_data = JSON.parse(data);
                if(parsed_data.success){
                	loader_complete(parsed_data.msg);
                    $('#payment').modal('toggle');
                    if($("input[name=action]").val() == "new_order"){
                    	$("#new_order_form")[0].reset();
                    }
                    else{
                    	$("#new_order_form input, #new_order_form select").attr("disabled", true);
					$("#new_order_form button[type=submit]").hide();
                    }
                   
                    $("#new_order_form input[name=action]").val("new_order");
                    var table = "#table_orders";
                        var query = "action=load_orders";
                        load_table_data(table, query);
                }
            },
            error: function(errorThrown){
                  error = JSON.stringify(errorThrown);
            } 
        });
        });
   	$(".new_order").on('click', function(){
   		$("#new_order_form input[name=action]").val("new_order");
   		$("input[name=service_order_id]").val("");
   		$("input[name=recipient_id]").val("");
   		$("#new_order_form")[0].reset();
   		$("#new_order_form input, #new_order_form select").attr("disabled", false);
   		$("#new_order_form button[type=submit]").show();
   		$(".enable_edit").hide();
   	});
	$("#table_orders").on('click',".update_order", function(){
		var id = $(this).attr('data-id');
		jQuery.ajax({
				type:"POST",
				url: ajaxUrl,
				data: {action: "get_order", id: id},
				success: function(data){
					var data = JSON.parse(data);
					var services = JSON.parse(data.services);
					var services_append = "";
					$.each(services, function(i, value){
						if(value.Service_type_id==data.service_id){
							services_append = services_append + "<option selected value='" + value.Service_id + "'>"+ value.Service_Name+"</option>";
						}
						else{
							services_append = services_append + "<option value='" +  + "'>"+ value.Service_Name+"</option>";
						}
					});
					$("#Service").html(services_append);
					data = data.order_details;
					$("#service_start").val(data.service_start);
					$("#service_end").val(data.service_end);
					$("#service_type").val(data.Service_type_id);
					$("#First_Name").val(data.First_Name);
					$("#Last_Name").val(data.Last_Name);
					$("#Email").val(data.Email);
					$("#Phone_Number").val(data.Phone_Number);
					$("#Address").val(data.Address);
					$("#payment_method").val(data.payment_method);
					$("input[name=action]").val("update_order");
					$("input[name=service_order_id]").val(id);
					$("input[name=recipient_id]").val(data.Service_recipient_id);
					$("#for_whom[value=" + data.For_Whom + "]").prop('checked', true);
					$("#new_order_form input, #new_order_form select").attr("disabled", true);
					$("#new_order_form button[type=submit]").hide();
					$(".enable_edit").show();

			},
			error: function(errorThrown){
				error = JSON.stringify(errorThrown);
			} 
		});
	});
	$("#table_orders").on('click',".re-order", function(){
		var id = $(this).attr('data-id');
		jQuery.ajax({
				type:"POST",
				url: ajaxUrl,
				data: {action: "get_order", id: id},
				success: function(data){
					var data = JSON.parse(data);
					var services = JSON.parse(data.services);
					var services_append = "";
					$.each(services, function(i, value){
						if(value.Service_type_id==data.service_id){
							services_append = services_append + "<option selected value='" + value.Service_id + "'>"+ value.Service_Name+"</option>";
						}
						else{
							services_append = services_append + "<option value='" +  + "'>"+ value.Service_Name+"</option>";
						}
					});
					$("#Service").html(services_append);
					data = data.order_details;
					$("#service_start").val("");
					$("#service_end").val("");
					$("#service_type").val(data.Service_type_id);
					$("#First_Name").val(data.First_Name);
					$("#Last_Name").val(data.Last_Name);
					$("#Email").val(data.Email);
					$("#Phone_Number").val(data.Phone_Number);
					$("#Address").val(data.Address);
					$("#payment_method").val(data.payment_method);
					$("input[name=action]").val("new_order");
					$("input[name=service_order_id]").val(id);
					$("input[name=recipient_id]").val(data.Service_recipient_id);
					$("#for_whom[value=" + data.For_Whom + "]").prop('checked', true);
					$(".enable_edit").hide();
					$("#new_order_form input, #new_order_form select").attr("disabled", false);
					$("#new_order_form button[type=submit]").show();

			},
			error: function(errorThrown){
				error = JSON.stringify(errorThrown);
			} 
		});
	});
	$("#table_orders").on('click',".cancel_order", function(){
			var this_btn = $(this);
			if(confirm("You are about to cancel this service order, click OK to proceed.")){
			jQuery.ajax({
				type:"POST",
				url: ajaxUrl,
				data: {action: "cancel_order", id: $(this).attr('data-id')},
				beforeSend: function(){
					start_loader("Loading...");
				},
				success: function(data){
					parsed_data = JSON.parse(data);
					if(parsed_data.success){
						loader_complete(parsed_data.msg);
						var table = "#table_orders";
						var query = "action=load_orders";
						load_table_data(table, query);
					}
			},
			error: function(errorThrown){
				error = JSON.stringify(errorThrown);
			} 
		});
		}
		});
</script>
<div class="user-dashboard-title">
	<i class="fa fa-home"></i>&nbsp;Orders List
</div>
<div class="sub-nav">
	<div id="status-bar"><a href="status=pending" class="active">Pending</a> | <a href="status=on going">On going</a> | <a href="status=completed">Completed</a> | <a href="status=cancelled">Cancelled</a></div>
</div>
<div class="text-right"><button class="btn btn-default btn-sm new_order" style="margin-bottom: 15px" data-toggle="modal" data-target="#modal_order"><i class="fa fa-plus"></i>&nbsp;New Order</button></div>
<table class="table" style="font-size: 13px;" id="table_orders">
	<thead>
		<tr>
			<th>Service</th>
			<th>Start</th>
			<th>End</th>
			<th>Recipient</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php $controller->generate_orders_list(); ?>
	</tbody>
	
</table>
<div class="modal" id="modal_order">
	<form class="form-horizontal" action="" method="post" id="new_order_form">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				Order Details
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body" style="max-height: 600px; overflow-x: scroll">

    <input type="hidden" name="action" value="new_order">
    <input type="hidden" name="service_order_id">
    <input type="hidden" name="recipient_id">
    <button class="btn btn-default enable_edit" type="button"><i class="fa fa-pencil"></i>&nbsp;Enable Editing</button>
 	<!-- <button type="button" class="btn btn-default f-right" data-toggle="modal" data-target="#browse_old_orders"><i class="fa fa-plus"></i>&nbsp;Browse from previous orders..</button> -->
            <div class="form-group row clearfix">
                <div class="col-sm-6">
                	<label class="control-label" for="registration-date">Service Start:</label>
                	            <!-- 	<div class="input-group registration-date-time">
                	            		<span class="input-group-addon" id="basic-addon1"><span class="fa fa-calendar" aria-hidden="true"></span></span> -->
                	            		<input class="form-control datetime" name="service_start" id="service_start" type="text">
                	            <!-- 	</div> -->
                </div>
                <div class="col-sm-6">
                	<label class="control-label" for="registration-date">Service End:</label>
                	        <!--     	<div class="input-group registration-date-time">
                	            		<span class="input-group-addon" id="basic-addon1"><span class="fa fa-calendar" aria-hidden="true"></span></span> -->
                	            		<input class="form-control datetime" name="service_end" id="service_end" type="text">
                	            <!-- 	</div> -->
                </div>
            </div>
            <div class="form-group row clearfix">
            	<div class="col-sm-6">
            		<label class="control-label" for="registration-date">Service Type</label>
                	<select class="form-control" name="service_type" id="service_type">
                		<option value="">Select Service Type</option>
                		<?php $controller->load_select(json_decode($service_types)); ?>
                	</select>
               </div>
            	<div class="col-sm-6">
            		<label class="control-label" for="registration-date">Service</label>
                	<select class="form-control" name="Service" id="Service">
                		<option value="">Select Service</option>
                	</select>
               </div>
            </div>
            <div class="form-group row clearfix">
            	<div class="col-sm-12">
            		<label class="control-label" for="registration-date">For Whom?</label>
                	<input class="inline-radio" name="For_Whom" id="for_whom" type="radio" value="Myself"> Myself
                	&nbsp;&nbsp;<input class="inline-radio" name="For_Whom" value="Others" id="for_whom" type="radio"> Others
               </div>
            </div>
            <div class="form-group row clearfix">
            	<div class="col-sm-6">
            		<label class="control-label" for="registration-date">First Name</label>
                	<input class="form-control" name="First_Name" id="First_Name" type="text">
               </div>
            	<div class="col-sm-6">
            		<label class="control-label" for="registration-date">Last Name</label>
                	<input class="form-control" name="Last_Name" id="Last_Name" type="text">
               </div>
            </div>
            <div class="form-group row clearfix">
            	<div class="col-sm-12">
            		<label class="control-label" for="registration-date">Email</label>
                	<input class="form-control" name="Email" id="Email" type="text">
               </div>
            </div>
            <div class="form-group row clearfix">
            	<div class="col-sm-12">
            		<label class="control-label" for="registration-date">Phone Number</label>
                	<input class="form-control" name="Phone_Number" id="Phone_Number" type="text">
               </div>
            </div>
            <div class="form-group row clearfix">
            	<div class="col-sm-12">
            		<label class="control-label" for="registration-date">Address</label>
                	<input class="form-control" name="Address" id="Address" type="text">
               </div>
            </div>
            <div class="form-group row clearfix">
            	<div class="col-sm-12">
            		<label class="control-label" for="registration-date">Select Payment Method</label>
            		<select name="payment_method" id="payment_method" class="form-control">
                    	<option>Cash</option>
                    	<option>Credit Card</option>
                    	<option>Check</option>
               	 </select>
               </div>
            </div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-default" type="button" data-dismiss="modal" >Close</button>
				<button class="btn btn-success" type="submit">Submit</button>
			</div>
		</form>
		</div>
	</div>
</div>
