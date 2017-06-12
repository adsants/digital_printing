<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kasir extends CI_Controller {
		
	public function __construct() {
		parent::__construct();
		
		$this->load->model('t_order_model');
		$this->load->model('t_barang_order_model');
		$this->load->model('t_log_order_model');
		$this->load->model('t_bayar_order_model');
	} 

	public function index(){		
		$like 		= null;
		$order_by 	= 'tgl_order'; 
		$urlSearch 	= null;
		
		$where  = array('t_order.POSISI_ORDER' => 'KASIR');
		
		if($this->input->get('field')){
			$like = array($_GET['field'] => $_GET['keyword']);
			$urlSearch = "?field=".$_GET['field']."&keyword=".$_GET['keyword'];
		}		
		
		$this->load->library('pagination');	
		
		$config['base_url'] 	= base_url().'barang/index'.$urlSearch;
		$this->jumlahData 		= $this->t_order_model->getCount($where ,$like);		
		$config['total_rows'] 	= $this->jumlahData;		
		$config['per_page'] 	= 50;		
		
		$this->pagination->initialize($config);	
		$this->showData = $this->t_order_model->showData($where ,$like,$order_by,$config['per_page'],$this->input->get('per_page'));
		$this->pagination->initialize($config);
		
		$this->template_view->load_view('kasir/kasir_view');
	}
	
	public function proses($IdPrimaryKey){
		
		$where = array('id_order' => $IdPrimaryKey);
		$this->oldData = $this->t_order_model->getData($where);	
		
		
		$this->dataBarang  = $this->t_barang_order_model->showData($where);	
		
		$this->logAlur  = $this->t_log_order_model->showData($where);	
		
		if($this->oldData){
			$this->template_view->load_view('kasir/proses_view');
		}
		else{
			redirect($this->uri->segment('1'));
		}		
	
	}
	
	public function proses_data(){
			if($this->input->post('DARI')==''){
				$data = array(					
					'TOTAL_BAYAR' 			=> $this->input->post('TOTAL_BAYAR')	,		
					'DISCOUNT' 			=> $this->input->post('DISCOUNT')		
				);			
				$where  = array('ID_ORDER' => $this->input->post('ID_ORDER'));
				$query = $this->t_order_model->update($where,$data);
				$status = array('status' => true,'pesan_modal' => 'Data berhasil disimpan.. silahkan proses WO untuk mencetak Nota.','redirect_link' => base_url()."".$this->uri->segment(1)."/proses/". $this->input->post('ID_ORDER') );
			}
			else{
				
				$dataUpdate = array(					
					'STATUS_BAYAR' 			=> $this->input->post('STATUS_BAYAR'),
					'POSISI_ORDER' 	=> 	$this->input->post('KE')	
				);			
				$where  = array('ID_ORDER' => $this->input->post('ID_ORDER'));
				$query = $this->t_order_model->update($where,$dataUpdate);
				
				
				///// input Log WO
				$data = array(					
					'ID_ORDER' 			=> $this->input->post('ID_ORDER')	,		
					'ID_KARYAWAN' 		=> $this->session->userdata('id_karyawan')	,			
					'CATATAN_LOG_ORDER' => $this->input->post('CATATAN')	,		
					'DARI' 				=>  $this->input->post('DARI'),			
					'KE' 				=> $this->input->post('KE')		
				);
				$this->db->set('TGL_LOG_ORDER', 'NOW()', FALSE);
				$query = $this->t_log_order_model->insert($data);
				
				
				$dataBayar = array(								
					'JENIS_BAYAR' 	=> 	$this->input->post('JENIS_BAYAR')	,
					'JUMLAH_BAYAR' 	=> 	$this->input->post('TOTAL_BAYAR')	
					
				);
				$this->db->set('TGL_BAYAR', 'NOW()', FALSE);
				$query = $this->t_bayar_order_model->insert($dataBayar);
				
				$status = array('status' => true,'pesan_modal' => 'Data berhasil disimpan.. anda dapat mencetak Nota.','redirect_link' => base_url()."".$this->uri->segment(1)."/proses/". $this->input->post('ID_ORDER') );
			}
			
			
			
			
			echo(json_encode($status));
	}
	
}
