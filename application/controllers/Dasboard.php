<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dasboard extends MY_Controller {
	function __construct()
	{
		parent::__construct();
		$this->is_logedin();
		$this->load->library(['ion_auth', 'form_validation']);
		$this->lang->load('auth');
	}

	public function index()
	{
		$data = array();
		$data['pagetitle'] = 'Dashboard SMART FACTORY';
		$this->loadViews('dasboard', $data);		}




	public function list_report_dasbord() {
		
		$buyer = '';;
		$tanggal_awal = date('Y-m-d');
		$tanggal_akhir = date('Y-m-d');

		$data['info_buyer'] = $buyer;
		$data['info_tanggal_awal'] = $tanggal_awal;
		$data['info_tanggal_akhir'] = $tanggal_akhir;
		
		$sql = "exec [sp_grafik_defect_rate] '$buyer' , '$tanggal_awal' , '$tanggal_akhir' , ''";
		$data['data'] = $this->db->query($sql)->result_array(); 
		
		$this->load->view('welcome_grafik', $data);
		//$this->loadViews("Qa_end_line/Index", $this->global, NULL, NULL);
	}
	
	
	public function lost_time()
	{
		
		$sql_loss_time = "sp_dashboard_loss_time";
		$data['data_loss_time'] = $this->db->query($sql_loss_time)->result_array();
		
		$this->load->view('welcome_lost_time', $data);

	}
	
	public function dasboard_2()
	{
		
		$data['pagetitle'] = "DASHBOARD V 2";
		$this->loadViews('dasboard/dasboard_2', $data);
			
	}
	
	public function dasboard_3()
	{
		
		$data['pagetitle'] = "DASHBOARD V 2";
		$this->loadViews('dasboard/dasboard_3', $data);
			
	}


public function fml()
	{
		$tanggal = date('Y-m-d');
		$tanggal2 = date('Y-m-d');
		$line = '';
		
		
		$sql = "exec [sp_fml_report] '$tanggal' , '$tanggal2', '$line' ";
		//echo $sql ;

		$data['data'] = $this->db->query($sql)->result_array();  
		
		// return $data ; 
		//echo json_encode($data);
		//pre($data);
		$data['pagetitle'] = "FML";
		$this->load->view('dasboard/fml', $data);
			
	}
	
}
