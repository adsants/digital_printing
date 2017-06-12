<?php

class T_harga_barang_model extends CI_Model {
	public function __construct() {
		parent::__construct();
		
		//$this->load->model('log_model');
	}	
	
	function showData($where = null,$like = null,$order_by = null,$limit = null, $fromLimit=null){
		
		$this->db->select("*");		
		if($where){
			$this->db->where($where);
		}		
		if($like){
			$this->db->like($like);
		}		
		if($order_by){
			$this->db->order_by($order_by);
		}			
		return $this->db->get("t_harga_barang",$limit,$fromLimit)->result();
	}
	
	function getCount($where = null,$like = null,$order_by = null,$limit = null, $fromLimit=null){
		$this->db->select("*");		
		if($where){
			$this->db->where($where);
		}		
		if($like){
			$this->db->like($like);
		}
		return $this->db->get("t_harga_barang",$limit,$fromLimit)->num_rows();
	}
	
	function getData($where){
		$this->db->select("*");		
		$this->db->where($where);		
		return $this->db->get("t_harga_barang")->row();
	}
	function getDataHargaBeda($idBarang,$jumlahBarang){
		$this->db->select("*");		
		$this->db->where('id_barang',$idBarang);	
		$this->db->where('min_barang <=', $jumlahBarang);
		$this->db->where('max_barang >=', $jumlahBarang);		
		return $this->db->get("t_harga_barang")->row();
	}
	
	function getPrimaryKeyMax(){
		$query = $this->db->query('select max(id_t_harga_barang) as MAX from t_harga_barang') ;	
		return $query->row();
	}
	
	function insert($data){
		$this->db->insert('t_harga_barang', $data);	
	}
	function update($where,$data){		
		$this->db->where($where);		
		$this->db->update('t_harga_barang', $data);
	}
	function delete($where){
		$this->db->where($where);
		$this->db->delete('t_harga_barang');		
	}
}

?>
