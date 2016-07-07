<?php 
include './../../../../../wp-blog-header.php';
include 'controller/my_controller.php';
$controller = new my_controller();
$data = array();
switch ($_POST["action"]) {
	case 'count_pending_orders':
		$orders = $controller->get_orders();
		echo count($orders);
		break;
	case 'get_order':
		$id = $_POST['id'];
		echo json_encode($controller->get_order($id));
		break;
	case 'get_orders':
		$orders = $controller->get_orders();
		$result = array();
		foreach ($orders as $key => $value) {
			$temp_order = array();
			$temp_order["Service"] = $value["Service_Name"];
			$temp_order["Name"] = $value["First_Name"]. " " .$value["Last_Name"];
			$temp_order["Phone_Number"] = $value["Phone_Number"];
			$temp_order["Email"] = $value["Email"];
			// $temp_orers["Address"] = $value["Address"];
			$temp_order["service_start"] = $value["service_start"];
			$temp_order["service_end"] = $value["service_end"];
			$temp_order["action"] = "<button class='btn btn-xs btn-info assign_employee' data-toggle='modal' data-target='#assign_employee' data-id='".$value["service_order_id"]."'><i class='fa fa-user'></i> Assign Employee</button>";
			$result[] = $temp_order;
		}
		echo json_encode($result);
		break;
	case 'new_service':
		$excludes = array('action');
		$data = $controller->exclude_unnecessary($_POST, $excludes);
		if($controller->add_new_service($data)){
			$data["success"] = true;
			$data["msg"] = "Successfully added new service.";
 		}
		else{
			$data["success"] = false;
			$data["msg"] = "Failed to add new service.";
		}
		echo json_encode($data);
		break;
	case 'update_service':
		$excludes = array('action');
		$data = $controller->exclude_unnecessary($_POST, $excludes);
		if($controller->update_service($data)){
			$data["success"] = true;
			$data["msg"] = "Successfully updated selected service.";
 		}
		else{
			$data["success"] = false;
			$data["msg"] = "Failed to update selected service.";
		}
		echo json_encode($data);
		break;
	case 'deactivate_service':
		$id = $_POST["service_id"];
		if($controller->deactivate_service($id)){
			$data["success"] = true;
			$data["msg"] = "Successfully deactivated selected service.";
 		}
		else{
			$data["success"] = false;
			$data["msg"] = "Failed to deactivate selected service.";
		}
		echo json_encode($data);
		break;
	case 'new_manager':
		$excludes = array('action');
		$data = $controller->exclude_unnecessary($_POST, $excludes);
		if($controller->add_manager($data)){
			$data["success"] = true;
			$data["msg"] = "Successfully add new manager.";
 		}
		else{
			$data["success"] = false;
			$data["msg"] = "Failed to add new manager.";
		}
		echo json_encode($data);
		break;
	case 'new_employee':
		$excludes = array('action');
		$data = $controller->exclude_unnecessary($_POST, $excludes);
		if($controller->add_employee($data)){
			$data["success"] = true;
			$data["msg"] = "Successfully add new employee.";
 		}
		else{
			$data["success"] = false;
			$data["msg"] = "Failed to add new employee.";
		}
		echo json_encode($data);
		break;
	case 'get_service':
		$id = $_POST['id'];
		echo json_encode($controller->get_service($id));
		break;
	case 'get_services':
		$services = $controller->get_services();
		$services = json_decode($services);
		foreach ($services as $key => $value) {
			$temp_service = array();
			$temp_service["sevice_name"] = $value->Service_Name;
			$temp_service["Price"] = $value->Service_Type_Name;
			$temp_service["Service_type"] = "$".number_format($value->Price,2);
			$temp_service["action"] = "<button class='btn btn-sm btn-default update_service' data-id='".$value->Service_id."' data-target='#new_service' data-toggle='modal'><i class='fa fa-pencil'></i></button> <button class='btn btn-sm btn-danger deactivate_service' data-id='".$value->Service_id."'><i class='fa fa-times'></i></button>";
			$result[] = $temp_service;
		}
		echo json_encode($result);
		break;
	case 'get_managers':
		$result = array();
		$managers = $controller->get_managers();
		foreach ($managers as $key => $value) {
			$temp_manager = array();
			$temp_manager["Name"] = $value["First_Name"]. " " .$value["Last_Name"];
			$temp_manager["Email"] = $value["Email"];
			$temp_manager["Address"] = $value["Address"];
			$temp_manager["Phone_Number"] = $value["Phone_Number"];
			$temp_manager["Type"] = $value["Phone_Number"];
			$temp_manager["action"] = "<button class='btn btn-sm btn-default manager_info' data-id='".$value["admin_id"]."'><i class='fa fa-list'></i></button>";
			$result[] = $temp_manager;
		}
		echo json_encode($result);
		break;
	case 'get_employees':
		$result = array();
		$employees = $controller->get_employees();
		foreach ($employees as $key => $value) {
			$temp_employee = array();
			$temp_employee["Name"] = $value["First_Name"]. " " .$value["Last_Name"];
			$temp_employee["Email"] = $value["Email"];
			$temp_employee["Address"] = $value["Address"];
			$temp_employee["Phone_Number"] = $value["Phone_Number"];
			$temp_employee["action"] = "<button class='btn btn-sm btn-default manager_info' data-id='".$value["Employee_id"]."'><i class='fa fa-list'></i></button>";
			$result[] = $temp_employee;
		}
		echo json_encode($result);
		break;
	case 'get_employee':
		$id = $_POST["id"];
		$employees = $controller->get_employee($id);
		echo json_encode($employees);
		break;
	
	default:
		# code...
		break;
}
?>