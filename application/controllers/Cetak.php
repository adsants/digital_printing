<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cetak extends CI_Controller {
		
	public function __construct() {
		parent::__construct();
		
		$this->load->model('t_order_model');
		$this->load->model('t_barang_order_model');
		$this->load->model('t_log_order_model');
		$this->load->model('t_bayar_order_model');
	} 

	
	public function nota($IdPrimaryKey){
		
		$where = array('id_order' => $IdPrimaryKey);
		$this->oldData = $this->t_order_model->getData($where);			
		$this->dataBarang  = $this->t_barang_order_model->showData($where);			
		$this->logAlur  = $this->t_log_order_model->showData($where);	
		
		if($this->oldData){
			$this->load->view('cetak/nota_view');
		}
		else{
			redirect($this->uri->segment('1'));
		}		
	
	}
	
}
