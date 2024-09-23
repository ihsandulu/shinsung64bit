<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qa_pon extends MY_Controller
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
        $data['pagetitle'] = 'DAFTAR LINE SEWING END LINE  PON ';
        $this->loadViews('Qa_pon/Index', $data);
        //$this->loadViews("Qa_end_line/Index", $this->global, NULL, NULL);
    }
	
	
	
	public function list_data()
    {
        $data['pagetitle'] = 'LIST DATA P O N ';
        $this->loadViews('Qa_pon/list_data', $data);
        //$this->loadViews("Qa_end_line/Index", $this->global, NULL, NULL);
    }
	
	

    public function daftar_schedule($line_) {
       	$tanggal = date('Y-m-d');
	    $sql = "
			SELECT  
				(select top 1  status_aql from  pon_qa where pon_qa.id_scedule =  v_schedule_produksi_2021_hari_ini.[ID] AND tanggal_upload = '$tanggal') AS status,
				v_schedule_produksi_2021_hari_ini.[ID],   
				v_schedule_produksi_2021_hari_ini.[tampilkan_target] ,
				v_schedule_produksi_2021_hari_ini.[KANAAN_PO],
				v_schedule_produksi_2021_hari_ini.[STYLE_NO],
				v_schedule_produksi_2021_hari_ini.[ITEM],
				v_schedule_produksi_2021_hari_ini.[COLOR],
				v_schedule_produksi_2021_hari_ini.[QTY_ORDER],
				v_schedule_produksi_2021_hari_ini.[FOB], 
				CONVERT(date, v_schedule_produksi_2021_hari_ini.DELIVERY)  GAC,
				v_schedule_produksi_2021_hari_ini.[QTY_PLAN],
				v_schedule_produksi_2021_hari_ini.[DES]
				
			FROM 
				KIS.KMJ1_KIS_2019_PREPARE.dbo.v_schedule_produksi_2021_hari_ini 
			WHERE 
				LINE_SEWING = '$line_' 
			ORDER BY 
				tampilkan_target DESC
		" ; 
        
        $data['schedule']= $this->db->query($sql)->result_array(); 
         // pre($data);
        $data['line'] = $line_;
        $data['pagetitle'] = "DAFTAR SCHEDULE LINE $line_";
        $this->loadViews('Qa_pon/daftar_schedule', $data);
    }


    public function upload_style_img() { 
        //$data['pagetitle'] = "INSPECT BAGS LINE  DEFECT LIST";
        //$data= array();
        
		$tanggal = date('Y-m-d');
        $line = $this->uri->segment(3);
		$id = $this->uri->segment(4);
        $sql = $this->db->query("SELECT * FROM pon_image WHERE pon_image.id_schedule = '$id' AND pon_image.line = '$line' AND pon_image.tanggal_upload = '$tanggal'");
        $data['data']  = $sql->result_array();  
       // pre($data['data']);
	   
	   	$sql = "select  [ID]      ,[KANAAN_PO]      ,[BUYER]      ,[STYLE_NO]      ,[ITEM]      ,[COLOR]      ,[QTY_ORDER]      ,[FOB]      ,  CONVERT(date, DELIVERY)  GAC          ,[QTY_PLAN]      , LINE_SEWING               ,[DES] from Schedule_produksi where LINE_SEWING = '$line' and id = '$id' " ; 
		$data['schedule'] = $this->db_kis->query($sql)->row_array(); 
	
		//pre($data['schedule']);
		$sql_ = $this->db->query("SELECT * FROM reference_fml ORDER BY jam1 ASC");
        $data['data_reference']  = $sql_->result_array();
		
		$sql_defect = $this->db->query("SELECT * FROM daftar_defect ORDER BY kode ASC");
        $data['data_defect']  = $sql_defect->result_array();
		
        //pre($data);
        
        
        $this->load->view('Qa_pon/upload_style_img', $data);
    }
	
	public function cek_jenis_fml() { 
		$tanggal = date('Y-m-d'); 
		$jenis = $this->input->get('jenis_fml');
		$line = $this->input->get('line');
		$id_schedule = $this->input->get('id_schedule');
		
		$sql_fml = $this->db->query("SELECT * FROM reference_fml WHERE jenis = '$jenis'");
        $data['data_fml']  = $sql_fml->row_array(); 
		
		$jenis_fml = $data['data_fml']['jenis'];
		$jam1 = $data['data_fml']['jam1'];
		$jam2 = $data['data_fml']['jam2'];
		
		$data_output = $this->db->query(" exec hasil_produksi_perjam_target_per_idschedule  $id_schedule ,'$tanggal' , $line  ");
        $data['data_output']  = $data_output->row_array();
		$output = $data['data_output']['JAM_'.$jam1.''] + $data['data_output']['JAM_'.$jam2.''];
		
		$sql_sample = $this->db->query("SELECT sample_size, accept, reject FROM ref_inspection where ".$output." between lot_min and lot_max ");
        $data['data_sample']  = $sql_sample->row_array(); 
		$sample_ = $data['data_sample']['sample_size'];
		$accept = $data['data_sample']['accept'];
		
		if($sample_ =="" or $sample_ =="0") {
			$sample = 0;
		} else {
			$sample = $sample_;
		}
		
		//pre($data);
		//pre($output);
		
		$sql_cek_pon = $this->db->query("SELECT * FROM pon_qa where id_scedule = '$id_schedule' AND tanggal_upload = '$tanggal' AND jenis_fml = '$jenis'");
		
		$data['data_cek_pon']  = $sql_cek_pon->row_array(); 
		$qty_defect = $data['data_cek_pon']['qty_defect'];
		

		
		$data = array(
            'qty_output'	 =>  $output,
			'qty_sample' 	 =>  $sample,
			'accept' 	 	 =>  $accept,
			'qty_defect' 	 =>  $qty_defect,
            );
		echo json_encode($data);
	}
	
    public function sp_hasil_produksi_perjam_target_per_idschedule($line , $id_schedule  , $tanggal   ) {
      
        $data = $this->db->query(" hasil_produksi_perjam_target_per_idschedule  $id_schedule ,'$tanggal' , $line  ")->result_array();
        echo json_encode($data);
    }



    public function list_image() { 
        //$data['pagetitle'] = "INSPECT BAGS LINE  DEFECT LIST";
        $tanggal = date('Y-m-d');
        $line = $this->uri->segment(3);
		$id = $this->uri->segment(4);
		$jenis = $this->uri->segment(5);
		
        $sql = $this->db->query("SELECT * FROM pon_image WHERE pon_image.id_schedule = '$id' AND pon_image.line = '$line' AND pon_image.tanggal_upload = '$tanggal' AND jenis_fml = '$jenis'");
        $data['data']  = $sql->result_array();  
 
 
 		$sql_cek_pon = $this->db->query("SELECT id, img_style, jenis_fml  FROM pon_qa where id_scedule = '$id' AND tanggal_upload = '$tanggal' AND jenis_fml = '$jenis'");
 		$data['data_pon']  = $sql_cek_pon->row_array();  
		//pre($data);
		
		$sql_measurement = $this->db->query("SELECT * FROM measurement_image WHERE measurement_image.id_schedule = '$id' AND measurement_image.line = '$line' AND measurement_image.tanggal_upload = '$tanggal' AND jenis_fml = '$jenis'");
        $data['data_measurement']  = $sql_measurement->result_array();  
		//pre($data);
		
        $this->load->view('Qa_pon/list_image', $data);
    }
	
	public function list_defect() { 
        //$data['pagetitle'] = "INSPECT BAGS LINE  DEFECT LIST";
        $tanggal = $this->uri->segment(5);
        $line = $this->uri->segment(3);
		$id = $this->uri->segment(4);
		$jenis = $this->uri->segment(6);
        $sql = $this->db->query("exec [sp_defectrate_pon_perjenisfml] $line , $id  ,'$tanggal', '$jenis' ;");
        $data['data']  = $sql->result_array();  
 
        $this->load->view('Qa_pon/list_defect', $data);
    }
    
	
	  public function AJAX_insert_data_img_pon()
	{
		date_default_timezone_set("Asia/Jakarta");
		$id_scedule = $this->input->post('id_scedule');
		$img_style = $this->input->post('img_style');
		$tanggal = date('Y-m-d');
		$time = date('H-i-s');
		$color = $this->input->post('color');
		$jenis_fml = $this->input->post('jenis_fml');
		$line = $this->input->post('line');
		
		$imageLoader = $this->input->post('imageLoader');
		
		$sql = "SELECT  * from Schedule_produksi where LINE_SEWING = '$line' and ID = '$id_scedule' " ; 
		$dt['schedule'] = $this->db_kis->query($sql)->row_array();  

		$user = $this->ion_auth->user()->row_array(); 
				
		if($dt['schedule']) {
			  
			 
			
			  $data = array();
			  $dt_schedule = $dt['schedule'] ;
			  
			  $data['id_scedule'] = $id_scedule; 
			  $data['kanaan_po'] = $dt_schedule['KANAAN_PO'];
			  $data['style'] = $dt_schedule['STYLE_NO'];
			  $data['color'] = $dt_schedule['COLOR'];
			  $data['qty_order'] = $dt_schedule['QTY_ORDER'];
			  $data['line'] = $line;
			  $data['tanggal'] = $tanggal;
			  $data['user_id'] = $user['user_id'];
			  $data['nama_user'] =  $user['first_name'] .' '.$user['last_name'];
			  $data['tanggal_upload'] = $tanggal;
			  
			  $data['des'] = $dt_schedule['DES'];
			  
			  $data['jenis_fml'] = $this->input->post('jenis_fml');
			  $data['qty_output'] = $this->input->post('qty_output');
			  $data['qty_sample'] = $this->input->post('qty_sample');
			  $data['qty_defect'] = $this->input->post('qty_defect');
			  
			  
			  //Status AQL
			$hasil_produksi_aql = $this->input->post('qty_output');
			$qty_defect_aql     = $this->input->post('qty_defect');
			$sql_cek_qty_aql = $this->db->query("SELECT * FROM ref_inspection WHERE $hasil_produksi_aql BETWEEN lot_min AND lot_max");
        	$data_aql['data_cek_qty_aql']  = $sql_cek_qty_aql->row_array(); 
			$accept = $data_aql['data_cek_qty_aql']['accept'];
			if($qty_defect_aql > $accept) {
				$status_aql = 'Reject';
			} else {
				$status_aql = 'Accept';
			}
			
			$data['status_aql'] = $status_aql;
			
			  if($imageLoader !="") {
				  
				  //Image
			 
				  $data_image['id_schedule'] = $id_scedule; 
				  $data_image['line'] = $line;
				  $data_image['style'] = $dt_schedule['STYLE_NO'];
				  
				  $data_image['tanggal_upload'] = $tanggal;
				  $data_image['color'] = $color;
				  $data_image['kode_defect'] = $this->input->post('kode_defect');
				  $data_image['jenis_fml'] = $this->input->post('jenis_fml');
			  
				  $file = md5(uniqid()).'_'.$jenis_fml.'_'.$tanggal.'_'.$time.'.jpg';
				  $uri =  substr($img_style,strpos($img_style,",")+1);
				  file_put_contents('./uploads/pon/'.$file, base64_decode($uri));
				  $data_image['img_style'] = $file;+
				  $this->db->insert('pon_image', $data_image);
				  
			  } else {
				  $data_image['img_style'] = '';
			  }
			
			$sql_cek_pon = $this->db->query("SELECT id, id_scedule, img_style FROM pon_qa where id_scedule = '$id_scedule' AND tanggal_upload = '$tanggal' AND jenis_fml = '$jenis_fml'");
			
			
			$cek_id = $sql_cek_pon->num_rows();
			if ($cek_id > 0) {
				$data_pon['data_cek_pon']  = $sql_cek_pon->row_array();
				$id = $data_pon['data_cek_pon']['id'];
				
				$data_update_pon['qty_defect']  = $this->input->post('qty_defect');
				$this->db->where('id', $id);
            	$this->db->update('pon_qa', $data_update_pon);
				//$this->db->insert('pon_image', $data_image);	
			} else {
				$this->db->insert('pon_qa', $data);
				
				
			}
		}
	
	}




//MEASUREMENT 
 public function AJAX_insert_data_img_pon_measurement()
	{
		date_default_timezone_set("Asia/Jakarta");
		
		$id_schedule = $this->input->post('id_schedule');
		$img_style = $this->input->post('img_style');
		$jenis_fml = $this->input->post('jenis_fml');
		
		$tanggal = date('Y-m-d');
		$time = date('H-i-s');
		$line = $this->input->post('line');
		
		$imageLoader2 = $this->input->post('imageLoader2');
		
		$sql = "SELECT  * from Schedule_produksi where LINE_SEWING = '$line' and ID = '$id_schedule' " ; 
		$dt['schedule'] = $this->db_kis->query($sql)->row_array();  

		$user = $this->ion_auth->user()->row_array(); 
				
		if($dt['schedule']) {
			
			  $data = array();
			  if($imageLoader2 !="") {
				  
				  //Image
				  
				 $sql_cek_pon = $this->db->query("SELECT ISNULL(img_style,'') AS img_style, style FROM pon_qa where id_scedule = '$id_schedule' AND jenis_fml = '$jenis_fml' AND tanggal_upload = '$tanggal'");
				 $data_pon['data_cek_pon']  = $sql_cek_pon->row_array(); 
				 $img = $data_pon['data_cek_pon']['img_style'];
				 $style = $data_pon['data_cek_pon']['style'];
				 
				if ($img == '') {
					  $file = md5(uniqid()).'_'.$jenis_fml.'_'.$tanggal.'_'.$time.'.jpg';
					  $uri =  substr($img_style,strpos($img_style,",")+1);
					  file_put_contents('./uploads/pon/'.$file, base64_decode($uri));
					 
					  $data_image['img_style'] = $file;+
					  
					  $this->db->where('id_scedule', $id_schedule);
					  $this->db->where('jenis_fml', $jenis_fml);
					  $this->db->where('line', $line);
					  $this->db->where('tanggal_upload', $tanggal);
					  $this->db->update('pon_qa', $data_image);
					  
				 } else {
					  
					  $file = md5(uniqid()).'_'.$jenis_fml.'_'.$tanggal.'_'.$time.'.jpg';
					  $uri =  substr($img_style,strpos($img_style,",")+1);
					  file_put_contents('./uploads/measurement/'.$file, base64_decode($uri));
					  $data_image['img_style'] = $file;+
					  
					  $data_image['id_schedule'] = $id_schedule; 
					  $data_image['line'] = $line;
					  $data_image['style'] = $style;
					  $data_image['tanggal_upload'] = $tanggal;
					  $data_image['jenis_fml'] = $jenis_fml;
					  
					  $this->db->insert('measurement_image', $data_image);
				 }
				  
			  } else {
				  
			  }
			
		}
	
	}
	


	
	 public function delete_image() { 
        $data = $this->input->post();
		$id = $data['id'] ; 
		
		$sql = $this->db->query("SELECT img_style FROM pon_image WHERE id = '$id'");
		$cek_id = $sql->num_rows();
		if ($cek_id > 0) {
				$data['data']  = $sql->row_array(); 
				$gambar = $data['data']['img_style'];
				//pre($gambar);
				unlink(realpath('./uploads/pon/'.$gambar));
		}
		//pre($id);
		$this->db->delete('pon_image',  "id = '$id'" );
        
    }
	
	public function delete_image_measurement_pon() { 
        $data = $this->input->post();
		$id = $data['id'] ; 
		
		$sql = $this->db->query("SELECT img_style FROM pon_qa WHERE id = '$id'");
		$cek_id = $sql->num_rows();
		if ($cek_id > 0) {
				$data['data']  = $sql->row_array(); 
				$gambar = $data['data']['img_style'];
				//pre($gambar);
				unlink(realpath('./uploads/pon/'.$gambar));
		}
		//pre($id);
		$this->db->query("UPDATE pon_qa SET img_style = '' WHERE id = '$id'");
        
    }
			
	public function delete_image_measurement() { 
			$data = $this->input->post();
			$id = $data['id'] ; 
			
			$sql = $this->db->query("SELECT img_style FROM measurement_image WHERE id = '$id'");
			$cek_id = $sql->num_rows();
			if ($cek_id > 0) {
					$data['data']  = $sql->row_array(); 
					$gambar = $data['data']['img_style'];
					//pre($gambar);
					unlink(realpath('./uploads/measurement/'.$gambar));
			}
			//pre($id);
			$this->db->delete('measurement_image',  "id = '$id'" );
			
		}

	public function datatable_list_data()
    {
        $orderstart = $_POST['start'];
        $orderlecgth = $_POST['length'];
        $myString = $_POST['search']['value'];
        $myArray = explode(';', $myString);
        $CI = &get_instance();
        $q = " Select * from v_pon_qa ";
        $qdef = $q;
        if (count($myArray) > 0) {
            for ($index = 0; $index < count($myArray); $index++) {
                $q = "Select * from ( " . $q . " ) as tbd ";
                $q .= " where cari like '%" . trim($myArray[$index]) . "%'";
            }
        } else {
            $q = "Select * from ( " . $q . " ) as tbd ";
            $q .= " where cari like '%" . $myString . "%'";
        }
        $qcountfilter = $q;
        $q = "Select  * , ROW_NUMBER() OVER(ORDER BY id   desc) AS ROWNUM  from ( " . $q . " ) as tbd ";
        if ($orderstart == 0) {
            $q = "Select * from ($q) as d where ROWNUM between " . $orderstart . " and " .
                $orderlecgth . " order by rownum";
        } else {
            $order2 = $orderstart + 1;
            $q = "Select * from ($q) as d where ROWNUM between " . $order2 . " and " . $orderstart *
                2 . " order by rownum";
        }
        //print_r($q); exit;
        $hasilquery = $CI->db->query($q);
        $data = array();
        $no = $_POST['start'];
        $data = array();
        foreach ($hasilquery->result() as $row) {
            $no++;
            $nestedData = array();
			
			$nestedData[] = '<button type="button" class="btn btn-danger btn-xs" onclick="pon_delete(\''.$row->id.'\');"> <i class="fa fa- fa-trash"></i> </button> 			
							
							<a href="#myModalDetail" data-toggle="modal" id="detail" data-id="'.$row->id.'"><button type="button" class="btn btn-primary btn-xs"> <i class="fa fa-search"></i> </button></a>';
							
			if($row->status_aql == "Accept") {
				$status_aql = '<button type="button" class="btn btn-success btn-xs"> <i class="fa fa-check-circle"></i> PASS</button>';
			} else if($row->status_aql == "Double Check") {
				$status_aql = '<button type="button" class="btn btn-success btn-xs"> <i class="fa fa-check-circle"></i> PASS (FR)</button>';
			} else {
				$status_aql = '<button type="button" class="btn btn-danger btn-xs"> <i class="fa fa-history"></i> FAIL </button>';
			}
			
			$nestedData[] = $status_aql;
			
			$nestedData[] = $row->line;
			$nestedData[] = $row->tanggal_upload;
			$nestedData[] = $row->kanaan_po;
			$nestedData[] = $row->style;
			$nestedData[] = $row->color;
			$nestedData[] = $row->qty_order;
			
			$nestedData[] = $row->des;
			$nestedData[] = $row->jenis_fml;
			$nestedData[] = $row->qty_output;
			$nestedData[] = $row->qty_sample;
			$nestedData[] = $row->qty_defect;
			$nestedData[] = $row->qty_defect2;
			
            $data[] = $nestedData;
        }

        $sql = "Select count(*) as num  from v_pon_qa ";
        $record_total = $CI->db->query($sql)->row()->num;
        $sql = "Select count(*) as num  from ($qcountfilter) as c   ";
        $recordsFiltered = $CI->db->query($sql)->row()->num;

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $record_total,  
            "recordsFiltered" => $recordsFiltered, 
            "data" => $data,
        );

        //output dalam format JSON
        echo json_encode($output);
    }
	
	
	
	
	 public function delete_pon() { 
        $data = $this->input->post();
		$id = $data['id'] ; 
		
		$sql_cek = $this->db->query("SELECT * FROM pon_qa WHERE id = '$id'");
        $data_aql['sql_cek']  = $sql_cek->row_array(); 
		
		$id_ = $data_aql['sql_cek']['id_scedule'];
			
			
		//$sql = $this->db->query("SELECT img_style FROM pon_image WHERE id_schedule = '$id_'");
		//$cek_id = $sql->num_rows();
		//if ($cek_id > 0) {
				//$data['data']  = $sql->row_array(); 
				//$gambar = $data['data']['img_style'];
				//pre($gambar);
				//unlink(realpath('./uploads/pon/'.$gambar));
		//}
		//pre($id);
		$this->db->delete('pon_image',  "id_schedule = '$id_'" );
		$this->db->delete('pon_qa',  "id = '$id'" );
        
    }
	
	
	public function detail_pon()
    {
        $data['pagetitle'] = 'DETAIL PON '; 
		$id = $this->input->post('rowid');
		
		$sql = $this->db->query("SELECT * FROM pon_qa WHERE id = '$id'");
		$data['pon']  = $sql->row_array();
		
		$id_schedule = $data['pon']['id_scedule']; 
		$line = $data['pon']['line']; 
		$tanggal_upload = $data['pon']['tanggal_upload']; 
		$jenis_fml = $data['pon']['jenis_fml']; 
		
		 $sql_ = $this->db->query("exec [sp_defectrate_pon_perjenisfml] $line , $id_schedule  ,'$tanggal_upload', '$jenis_fml' ;");
        $data['data']  = $sql_->result_array();
	
	
		$sql_image = $this->db->query("SELECT pon_image.*, daftar_defect.keterangan FROM pon_image LEFT JOIN daftar_defect ON pon_image.kode_defect = daftar_defect.kode WHERE pon_image.id_schedule = '$id_schedule' AND pon_image.line = '$line' AND pon_image.tanggal_upload = '$tanggal_upload' AND jenis_fml = '$jenis_fml'");
        $data['data_image']  = $sql_image->result_array(); 
		
		//pre($data);
		
		$sql_measurement = $this->db->query("SELECT * FROM measurement_image WHERE measurement_image.id_schedule = '$id_schedule' AND measurement_image.line = '$line' AND measurement_image.tanggal_upload = '$tanggal_upload' AND jenis_fml = '$jenis_fml'");
        $data['data_measurement']  = $sql_measurement->result_array();  



		$this->load->view('Qa_pon/detail_pon', $data);
    } 
	


	public function double_check_pon()
    {
        $data['pagetitle'] = 'DETAIL PON '; 
		$id = $this->input->post('rowid');
		
		//pre($data);
		$this->load->view('Qa_pon/double_check_pon', $data);
    } 
	
	
	public function update_qty_defect()
    {
		$data = array();
		$id = $this->input->post('id');
		$qty_output = $this->input->post('qty_output');
		$qty_defect = $this->input->post('qty_defect2');
		
		if($qty_defect > $qty_output) {
			
			$arr = array('status'  => '2');
			echo json_encode($arr);
			
		
		} else {
			$data_update['qty_defect2'] = $qty_defect; 
			$data_update['status_aql'] = 'Double Check';  
			$this->db->where('id', $id);
			$this->db->update('pon_qa', $data_update);
			
			$arr = array('status'  => '1');
			echo json_encode($arr);
		}
    } 
}