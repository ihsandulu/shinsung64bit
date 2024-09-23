<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mutasi extends MY_Controller
{

    private $db_kis = "";
    function __construct()
    {
        parent::__construct();
		$this->is_logedin();
		$this->lang->load('auth');
    }

    public function index_mutasi()
    {
        
        $query_lokasi = $this->db->query("SELECT * FROM KMJ1_MESIN_INVENTORY.dbo.lokasi ORDER BY lokasi ASC");
        $data['data_lokasi']  = $query_lokasi->result_array(); 
		
		$data['pagetitle'] = 'MUTASI MESIN ';
        $this->loadViews('mutasi/Index', $data);
    }
 


public function set_lokasi_mesin()
	{	
		$data = $this->input->post();
		$lokasi = $data['lokasi'];
		//pre($lokasi);
		if($lokasi =="") {
			unset($_SESSION['lokasi']);
		} else {
			$_SESSION['lokasi'] = $lokasi;
		}
	}
	
    public function list_data_mutasi()
    {
        $orderstart = $_POST['start'];
        $orderlecgth = $_POST['length'];
        $myString = $_POST['search']['value'];
        $myArray = explode(';', $myString);
        $CI = &get_instance();
        $q = " Select *  from  KMJ1_MESIN_INVENTORY.dbo.v_mutasi  ";
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
            
            if($row->status == "Proses") {
				$nestedData[] = '<a href="#myModalAdd" data-toggle="modal" id="edit" data-id="'.$row->id.'"><button type="button" class="btn btn-info btn-xs"> <i class="fa fa-edit"></i> </button></a>';
			} else {
				$nestedData[] = '';
			}
            $nestedData[] = $row->barcode;
			$nestedData[] = $row->tanggal_mutasi;
            
			$nestedData[] = $row->brand.' '.$row->type.' '.$row->sn;
			$nestedData[] = $row->asal;
			$nestedData[] = $row->tujuan;
			//$nestedData[] = $row->status;
			if($row->status == "Selesai") {
				$nestedData[] = '<button type="button" class="btn btn-success btn-xs"> <i class="fa fa-check-circle"></i> '.$row->status.'</button>';
			} else if($row->status == "Proses") {
				$nestedData[] = '<button type="button" class="btn btn-warning btn-xs"> <i class="fa fa-spinner"></i> '.$row->status.'</button>';
			} else if($row->status == "Batal") {
				$nestedData[] = '<button type="button" class="btn btn-danger btn-xs"> <i class="fa fa-close"></i> '.$row->status.'</button>';
			}
			$nestedData[] = $row->tanggal_update;
			
			
            $data[] = $nestedData;
        }

        $sql = "Select count(*) as num  from KMJ1_MESIN_INVENTORY.dbo.v_mutasi ";
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

    public function add_mutasi()
    {
        $data['pagetitle'] = 'MUTASI MESIN'; 
        $id = $this->input->post('rowid');
		
		$query_lokasi = $this->db->query("SELECT * FROM KMJ1_MESIN_INVENTORY.dbo.lokasi ORDER BY lokasi ASC");
        $data['data_lokasi']  = $query_lokasi->result_array(); 
		
        if($id =="new") {
            
        } else {
           $sql = $this->db->query("SELECT * FROM KMJ1_MESIN_INVENTORY.dbo.v_mutasi WHERE id = '$id'");
           $data['mutasi']  = $sql->row_array();  
            
        }
         // pre($data);
        $this->load->view('mutasi/add', $data);
    }
	
	
	public function cek_barcode ()
    {
		$barcode = trim($this->input->post('barcode'));
		
		$sql_mesin = $this->db->query("SELECT * FROM KMJ1_MESIN_INVENTORY.dbo.mesin WHERE barcode = '$barcode'");
        $data['data_mesin']  = $sql_mesin->row_array(); 
		$lokasi_awal = $data['data_mesin']['lokasi'];
		$mesin = $data['data_mesin']['brand']. ' - '.$data['data_mesin']['type'].' - '.$data['data_mesin']['sn'];
		if($data['data_mesin']){
			$arr = array('status'  => 'yes', 'lokasi_awal' => $lokasi_awal, 'mesin' => $mesin );
			echo json_encode($arr);
		} else {
			$arr = array('status'  => 'no');
			echo json_encode($arr);
		}
       
    }
	
	
	public function save_mutasi ()
    {
		$id = trim($this->input->post('id'));
		
		if($id =="") {
			$barcode = trim($this->input->post('barcode'));
			$sql_mesin = $this->db->query("SELECT * FROM KMJ1_MESIN_INVENTORY.dbo.mesin WHERE barcode IN (SELECT barcode FROM KMJ1_MESIN_INVENTORY.dbo.mutasi WHERE barcode = '$barcode' AND status = 'Proses')");
			$data['data_mesin']  = $sql_mesin->row_array(); 
			
			
			if($this->input->post('lokasi_awal') == $this->input->post('lokasi')) {
				$arr = array('status'  => 'no');
				echo json_encode($arr);
				
			} else if($data['data_mesin']) {
				$arr = array('status'  => 'no2');
				echo json_encode($arr);
				
			} else {
				$barcode = trim($this->input->post('barcode'));
				$data_insert['tanggal_mutasi'] = date('Y-m-d H:i:s');
				$data_insert['barcode'] = trim($this->input->post('barcode'));
				$data_insert['asal'] = $this->input->post('lokasi_awal');
				$data_insert['tujuan'] = $this->input->post('lokasi');
				$data_insert['user_input'] = $this->session->userdata('email');
				$data_insert['status'] = 'Proses';
				
				$this->db->insert('KMJ1_MESIN_INVENTORY.dbo.mutasi', $data_insert);
				$arr = array('status'  => 'yes');
				echo json_encode($arr);
			}
			
		} else {
			
			$status = $this->input->post('status');
			if($status == "Selesai") {
				$data_update['status'] = $this->input->post('status');
				$data_update['user_update'] = $this->session->userdata('email');
				$data_update['tanggal_update'] = date('Y-m-d H:i:s');
				
				$data_update_mesin['lokasi'] = $this->input->post('lokasi');
				
				$this->db->where('id', $id);
            	$this->db->update('KMJ1_MESIN_INVENTORY.dbo.mutasi', $data_update);
				
				$barcode = trim($this->input->post('barcode'));
				$this->db->where('barcode', $barcode);
            	$this->db->update('KMJ1_MESIN_INVENTORY.dbo.mesin', $data_update_mesin);
				$arr = array('status'  => 'yes');
				echo json_encode($arr);
			} else {
				$data_update['status'] = $this->input->post('status');
				$data_update['user_update'] = $this->session->userdata('email');
				$data_update['tanggal_update'] = date('Y-m-d H:i:s');
				
				$this->db->where('id', $id);
            	$this->db->update('KMJ1_MESIN_INVENTORY.dbo.mutasi', $data_update);
				$arr = array('status'  => 'yes');
				echo json_encode($arr);
			}
		}
	}
}