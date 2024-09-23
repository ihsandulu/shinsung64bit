<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class  Telegrambot extends MY_Controller {
	function __construct()
	{
		parent::__construct();
		$this->is_logedin();
		$this->load->library(['ion_auth', 'form_validation']);
		$this->lang->load('auth');
	}

	public function index()
	{
		$data['pagetitle'] = 'DAFTAR USER TELEGRAM';
		 $this->loadViews('Telegrambot/Index', $data);
	}

	 public function add_Telegrambot()
    {
        $data['pagetitle'] = 'DAFTAR TELEGRAM'; 
        $id = $this->input->post('rowid');
        if($id =="new") {
            
        } else { 
           $data['mesin']  =  execute_query_and_log("SELECT * FROM kis.kmj_cuti.dbo.t_telegram_bot WHERE id = '$id'");
        }
         // pre($data);
        $this->load->view('Telegrambot/add', $data);
    }

        public function exec_add_Telegrambot()
    {
        $data = $this->input->post();
        if($data['id']==""){
            unset($data['id']);
            $this->db->insert('kis.kmj_cuti.dbo.t_telegram_bot', $data);    
        }else{
            $this->db->where('id', $data['id']);
            $this->db->update('kis.kmj_cuti.dbo.t_telegram_bot', $data);    
        }
    }

    public function delete_data_Telegrambot()
    {
            $data = $this->input->post();
            $this->db->where('id', $data['id']);
            $this->db->delete('kis.kmj_cuti.dbo.t_telegram_bot');    
    }


	public function list_data_telegram()
    {
        $orderstart = $_POST['start'];
        $orderlecgth = $_POST['length'];
        $myString = $_POST['search']['value'];
        $myArray = explode(';', $myString);
        $CI = &get_instance();
        $q = " Select id , nik       ,id_telegram       ,nama  , nik + ' '+ nama as cari  from  kis.kmj_cuti.dbo.t_telegram_bot  ";
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
        $q = "Select  * , ROW_NUMBER() OVER(ORDER BY nama   desc) AS ROWNUM  from ( " . $q . " ) as tbd ";
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
            $nestedData[] = $row->nama . ' '.$row->nik;
            $nestedData[] = $row->id_telegram;
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

}