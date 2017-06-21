<?php

class T_log_order_model extends CI_Model {
	public function __construct() {
		parent::__construct();
		
		//$this->load->model('log_model');
	}	
	
	function showData($where){
		$this->db->select("m_karyawan.NAMA_KARYAWAN");				
		$this->db->select("t_log_order.DARI");				
		$this->db->select("t_log_order.KE");				
		$this->db->select("t_log_order.CATATAN_LOG_ORDER");				
		$this->db->select('DATE_FORMAT(t_log_order.tgl_log_order, "%Y-%m-%d %h:%i") as TGL_LOG_ORDER', FALSE);			
		$this->db->order_by("t_log_order.tgl_log_order");				
		$this->db->where($where);	
		
		$this->db->join('m_karyawan', 'm_karyawan.id_karyawan = t_log_order.id_karyawan');	
		return $this->db->get("t_log_order")->result();
	}

	function insert($data){
		$this->db->insert('t_log_order', $data);	
	}
	function update($where,$data){		
		$this->db->where($where);		
		$this->db->update('t_log_order', $data);
	}
	function delete($where){
		$this->db->where($where);
		$this->db->delete('t_log_order');		
	}
}

?>
