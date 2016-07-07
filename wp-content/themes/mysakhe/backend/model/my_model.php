<?php 
Class my_model { 
	private $db;
	public function __construct() {
		$this->db = $GLOBALS['wpdb'];
	}
	public function get_all($table){
		return $this->db->get_results( "SELECT * FROM {$table}", ARRAY_A);
	} 
	public function get_where($table, $where){
		return $this->db->get_results( "SELECT * FROM {$table} WHERE {$where}", ARRAY_A );
	}
	public function insert_data($table, $data){
		return $this->db->insert($table, $data);
	}
	public function last_inserted_id(){
		return $this->db->insert_id;
	}
	public function get_query($query){
		return $this->db->get_results($query, ARRAY_A);
	}
	public function update_data($table, $data, $where){
		return $this->db->update($table, $data, $where);
	}
	public function delete_data($table, $where){
		return $this->db->update($table, $where);
	}
	public function get_prefix(){
		return $this->db->prefix;
	} 
}  