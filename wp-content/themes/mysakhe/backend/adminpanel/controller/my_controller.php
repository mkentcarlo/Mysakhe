<?php 
include TEMPLATEPATH.'/forms/phpmailer/sendmail.php';
include TEMPLATEPATH.'/backend/model/my_model.php';
Class my_controller extends my_model {
	private $user_session_name = "admindata";
	public function get_user($user_id){
		$table = $this->get_prefix()."admin_users";
		$result = $this->get_query("SELECT * from {$table} WHERE user_id='$user_id'");
		return $result[0];
	}
	public function get_managers(){
		$table = $this->get_prefix()."administrator";
		$result = $this->get_query("SELECT * from {$table}");
		return $result;
	}
	public function get_employees(){
		$table = $this->get_prefix()."employees";
		$result = $this->get_query("SELECT * from {$table}");
		return $result;
	}
	public function get_employee($id){
		$table = $this->get_prefix()."employees";
		$result = $this->get_query("SELECT * from {$table} WHERE Employee_id='$id'");
		return $result[0];
	}
	public function add_new_service($data){
		$table = $this->get_prefix()."services";
		return $this->insert_data($table, $data);
	}
	public function register_user($userdata){
		$table = $this->get_prefix()."admin_users";
		return $this->insert_data($table, $userdata);
	}
	public function email_exists($email){
		$table = $this->get_prefix()."registered_users";
		$result = $this->get_query("SELECT * from {$table} where Email='$email'");
		if($result){
			return md5($result[0]["user_id"]);
		}
		return false;
	}
	public function get_order($id){
		$table = $this->get_prefix()."service_orders";
		$table2 = $this->get_prefix()."service_types";
		$table3 = $this->get_prefix()."services";
		$table4 = $this->get_prefix()."service_recipients";
		$result = $this->get_query("SELECT * FROM {$table} a, {$table2} b, {$table3} c, {$table4} d WHERE a.service_id=c.service_id AND c.Service_type_id=b.Service_type_id and a.service_recipient_id = d.Service_recipient_id and a.service_order_id = '$id'");
		return $result[0];
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
	public function login_admin($userdata){
		$table = $this->get_prefix()."administrator";
		$password = md5($userdata["password"]);
		$email = $userdata["email"];
		$result = $this->get_query("SELECT * from {$table} where Email='$email' and Password='$password'");
		$session_name = $this->user_session_name;
		$this->set_session($session_name, $result[0]);
		return $result[0];
	}
	public function logout_admin($userdata){
		$session_name = $this->user_session_name;
		$this->unset_session($session_name);
	}
	public function set_session($session_name, $data){
		$_SESSION[$session_name] = $data;
	}
	public function unset_session($session_name){
		unset($_SESSION[$session_name]);
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
	public function deactivate_service($service_id){
		$table = $this->get_prefix()."services";
		$where = array("Service_id"=>$service_id);
		$data = array("status"=>1);
		$this->update_data($table, $data, $where);
		return true;
	}
	
	public function get_orders($status=null){
		$table = $this->get_prefix()."service_orders";
		$table2 = $this->get_prefix()."service_types";
		$table3 = $this->get_prefix()."services";
		$table4 = $this->get_prefix()."service_recipients";
		$user_id = $this->get_current_user_id();
		if(!$status){
				$result = $this->get_query("SELECT * FROM {$table} a, {$table2} b, {$table3} c, {$table4} d WHERE a.service_id=c.service_id AND c.Service_type_id=b.Service_type_id and a.service_recipient_id = d.Service_recipient_id and a.order_status='pending'");
		}
		else{
				$result = $this->get_query("SELECT * FROM {$table} a, {$table2} b, {$table3} c, {$table4} d WHERE a.service_id=c.service_id AND c.Service_type_id=b.Service_type_id and a.service_recipient_id = d.Service_recipient_id and a.order_status='$status'");
		}
		return $result;
	}
	public function get_services($service_type_id=null){
		$table = $this->get_prefix()."services";
		$table2 = $this->get_prefix()."service_types";
		if($service_type_id){
			$result = $this->get_query("SELECT * from {$table} a,{$table2} b WHERE Service_type_id='$service_type_id' and a.Service_type_id=b.Service_type_id and a.status='0'");
		}
		else{
			$result = $this->get_query("SELECT * from {$table} a,{$table2} b WHERE a.Service_type_id=b.Service_type_id and a.status='0'");
		}
		return json_encode($result);
	}
	public function get_positions(){
		$table = $this->get_prefix()."position";
		return $this->get_all($table);
	}
	public function get_service($service_id){
		$table = $this->get_prefix()."services";
		$table2 = $this->get_prefix()."service_types";
		$result = $this->get_query("SELECT * from {$table} a,{$table2} b WHERE Service_id='$service_id' and a.Service_type_id=b.Service_type_id");
		return $result[0];
	}
	public function update_service($data){
		$table = $this->get_prefix()."services";
		$where = array("Service_id"=>$data["Service_id"]);
		$this->update_data($table, $data, $where);
		return true;
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
	public function load_positions(){
		$positions = $this->get_positions();
		foreach ($positions as $key => $value) {
			echo "<option value=$value[position_id]>$value[position_name]</option>";
		}
	}
	public function add_manager($data){
		$table = $this->get_prefix()."administrator";
		return $this->insert_data($table, $data);
	}
	public function add_employee($data){
		$table = $this->get_prefix()."employees";
		return $this->insert_data($table, $data);
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