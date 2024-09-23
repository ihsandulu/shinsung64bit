<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qa_cfa extends MY_Controller
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
        $data['pagetitle'] = 'DAFTAR ORDER SHEET';
        $this->loadViews('Qa_cfa/Index', $data);
        //$this->loadViews("Qa_end_line/Index", $this->global, NULL, NULL);
    }
	
	
	public function list_data_order_sheet()
    {
        $orderstart = $_POST['start'];
        $orderlecgth = $_POST['length'];
        $myString = $_POST['search']['value'];
        $myArray = explode(';', $myString);
        $CI = &get_instance();
        $q = " Select * from view_order_sheet_buyer ";
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
        $q = "Select  * , ROW_NUMBER() OVER(ORDER BY DELIVERY   asc) AS ROWNUM  from ( " . $q . " ) as tbd ";
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
			
			// $nestedData[] = '<button type="button" class="btn btn-danger btn-xs" onclick="pon_delete(\''.$row->id.'\');"> <i class="fa fa- fa-trash"></i> </button> 			
							
			// 				<a href="#myModalDetail" data-toggle="modal" id="detail" data-id="'.$row->id.'"><button type="button" class="btn btn-primary btn-xs"> <i class="fa fa-search"></i> </button></a>';
							
			// if($row->status_aql == "Accept") {
			// 	$status_aql = '<button type="button" class="btn btn-success btn-xs"> <i class="fa fa-check-circle"></i> PASS</button>';
			// } else if($row->status_aql == "Double Check") {
			// 	$status_aql = '<button type="button" class="btn btn-success btn-xs"> <i class="fa fa-check-circle"></i> PASS (FR)</button>';
			// } else {
			// 	$status_aql = '<button type="button" class="btn btn-danger btn-xs"> <i class="fa fa-history"></i> FAIL </button>';
			// }
			
			$nestedData[] = '<a href="'.base_url().'Qa_cfa/upload_style_img/'.$row->AUTONUMBER.'"><button type="button" class="btn btn-danger btn-md"> <i class="fa fa-file-image-o"> </i> </button></a>';
			
			$nestedData[] = $row->buyer;
			
			$nestedData[] = $row->KANAAN_PO;
			$nestedData[] = $row->BUYER_PO_NO;
			$nestedData[] = $row->STYLE_NO;
			$nestedData[] = $row->ITEM;
			
			$nestedData[] = $row->COLOR;
			$nestedData[] = $row->DES;
			$nestedData[] = $row->QTY;
			$nestedData[] = $row->FOB;
			$nestedData[] = $row->DELIVERY;
			

			
			
            $data[] = $nestedData;
        }

        $sql = "Select count(*) as num  from view_order_sheet_buyer  ";
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
	
	
	
	    public function upload_style_img() { 
        //$data['pagetitle'] = "INSPECT BAGS LINE  DEFECT LIST";
        //$data= array();
        $id = $this->uri->segment(3);
		
        $sql = $this->db->query("SELECT * FROM view_order_sheet_buyer WHERE AUTONUMBER = '$id'");
        $data['data']  = $sql->row_array();  
       //pre($data['data']);
	   
	   $sql_ = $this->db->query("SELECT * FROM cfa_qa WHERE AUTONUMBER = '$id'");
        $data['data_cfa']  = $sql_->row_array(); 
		
	   	//pre($data);
		$sql_ = $this->db->query("SELECT * FROM reference_fml ORDER BY jam1 ASC");
        $data['data_reference']  = $sql_->result_array();
		
		$sql_defect = $this->db->query("SELECT * FROM daftar_defect ORDER BY kode ASC");
        $data['data_defect']  = $sql_defect->result_array();
		
		//
		$output_ = $data['data_cfa']['qty_output']; 
		
		if($output_ =="") {
			$output = 0;
		} else {
			$output = $output_;
		}
		$sql_sample = $this->db->query("SELECT sample_size, accept, reject FROM ref_inspection where ".$output." between lot_min and lot_max ");
        $data['data_sample']  = $sql_sample->row_array(); 
		$accept   = $data['data_sample']['accept'];
		$data['status'] = $accept;
		
        //pre($data);
		//pre($data['status']);
        
        
        $this->load->view('Qa_cfa/upload_style_img', $data);
    }
	
	
	public function auto_insert() { 
		$tanggal = date('Y-m-d'); 
		$id = $this->input->get('id');
		$output = $this->input->get('output');
	
		$sql_sample = $this->db->query("SELECT sample_size, accept, reject FROM ref_inspection where ".$output." between lot_min and lot_max ");
        $data['data_sample']  = $sql_sample->row_array(); 
		$sample = $data['data_sample']['sample_size'];
		$accept = $data['data_sample']['accept'];
		
		$data = array(
			'qty_sample' 	 =>  $sample,
			'accept' 	 	 =>  $accept,
            );
		echo json_encode($data);
	}
	
	public function list_defect() { 
        //$data['pagetitle'] = "INSPECT BAGS LINE  DEFECT LIST";

        $id = $this->uri->segment(3);
        $sql = $this->db->query("exec [sp_defectrate_cfa] $id;");
        $data['data']  = $sql->result_array();  
 
        $this->load->view('Qa_cfa/list_defect', $data);
    }
	
	
	
	public function list_image() { 
        //$data['pagetitle'] = "INSPECT BAGS LINE  DEFECT LIST";
        $AUTONUMBER = $this->uri->segment(3);

		//cfa
        $sql = $this->db->query("SELECT * FROM cfa_image WHERE cfa_image.id_cfa = '$AUTONUMBER'");
        $data['data']  = $sql->result_array();  
	
		//measurement
		$sql_measurement = $this->db->query("SELECT * FROM measurement_image_cfa WHERE measurement_image_cfa.AUTONUMBER = '$AUTONUMBER'");
        $data['data_measurement']  = $sql_measurement->result_array();  
		//pre($data);
		
        $this->load->view('Qa_cfa/list_image', $data);
    }
	
	
	public function AJAX_insert_data_img_cfa()
	{
		date_default_timezone_set("Asia/Jakarta");
		$tanggal = date('Y-m-d');
		$time = date('H-i-s');
		$AUTONUMBER = $this->input->post('AUTONUMBER');
		$imageLoader = $this->input->post('imageLoader');
		$img_style = $this->input->post('img_style');
		
		$sql = "SELECT  * from view_order_sheet_buyer where AUTONUMBER = '$AUTONUMBER'" ; 
		$dt['dt_order_sheet'] = $this->db->query($sql)->row_array();  

		$user = $this->ion_auth->user()->row_array(); 
				
		if($dt['dt_order_sheet']) {
			  $data = array();
			  $order_sheet = $dt['dt_order_sheet'] ;
			  $data['AUTONUMBER'] 		= $AUTONUMBER; 
			  $data['KANAAN_PO'] 		= $order_sheet['KANAAN_PO'];
			  $data['BUYER_PO_NO'] 		= $order_sheet['BUYER_PO_NO'];
			  $data['STYLE_NO'] 		= $order_sheet['STYLE_NO'];
			  $data['ITEM'] 			= $order_sheet['ITEM'];
			  $data['COLOR'] 			= $order_sheet['COLOR'];
			  $data['SIZE'] 			= $order_sheet['SIZE'];
			  $data['QTY'] 				= $order_sheet['QTY'];
			  $data['PP_QTY'] 			= $order_sheet['PP_QTY'];
			  $data['FOB'] 				= $order_sheet['FOB'];
			  $data['AMOUNT'] 			= $order_sheet['AMOUNT'];
			  $data['DELIVERY'] 		= $order_sheet['DELIVERY'];
			  $data['DES'] 				= $order_sheet['DES'];
			  $data['qty_output'] 		= $this->input->post('qty_output');
			  $data['qty_sample'] 		= $this->input->post('qty_sample');
			  $data['qty_defect'] 		= $this->input->post('qty_defect');
			  
			  $data['tanggal_upload'] 	= $tanggal;
			  $data['user_id'] 			= $user['user_id'];
			  $data['nama_user'] 		= $user['first_name'] .' '.$user['last_name'];
			  $data['BUYER'] 			= $order_sheet['buyer'];
			  
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
			 
				  $data_image['id_cfa'] = $AUTONUMBER; 
				  
				  $data_image['tanggal_upload'] = $tanggal;
				  $data_image['kode_defect'] = $this->input->post('kode_defect');
			  
				  $file = md5(uniqid()).'_'.$tanggal.'_'.$time.'.jpg';
				  $uri =  substr($img_style,strpos($img_style,",")+1);
				  file_put_contents('./uploads/cfa/'.$file, base64_decode($uri));
				  $data_image['img_style'] = $file;+
				  $this->db->insert('cfa_image', $data_image);
				  
			  } else {
				  $data_image['img_style'] = '';
			  }
			
			$sql_cek_cfa = $this->db->query("SELECT * FROM cfa_qa where AUTONUMBER = '$AUTONUMBER'");
			
			
			$cek_id = $sql_cek_cfa->num_rows();
			//pre($cek_id); 
			if ($cek_id > 0) {
				$data_update_cfa['qty_output'] 		= $this->input->post('qty_output');
			  	$data_update_cfa['qty_sample'] 		= $this->input->post('qty_sample');
			  	$data_update_cfa['qty_defect'] 		= $this->input->post('qty_defect');
				$this->db->where('AUTONUMBER', $AUTONUMBER);
            	$this->db->update('cfa_qa', $data_update_cfa);
				//$this->db->insert('pon_image', $data_image);	
			} else {
				$this->db->insert('cfa_qa', $data);
				
				
			}
		}
	
	}



	public function delete_image_measurement() { 
		$data = $this->input->post();
		$id = $data['id'] ; 
			
		$sql = $this->db->query("SELECT img_style FROM measurement_image_cfa WHERE id = '$id'");
		$cek_id = $sql->num_rows();
		if ($cek_id > 0) {
			$data['data']  = $sql->row_array(); 
			$gambar = $data['data']['img_style'];
			//pre($gambar);
			unlink(realpath('./uploads/measurement_cfa/'.$gambar));
		}
			//pre($id);
		$this->db->delete('measurement_image_cfa',  "id = '$id'" );	
	}
	
	public function delete_cfa() { 
		$data = $this->input->post();
		$id = $data['id'] ; 
			
		$sql = $this->db->query("SELECT img_style FROM cfa_image WHERE id = '$id'");
		$cek_id = $sql->num_rows();
		if ($cek_id > 0) {
			$data['data']  = $sql->row_array(); 
			$gambar = $data['data']['img_style'];
			//pre($gambar);
			unlink(realpath('./uploads/cfa/'.$gambar));
		}
			//pre($id);
		$this->db->delete('cfa_image',  "id = '$id'" );	
	}
		




//MEASUREMENT 
 public function AJAX_insert_data_img_cfa_measurement()
	{
		date_default_timezone_set("Asia/Jakarta");
		
		$AUTONUMBER = $this->input->post('AUTONUMBER');
		$tanggal = date('Y-m-d');
		$time = date('H-i-s');
		$img_style = $this->input->post('img_style');
		$imageLoader2 = $this->input->post('imageLoader2');
		
		
			
		$file = md5(uniqid()).'_'.$tanggal.'_'.$time.'.jpg';
		 $uri =  substr($img_style,strpos($img_style,",")+1);
		file_put_contents('./uploads/measurement_cfa/'.$file, base64_decode($uri));
		
		$data_image['img_style'] = $file;+	  
		$data_image['AUTONUMBER'] = $AUTONUMBER; 
		$data_image['tanggal_upload'] = $tanggal;
					  
		$this->db->insert('measurement_image_cfa', $data_image);
					  
	
	}
	
	public function list_data_cfa()
    {
        $data['pagetitle'] = 'DATA CFA ';
        $this->loadViews('Qa_cfa/list_data', $data);
        //$this->loadViews("Qa_end_line/Index", $this->global, NULL, NULL);
    }
	
	public function datatable_cfa()
    {
        $orderstart = $_POST['start'];
        $orderlecgth = $_POST['length'];
        $myString = $_POST['search']['value'];
        $myArray = explode(';', $myString);
        $CI = &get_instance();
        $q = " Select * from view_cfa_qa ";
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
        $q = "Select  * , ROW_NUMBER() OVER(ORDER BY id   asc) AS ROWNUM  from ( " . $q . " ) as tbd ";
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
			
			// $nestedData[] = '<button type="button" class="btn btn-danger btn-xs" onclick="pon_delete(\''.$row->id.'\');"> <i class="fa fa- fa-trash"></i> </button> 			
							
			// 				<a href="#myModalDetail" data-toggle="modal" id="detail" data-id="'.$row->id.'"><button type="button" class="btn btn-primary btn-xs"> <i class="fa fa-search"></i> </button></a>';
							
			// if($row->status_aql == "Accept") {
			// 	$status_aql = '<button type="button" class="btn btn-success btn-xs"> <i class="fa fa-check-circle"></i> PASS</button>';
			// } else if($row->status_aql == "Double Check") {
			// 	$status_aql = '<button type="button" class="btn btn-success btn-xs"> <i class="fa fa-check-circle"></i> PASS (FR)</button>';
			// } else {
			// 	$status_aql = '<button type="button" class="btn btn-danger btn-xs"> <i class="fa fa-history"></i> FAIL </button>';
			// }
			
			
			
			$nestedData[] = '<button type="button" class="btn btn-danger btn-xs" onclick="cfa_delete(\''.$row->id.'\');"> <i class="fa fa- fa-trash"></i> </button> 			
							
							<a href="#myModalDetail" data-toggle="modal" id="detail" data-id="'.$row->id.'"><button type="button" class="btn btn-primary btn-xs"> <i class="fa fa-search"></i> </button></a>';
							
			if($row->status_aql == "Accept") {
				$status_aql = '<button type="button" class="btn btn-success btn-xs"> <i class="fa fa-check-circle"></i> PASS</button>';
			} else if($row->status_aql == "Double Check") {
				$status_aql = '<button type="button" class="btn btn-success btn-xs"> <i class="fa fa-check-circle"></i> PASS (FR)</button>';
			} else {
				$status_aql = '<button type="button" class="btn btn-danger btn-xs"> <i class="fa fa-history"></i> FAIL </button>';
			}
			
			$nestedData[] = $status_aql;
			$nestedData[] = $row->tanggal_upload;
			$nestedData[] = $row->BUYER;
			
			$nestedData[] = $row->KANAAN_PO;
			$nestedData[] = $row->BUYER_PO_NO;
			$nestedData[] = $row->STYLE_NO;
			$nestedData[] = $row->ITEM;
			
			$nestedData[] = $row->COLOR;
			$nestedData[] = $row->DES;
			$nestedData[] = $row->QTY;
			$nestedData[] = $row->FOB;
			$nestedData[] = $row->DELIVERY;
			
			$nestedData[] = $row->qty_output;
			$nestedData[] = $row->qty_sample;
			$nestedData[] = $row->qty_defect;
			$nestedData[] = $row->qty_defect2;
			

			
			
            $data[] = $nestedData;
        }

        $sql = "Select count(*) as num  from view_cfa_qa  ";
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
	
	 public function cfa_delete() { 
        $data = $this->input->post();
		$id = $data['id'] ; 
		
		$sql_cek = $this->db->query("SELECT * FROM cfa_qa WHERE id = '$id'");
        $data_aql['sql_cek']  = $sql_cek->row_array(); 
		
		$id_ = $data_aql['sql_cek']['AUTONUMBER'];
			
			
		//$sql = $this->db->query("SELECT img_style FROM pon_image WHERE id_schedule = '$id_'");
		//$cek_id = $sql->num_rows();
		//if ($cek_id > 0) {
				//$data['data']  = $sql->row_array(); 
				//$gambar = $data['data']['img_style'];
				//pre($gambar);
				//unlink(realpath('./uploads/pon/'.$gambar));
		//}
		//pre($id);
		$this->db->delete('cfa_qa',  "id = '$id'" );
		$this->db->delete('cfa_image',  "id_cfa = '$id_'" );
		$this->db->delete('measurement_image_cfa',  "AUTONUMBER = '$id_'" );
        
    }


	public function detail_cfa()
    {
        $data['pagetitle'] = 'DETAIL CFA '; 
		$id = $this->input->post('rowid');
		
		$sql = $this->db->query("SELECT * FROM cfa_qa WHERE id = '$id'");
		$data['cfa']  = $sql->row_array();
		
		$AUTONUMBER = $data['cfa']['AUTONUMBER']; 
		
		$sql = $this->db->query("exec [sp_defectrate_cfa] $AUTONUMBER");
        $data['data']  = $sql->result_array(); 

		$sql_image = $this->db->query("SELECT * FROM cfa_image LEFT JOIN daftar_defect ON cfa_image.kode_defect = daftar_defect.kode WHERE id_cfa = '$AUTONUMBER' ");
        $data['data_image']  = $sql_image->result_array(); 
		
		$sql_measurement = $this->db->query("SELECT * FROM measurement_image_cfa LEFT JOIN daftar_defect ON measurement_image_cfa.kode_defect = daftar_defect.kode WHERE AUTONUMBER = '$AUTONUMBER'");
        $data['data_measurement']  = $sql_measurement->result_array();  

		//pre($data);

		$this->load->view('Qa_cfa/detail_cfa', $data);
    } 
	


	public function double_check_cfa()
    {
        $data['pagetitle'] = 'DETAIL CFA '; 
		$id = $this->input->post('rowid');
		
		//pre($data);
		$this->load->view('Qa_cfa/double_check_cfa', $data);
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
			$this->db->update('cfa_qa', $data_update);
			
			$arr = array('status'  => '1');
			echo json_encode($arr);
		}
    } 
	
	
}