<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Log
 */
class Ordersheet extends MY_Controller
{
	
	function __construct()
	{
        parent::__construct();
		$this->is_logedin();
	    $this->load->helper(array('form', 'url'));
	    $this->db_kis  = $this->load->database('kis', TRUE);
        $this->db_OS  = $this->load->database('OrderSheet', TRUE);
        
		$this->load->helper('url');
		$this->load->library(['ion_auth', 'form_validation']);
	  
	}


	public function HdMdUpdate()
	{	
		$data['pagetitle'] = "ORDERSHEET UPDATE HD MD";
		//pre($data);
		$this->loadViews('Ordersheet/ViewHdMdUpdate', $data);	
    }


    public function HdMdUpdateHistory()
	{	
		$data['pagetitle'] = "HD MD HISTORY";
		//pre($data);
		$this->loadViews('Ordersheet/ViewHdMdHistory', $data);	
    }

    public function HdMdUpdateAction()
	{	 $user = $this->ion_auth->user()->row_array() ; 
		$data = $_POST;
		pre($_POST);
        $this->db_kis->where('kj', $data['kj']);
        $this->db_kis->where('seasoninerp', $data['seasoninerp']);
        $this->db_kis->where('productCode', $data['productCode']);
        $this->db_kis->delete('KMJ1_KIS_ORDER_SHEET.dbo.OrdersheetHdMd');
        // echo $this->db_kis->affected_rows(); 
         $data['UserInsert']= $user['ip_address']."|".$user['email'];
         $this->db_kis->insert('KMJ1_KIS_ORDER_SHEET.dbo.OrdersheetHdMd', $data);
        // $data['schedule']= $this->db_kis->query($sql)->row_array();  
             
		
	}
}