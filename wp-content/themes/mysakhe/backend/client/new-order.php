<?php
global $controller;
$service_types = $controller->get_service_types();
$userdata = json_encode($controller->get_userdata());
?>
<script>
	jQuery(document).ready(function(){
		$("input[name=For_Whom]").change(function(){
            $.ajax({
                method: "POST",
                url: ajaxUrl,
                data: { action: "get_userdata" },
                success: function(data){
                    data = JSON.parse(data);
                    var user = data.userdata;
                    if($(this).val()=="Myself"){
                        $("#First_Name").val(user.First_Name);
                        $("#Last_Name").val(user.Last_Name);
                        $("#Address").val(user.Address);
                        $("#Phone_Number").val(user.Phone_Number);
                        $("#Email").val(user.Email);
                    }
                    else{
                        $("#First_Name").val("");
                        $("#Last_Name").val("");
                        $("#Address").val("");
                        $("#Phone_Number").val("");
                        $("#Email").val("");
                    }
                }
            });
		
		});
        $("#new_order_form").submit(function(e){
            e.preventDefault();
            formdata = $(this).serialize();
            jQuery.ajax({
            type:"POST",
            url: ajaxUrl,
            data: formdata,
            success: function(data){
                parsed_data = JSON.parse(data);
                if(parsed_data.success){
                    $('#payment').modal('toggle');
                    $("#new_order_form")[0].reset();
                    $("input[name=action]").val("new_order");  
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
        $("#Service").change(function(e){
            var price = parseInt($("#Service option:selected").attr('data-price'));
            var service = $("#Service option:selected").text();
            var service_type = $("#service_type option:selected").text();
            $("td.amount").html("$" + price.toFixed(2));
            $("td.selected_service").html(service);
            $("td.selected_type").html(service_type);
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
		
	});
</script>

<div class="user-dashboard-title">
	<i class="fa fa-plus"></i>&nbsp;New Order
</div>
 <form class="form-horizontal" action="" method="post" id="new_order_form">
    <input type="hidden" name="action" value="new_order">
 	<button type="button" class="btn btn-default f-right" data-toggle="modal" data-target="#browse_old_orders"><i class="fa fa-plus"></i>&nbsp;Browse from previous orders..</button>
            <div class="form-group row clearfix">
                <div class="col-sm-6">
                	<label class="control-label" for="registration-date">Service Start:</label>
                	            	<div class="input-group registration-date-time">
                	            		<span class="input-group-addon" id="basic-addon1"><span class="fa fa-calendar" aria-hidden="true"></span></span>
                	            		<input class="form-control datetime" name="service_start" id="service_start" type="text">
                	            	</div>
                </div>
                <div class="col-sm-6">
                	<label class="control-label" for="registration-date">Service End:</label>
                	            	<div class="input-group registration-date-time">
                	            		<span class="input-group-addon" id="basic-addon1"><span class="fa fa-calendar" aria-hidden="true"></span></span>
                	            		<input class="form-control datetime" name="service_end" id="service_end" type="text">
                	            	</div>
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
                	&nbsp;&nbsp;<input class="inline-radio" name="for_whom" value="Others" id="for_whom" type="radio"> Others
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
            <div class="text-right">
            	<button class="btn btn-success" type="button" data-toggle="modal" data-target="#payment">Proceed to Payment</button>
            </div>

<div class="modal modal-fade" id="browse_old_orders">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Import</h4>
      </div>
      <div class="modal-body">
        <table class="table table-striped table-hover">
    <tbody>
        <tr>
            <td>Service Type</td>
            <td>Service Name</td>
            <td>From</td>
            <td>To</td>
            <td><button class="btn btn-default btn-xs">Select</button></td>
        <tr>
            <td>Service Type</td>
            <td>Service Name</td>
            <td>From</td>
            <td>To</td>
            <td><button class="btn btn-default btn-xs">Select</button></td>
        </tr>
    </tbody>
</table>
      </div>
    </div>
  </div>
</div>
<div class="modal modal-fade" id="payment">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Payment Options</h4>
    </div>
    <div class="modal-body">
        <table class="">
           <tbody>
            <tr>
                <td>Service Type:</td>
                <td class="selected_type"></td>
            </tr>
            <tr>
                <td>Selected Service:</td>
                <td class="selected_service"></td>
            </tr>
            <tr>
                <td>Amount:</td>
                <td class="amount"></td>
            </tr>
            <tr>
                <td>Payment Method:</td>
                <td><select name="payment_method" id="payment_method" class="form-control">
                    <option>Cash</option>
                    <option>Credit Card</option>
                    <option>Check</option>
                </select></td>
            </tr>
           </tbody>
       </table>
   </div>
   <div class="modal-footer">
        <button class="btn btn-success" id="submit_order">Submit Order</button>
   </div>
</div>
</div>
</div>
</form>