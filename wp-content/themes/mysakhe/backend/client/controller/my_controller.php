<?php 
include TEMPLATEPATH.'/forms/phpmailer/sendmail.php';
include TEMPLATEPATH.'/backend/model/my_model.php';
Class my_controller extends my_model {
	private $user_session_name = "userdata";
	public function get_user($user_id){
		$table = $this->get_prefix()."registered_users";
		$result = $this->get_query("SELECT * from {$table} WHERE user_id='$user_id'");
		return $result[0];
	}
	public function register_user($userdata){
		$table = $this->get_prefix()."registered_users";
		return $this->insert_data($table, $userdata);
	}
	public function add_recipient($recipient_data){
		$table = $this->get_prefix()."service_recipients";
		return $this->insert_data($table, $recipient_data);
	}
	public function update_recipient($recipient_data){
		$table = $this->get_prefix()."service_recipients";
		$data = $recipient_data;
		$where = array("Service_recipient_id"=>$recipient_data["Service_recipient_id"]);
		return $this->update_data($table, $data, $where);
	}
	public function add_order($order_data){
		$table = $this->get_prefix()."service_orders";
		return $this->insert_data($table, $order_data);
	}
	public function update_order($order_data){
		$table = $this->get_prefix()."service_orders";
		$data = $order_data;
		$where = array("service_order_id"=>$data["service_order_id"]);
		return $this->update_data($table, $data, $where);
	}
	public function get_order($id){
		$table = $this->get_prefix()."service_orders";
		$table2 = $this->get_prefix()."service_types";
		$table3 = $this->get_prefix()."services";
		$table4 = $this->get_prefix()."service_recipients";
		$result = $this->get_query("SELECT * FROM {$table} a, {$table2} b, {$table3} c, {$table4} d WHERE a.service_id=c.service_id AND c.Service_type_id=b.Service_type_id and a.service_recipient_id = d.Service_recipient_id and a.service_order_id = '$id'");
		return $result[0];
	}
	public function get_orders($status=null){
		$table = $this->get_prefix()."service_orders";
		$table2 = $this->get_prefix()."service_types";
		$table3 = $this->get_prefix()."services";
		$table4 = $this->get_prefix()."service_recipients";
		$user_id = $this->get_current_user_id();
		if(!$status){
				$result = $this->get_query("SELECT * FROM {$table} a, {$table2} b, {$table3} c, {$table4} d WHERE a.service_id=c.service_id AND c.Service_type_id=b.Service_type_id and a.service_recipient_id = d.Service_recipient_id and a.order_status='pending' and a.user_id='$user_id'");
		}
		else{
				$result = $this->get_query("SELECT * FROM {$table} a, {$table2} b, {$table3} c, {$table4} d WHERE a.service_id=c.service_id AND c.Service_type_id=b.Service_type_id and a.service_recipient_id = d.Service_recipient_id and a.order_status='$status' and a.user_id='$user_id'");
		}
		return $result;
	}
	public function cancel_order($service_order_id){
		$table = $this->get_prefix()."service_orders";
		$where = array("service_order_id"=>$service_order_id);
		$data = array("order_status"=>"cancelled");
		return $this->update_data($table, $data, $where);
	}
	public function order_list_sub_nav(){
		echo "<div><span>Pending</span> | <span>On going</span> | <span>Cancelled</span></div>";
	}
	public function generate_orders_list($status=null){
		if($status){
			$orders = $this->get_orders($status);
		}
		else{
			$orders = $this->get_orders();
		}
		foreach ($orders as $key => $value) {
			echo "<tr>
					<td>$value[Service_Name]</td>
					<td>$value[service_start]</td>
					<td>$value[service_end]</td>
					<td>$value[First_Name] $value[Last_Name]</td> 
					<td><button class='btn btn-info btn-xs update_order' data-toggle='modal' data-id='". $value["service_order_id"] ."' data-target='#modal_order'><i class='fa fa-pencil'></i></button> <button data-id='". $value["service_order_id"] ."' class='btn btn-danger btn-xs cancel_order'><i class='fa fa-times'></i></button></td>
				</tr>";
		}
	}
	public function email_exists($email){
		$table = $this->get_prefix()."registered_users";
		$result = $this->get_query("SELECT * from {$table} where Email='$email'");
		if($result){
			return md5($result[0]["user_id"]);
		}
		return false;
	}
	public function get_encrypted_id($encrypted_id){
		$table = $this->get_prefix()."registered_users";
		$result = $this->get_query("SELECT * from {$table} where md5(user_id)='$encrypted_id'");
		if($result){
			return $result[0]["user_id"];
		}
		else{
			return false;
		}
	}
	public function send_email($email_data){
		include TEMPLATEPATH.'/forms/form_details.php';

		$body = '<div align="left" style="width:700px; height:auto; font-size:12px; color:#333333; letter-spacing:1px; line-height:20px;">
			<div style="border:8px double #c3c3d0; padding:12px;">
			<div align="center" style="font-size:22px; font-family:Times New Roman, Times, serif; color:#051d38;">'.$email_data["title"].'</div>
			<table width="90%" cellspacing="2" cellpadding="5" align="center" style="font-family:Verdana; font-size:13px">
			';

		if(isset($email_data["to_email"])){
			$to_email = $email_data["to_email"];
		}
		if(isset($email_data["from_name"])){
			$from_name = $email_data["from_name"];
		}
		if(isset($email_data["subject"])){
			$subject = $email_data["subject"];
		}
		
		$body = $body.$email_data["text"];

		$body .= '
			</table>

			</div>
			</div>';	
		 $mail = new SendMail($host, $username, $password);
		
			$trysend = $mail->sendNow($to_email, $to_name, $cc, $bcc, $from_email, $from_name, $subject, $body);
			if ($trysend == 'ok'){
				return true;
			}
			else{
				return false;}
		
	}
	public function exclude_unnecessary($data, $exceptions){
		$return_data = array();
		foreach ($data as $key => $value) {
			if(!in_array($key, $exceptions)){
				$return_data[$key] = $value;
			}
		}

		return $return_data; 
	}
	public function reset_password($user_id, $new_password){
		$new_password = md5($new_password);
		$table = $this->get_prefix()."registered_users";
		$where = array("user_id"=>$user_id);
		$data = array("Password"=>$new_password);
		return $this->update_data($table, $data, $where);
	}
	public function login_user($userdata){
		$table = $this->get_prefix()."registered_users";
		$password = md5($userdata["password"]);
		$email = $userdata["email"];
		$result = $this->get_query("SELECT * from {$table} where Email='$email' and Password='$password'");
		$session_name = $this->user_session_name;
		$this->set_session($session_name, $result[0]);
		return $result[0];
	}
	public function set_session($session_name, $data){
		$_SESSION[$session_name] = $data;
	}
	public function get_session($session_name){
		return $_SESSION[$session_name];
	}
	public function user_is_logged_in(){
		$session_name = $this->user_session_name;
		if(isset($_SESSION[$session_name])){
			return true;
		}
		else{
			return false;
		}
	}	
	public function get_userdata(){
		$session_name = $this->user_session_name;
		return $this->get_session($session_name);
	}
	public function get_current_user_id(){
		return $this->get_userdata()["user_id"];
	}
	public function get_services($service_type_id){
		$table = $this->get_prefix()."services";
		$result = $this->get_query("SELECT * from {$table} WHERE Service_type_id='$service_type_id'");
		return json_encode($result);
	}
	public function get_service_types(){
		$table = $this->get_prefix()."service_types";
		$result = $this->get_all($table);
		return json_encode($result);
	}
	public function get_service_type($get_service_type){
		$table = $this->get_prefix()."service_types";
		$result = $this->get_query("SELECT * FROM {$table} WHERE Service_type_id='$get_service_type'");
		return $result[0];
	}
	public function load_select($data){
		foreach ($data as $key => $value) {
			echo "<option value='$value->Service_type_id'>$value->Service_Type_Name</option>";
		}
	}
	public function verify_old_pass($old, $user_id){
		$table = $this->get_prefix()."registered_users";
		$old = md5($old);
		$result = $this->get_query("SELECT * from {$table} where user_id='$user_id' and Password='$old'");
		if($result){
			return true;
		}
		else{
			return false;
		}
	}
	public function update_profile($data){
		$table = $this->get_prefix()."registered_users";
		$id = $this->get_current_user_id();
		$where = array("user_id"=>$id);
		$this->update_data($table, $data, $where);
		$userdata = $this->get_user($id);
		$session_name = $this->user_session_name;
		$this->set_session($session_name, $userdata);

		return true;
	}
	public function change_password($old, $new, $user_id){
		if($this->verify_old_pass($old, $user_id)){
			$this->reset_password($user_id, $user_id);
			return true;
		}	
		else{
			return false;
		}
	}

}