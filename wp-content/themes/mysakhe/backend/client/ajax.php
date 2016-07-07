<?php
include './../../../../../wp-blog-header.php';
include 'controller/my_controller.php';
$controller = new my_controller();
session_start();
$data = array();
if(isset($_POST["action"])){
	switch ($_POST["action"]) {
		case 'get_userdata':
			echo json_encode($controller->get_userdata());
			break;
		case 'update_profile':
			$data = $_POST;
			$exclude = array('action');
			$data = $controller->exclude_unnecessary($data, $exclude);
			$controller->update_profile($data);
			$data["userdata"] = $controller->get_userdata();
			$data["msg"] = "You successfully updated your personal information.";
			echo json_encode($data);
			break;
		case 'load_services':
			echo $controller->get_services($_POST["service_type_id"]);
			break;
		case 'change_password':
			$new_pass = $_POST["new_password"];
			$old_pass = $_POST["old_password"];
			$user_id = $controller->get_current_user_id();
			if($controller->change_password($old_pass, $new_pass, $user_id)){
				$data["success"] = true;
				$data["msg"] = "You have successfully changed you password.";
			}
			else{
				$data["success"] = false;
				$data["msg"] = "You failed to change your password. Please try again.";
			}
			echo json_encode($data);
			break;
		case 'load_orders':
			if(isset($_POST["status"])){
				$data = $controller->get_orders($_POST["status"]);
			}
			else{
				$data = $controller->get_orders();
			}
			echo json_encode($data);
			break;
		case 'get_order':
			$id = $_POST["id"];
			$data = $controller->get_order($id);
			$data["order_details"] = $data;
			$data["services"] = $controller->get_services($data["Service_type_id"]);
			echo json_encode($data);
			break;
		case 'cancel_order':
			if($controller->cancel_order($_POST["id"])){
				$data["success"] = true;
				$data["msg"] = "Your order has been successfully cancelled.";
			}
			else{
				$data["success"] = false;
			}
			echo json_encode($data);
			break;
		case 'update_order':
			$id = $_POST["service_order_id"];
			$recipient_id = $_POST["recipient_id"];
			$recipient_data = array("First_Name" => $_POST["First_Name"],
						    "Last_Name" => $_POST["Last_Name"],
						    "Address" => $_POST["Address"],
						    "Email" => $_POST["Email"],
						    "Phone_Number" => $_POST["Phone_Number"],
						    "For_Whom" => $_POST["For_Whom"],
						    "Service_recipient_id" => $recipient_id);

			$controller->update_recipient($recipient_data);
			$userdata = json_encode($controller->get_userdata());
			$order_data = array("service_id"=>$_POST["Service"],
							"service_recipient_id"=>$recipient_id,
							"service_start"=>$_POST["service_start"],
							"service_end"=>$_POST["service_end"],
						    "service_order_id" => $id,
							"payment_method"=>$_POST["payment_method"]);
			$controller->update_order($order_data);
			$data["success"] = true;
			$data["msg"] = "Your order has been successfully updated.";
			echo json_encode($data);
			break;
		case 'new_order':

			$recipient_data = array("First_Name" => $_POST["First_Name"],
						    "Last_Name" => $_POST["Last_Name"],
						    "Address" => $_POST["Address"],
						    "Email" => $_POST["Email"],
						    "Phone_Number" => $_POST["Phone_Number"],
						    "For_Whom" => $_POST["For_Whom"]);

			if($controller->add_recipient($recipient_data)){
				$recipient_id = $controller->last_inserted_id();
				$userdata = json_encode($controller->get_userdata());
				$order_data = array("service_id"=>$_POST["Service"],
							"service_recipient_id"=>$recipient_id,
							"service_start"=>$_POST["service_start"],
							"service_end"=>$_POST["service_end"],
							"payment_method"=>$_POST["payment_method"],
							"user_id"=>$controller->get_current_user_id());
				
				if($controller->add_order($order_data)){
					$data["success"] = true;
					$data["msg"] = "Your order has been successfully submitted.";
				}
				else{
					$data["success"] = false;
				}
				
			}
			else{
					$data["success"] = false;
			}

			echo json_encode($data);
			
			break;
		default:
			# code...
			break;
	}
}
 ?>