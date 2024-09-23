<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mekanik extends MY_Controller
{

    private $db_kis = "";
    function __construct()
    {
        parent::__construct();
		$this->is_logedin();
		$this->lang->load('auth');
    }

    public function index()
    {
        $data['pagetitle'] = 'DAFTAR MESIN ';
        $this->loadViews('Mekanik/Index', $data);
    }
	
	
	public function add_mesin()
    {
        $data['pagetitle'] = 'DAFTAR MESIN '; 
		$id = $this->input->post('rowid');
		
		if($id =="new") {
			$data['form'] = 'add';
		} else {
			$sql = $this->db->query("SELECT * FROM mesin WHERE id = '$id'");
			$data['mesin']  = $sql->row_array(); 
			$data['form'] = 'update'; 
		}
		//pre($data);
		$this->load->view('Mekanik/add', $data);
    } 
	
	public function list_data()
    {
        $orderstart = $_POST['start'];
        $orderlecgth = $_POST['length'];
        $myString = $_POST['search']['value'];
        $myArray = explode(';', $myString);
        $CI = &get_instance();
        $q = " Select * from v_mesin ";
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
			
			$nestedData[] = '<button type="button" class="btn btn-danger btn-xs" onclick="hasil_defect_delete(\''.$row->id.'\');"> <i class="fa fa- fa-trash"></i> </button> 			
							<a href="#myModalAdd" data-toggle="modal" id="edit" data-id="'.$row->id.'"><button type="button" class="btn btn-info btn-xs"> <i class="fa fa-edit"></i> </button></a>';
			$nestedData[] = $row->barcode;
			$nestedData[] = $row->nama_mesin;
			$nestedData[] = $row->brand;
			$nestedData[] = $row->type;
			$nestedData[] = $row->sn;
			$nestedData[] = $row->location;

			if($row->status == "Aktif") {
				$nestedData[] = '<button type="button" class="btn btn-success btn-xs"> <i class="fa fa-check-circle"></i> '.$row->status.'</button>';
			} else if($row->status == "Perbaikan") {
				$nestedData[] = '<button type="button" class="btn btn-warning btn-xs"> <i class="fa fa-exclamation-triangle"></i> '.$row->status.'</button>';
			} else if($row->status == "Rusak") {
				$nestedData[] = '<button type="button" class="btn btn-danger btn-xs"> <i class="fa fa-close"></i> '.$row->status.'</button>';
			} else {
				$nestedData[] = '<button type="button" class="btn btn-info btn-xs"> <i class="fa  fa-clock-o"></i> '.$row->status.'</button>';
			}
			
			
            $data[] = $nestedData;
        }

        $sql = "Select count(*) as num  from v_mesin ";
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

	
	
	public function save_mesin()
    {
     	$data = $this->input->post();
		$id = $this->input->post('id');
        if($data['id']==""){
            unset($data['id']);
            $this->db->insert('mesin', $data);    
        }else{
            
			unset($data['id']);
			$this->db->where('id', $id);
            $this->db->update('mesin', $data);    
        }
    } 
	
	public function delete_data()
    {
     	$data = $this->input->post();
		$id = $data['id'] ;
		$this->db->delete('mesin',  "id = '$id'");
    }
	
	
}