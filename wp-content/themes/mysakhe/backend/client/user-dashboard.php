<?php include 'controller/my_controller.php';
global $controller;
$controller = new my_controller();
$userdata = $controller->get_userdata();
$fullname = $userdata["First_Name"]." ".$userdata["Last_Name"];
if(!$controller->user_is_logged_in()){
	echo "<script>window.location='non-medical-in-home-care-log-in'</script>";
}
 ?>

<script>
var ajaxUrl = "<?php echo get_template_directory_uri().'/backend/client/ajax.php'; ?>";
var userdata = <?php echo json_encode($controller->get_userdata()); ?>;
function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}
var stack_modal = {"dir1": "down", "dir2": "right", "push": "top", "modal": true, "overlay_close": true};
  var stack = {"dir1": "down", "dir2": "right", "push": "top", "modal": false, "overlay_close": false};
  var option = {
        text: "Please Wait...",
        hide: false,
        buttons: {
            closer: false,
            sticker: false
        },
        opacity: .75,
        shadow: false,
        addclass: 'stack-modal'
  };
 var loader;
  
  function start_loader(text){
    option.stack = stack_modal;
    option.text = text;
    option.type = 'info';
    option.icon = 'fa fa-spinner fa-spin';
    loader = new PNotify(option);
  }
  function loader_complete(text){
    $(".ui-pnotify-modal-overlay").hide();
    option.stack = stack;
    option.text = text;
    option.hide = true;
    option.type = 'success';
    option.icon = 'fa fa-check';
    option.buttons = { closer: true,
            sticker: true };
    loader.update(option);
  }
  function loader_error(text){
    $(".ui-pnotify-modal-overlay").hide();
    option.stack = stack;
    option.buttons = { closer: true,
            sticker: true };
    option.hide = true;
    option.text = text;
    option.icon = 'fa fa-exclamation-triangle';
    option.type = 'error';
    loader.update(option);
  }   
</script>
<div class="user-dashboard" style="display: none">
    <div class="row profile">
    	<div class="col-md-12" style="padding: 0px;">
    		<nav class="navbar navbar-light bg-faded">
    			<ul class="nav navbar-nav">
    				<li class="nav-item active">
    					<a href="#orders" id="a_orders" data-toggle="tab">
							<i class="fa fa-home"></i>
							Orders List </a>
    				</li>
    				<li class="nav-item">
    						<a href="#personal-information" data-toggle="tab">
							<i class="fa fa-user"></i>
							Personal Infomation </a>
    				</li>
    				<li class="nav-item">
    						<a href="#change-password" data-toggle="tab">
							<i class="fa fa-lock"></i>
							Change 
							Password </a>
    				</li>
    			</ul>
    		</nav>
    	</div>
	</div>
	<div class="row">
		<div class="col-md-12" style="padding: 0px;">
            <div class="profile-content clearfix">
			  <div class="tab-content">
			  	<div class="tab-pane fade in active" id="orders">
			  		<?php get_client_backend('orders-list'); ?>
			  	</div>
			  	<div class="tab-pane fade" id="personal-information">
			  		<?php get_client_backend('personal-information'); ?>
			  	</div>
			  	<div class="tab-pane fade" id="change-password">
			  		<?php get_client_backend('change-password'); ?>
			  	</div>
			  </div>
            </div>
		</div>
	</div>
<br>
<br>
</div>
<script>
$(document).ready(function(){


	 window.load_table_data = function(table, query){
		dataTable = $(table).dataTable();
	 	dataTable.fnClearTable();
    		dataTable.fnDraw();  
		jQuery.ajax({
            type:"POST",
            url: ajaxUrl,
            data: query,
            success: function(data){
            	data = JSON.parse(data); 
            	$.each(data, function(index, data) {   
            	if(data.order_status=="pending"){
            		var actions = "<button class='btn btn-info btn-xs update_order' data-id='" + data.service_order_id + "' data-toggle='modal' data-target='#modal_order'><i class='fa fa-pencil'></i></button> <button data-id='" + data.service_order_id + "' class='btn btn-danger btn-xs cancel_order'><i class='fa fa-times'></i></button>";
            	}
            	else if(data.order_status=="completed"){
            			var actions = "<button class='btn btn-info btn-xs re-order' data-id='" + data.service_order_id + "' data-toggle='modal' data-target='#modal_order'><i class='fa fa-pencil'></i>Re-order</button>";
            	}
            	else{
            		var actions = "";
            	}
 
            	 $(table).dataTable().fnAddData( [
                                       data.Service_Name,
                                       data.service_start,
                                       data.service_end,
                                       data.First_Name + " " + data.Last_Name,
                                       actions ] 
                                  ); 
            	});
    			
            },
            error: function(errorThrown){
                  error = JSON.stringify(errorThrown);
            } 
        });
	}
	window.ajax_get_request = function(table, query){
		
	}
});
</script>