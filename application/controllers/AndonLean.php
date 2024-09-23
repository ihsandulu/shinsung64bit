<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Log
 */
class AndonLean extends MY_Controller
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

	public function JumlahKaryawan()
	{
		$data['tanggal'] = date("Y-m-d");
		$tanggal = $data['tanggal'] ;
		$data['pagetitle'] = 'DAFTAR JUMLAH KARYAWAN '.$data['tanggal'] . ' ';
		$query = $this->db->query("SELECT * FROM jumlah_karyawan_harian WHERE tanggal = ?", array($tanggal));
		$data['JumlahKaryawan'] = $query->result_array(); 
		$query = $this->db->query("SELECT * FROM lean_menit_penargetan WHERE tanggal = ?", array($tanggal));
		$data['LeanMenitPenargetan'] = $query->result_array(); 
		$this->loadViews('AndonLean/JumlahKaryawan', $data);
	}
	
	public function JumlahKaryawanAction()
	{
		
		$data= $_POST;
		$data['tanggal'] = date("Y-m-d"); 
		$tanggal = $data['tanggal'] ;

		pre($data);
		$this->db->query("DELETE FROM jumlah_karyawan_harian WHERE tanggal = ?", array($tanggal));
		$this->db->insert('jumlah_karyawan_harian' , $data);
	}

	public function LeanMenitPenargetanAction()
	{
		
		$data= $_POST;
		$data['tanggal'] = date("Y-m-d"); 
		$tanggal = $data['tanggal'] ;

		pre($data);
		$this->db->query("DELETE FROM lean_menit_penargetan WHERE tanggal = ?", array($tanggal));
		$this->db->insert('lean_menit_penargetan' , $data);
	}
	
	
	 
  
  
  
}

/* End of file Log.php */
/* Location: ./application/controllers/Log.php */