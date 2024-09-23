<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Log
 */
class Log extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->is_logedin();
	}

	public function index()
	{
		$data['pagetitle'] = 'Log';
		$this->loadViews('v_log', $data);
	}
}

/* End of file Log.php */
/* Location: ./application/controllers/Log.php */