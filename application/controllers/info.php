<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class info extends MY_Controller 
{
	
	public function index()
	{
		$data['pagetitle'] = 'DASHBOARD PANGGILAN ';
		$this->load->view('panggilan/index', $data);
	}
	
	public function panggilan()
	{

		$group = array('adminzz');
		 if ($this->ion_auth->in_group($group)) 
		{
			$id = $this->uri->segment(3);
			$data['pagetitle'] = 'DASHBOARD PANGGILAN ';
			$data['id'] = $id;
			$this->load->view('panggilan/datawithio', $data);
			
		}else
		{
			$data['pagetitle'] = 'DASHBOARD PANGGILAN ';
			$id = $this->uri->segment(3);
			   // pre($id);
			$where = "where  convert(date , jam)  = convert(date , getdate())  ";
			if($id != "") {
				$where = " where  convert(date , jam)  = convert(date , getdate())  and group_dept = '$id'";
			}  
			// echo $where; 
			$sql = "SELECT inspect_v2_panggilan.*, ref_panggilan.group_dept FROM inspect_v2_panggilan
					LEFT JOIN ref_panggilan ON  inspect_v2_panggilan.panggilan_nama = ref_panggilan.nama
					$where
					";
					//   echo $sql ;
			$data['panggilan'] = $this->db->query($sql)->result_array();
			//pre($data);
			$this->load->view('panggilan/data', $data);
		}


		
	}
	
}