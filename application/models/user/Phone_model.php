<?php

class Phone_model extends CI_Model {

	private $version = 'db';
	private $table = "phone";

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

	public function findById($id,$field="*"){
		
		return $this->db
				->from($this->table)
				->where('id',$id)
                ->where('user_id',$this->session->userdata('id')?? 0)
				->where('is_deleted',0)
				->select($field)
				->limit(1)
				->get()
				->row_array();
	}

	public function findAll(){
		
		$res = $this->db
				->from($this->table)
                ->where('user_id',$this->session->userdata('id')?? 0)
				->where('is_deleted',0)
				->get()
				->result_array();
		//$this->db->close();

        foreach( $res as $k => $v ){
            $res[$k]['created_at'] = date('Y-m-d H:i:s', $v['created_at']);
        }

		return $res;
	}

	public function userUpdateById($id,$update){
		
		return $this->db
				->where('id',$id)
                ->where('user_id',$this->session->userdata('id')?? 0)
				->where('is_deleted',0)
				->update($this->table,$update);
	}

}

?>