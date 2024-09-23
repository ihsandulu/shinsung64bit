<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Log
 */
class Hasil_inputan extends MY_Controller
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
		$data['pagetitle'] = 'HASIL INPUTAN HARI INI ';
		$this->loadViews('Hasil_inputan/Index', $data);
	}

	public function EditOutputHD()
	{
		$data['pagetitle'] = 'HASIL INPUTAN OUTPUT HD HARI INI ';
		$this->loadViews('Hasil_inputan/EditOutputHD', $data);
	}

	public function EditOutputPacking()
	{
		$data['pagetitle'] = 'HASIL INPUTAN OUTPUT PACKING HARI INI ';
		$this->loadViews('Hasil_inputan/EditOutputPacking', $data);
	}

	public function EditOutputQC()
	{
		$data['pagetitle'] = 'HASIL INPUTAN OUTPUT QC HARI INI ';
		$this->loadViews('Hasil_inputan/EditOutputQC', $data);
	}

	public function EditOutputIroning()
	{
		$data['pagetitle'] = 'HASIL INPUTAN OUTPUT IRONING HARI INI ';
		$this->loadViews('Hasil_inputan/EditOutputIroning', $data);
	}
	
	
	public function hasil_defect_delete()
	{
		$data = $this->input->post();
		$id = $data['id'] ; 
		//pre($id);
		$this->db->delete('inspect_v2',  "id = '$id'" );	
	}


	public function hasil_ok_delete()
	{
		$data = $this->input->post();
		$id = $data['id'] ; 
		//pre($id);
		$this->db->delete('inspect_v2',  "id = '$id'" );	
	}
	
	public function update_data_detail()
	{
		$data = $this->input->post(null, true);
		$id = $data['id']; 
		$qty = $data['qty'];
		$data['TANGGAL_HASIL'] = date("Y-m-d H:i:s", strtotime($data['TANGGAL_HASIL']));
		unset($data['id']);
		//pre($id);

	    if ($id) {
         $this->db->where('id', $id);
		 $this->db->update('sewing_hasil_produksi', $data);
        }
		
		//$this->db->delete('inspect_v2',  "id = '$id'" );	
	}

	public function update_data_detail_ironing()
	{
		$data = $this->input->post(null, true);
		$id = $data['id']; 
		$qty = $data['qty'];
		$data['TANGGAL_HASIL'] = date("Y-m-d H:i:s", strtotime($data['TANGGAL_HASIL']));
		unset($data['id']);
		//pre($id);

	    if ($id) {
         $this->db->where('id', $id);
		 $this->db->update('sewing_hasil_ironing', $data);
        }
		
		//$this->db->delete('inspect_v2',  "id = '$id'" );	
	}

	public function update_data_detail_packing()
	{
		$data = $this->input->post(null, true);
		$id = $data['id']; 
		$qty = $data['qty'];
		$data['TANGGAL_HASIL'] = date("Y-m-d H:i:s", strtotime($data['TANGGAL_HASIL']));
		unset($data['id']);
		//pre($id);

	    if ($id) {
			$this->db->where('id', $id);
			$this->db->update('sewing_hasil_packing', $data);
        }
		//$this->db->delete('inspect_v2',  "id = '$id'" );	
	}
	
	public function update_data_detail_hd()
	{
		$data = $this->input->post(null, true);
		$id = $data['id']; 
		$qty = $data['qty'];
		unset($data['id']);
		//pre($id);

	    if ($id) {
         $this->db->where('id', $id);
		 $this->db->update('sewing_hasil_output_hd', $data);
        }
		
		//$this->db->delete('inspect_v2',  "id = '$id'" );	
	}
	
	public function pindah_style()
	{
		$data['pagetitle'] = '-';
		$rowid = $this->input->post('rowid');
		
		$kode_line = explode('_',$rowid);
		$ID = trim($kode_line[0]);
		$line = trim($kode_line[1]);
		$data['id'] = $ID;
		$data['line'] = $line;
		
		
		$sql_hd = "SELECT * FROM v_hasil_output_hd WHERE id = '$ID'"; 
		
		$data['data_hd'] = $this->db->query($sql_hd)->row_array(); 
		
		
		$sql = "select  v_schedule_produksi_2021_hari_ini.[ID]  ,   [tampilkan_target] ,[KANAAN_PO]      ,[STYLE_NO]      ,[ITEM]      ,[COLOR]      ,[QTY_ORDER]      ,[FOB]      ,  CONVERT(date, DELIVERY)  GAC          ,[QTY_PLAN]                     ,[DES]
		from
		KMJ1_KIS_2019_PREPARE.dbo.v_schedule_produksi_2021_hari_ini 
		where LINE_SEWING = '$line' order by tampilkan_target desc" ; 
		
		$data['schedule'] = $this->db_kis->query($sql)->result_array(); 
		//pre($data);
		$this->load->view('Hasil_inputan/pindah_style', $data);
	}
	
	
	public function confirm_pindah_style()
	{
		$rowid = $this->input->post('id');
		$kode_id = explode('_',$rowid);
		$id_hasil = trim($kode_id[0]);
		$id_schedule = trim($kode_id[1]);
		
		$sql = "select  * from KMJ1_KIS_2019_PREPARE.dbo.v_schedule_produksi_2021_hari_ini where ID = '$id_schedule'" ; 
		$dt['schedule'] = $this->db_kis->query($sql)->row_array();  
		
		if($dt['schedule']) {
			  $data = array();
			  $dt_schedule = $dt['schedule'];
			  $data['KANAAN_PO'] = $dt_schedule['KANAAN_PO'];
			  $data['STYLE_NO'] = $dt_schedule['STYLE_NO'];
			  $data['ITEM'] = $dt_schedule['ITEM'];
			  $data['COLOR'] = $dt_schedule['COLOR'];
			
			  $data['QTYGLOBAL'] = $dt_schedule['QTY_ORDER'];
			  $data['ID_ORDER'] = $dt_schedule['ID_ORDER'];
			  $data['DES'] = $dt_schedule['DES'];
			  $data['GAC'] = $dt_schedule['DELIVERY'];
			  $data['FOB'] = $dt_schedule['FOB'];
			  $data['CMT']= $dt_schedule['FOB']/10;
			  $data['id_schedule'] = $dt_schedule['ID'];
			 
			  $this->db->where('id', $id_hasil);
        	  $this->db->update('sewing_hasil_output_hd', $data);
		
		
				$arr = array('status'  => 'ok');
				echo json_encode($arr);
		} else {
			$arr = array('status'  => 'no');
				echo json_encode($arr);
		}
	}
	
	public function pindah_style_ironing()
	{
		$data['pagetitle'] = '-';
		$rowid = $this->input->post('rowid');
		
		$kode_line = explode('_',$rowid);
		$ID = trim($kode_line[0]);
		$line = trim($kode_line[1]);
		$data['id'] = $ID;
		$data['line'] = $line;
		
		
		$sql_packing = "SELECT * FROM v_hasil_output_ironing WHERE id = '$ID'"; 
		
		$data['data_packing'] = $this->db->query($sql_packing)->row_array(); 
		
		
		$sql = "select  v_schedule_produksi_2021_hari_ini.[ID]  ,   [tampilkan_target] ,[KANAAN_PO]      ,[STYLE_NO]      ,[ITEM]      ,[COLOR]      ,[QTY_ORDER]      ,[FOB]      ,  CONVERT(date, DELIVERY)  GAC          ,[QTY_PLAN]                     ,[DES]
		from
		v_schedule_produksi_2021_hari_ini 
		where LINE_SEWING = '$line' order by tampilkan_target desc" ; 
		
		$data['schedule'] = $this->db_kis->query($sql)->result_array(); 
		//pre($data);
		$this->load->view('Hasil_inputan/pindah_style_ironing', $data);
	}

	public function pindah_style_packing()
	{
		$data['pagetitle'] = '-';
		$rowid = $this->input->post('rowid');
		
		$kode_line = explode('_',$rowid);
		$ID = trim($kode_line[0]);
		$line = trim($kode_line[1]);
		$data['id'] = $ID;
		$data['line'] = $line;
		
		
		$sql_packing = "SELECT * FROM v_hasil_output_packing WHERE id = '$ID'"; 
		
		$data['data_packing'] = $this->db->query($sql_packing)->row_array(); 
		
		
		$sql = "select  v_schedule_produksi_2021_hari_ini.[ID]  ,   [tampilkan_target] ,[KANAAN_PO]      ,[STYLE_NO]      ,[ITEM]      ,[COLOR]      ,[QTY_ORDER]      ,[FOB]      ,  CONVERT(date, DELIVERY)  GAC          ,[QTY_PLAN]                     ,[DES]
		from
		v_schedule_produksi_2021_hari_ini 
		where LINE_SEWING = '$line' order by tampilkan_target desc" ; 
		
		$data['schedule'] = $this->db_kis->query($sql)->result_array(); 
		//pre($data);
		$this->load->view('Hasil_inputan/pindah_style_packing', $data);
	}
	
	
	public function pindah_style2()
	{
		$data['pagetitle'] = '-';
		$rowid = $this->input->post('rowid');
		
		$kode_line = explode('_',$rowid);
		$ID = trim($kode_line[0]);
		$line = trim($kode_line[1]);
		$data['id'] = $ID;
		$data['line'] = $line;
		
		
		$sql_packing = "SELECT * FROM v_hasil_output WHERE id = '$ID'"; 
		
		$data['data_packing'] = $this->db->query($sql_packing)->row_array(); 
		
		
		$sql = "select  v_schedule_produksi_2021_hari_ini.[ID]  ,   [tampilkan_target] ,[KANAAN_PO]      ,[STYLE_NO]      ,[ITEM]      ,[COLOR]      ,[QTY_ORDER]      ,[FOB]      ,  CONVERT(date, DELIVERY)  GAC          ,[QTY_PLAN]                     ,[DES]
		from
		v_schedule_produksi_2021_hari_ini 
		where LINE_SEWING = '$line' order by tampilkan_target desc" ; 
		
		$data['schedule'] = $this->db_kis->query($sql)->result_array(); 
		//pre($data);
		$this->load->view('Hasil_inputan/pindah_style2', $data);
	}
	
	
	public function confirm_pindah_style2()
	{
		$rowid = $this->input->post('id');
		$kode_id = explode('_',$rowid);
		$id_hasil = trim($kode_id[0]);
		$id_schedule = trim($kode_id[1]);
		
		$sql = "select  * from v_schedule_produksi_2021_hari_ini where ID = '$id_schedule'" ; 
		$dt['schedule'] = $this->db_kis->query($sql)->row_array();  
		
		if($dt['schedule']) {
			  $data = array();
			  $dt_schedule = $dt['schedule'];
			  $data['KANAAN_PO'] = $dt_schedule['KANAAN_PO'];
			  $data['STYLE_NO'] = $dt_schedule['STYLE_NO'];
			  $data['ITEM'] = $dt_schedule['ITEM'];
			  $data['COLOR'] = $dt_schedule['COLOR'];
			
			  $data['QTYGLOBAL'] = $dt_schedule['QTY_ORDER'];
			  $data['ID_ORDER'] = $dt_schedule['ID_ORDER'];
			  $data['DES'] = $dt_schedule['DES'];
			  $data['GAC'] = $dt_schedule['DELIVERY'];
			  $data['FOB'] = $dt_schedule['FOB'];
			  $data['CMT']= $dt_schedule['FOB']/10;
			  $data['id_schedule'] = $dt_schedule['ID'];
			 
			  $this->db->where('id', $id_hasil);
        	  $this->db->update('sewing_hasil_produksi', $data);
		
		
				$arr = array('status'  => 'ok');
				echo json_encode($arr);
		} else {
			$arr = array('status'  => 'no');
				echo json_encode($arr);
		}
	}

	public function confirm_pindah_style_ironing()
	{
		$rowid = $this->input->post('id');
		$kode_id = explode('_',$rowid);
		$id_hasil = trim($kode_id[0]);
		$id_schedule = trim($kode_id[1]);
		
		$sql = "select  * from v_schedule_produksi_2021_hari_ini where ID = '$id_schedule'" ; 
		$dt['schedule'] = $this->db_kis->query($sql)->row_array();  
		
		if($dt['schedule']) {
			  $data = array();
			  $dt_schedule = $dt['schedule'];
			  $data['KANAAN_PO'] = $dt_schedule['KANAAN_PO'];
			  $data['STYLE_NO'] = $dt_schedule['STYLE_NO'];
			  $data['ITEM'] = $dt_schedule['ITEM'];
			  $data['COLOR'] = $dt_schedule['COLOR'];
			
			  $data['QTYGLOBAL'] = $dt_schedule['QTY_ORDER'];
			  $data['ID_ORDER'] = $dt_schedule['ID_ORDER'];
			  $data['DES'] = $dt_schedule['DES'];
			  $data['GAC'] = $dt_schedule['DELIVERY'];
			  $data['FOB'] = $dt_schedule['FOB'];
			  $data['CMT']= $dt_schedule['FOB']/10;
			  $data['id_schedule'] = $dt_schedule['ID'];
			 
			  $this->db->where('id', $id_hasil);
        	  $this->db->update('sewing_hasil_ironing', $data);

			$arr = array('status'  => 'ok');
			echo json_encode($arr);
		} else {
			$arr = array('status'  => 'no');
			echo json_encode($arr);
		}
	}

	public function confirm_pindah_style_packing()
	{
		$rowid = $this->input->post('id');
		$kode_id = explode('_',$rowid);
		$id_hasil = trim($kode_id[0]);
		$id_schedule = trim($kode_id[1]);
		
		$sql = "select  * from v_schedule_produksi_2021_hari_ini where ID = '$id_schedule'" ; 
		$dt['schedule'] = $this->db_kis->query($sql)->row_array();  
		
		if($dt['schedule']) {
			  $data = array();
			  $dt_schedule = $dt['schedule'];
			  $data['KANAAN_PO'] = $dt_schedule['KANAAN_PO'];
			  $data['STYLE_NO'] = $dt_schedule['STYLE_NO'];
			  $data['ITEM'] = $dt_schedule['ITEM'];
			  $data['COLOR'] = $dt_schedule['COLOR'];
			
			  $data['QTYGLOBAL'] = $dt_schedule['QTY_ORDER'];
			  $data['ID_ORDER'] = $dt_schedule['ID_ORDER'];
			  $data['DES'] = $dt_schedule['DES'];
			  $data['GAC'] = $dt_schedule['DELIVERY'];
			  $data['FOB'] = $dt_schedule['FOB'];
			  $data['CMT']= $dt_schedule['FOB']/10;
			  $data['id_schedule'] = $dt_schedule['ID'];
			 
			  $this->db->where('id', $id_hasil);
        	  $this->db->update('sewing_hasil_packing', $data);
		
			$arr = array('status'  => 'ok');
			echo json_encode($arr);
		} else {
			$arr = array('status'  => 'no');
				echo json_encode($arr);
		}
	}
}

/* End of file Log.php */
/* Location: ./application/controllers/Log.php */
