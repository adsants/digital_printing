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
		
		$this->jumlahBarang  = $this->t_barang_order_model->getCount($where);	
		
		$this->logAlur  = $this->t_log_order_model->showData($where);	
		
		if($this->oldData){
			$this->template_view->load_view('kasir/proses_view');
		}
		else{
			redirect($this->uri->segment('1'));
		}		
	
	}
	
	public function proses_data(){
			
		$data = array(					
			'TOTAL_BAYAR' 			=> $this->input->post('TOTAL_BAYAR')	,		
			'DISCOUNT' 			=> $this->input->post('DISCOUNT')		
		);			
		$where  = array('ID_ORDER' => $this->input->post('ID_ORDER'));
		$query = $this->t_order_model->update($where,$data);	
		
		
		
		//// input ulang barang
		
		$whereDelete = array('id_order' => $this->input->post('ID_ORDER'));
		$delete = $this->t_barang_order_model->delete($whereDelete);
		
		foreach($this->input->post('ID_BARANG') as $ID_BARANG_GRAFIS){
			
			$maxCountBarang = $this->t_barang_order_model->getPrimaryKeyMax($this->input->post('ID_ORDER'));
			$newId = $maxCountBarang->MAX + 1;	
			
			
			$this->db->query("				
			insert into t_barang_order 
				(
					COUNT_BARANG,
					ID_ORDER,
					NAMA_BARANG,
					JUMLAH_QTY,
					SATUAN_BARANG,
					HARGA_SATUAN,
					TOTAL_HARGA						
				)
				values
				(
					'".$newId."',
					'".$this->input->post('ID_ORDER')."',
					'".$this->input->post('NAMA_BARANG_'.$ID_BARANG_GRAFIS)."',
					'".$this->input->post('JUMLAH_QTY_'.$ID_BARANG_GRAFIS)."',
					'".$this->input->post('SATUAN_BARANG_'.$ID_BARANG_GRAFIS)."',
					'".$this->input->post('HARGA_SATUAN_'.$ID_BARANG_GRAFIS)."',
					'".$this->input->post('TOTAL_HARGA_'.$ID_BARANG_GRAFIS)."'						
				)
				
			");
			
		}
		
		$whereDeleteBayar = array('id_order' => $this->input->post('ID_ORDER'));
		$delete = $this->t_bayar_order_model->delete($whereDeleteBayar);
		
		
		$dataOrder = array(								
			'POSISI_ORDER' 	=> 	'FINISH'		
		);
		$where = array('id_order' =>	$this->input->post('ID_ORDER'));
		$query = $this->t_order_model->update($where ,$dataOrder);
		
		
		$idBayar 	= $this->t_bayar_order_model->getPrimaryKeyMax($this->input->post('ID_ORDER'));
		//echo $this->db->last_query();
		$newIdBayar	= $idBayar->MAX + 1;		
		
		$dataBayar = array(								
			'ID_T_BAYAR_ORDER' 	=> 	$newIdBayar	,
			'JENIS_BAYAR' 		=> 	$this->input->post('JENIS_BAYAR')	,
			'ID_ORDER' 			=> 	$this->input->post('ID_ORDER')	,
			'JUMLAH_BAYAR' 		=> 	$this->input->post('TOTAL_BAYAR')	
			
		);
		$this->db->set('TGL_BAYAR', 'NOW()', FALSE);
		$query = $this->t_bayar_order_model->insert($dataBayar);
		
		$status = array('status' => true,'pesan_modal' => 'Data berhasil disimpan.. silahkan proses WO untuk mencetak Nota.','redirect_link' => base_url()."".$this->uri->segment(1)."/proses/". $this->input->post('ID_ORDER') );
			
			
		echo(json_encode($status));
	}
	
}
