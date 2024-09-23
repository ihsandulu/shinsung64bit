<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mesin extends MY_Controller
{

    private $db_kis = "";
    function __construct()
    {
        parent::__construct();
		$this->is_logedin();
		$this->lang->load('auth');
    }
	
	
	
	public function dashboard()
    {
        
        $data['pagetitle'] = ' ';
        $this->loadViews('mesin/dashboard', $data);
    }
	
	
    public function index_lokasi_mesin()
    {
        
        $data['pagetitle'] = 'MASTER LOKASI MESIN ';
        $this->loadViews('Lokasi_mesin/Index', $data);
    }

    public function combo_box_lokasi_mesin()
    {
             $q = " Select id , lokasi , keterangan , lokasi + ' '+ keterangan as cari  from  KMJ1_MESIN_INVENTORY.dbo.lokasi  ";
             $hasilquery = $this->db->query($q);
             $data = $hasilquery->result_array();
             return $data;

    }    

    public function list_data_lokasi_mesin()
    {
        $orderstart = $_POST['start'];
        $orderlecgth = $_POST['length'];
        $myString = $_POST['search']['value'];
        $myArray = explode(';', $myString);
        $CI = &get_instance();
        $q = " Select id , lokasi , keterangan , lokasi + ' '+ keterangan as cari  from  KMJ1_MESIN_INVENTORY.dbo.lokasi  ";
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
        $q = "Select  * , ROW_NUMBER() OVER(ORDER BY lokasi   desc) AS ROWNUM  from ( " . $q . " ) as tbd ";
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
        // log_message('debug', 'Last Query: ' . $this->db->last_query());

        // $elapsedTime = $this->db->elapsed_time('start_query', 'end_query');
        // $numericElapsedTime = (float) $elapsedTime; // or (int) $elapsedTime;
        // $execution_time = (float)  $this->db->elapsed_time('start_query', 'end_query');
        // log_slow_queries($execution_time, $this->db->last_query());
        $data = array();
        $no = $_POST['start'];
        $data = array();
        foreach ($hasilquery->result() as $row) {
            $no++;
            $nestedData = array();
            
            $nestedData[] = '<button type="button" class="btn btn-danger btn-xs" onclick="delete_data(\''.$row->id.'\');"> <i class="fa fa- fa-trash"></i> </button>            
                            <a href="#myModalAdd" data-toggle="modal" id="edit" data-id="'.$row->id.'"><button type="button" class="btn btn-info btn-xs"> <i class="fa fa-edit"></i> </button></a>';
            $nestedData[] = $row->lokasi;
            $nestedData[] = $row->keterangan;
            $data[] = $nestedData;
        }

        $sql = "Select count(*) as num  from KMJ1_MESIN_INVENTORY.dbo.lokasi ";
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

        public function add_lokasi_mesin()
    {
        $data['pagetitle'] = 'DAFTAR LOKASI MESIN'; 
        $id = $this->input->post('rowid');
        if($id =="new") {
            
        } else {
             

            // $sql = $this->db->query("SELECT * FROM KMJ1_MESIN_INVENTORY.dbo.lokasi WHERE id = '$id'");
            // $data['mesin']  = $sql->row_array();  
            
           $data['mesin']  =  execute_query_and_log("SELECT * FROM KMJ1_MESIN_INVENTORY.dbo.lokasi WHERE id = '$id'");
        }
         // pre($data);
        $this->load->view('Lokasi_mesin/add', $data);
    }

        public function exec_add_lokasi_mesin()
    {
        $data = $this->input->post();
        if($data['id']==""){
            unset($data['id']);
            $this->db->insert('KMJ1_MESIN_INVENTORY.dbo.lokasi', $data);    
        }else{
            $this->db->where('id', $data['id']);
            $this->db->update('KMJ1_MESIN_INVENTORY.dbo.lokasi', $data);    
        }
    }

    public function delete_data_lokasi_mesin()
    {
            $data = $this->input->post();
            $this->db->where('id', $data['id']);
            $this->db->delete('KMJ1_MESIN_INVENTORY.dbo.lokasi');    
    }


  



 //=====================KATEGORI MESIN ===================================//   
 public function index_kategori_mesin()
    {
        $data['pagetitle'] = 'MASTER KATEGORI MESIN ';
        $this->loadViews('kategori_mesin/Index', $data);
    }

  public function combo_box_kategori_mesin()
    {
             $q = " Select id , kategori , catatan , kategori + ' '+ catatan as cari   from  KMJ1_MESIN_INVENTORY.dbo.kategori_mesin  ";
             $hasilquery = $this->db->query($q);
             $data = $hasilquery->result_array();
             return $data;

    }    


 public function list_data_kategori_mesin()
    {
        $orderstart = $_POST['start'];
        $orderlecgth = $_POST['length'];
        $myString = $_POST['search']['value'];
        $myArray = explode(';', $myString);
        $CI = &get_instance();
        $q = " Select id , kategori , catatan , kategori + ' '+ catatan as cari  from  KMJ1_MESIN_INVENTORY.dbo.kategori_mesin  ";
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
            
            $nestedData[] = '<button type="button" class="btn btn-danger btn-xs" onclick="delete_data(\''.$row->id.'\');"> <i class="fa fa- fa-trash"></i> </button>            
                            <a href="#myModalAdd" data-toggle="modal" id="edit" data-id="'.$row->id.'"><button type="button" class="btn btn-info btn-xs"> <i class="fa fa-edit"></i> </button></a>';
            $nestedData[] = $row->kategori;
            $nestedData[] = $row->catatan;
            $data[] = $nestedData;
        }

        $sql = "Select count(*) as num  from KMJ1_MESIN_INVENTORY.dbo.kategori_mesin ";
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



        public function add_kategori_mesin()
    {
        $data['pagetitle'] = 'DAFTAR kategori MESIN'; 
        $id = $this->input->post('rowid');
        if($id =="new") {
            
        } else {
            $sql = $this->db->query("SELECT * FROM KMJ1_MESIN_INVENTORY.dbo.kategori_mesin WHERE id = '$id'");
            $data['kategori_mesin']  = $sql->row_array();  
        }
         // pre($data);
        $this->load->view('kategori_mesin/add', $data);
    }

        public function exec_add_kategori_mesin()
    {
        $data = $this->input->post();
        if($data['id']==""){
            unset($data['id']);
            $this->db->insert('KMJ1_MESIN_INVENTORY.dbo.kategori_mesin', $data);    
        }else{
            $this->db->where('id', $data['id']);
            $this->db->update('KMJ1_MESIN_INVENTORY.dbo.kategori_mesin', $data);    
        }
    }

    public function delete_data_kategori_mesin()
    {
            $data = $this->input->post();
            $this->db->where('id', $data['id']);
            $this->db->delete('KMJ1_MESIN_INVENTORY.dbo.kategori_mesin');    
    }





     //=====================QCO PLAN ===================================//   
 public function index_qco_plan()
    {
        $data['pagetitle'] = 'QCO PLAN ';
        $this->loadViews('qco_plan/Index', $data);
    }
 public function list_data_qco_plan()
    {
        $orderstart = $_POST['start'];
        $orderlecgth = $_POST['length'];
        $myString = $_POST['search']['value'];
        $myArray = explode(';', $myString);
        $CI = &get_instance();
        $q = " Select id , lokasi , lokasi as cari  from  KMJ1_MESIN_INVENTORY.dbo.qco_plan  ";
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
            
            $nestedData[] = '<button type="button" class="btn btn-danger btn-xs" onclick="delete_data(\''.$row->id.'\');"> <i class="fa fa- fa-trash"></i> </button>            
                            <a href="#myModalAdd" data-toggle="modal" id="edit" data-id="'.$row->id.'"><button type="button" class="btn btn-info btn-xs"> <i class="fa fa-edit"></i> </button></a>';
            $nestedData[] = $row->lokasi;
            $data[] = $nestedData;
        }

        $sql = "Select count(*) as num  from KMJ1_MESIN_INVENTORY.dbo.qco_plan ";
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


    public function list_data_qco_plan_detail()
    {
        $orderstart = $_POST['start'];
        $orderlecgth = $_POST['length'];
        $myString = $_POST['search']['value'];
        $myArray = explode(';', $myString);
        $id_header = $_POST['id'];
        $CI = &get_instance();
        $q = " Select id , kategori_mesin, qty , kategori_mesin as cari  from  
               KMJ1_MESIN_INVENTORY.dbo.qco_plan_detail  where id_header = '$id_header' ";
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
            
            $nestedData[] = '<button type="button" class="btn btn-danger btn-xs" onclick="delete_data_detail(\''.$row->id.'\');"> <i class="fa fa- fa-trash"></i> </button>            
                          ';
            $nestedData[] = $row->kategori_mesin;
            $nestedData[] = $row->qty;
            $data[] = $nestedData;
        }

        $sql = "Select count(*) as num  from KMJ1_MESIN_INVENTORY.dbo.qco_plan_detail ";
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



        public function add_qco_plan()
    {
        $data['pagetitle'] = 'DAFTAR QCO PLAN MESIN'; 
        $id = $this->input->post('rowid');
        if($id =="new") {
            
        } else {
            $sql = $this->db->query("SELECT * FROM KMJ1_MESIN_INVENTORY.dbo.qco_plan WHERE id = '$id'");
            $data['qco_plan']  = $sql->row_array();  
        }

        $data['kategori_mesin'] = $this->combo_box_kategori_mesin();
        $data['lokasi_mesin'] = $this->combo_box_lokasi_mesin();
          // pre($data);
        $this->load->view('qco_plan/add', $data);
    }

        public function exec_add_qco_plan()
    {
        $data = $this->input->post();
        if($data['id']==""){
            unset($data['id']);
                $x = $this->db->query("SELECT newid() as id ")->row_array();
                $data['id']= $x['id'];

                // Perform the insert
                $this->db->insert('KMJ1_MESIN_INVENTORY.dbo.qco_plan', $data); 
                echo $data['id'];

        }else{
            $this->db->where('id', $data['id']);
            $this->db->update('KMJ1_MESIN_INVENTORY.dbo.qco_plan', $data);    
        }



    }

    public function exec_add_qco_plan_detail()
    {
        $data = $this->input->post();
        
            $this->db->insert('KMJ1_MESIN_INVENTORY.dbo.qco_plan_detail', $data);    
         
    }

    public function delete_data_qco_plan()
    {
            $data = $this->input->post();
            $this->db->where('id', $data['id']);
            $this->db->delete('KMJ1_MESIN_INVENTORY.dbo.qco_plan');    
    }

    public function delete_data_qco_plan_detail()
    {
            $data = $this->input->post();
            $this->db->where('id', $data['id']);
            $this->db->delete('KMJ1_MESIN_INVENTORY.dbo.qco_plan_detail');    
    }

	
	
	
	
	//===================== DATA MESIN =============//
	public function index_mesin()
    {
        $data['pagetitle'] = 'DAFTAR MESIN ';
		
		$query_lokasi = $this->db->query("SELECT * FROM KMJ1_MESIN_INVENTORY.dbo.lokasi ORDER BY lokasi ASC");
        $data['data_lokasi']  = $query_lokasi->result_array(); 
		
        $this->loadViews('mesin/Index', $data);
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
	
	
	public function add_mesin()
    {
        $data['pagetitle'] = 'DAFTAR MESIN '; 
		$data['status_data'] = $this->input->post('status_data');
		$id = $this->input->post('rowid');
		
		$query_lokasi = $this->db->query("SELECT * FROM KMJ1_MESIN_INVENTORY.dbo.lokasi ORDER BY lokasi ASC");
        $data['data_lokasi']  = $query_lokasi->result_array(); 
		
		$query_kategori = $this->db->query("SELECT * FROM KMJ1_MESIN_INVENTORY.dbo.kategori_mesin ORDER BY kategori ASC");
        $data['data_kategori']  = $query_kategori->result_array(); 
		
		$query_model = $this->db->query("SELECT * FROM KMJ1_MESIN_INVENTORY.dbo.model ORDER BY brand_model ASC");
        $data['data_model']  = $query_model->result_array();  
		
		if($id =="new") {
		} else {
			$sql = $this->db->query("SELECT * FROM KMJ1_MESIN_INVENTORY.dbo.mesin WHERE id = '$id'");
			$data['mesin']  = $sql->row_array(); 
		}
		//pre($data);
		$this->load->view('mesin/add', $data);
    } 
	
	public function list_data_mesin()
    {
        $orderstart = $_POST['start'];
        $orderlecgth = $_POST['length'];
        $myString = $_POST['search']['value'];
        $myArray = explode(';', $myString);
        $CI = &get_instance();
        $q = " Select * from KMJ1_MESIN_INVENTORY.dbo.v_mesin ";
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
			
			
			//<a href="#myModalAdd_Copy" data-toggle="modal" id="edit" data-id="'.$row->id.'"><button type="button" class="btn btn-primary btn-xs"> <i class="fa fa-copy"></i> </button></a>'
			/*
			if(strlen($row->barcode)<=25) {
				
			} else {
				$nestedData[] = substr($row->barcode, 1, 25); 
			}
			*/
			$nestedData[] = $row->barcode; 
			$nestedData[] = $row->kategori;
			$nestedData[] = $row->nama_mesin;
			$nestedData[] = $row->brand;
			$nestedData[] = $row->type;
			$nestedData[] = $row->sn;
			$nestedData[] = $row->lokasi;

			if($row->status == "Aktif") {
				$nestedData[] = '<button type="button" class="btn btn-success btn-xs"> <i class="fa fa-check-circle"></i> '.$row->status.'</button>';
			} else if($row->status == "Perbaikan") {
				$nestedData[] = '<button type="button" class="btn btn-warning btn-xs"> <i class="fa fa-exclamation-triangle"></i> '.$row->status.'</button>';
			} else if($row->status == "Rusak") {
				$nestedData[] = '<button type="button" class="btn btn-danger btn-xs"> <i class="fa fa-close"></i> '.$row->status.'</button>';
			} else {
				$nestedData[] = '<button type="button" class="btn btn-info btn-xs"> <i class="fa  fa-clock-o"></i> '.$row->status.'</button>';
			}
			
			$nestedData[] = '			
							<a href="#myModalAdd" data-toggle="modal" id="edit" data-id="'.$row->id.'"><button type="button" class="btn btn-info btn-xs"> <i class="fa fa-edit"></i> </button></a>
							<button type="button" class="btn btn-danger btn-xs" onclick="hasil_defect_delete(\''.$row->id.'\');"> <i class="fa fa- fa-trash"></i> </button> ';
							
            $data[] = $nestedData;
        }

        $sql = "Select count(*) as num  from KMJ1_MESIN_INVENTORY.dbo.v_mesin ";
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
		$bar = trim($this->input->post('barcode'));
		
        if($data['id']==""){
            unset($data['id']);
			unset($data['status_data']);
			unset($data['brand_model']);
			
			$barcode = explode('.',$this->input->post('barcode'));
			
			$data['barcode'] = trim($this->input->post('barcode'));
			$data['brand'] = trim($barcode[1]);
			$data['type'] = trim($barcode[2]);
			$data['nama_mesin'] = trim($barcode[1]).' - '.trim($barcode[2]);
			
			$cek_barcode = $this->db->query("SELECT barcode, sn, lokasi, kategori FROM KMJ1_MESIN_INVENTORY.dbo.mesin WHERE barcode = '$bar'");
			$data_cek['barcode']  = $cek_barcode->row_array(); 
			
			if($data_cek['barcode']['sn']=="" or $data_cek['barcode']['lokasi']=="" or $data_cek['barcode']['kategori']=="") {
				$informasi = '1';
			} else {
				$informasi = '0';
			}
			
			
			
			if($data_cek['barcode']) {
				$arr = array('status'  => 'no', 'informasi' => $informasi);
				echo json_encode($arr);
			
			} else {
            	
				
				$this->db->insert('KMJ1_MESIN_INVENTORY.dbo.mesin', $data);  
				$arr = array('status'  => 'yes');
				echo json_encode($arr);  
			}
			
	    } else {
			unset($data['id']);
			unset($data['status_data']);
			unset($data['brand_model']);
			
			$brand_model = explode('|',$this->input->post('brand_model'));
			$brand = trim($brand_model[0]);
			$model = trim($brand_model[1]);
				
			$status_data = $this->input->post('status_data');
			$data['brand'] = $brand;
			$data['type'] = $model;
			$data['nama_mesin'] = $brand.' - '.$model;
				
			$this->db->where('id', $id);
			$this->db->update('KMJ1_MESIN_INVENTORY.dbo.mesin', $data);
			$arr = array('status'  => 'yes');
			echo json_encode($arr); 
        }		
    } 
	
	
	public function delete_data()
    {
     	$data = $this->input->post();
		$id = $data['id'] ;
		$this->db->delete('KMJ1_MESIN_INVENTORY.dbo.mesin',  "id = '$id'");
    }
	
	
	public function cari_brand()
	{
	 $keyword = $this->input->post('query');
	 $sql = $this->db->query("SELECT brand FROM KMJ1_MESIN_INVENTORY.dbo.brand WHERE brand  LIKE '%$keyword%' ORDER BY brand ASC")->result_array();
		if($sql) {
			foreach($sql  as $row)
			$arr_result[] = $row['brand'];	
			echo json_encode($arr_result);	
		}
		
	}
	
	
	public function cari_model()
	{
	 $keyword = $this->input->post('query');
	 $sql = $this->db->query("SELECT model, brand_model FROM KMJ1_MESIN_INVENTORY.dbo.model WHERE model  LIKE '%$keyword%' OR brand_model LIKE '%$keyword%' ORDER BY model ASC")->result_array();
		if($sql) {
			foreach($sql  as $row)
			$arr_result[] = $row['brand_model']. ' | '.$row['model'] ;	
			echo json_encode($arr_result);	
		}
		
	}
	
	//LIST DATA MODEL 
	public function index_model()
    {
        $data['pagetitle'] = 'DAFTAR MODEL DAN BRAND ';
        $this->loadViews('model/Index', $data);
    }
	 public function list_data_model()
    {
        $orderstart = $_POST['start'];
        $orderlecgth = $_POST['length'];
        $myString = $_POST['search']['value'];
        $myArray = explode(';', $myString);
        $CI = &get_instance();
        $q = " Select id , model , brand_model , model +' '+ brand_model as cari , 'KMJ1.'+replace(brand_model,' ','_')+'.'+model+'.' AS barcode   from  KMJ1_MESIN_INVENTORY.dbo.model  ";
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
            $nestedData[] = $row->id;
            $nestedData[] = $row->model;
            $nestedData[] = $row->brand_model;
			//$nestedData[] ='<a href="#" data-toggle="modal" data-target="#myModal" class="brand-model-link" onclick=panggil_modal(\''.$row->barcode.'\')>  GENERATE TEXT </a>';
			$nestedData[] ='<a href="#myModalCetak" data-toggle="modal" id="add" data-id="'.$row->barcode.'">PRINT </a>';

            $data[] = $nestedData;
        }

        $sql = "Select count(*) as num  from KMJ1_MESIN_INVENTORY.dbo.model ";
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


	public function add_model()
		{
			$data['pagetitle'] = 'DAFTAR MESIN '; 
			$id = $this->input->post('rowid');
			
			if($id =="new") {
			} else {
				$sql = $this->db->query("SELECT * FROM KMJ1_MESIN_INVENTORY.dbo.model WHERE id = '$id'");
				$data['model']  = $sql->row_array(); 
			}
			//pre($data);
			$this->load->view('model/add', $data);
		} 
	
	
	public function model_cetak()
		{
			$data['pagetitle'] = 'DAFTAR MESIN '; 
			$id = $this->input->post('rowid');
			
			$sql = $this->db->query("SELECT MAX(barcode) AS barcode_terahir FROM KMJ1_MESIN_INVENTORY.dbo.mesin WHERE barcode LIKE '%$id%'");
			$data['id'] = $id;
			$data['barcode']  = $sql->row_array();
			//pre($id);
			$this->load->view('model/cetak', $data);
		} 
	
	
	
	public function barcode()
		{
			$data['pagetitle'] = 'DAFTAR MESIN '; 
			
			$this->load->view('model/barcode', $data);
		}
	
	public function coba_barcode()
		{
			$this->load->library("EscPos.php");

			try {
					// Enter the device file for your USB printer here
				  $connector = new Escpos\PrintConnectors\FilePrintConnector("/dev/usb/lp0");
					   
					/* Print a "Hello world" receipt" */
					$printer = new Escpos\Printer($connector);
					$printer -> text("Hello World!\n");
					$printer -> cut();
			
					/* Close printer */
					$printer -> close();
			} catch (Exception $e) {
				echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
			}
		}
	
		
			
	public function save_model()
    {
		$id 			= $this->input->post('id');	
		$model 			= $this->input->post('model');
		$brand_model 	= $this->input->post('brand_model');	
		
        if($data['id']==""){
			$data['model'] = str_replace(" ","_",$model);
			$data['brand_model'] = str_replace(" ","_",$brand_model);
			
            $this->db->insert('KMJ1_MESIN_INVENTORY.dbo.model', $data);    
	    } else {
			$data['model'] = str_replace(" ","_",$model);
			$data['brand_model'] = str_replace(" ","_",$brand_model);
			
			$this->db->where('id', $id);
			$this->db->update('KMJ1_MESIN_INVENTORY.dbo.model', $data); 
        }		
    } 
	
}