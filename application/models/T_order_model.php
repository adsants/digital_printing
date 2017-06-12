<?php

class T_order_model extends CI_Model {
	public function __construct() {
		parent::__construct();
		
		//$this->load->model('log_model');
	}	
	
	function showData($where = null,$like = null,$order_by = null,$limit = null, $fromLimit=null){
		
		$this->db->select("t_order.NO_ORDER");		
		$this->db->select("t_order.ID_ORDER");		
		$this->db->select("t_order.TGL_ORDER");		
		$this->db->select("m_customer.NAMA_CUSTOMER");		
		if($where){
			$this->db->where($where);
		}		
		if($like){
			$this->db->like($like);
		}		
		if($order_by){
			$this->db->order_by($order_by);
		}			
		
		$this->db->join('m_customer', 't_order.id_customer = m_customer.id_customer');
		return $this->db->get("t_order",$limit,$fromLimit)->result();
	}
	
	function getCount($where = null,$like = null,$order_by = null,$limit = null, $fromLimit=null){
		$this->db->select("*");		
		if($where){
			$this->db->where($where);
		}		
		if($like){
			$this->db->like($like);
		}
		return $this->db->get("t_order",$limit,$fromLimit)->num_rows();
	}
	
	function getData($where){
		$this->db->select("t_order.NO_ORDER");		
		$this->db->select("t_order.ID_ORDER");		
		$this->db->select("t_order.DISCOUNT");		
		$this->db->select("t_order.CATATAN");		
		$this->db->select("t_order.TOTAL_BAYAR");		
		$this->db->select("t_order.JENIS_BAYAR");		
		$this->db->select("t_order.JENIS_ORDER");		
		$this->db->select("t_order.TGL_ORDER");		
		$this->db->select("t_order.POSISI_ORDER");		
		$this->db->select("m_customer.NAMA_CUSTOMER");	
		$this->db->select("m_customer.HP_CUSTOMER");	
		$this->db->select("m_customer.ALAMAT_CUSTOMER");	
		
		$this->db->where($where);		
		$this->db->join('m_customer', 't_order.id_customer = m_customer.id_customer');
		return $this->db->get("t_order")->row();
	}
	
	
	function getPrimaryKeyMax(){
		$query = $this->db->query('select max(id_order) as MAX from t_order') ;	
		return $query->row();
	}
	
	function insert($data){
		$this->db->insert('t_order', $data);	
	}
	function update($where,$data){		
		$this->db->where($where);		
		$this->db->update('t_order', $data);
	}
	function delete($where){
		$this->db->where($where);
		$this->db->delete('t_order');		
	}
}

?>
