<?php

class User_model extends CI_Model {

	private $version = 'db';
	private $table = "user";

	public function __construct(){
			
		parent::__construct();
		$this->table = $this->version.'_'.$this->table;
		$this->load->database();
	}

	public function close_conn(){
		$this->db->close();
	}

	public function insert($insert){

		$res = $this->db->insert($this->table, $insert);
		//$this->db->close();

		return $res;
	}

	public function findUserByEmail($email,$field="*"){
		
		$res = $this->db
				->from($this->table)
				->where('role_id',3)
				->where('email',$email)
				->select($field)
				->limit(1)
				->get()
				->row_array();
		//$this->db->close();

		return $res;
	}


}
?>