<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Qa_end_lineb extends MY_Controller
{
	private $db_kis = "";
	function __construct()
	{
		parent::__construct();
		// $this->is_logedin();
		$this->load->helper(array('form', 'url'));
		$this->db_kis  = $this->load->database('kis', TRUE);
		$this->load->helper('url');
		$this->load->library(['ion_auth', 'form_validation']);
	}

	public function index()
	{
		$data['pagetitle'] = 'SEWING END LINE LIST';
		$this->loadViews('Qa_end_line/Indexb', $data);
		//$this->loadViews("Qa_end_line/Index", $this->global, NULL, NULL);
	}
}

/* End of file Log.php */
/* Location: ./application/controllers/Log.php */
