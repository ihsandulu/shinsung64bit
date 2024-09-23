<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_opname extends MY_Controller
{

    private $db_kis = "";
    function __construct()
    {
        parent::__construct();
		$this->is_logedin();
		$this->lang->load('auth');
    }

    public function index_stock_opname()
    {
        
        $data['pagetitle'] = 'Stock Opname ';
        $this->loadViews('stock_opname/Index', $data);
    }
 

    public function list_data_stock_opname()
    {
        $orderstart = $_POST['start'];
        $orderlecgth = $_POST['length'];
        $myString = $_POST['search']['value'];
        $myArray = explode(';', $myString);
        $CI = &get_instance();
        $q = " Select *  from  KMJ1_MESIN_INVENTORY.dbo.v_header_stock_opname  ";
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
        $q = "Select  * , ROW_NUMBER() OVER(ORDER BY tanggal_stock_opname   desc) AS ROWNUM  from ( " . $q . " ) as tbd ";
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
           $id = $row->tanggal_stock_opname.'|'.$row->lokasi;
           $nestedData[] = '<a href="#myModalEdit" data-toggle="modal" id="edit" data-id="'.$id.'"><button type="button" class="btn btn-info btn-xs"> <i class="fa fa-edit"></i> </button></a>';
		   
            $nestedData[] = $row->tanggal_stock_opname;
            $nestedData[] = $row->lokasi;
			
			
            $data[] = $nestedData;
        }

        $sql = "Select count(*) as num  from KMJ1_MESIN_INVENTORY.dbo.v_header_stock_opname ";
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

    public function add_stock_opname()
    {
        $data['pagetitle'] = 'STOCK OPNAME'; 
        $id = $this->input->post('rowid');
		
		
		
        if($id =="new") {
          $query_lokasi = $this->db->query("SELECT * FROM KMJ1_MESIN_INVENTORY.dbo.lokasi ORDER BY lokasi ASC");
          $data['data_lokasi']  = $query_lokasi->result_array();   
		  
        } else {
           
            
        }
        //pre($data);
        $this->load->view('stock_opname/add', $data);
    }
	
	
	public function edit_stock_opname()
    {
           $key = $this->input->post('rowid');
		   $id = explode('|',$key);
		   $tanggal = trim($id[0]);
		   $lokasi = $id[1];
			
			
		  $query_lokasi = $this->db->query("SELECT * FROM KMJ1_MESIN_INVENTORY.dbo.lokasi WHERE lokasi = '$lokasi'");
          $data['data_lokasi']  = $query_lokasi->result_array(); 
		  
		  $query_header = $this->db->query("SELECT * FROM KMJ1_MESIN_INVENTORY.dbo.v_header_stock_opname WHERE lokasi = '$lokasi' AND CONVERT(VARCHAR, tanggal_stock_opname, 23) = '$tanggal'");
          $data['data_header']  = $query_header->row_array(); 
		  
		  
		   $sql = $this->db->query("SELECT * FROM KMJ1_MESIN_INVENTORY.dbo.stock_opname WHERE CONVERT(VARCHAR, tanggal_stock_opname, 23) = '$tanggal' AND lokasi = '$lokasi' AND status_opname = 'Selesai'");
           $data['stock_opname']  = $sql->result_array();  
		   

        //pre($data);
        $this->load->view('stock_opname/edit', $data);
    }
	
	
	
	public function save_stock_opname ()
    {
		$barcode = trim($this->input->post('barcode'));
		$lokasi = $this->input->post('lokasi');
		$status_stock = $this->input->post('status_stock');
		if($status_stock =="") {
			$sts = "Proses";
		} else { 
			$sts = "Selesai";
		}
		
		
		$sql_mesin = $this->db->query("SELECT * FROM KMJ1_MESIN_INVENTORY.dbo.mesin WHERE barcode = '$barcode'");
        $data['data_mesin']  = $sql_mesin->row_array();
		
		$sql_cek = $this->db->query("SELECT * FROM KMJ1_MESIN_INVENTORY.dbo.stock_opname WHERE barcode = '$barcode' AND lokasi = '$lokasi' AND status_opname = '$sts'");
        $data['data_cek']  = $sql_cek->row_array();
		
		if($data['data_mesin']) {
			if($data['data_cek']) {
			$arr = array('status'  => 'no2');
			echo json_encode($arr);
			} else {
				$data_insert['tanggal_stock_opname'] = date('Y-m-d H:i:s');
				$data_insert['barcode'] = trim($this->input->post('barcode'));
				$data_insert['lokasi'] = $this->input->post('lokasi');
				$data_insert['status_mesin'] = 'Aktif';
				$data_insert['user_input'] = $this->session->userdata('email');
				$data_insert['status_opname'] = $sts;
				
				$this->db->insert('KMJ1_MESIN_INVENTORY.dbo.stock_opname', $data_insert);
				$arr = array('status'  => 'yes');
				echo json_encode($arr);
			}
		} else {
			$arr = array('status'  => 'no');
			echo json_encode($arr);
			
		}
	}
	
	
	
	public function detail_stock_opname ()
    {
		$data['pagetitle'] = 'STOCK OPNAME'; 
        $lokasi = $this->uri->segment(3);
		//pre($lokasi);
		$lokasi_asli = str_replace("_"," ",$lokasi);
		$user = $this->session->userdata('email');
		$query_detail = $this->db->query("SELECT KMJ1_MESIN_INVENTORY.dbo.stock_opname.*, mesin.nama_mesin, mesin.brand, mesin.type, mesin.sn FROM KMJ1_MESIN_INVENTORY.dbo.stock_opname LEFT JOIN KMJ1_MESIN_INVENTORY.dbo.mesin ON stock_opname.barcode = mesin.barcode WHERE user_input = '$user' AND stock_opname.lokasi = '$lokasi_asli' AND status_opname = 'Proses'");
        $data['data_detail']  = $query_detail->result_array(); 
		//pre($data);
		if($data['data_detail']) {
			$data['status_data'] = 'ada'; 
		} else { 
			$data['status_data'] = 'tidak'; 
		}
		
		$this->load->view('stock_opname/detail', $data);
	}
	
	
	
	public function details_stock_opname ()
    {
		 
		$lokasi = $this->uri->segment(3);
		$tanggal = $this->uri->segment(4);
		//pre($lokasi);
		$lokasi_asli = str_replace("_"," ",$lokasi); 
		
		$query_detail = $this->db->query("SELECT KMJ1_MESIN_INVENTORY.dbo.stock_opname.*, mesin.nama_mesin, mesin.brand, mesin.type, mesin.sn FROM KMJ1_MESIN_INVENTORY.dbo.stock_opname LEFT JOIN KMJ1_MESIN_INVENTORY.dbo.mesin ON stock_opname.barcode = mesin.barcode WHERE stock_opname.lokasi = '$lokasi_asli' AND status_opname = 'Selesai' AND CONVERT(VARCHAR, tanggal_stock_opname, 23) = '$tanggal'");
        $data['data_detail']  = $query_detail->result_array(); 
		//pre($lokasi_asli);
		
		$this->load->view('stock_opname/details', $data);
	}
	
	
	
	public function update_status_mesin ()
    {
		$id = $this->input->post('id');
		$status_mesin = $this->input->post('status_mesin');
		$data['status_mesin'] = $status_mesin;
		$this->db->where('id', $id);
        $this->db->update('KMJ1_MESIN_INVENTORY.dbo.stock_opname', $data); 
		
		if($id) {
			$arr = array('status'  => 'yes');
			echo json_encode($arr);
		} else {
			$arr = array('status'  => 'no');
			echo json_encode($arr);
		}
	}
	
	
	public function delete_stock_opname ()
    {
            $data = $this->input->post();
            $this->db->where('id', $data['id']);
            $this->db->delete('KMJ1_MESIN_INVENTORY.dbo.stock_opname');    
    }
	
	
	
	public function confirm_stock_opname ()
    {
		$lokasi = $this->input->post('id');
		$lokasi_asli = str_replace("_"," ",$lokasi);
		$user = $this->session->userdata('email');
		
		$data_update['status_opname'] = "Selesai";
		
		$this->db->where('user_input', $user);
		$this->db->where('lokasi', $lokasi_asli);
		$this->db->where('status_opname', 'Proses');
        $this->db->update('KMJ1_MESIN_INVENTORY.dbo.stock_opname', $data_update); 
		
		if($lokasi) {
			$arr = array('status'  => 'yes');
			echo json_encode($arr);
		} else {
			$arr = array('status'  => 'no');
			echo json_encode($arr);
		}
	}
	
}
