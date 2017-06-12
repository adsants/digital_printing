<?php

class T_barang_order_model extends CI_Model {
	public function __construct() {
		parent::__construct();
		
		//$this->load->model('log_model');
	}	
	
	
	
	function showData($where){
		$this->db->select("m_barang.ID_BARANG");		
		$this->db->select("m_barang.NAMA_BARANG");		
		$this->db->select("m_barang.SATUAN");		
		$this->db->select("t_barang_order.JUMLAH_QTY");		
		$this->db->select("t_barang_order.HARGA_SATUAN");		
		$this->db->select("t_barang_order.TOTAL_HARGA");		
		$this->db->where($where);	
		
		$this->db->join('m_barang', 'm_barang.id_barang = t_barang_order.id_barang');	
		return $this->db->get("t_barang_order")->result();
	}
	
	
	function insert($data){
		$this->db->insert('t_barang_order', $data);	
	}
	function update($where,$data){		
		$this->db->where($where);		
		$this->db->update('t_barang_order', $data);
	}
	function delete($where){
		$this->db->where($where);
		$this->db->delete('t_barang_order');		
	}
}

?>
