<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Qa_end_line_dashboard2 extends MY_Controller
{
	private $db_kis = "";
	function __construct()
	{
		parent::__construct();
		$this->is_logedin();
	    $this->load->helper(array('form', 'url'));
	    $this->db_kis  = $this->load->database('kis', TRUE);
		$this->load->helper('url');
		$this->load->library(['ion_auth', 'form_validation']);
	}



	public function index()
	{
		$tanggal = date('Y-m-d');
		$data['pagetitle'] = 'MONITORING DETAIL BY SCHEDULE ALL LINE | TANGGAL '.$tanggal;

		//query persent defect dashboard_Qa_end_line_all_line
		$sql = " dashboard_Qa_end_line_all_line " ; 
		$data['persen_defect'] = $this->db->query($sql)->result_array();  

		//get chief 
		
		//$sql = " SELECT * FROM dbo.tampilan_hasil_produksi_daftar_manager_supervisor WHERE tanggal = '$tanggal'  " ; 
		//$data['chief']= $this->db_kis->query($sql)->result_array();  		

		
		$this->loadViews('Qa_end_line/list_report_dasbord2', $data);
		//$this->loadViews("Qa_end_line/Index", $this->global, NULL, NULL);
	}
	
	
	
	public function list_report_detail_dasbord2()
	{
		
			$tanggal = date('Y-m-d');
		$data['pagetitle'] = 'MONITORING DETAIL BY SCHEDULE ALL LINE | TANGGAL '.$tanggal;

		//query persent defect dashboard_Qa_end_line_all_line
		$sql = " dashboard_Qa_end_line_all_line " ; 
		$data['persen_defect']= $this->db->query($sql)->result_array();  

		$sql_hasil = " sp_monitoring_schedule_hari_ini " ; 
		$data['data_hasil']= $this->db->query($sql_hasil)->result_array();  
		//get chief 
		//$sql = " SELECT * FROM dbo.tampilan_hasil_produksi_daftar_manager_supervisor WHERE tanggal = '$tanggal'  " ; 
		//$data['chief']= $this->db_kis->query($sql)->result_array();  
		
		$this->load->view('Qa_end_line/list_report_detail_dasbord2', $data);
		//$this->loadViews("Qa_end_line/Index", $this->global, NULL, NULL);
	}
	
}
