<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends CI_Controller {
		
	public function __construct() {
		parent::__construct();
		
		
		$this->load->model('t_harga_barang_model');
		$this->load->model('customer_model');
		$this->load->model('t_log_order_model');
		$this->load->model('t_order_model');
	} 

	public function index(){				
		redirect('order/add');
	}
	public function add(){				
		$this->template_view->load_view('order/form_order_view');
	}
	public function add_data(){	

	
		$jumlahIdBarang = count($this->input->post('id_barang'));
	//	var_dump($jumlahIdBarang);
		if(    $jumlahIdBarang > 0   ){
			
			if($this->input->post('ID_CUSTOMER') == ''){
			
			///// input customer jika tidak ada di datasbe
			$maxIDCustomer = $this->customer_model->getPrimaryKeyMax();
			$idCustomer = $maxIDCustomer->MAX + 1;			

			$data = array(					
				'ID_CUSTOMER' => $idCustomer	,			
				'ALAMAT_CUSTOMER' => $this->input->post('ALAMAT_CUSTOMER')	,			
				'NAMA_CUSTOMER' => $this->input->post('NAMA_CUSTOMER')	,			
				'HP_CUSTOMER' => $this->input->post('HP_CUSTOMER')				
			);
			$query = $this->customer_model->insert($data);							
			}
			else{
				$idCustomer = $this->input->post('ID_CUSTOMER');
			}
			
			///////
			if( $this->input->post('JENIS_ORDER') =='4'){
				$posisiOrder = 'KASIR';
			}
			elseif($this->input->post('JENIS_ORDER') =='3'){
				$posisiOrder = 'OP-PRINT';
			}
			else{
				$posisiOrder = 'OP-GRAFIS';
			}
			
			////// input t_order
			$maxIDOrder = $this->t_order_model->getPrimaryKeyMax();
			$idOrder = $maxIDOrder->MAX + 1;
			
			$no_order = date('ymdHis');
			
			$data = array(					
				'ID_ORDER' 		=> 	$idOrder,			
				'ID_CUSTOMER'	=> 	$idCustomer	,			
				'POSISI_ORDER' 	=> 	$posisiOrder,			
				'JENIS_ORDER' 	=>  $this->input->post('JENIS_ORDER')	,			
				'NO_ORDER' 	=>  $no_order	,
				'ID_KARYAWAN' 		=> $this->session->userdata('id_karyawan')	,						
				'CATATAN' 		=> 	$this->input->post('CATATAN')				
			);
			$this->db->set('TGL_ORDER', 'NOW()', FALSE);
			$this->db->set('TGL_AMBIL', 'NOW()', FALSE);
			$query = $this->t_order_model->insert($data);
			
			
			foreach($this->input->post('id_barang') as $id_barang){
				$this->db->query("				
				insert into t_barang_order 
					(
						ID_BARANG,
						ID_ORDER,
						JUMLAH_QTY,
						HARGA_SATUAN,
						TOTAL_HARGA
					)
					values
					(
						'".$id_barang."',
						'".$idOrder."',
						'".$this->input->post('jumlah_qty_'.$id_barang)."',
						'".$this->input->post('harga_qty_'.$id_barang)."',
						'".$this->input->post('total_harga_'.$id_barang)."'
					)
					
				");
				
			}
			
			///// input Log WO
			$data = array(					
				'ID_ORDER' 			=> $idOrder	,			
				'ID_KARYAWAN' 		=> $this->session->userdata('id_karyawan')	,			
				'CATATAN_LOG_ORDER' => '',			
				'DARI' 				=>  'CS',			
				'KE' 				=> $posisiOrder			
			);
			$this->db->set('TGL_LOG_ORDER', 'NOW()', FALSE);
			$query = $this->t_log_order_model->insert($data);
			
			$status = array('status' => true , 'redirect_link' => base_url()."".$this->uri->segment(1) , 'pesan_modal' => '<b>Input Work Order berhasil disimpan.</b><br><b>No WO adalah <h3>'.$no_order.'</h3></b>');
		}
		else{
			$status = array('status' => false , 'pesan' => 'Proses simpan gagal, anda belum input barang !');
		}
		
		echo(json_encode($status));
	}
	
	
}