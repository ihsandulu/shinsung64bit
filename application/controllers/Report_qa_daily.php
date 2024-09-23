<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Log
 */
class Report_qa_daily extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->is_logedin();
	}

	public function Daily_defect_rate_Action()
	{
		$tanggal_sebelum = '2023-07-25'; $tanggal_sesudah = '2023-07-25';

		$data['pagetitle'] = 'REPORT QA DAILY DEFECT RATE ACTION ';
		$data['report_array'] = $this->ambil_data_qty_check($tanggal_sebelum ,$tanggal_sesudah  );
		$data['report_defect'] = $this->ambil_data_qty_per_defect($tanggal_sebelum ,$tanggal_sesudah  );
		$data['sum_defect'] = $this->ambil_data_total_per_defect($tanggal_sebelum ,$tanggal_sesudah  );
		$data['daftar_defect'] = Helper_daftar_defect();
		// pre($data['daftar_defect']);
		$this->loadViews('Report_qa_daily/Defect_rate_Action_view', $data);
	}
 
	public function ambil_data_qty_check( $tanggal_sebelum ,$tanggal_sesudah )
	{
		$sql = "Select 
		ins.line , 	CONVERT(VARCHAR(10), ins.tanggal , 120) tanggal  , ins.kanaan_po , ins.style , ins.color 
		, ins.qty_order  ,  count(*) as qty_check   , des  from 
		[inspect_v2] ins where
		CONVERT(VARCHAR(10), ins.tanggal , 120)  between '$tanggal_sebelum' and '$tanggal_sesudah'
		group by 
		ins.line ,	CONVERT(VARCHAR(10), ins.tanggal , 120) , ins.kanaan_po , ins.style , ins.color 
		, ins.qty_order , des   order by   ins.line ,	CONVERT(VARCHAR(10), ins.tanggal , 120)  ";
  // echo $sql;
		$data= $this->db->query($sql)->result_array();  
// pre($data);
		return $data ; 
	}
	public function ambil_data_qty_per_defect( $tanggal_sebelum ,$tanggal_sesudah )
	{
		$sql = "Select 
		ins.line , 	CONVERT(VARCHAR(10), ins.tanggal , 120) tanggal  , ins.kanaan_po , ins.style , ins.color 
		, ins.qty_order  ,  count(*) as qty_defect , kode_defect  , des   from 
		[inspect_v2] ins where
		CONVERT(VARCHAR(10), ins.tanggal , 120) 
		between  '$tanggal_sebelum' and '$tanggal_sesudah'
		and kode_defect <> 'ok'
		group by 
		ins.line ,	CONVERT(VARCHAR(10), ins.tanggal , 120) , ins.kanaan_po , ins.style , ins.color 
		, ins.qty_order  
		, kode_defect  , des 
		order by   ins.line ,	CONVERT(VARCHAR(10), ins.tanggal , 120) ";
    // echo $sql;
		$data= $this->db->query($sql)->result_array();  
// pre($data);
		return $data ; 
	}
	public function ambil_data_total_per_defect( $tanggal_sebelum ,$tanggal_sesudah )
	{
		$sql = "Select 
		count(*) as qty_defect , kode_defect   from 
		[inspect_v2] ins where
		CONVERT(VARCHAR(10), ins.tanggal , 120) 
		between  '$tanggal_sebelum' and '$tanggal_sesudah'
		and kode_defect <> 'ok'
		group by 
		kode_defect 
		 ";
    // echo $sql;
		$data= $this->db->query($sql)->result_array();  
// pre($data);
		return $data ; 
	}




	public function Summary_defect_rate_Action()
	{
		$tanggal_sebelum = '2023-07-25'; $tanggal_sesudah = '2023-07-31';
		$data['pagetitle'] = 'REPORT QA SUMMARY DEFECT RATE ACTION ';
		$data['tanggal'] = cetakNamaHari($tanggal_sebelum , $tanggal_sesudah );
		 $data['qty_check_harian_line'] = $this->ambil_qty_check_harian_line($tanggal_sebelum ,$tanggal_sesudah  );
		 $data['qty_defect_harian_line'] = $this->ambil_qty_defect_harian_line($tanggal_sebelum ,$tanggal_sesudah  );
		 $data['daftar_line'] = $this->ambil_daftar_line($tanggal_sebelum ,$tanggal_sesudah  );
		// pre($data['daftar_defect']);
		$this->loadViews('Report_qa_daily/Summary_defect_rate_Action_view', $data);
	}

	public function ambil_daftar_line( $tanggal_sebelum ,$tanggal_sesudah )
	{
		$sql = "Select distinct  ins.line  from 	[inspect_v2] ins where CONVERT(VARCHAR(10), ins.tanggal , 120)  between '$tanggal_sebelum' and '$tanggal_sesudah' 	  order by   ins.line  ";  
		$data= $this->db->query($sql)->result_array();  
		return $data ; 
	}

	public function ambil_qty_check_harian_line( $tanggal_sebelum ,$tanggal_sesudah )
	{
		$sql = "
		Select count(*) qty_check , tanggal , line   from 
			(
			Select  distinct  (uuid) , 	CONVERT(VARCHAR(10), ins.tanggal , 120) tanggal , line   
			from 
				[inspect_v2] ins 
			where
			 	CONVERT(VARCHAR(10), ins.tanggal , 120)  between '$tanggal_sebelum' and '$tanggal_sesudah' 	
			 ) as data
			group by 
			 	tanggal , line    
			order by   
			   tanggal asc

		  ";  
		$data= $this->db->query($sql)->result_array();  
		return $data ; 
	}

	public function ambil_qty_defect_harian_line( $tanggal_sebelum ,$tanggal_sesudah )
	{
		$sql = "
		Select count(*) qty_defect , tanggal , line   from 
			(
			Select    	CONVERT(VARCHAR(10), ins.tanggal , 120) tanggal , line   
			from 
				[inspect_v2] ins 
			where
			 	CONVERT(VARCHAR(10), ins.tanggal , 120)  between '$tanggal_sebelum' and '$tanggal_sesudah' 	
			 	and 
				kode_defect <> 'ok'
			 ) as data
			group by 
			 	tanggal ,  line    
			order by   
			    line 

		  ";  

		// $sql = "Select 
		// 	count(*) as qty_defect , CONVERT(VARCHAR(10), ins.tanggal , 120) tanggal , line  
		// from 
		// 	[inspect_v2] ins 
		// where
		// 	CONVERT(VARCHAR(10), ins.tanggal , 120) between  '$tanggal_sebelum' and '$tanggal_sesudah'
		// 	and 
		// 	kode_defect <> 'ok'
		// group by 
		// 	CONVERT(VARCHAR(10), ins.tanggal , 120) , line
		//  ";   
 		$data= $this->db->query($sql)->result_array();  
		return $data ; 
	}


// select  count(*) as qty_checking , line into #checking from 
// 	( select distinct (uuid) , line  from   [dbo].[inspect_v2]  where 
// 	--line = @line and id_schedule = @id_schedule and 
// 	CONVERT(VARCHAR(10), time_stamp, 120)   = CONVERT(VARCHAR(10), GETDATE(), 120) ) as data
// 	group by line 

//     select count(*) as sum_defect , line   into #defect  from   [dbo].[inspect_v2]  where 
// 	-- line = @line and id_schedule = @id_schedule and 
// 	  CONVERT(VARCHAR(10), time_stamp, 120)   = CONVERT(VARCHAR(10), GETDATE(), 120) 
// 	  and kode_defect <> 'OK'  
//     group by line ;



}