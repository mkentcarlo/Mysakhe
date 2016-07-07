function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

var load_orders = function(){
		load_table_data("#table-orders", "action=get_orders");
};
var load_managers = function(){
		load_table_data("#table-managers", "action=get_managers");
};
var load_services = function(){
		load_table_data("#table-services", "action=get_services");
};
var load_employees = function(){
		load_table_data("#table-employees", "action=get_employees");
};
jQuery(document).ready(function($){
	$("#emp").select2();
	var page = getParameterByName("p");
	var count_pending_orders = get_data("action=count_pending_orders");
	$(".pending_num").text(count_pending_orders);
	switch(page){
		case "managers":
		load_managers();
		$("li.menu-managers").addClass("selected");
		$("li.menu-users ul").addClass("in");
			break;

		case "services":
		load_services();
		$("li.menu-services").addClass("selected");
			break;

		case "employees":
		load_employees();
		$("li.menu-users ul").addClass("in");
		$("li.menu-employees").addClass("selected");
			break;

		case "orders":
		load_orders();
		$("li.menu-orders").addClass("selected");
			break;

		default:
		load_services();
		break;

	}

	$("#frmnew_manager").on('submit', function(e){
		e.preventDefault();
		var formdata = $(this).serialize();
		submit_data(formdata, load_managers);
	});
	$("#frmnew_employee").on('submit', function(e){
		e.preventDefault();
		var formdata = $(this).serialize();
		submit_data(formdata, load_employees);
	});
	$(".reload").click(function(e){
		e.preventDefault();
		$table = $(this).attr('data-table');
		$action = $(this).attr('data-action');
		load_table_data($table, "action="+ $action);
	});
	$("#frmnew_service").submit(function(e){
		e.preventDefault();
		var formdata = $(this).serialize();
		submit_data(formdata, load_services);
	});

	$("button.new_service").on('click', function(){
		$("#frmnew_service input[name=action]").val("new_service");
	});
	$("#table-services").on('click', '.update_service', function(){
		var id = $(this).attr("data-id");
		service_info = get_data("action=get_service&id=" + id );
		$("#frmnew_service input[name=action]").val("update_service");
		$.each(service_info, function(index, value){
			$("input[name=" + index + "]").val(value);
		});
		
	});
	$("#table-services").on('click', '.deactivate_service', function(){
		id = $(this).attr('data-id');
		var c = confirm("You are about to delete this file, click OK to continue.");
		if(c){
			submit_data("action=deactivate_service&service_id="+id, load_services);
		}
		
	});
	$("#table-orders").on('click', '.assign_employee', function(){
		var id = $(this).attr("data-id");
		var order_info = get_data("action=get_order&id=" + id );
		$("input[name=service_start]").val(order_info.service_start);
		$("input[name=service_end]").val(order_info.service_end);
		$("input[name=Service]").val(order_info.Service_Name);
		$("#frmnew_assign_employee input[name=action]").val("assign_employee");
		
	});
	$('#emp').on("select2:selecting", function(e) { 
		var id = $(this).val();
		var emp_info = get_data("action=get_employee&id="+id);
		$("input[name=Email]").val(emp_info.Email);
		$("input[name=Phone_Number]").val(emp_info.Phone_Number);
	});
});