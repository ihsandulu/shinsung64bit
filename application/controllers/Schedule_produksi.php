<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule_produksi extends MY_Controller 
{
	
  function __construct()
    {
        parent::__construct();
        $this->is_logedin();
    }
	
	public function entry_data()
  {
  	$data = array();

    $ID = $this->uri->segment(3);
    if ($ID) {
      $this->global['pagetitle'] = 'EDIT PRODUCTION SCHEDULE DATA';
      $this->db->where('ID', $ID);
      $data = $this->db->get('Schedule_produksi')->row_array();
      // pre($data);
    } else {
      $this->global['pagetitle'] = 'PRODUCTION SCHEDULE DATA ENTRY';
    }
    
    
    $this->loadViews("Schedule_produksi/entry_data_schedule_produksi", $this->global, $data, NULL);
  }

   public function index()
  {
  	$data = array();
    $btn = '<a class="btn btn-success btn-sm" href="'.base_url().'/Schedule_produksi/entry_data"><i class="fa fa-plus" aria-hidden="true"></i> ADD NEW </a>
    ';
    $this->global['pagetitle'] = 'PRODUCTION SCHEDULE DATA LIST '. $btn;
    $q = "Select top 1 * from Schedule_produksi ";
    $data['header'] = $this->db->query($q)->result_array();
    $this->loadViews("Schedule_produksi/list_data_schedule_produksi", $this->global, $data, NULL);
  }
  public function indexb()
  {
  	$data = array();
    $btn = '<a class="btn btn-success btn-sm" href="'.base_url().'/Schedule_produksi/entry_data"><i class="fa fa-plus" aria-hidden="true"></i> ADD NEW </a>
    ';
    $this->global['pagetitle'] = 'PRODUCTION SCHEDULE DATA LIST '. $btn;
    $q = "Select top 1 * from Schedule_produksi ";
    $data['header'] = $this->db->query($q)->result_array();
    $this->loadViews("Schedule_produksi/list_data_schedule_produksib", $this->global, $data, NULL);
  }
  public function ajax_insert_schedule_produksi()
	{
		$ID = $this->input->post('ID');

		$data = $this->input->post();
		// pre($data);
		// die();
		if ($ID) {
			// EDIT
			$this->db->where('ID', $ID);
			unset($data['ID']);
			$this->db->update('Schedule_produksi', $data);
		} else {
			// NEW
			unset($data['ID']);
			$RESULT = $this->db->insert('Schedule_produksi', $data);
			
		}
	}

 public function gridSchedule(){
 		  $orderstart = $_POST['start'];
        $orderlecgth = $_POST['length'];
        $myString = $_POST['search']['value'];
        $whereharini = ""; 
        // pre( $myString);
        // echo (strpos(strtolower (trim($myString)) ,"today"));
        if (strpos($myString, 'today') !== false)  
        {
          $whereharini = " and CONVERT(date , GETDATE()) 
          BETWEEN TANGGAL_SEWING_START AND TANGGAL_SEWING_END   "; 
          $myString = str_replace("today" , "" , $myString);
        }

        $myArray = explode(';', $myString);
        $q = " Select *, CAST(LINE_SEWING AS INT)AS line , LINE_SEWING + ' ' + kanaan_po + ' ' + BUYER + ' ' + STYLE_NO + ' ' + ITEM + ' '
        + convert( nvarchar(10), TANGGAL_SEWING_START , 126 )  + ' ' + 
        convert( nvarchar(10), TANGGAL_SEWING_END , 126 )  + ' '
          as cari  from Schedule_produksi where 1 = 1 $whereharini ";
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
                $orderlecgth . " order by line ASC";
        } else {
            $order2 = $orderstart + 1;
            $q = "Select * from ($q) as d where ROWNUM between " . $order2 . " and " . $orderstart *
                2 . " order by line ASC";
        }
        //print_r($q); exit;
        $hasilquery = $this->db->query($q);
        $data = array();
        $no = $_POST['start'];
        $data = array();
        $ip = $_SERVER['HTTP_HOST'];
        //  pre($ip); exit;
        foreach ($hasilquery->result() as $row) {
            $no++;
            $nestedData = array();		
            
            $nestedData[] = '<a href="'. base_url() .'Schedule_produksi/entry_data/'.$row->ID.'" class="btn btn-xs btn-warning"> EDIT </a> 
            <a target="_blank" href="http://'. $ip .'/sgiv2/lean/Qa_andon/display_sgi/'.$row->LINE_SEWING.'" class="btn btn-xs btn-primary"> VIEW KANBAN </a> ' ;
            $nestedData[] = $row->LINE_SEWING;	
            $nestedData[] = $row->KANAAN_PO;	 
            $nestedData[] = $row->BUYER;	 
            $nestedData[] = $row->STYLE_NO;	 
            $nestedData[] = $row->ITEM;	 
            $nestedData[] = $row->COLOR;	 
            $nestedData[] = $row->SIZE;	 
            $nestedData[] = $row->QTY_ORDER;	 
            $nestedData[] = $row->FOB;	 
            $nestedData[] = kiri($row->DELIVERY,10);	 
           
            $nestedData[] = $row->TANGGAL_SEWING_START;	 
            $nestedData[] = $row->TANGGAL_SEWING_END;	 
            $nestedData[] = $row->QTY_PLAN;	 
            $nestedData[] = $row->target100persen;	 
            $nestedData[] = $row->QTY_HARIAN;	 
            $nestedData[] = $row->catatan;	  
            $nestedData[] = "";
            $nestedData[] = $row->DES;
            $nestedData[] = $row->tampilkan_target;
            $nestedData[] = $row->tampilkan_andon;
     


            $data[] = $nestedData;
        }

        $sql = "Select count(*) as num  from Schedule_produksi ";
        $record_total = $this->db->query($sql)->row()->num;
        $sql = "Select count(*) as num  from ($qcountfilter) as c   ";
        $recordsFiltered = $this->db->query($sql)->row()->num;

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $record_total,  
            "recordsFiltered" => $recordsFiltered, 
            "data" => $data,
            "q" => $q,

        );

        //output dalam format JSON
        echo json_encode($output);
 }
	
}