<?php

class T_bayar_order_model extends CI_Model {
	public function __construct() {
		parent::__construct();
		
		//$this->load->model('log_model');
	}	
	
	function showData($where){
		$this->db->select("*");			
		$this->db->where($where);	
		return $this->db->get("t_bayar_order")->result();
	}
	
	
	function insert($data){
		$this->db->insert('t_bayar_order', $data);	
	}
	function update($where,$data){		
		$this->db->where($where);		
		$this->db->update('t_bayar_order', $data);
	}
	function delete($where){
		$this->db->where($where);
		$this->db->delete('t_bayar_order');		
	}
}

?>
