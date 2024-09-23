<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * MY_Con
 * 
 */
class MY_Controller extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function is_logedin()
	{
		if (!$this->ion_auth->logged_in()) {
		  redirect('auth/login');
		}
	}

	function loadViews($viewName = "", $headerInfo = NULL, $pageInfo = NULL, $footerInfo = NULL){
    if($this->session->userdata("baru")=="OK"){
      $this->load->view('includes/headerb', $headerInfo);
    }else{
      $this->load->view('includes/header', $headerInfo);
    }
        $this->load->view($viewName, $pageInfo);
        $this->load->view('includes/footer', $footerInfo);
    }

    public function columnDelete()
    {
        $data = array(
            'bahan_baku_dokumen',
            'bahan_baku_tarif',
            'bank_devisa',
            'barang',
            'barang_dokumen',
            'barang_entitas',
            'barang_spek_khusus',
            'barang_tarif',
            'barang_vd',
            'dokumen',
            'entitas',
            'header',
            'jaminan',
            'kemasan',
            'kontainer',
            'pengangkut',
            'pungutan',
            'bahan_baku'
        );

          return $data;
    }
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */
