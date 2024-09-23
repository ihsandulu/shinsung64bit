<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Qa_end_line extends MY_Controller
{
	private $db_kis = "";
	function __construct()
	{
		parent::__construct();
		// $this->is_logedin();
		$this->load->helper(array('form', 'url'));
		$this->db_kis  = $this->load->database('kis', TRUE);
		$this->load->helper('url');
		$this->load->library(['ion_auth', 'form_validation']);
	}

	public function index()
	{
		$data['pagetitle'] = 'DAFTAR LINE SEWING END LINE';
		$this->loadViews('Qa_end_line/Index', $data);
		//$this->loadViews("Qa_end_line/Index", $this->global, NULL, NULL);
	}

	public function daftar_schedule($line_)
	{
		/* $sql = "select  v_schedule_produksi_2021_hari_ini.[ID]  ,   [tampilkan_target] ,[KANAAN_PO]      ,[STYLE_NO]      ,[ITEM]      ,[COLOR]      ,[QTY_ORDER]   , SIZE   ,[FOB]      ,  CONVERT(date, DELIVERY)  GAC          ,[QTY_PLAN]                     ,[DES]
		
		from
		SGI_LEAN.dbo.v_schedule_produksi_2021_hari_ini 
		
		
		where LINE_SEWING = '$line_' order by tampilkan_target desc" ; */


		/* $sql = "SELECT  v_schedule_produksi_2021_hari_ini.[ID], [tampilkan_target], [KANAAN_PO], [STYLE_NO], [ITEM], [COLOR],[QTY_ORDER], SIZE, [FOB],  CONVERT(date, DELIVERY) GAC, [QTY_PLAN], [DES]
		FROM
		SGI_LEAN.dbo.v_schedule_produksi_2021_hari_ini 		
		WHERE LINE_SEWING = '$line_' ORDER BY tampilkan_target DESC";
		$data['schedule'] = $this->db_kis->query($sql)->result_array(); */

		/* $sql = $this->db_kis->from("SGI_LEAN.dbo.v_schedule_produksi_2021_hari_ini")
			->select("MIN(ID) AS ID, 
        KANAAN_PO, 
        STYLE_NO, 
        MAX(tampilkan_target) AS tampilkan_target, 
        MIN(ITEM) AS ITEM, 
        SUM(QTY_ORDER) AS QTY_ORDER, 
        MIN(FOB) AS FOB, 
        MIN(CONVERT(date, DELIVERY)) AS GAC, 
        SUM(QTY_PLAN) AS QTY_PLAN, 
        MIN(DES) AS DES")
			->where("LINE_SEWING", $line_)
			->group_by("KANAAN_PO, STYLE_NO")
			->order_by("tampilkan_target", "DESC")
			->get()
			->result_array();
		$data['schedule'] = $sql; */
		// pre($data);
		$data['line'] = $line_;
		$data['pagetitle'] = "DAFTAR SCHEDULE LINE $line_";
		$this->loadViews('Qa_end_line/daftar_schedule', $data);
	}

	public function hasil_inspect_bags_defect_list_version1($line_, $id_schedule)
	{
		$sql = "select  [ID]      ,[KANAAN_PO]      ,[BUYER]      ,[STYLE_NO]      ,[ITEM]      ,[COLOR]      ,[QTY_ORDER]      ,[FOB]      ,  CONVERT(date, DELIVERY)  GAC          ,[QTY_PLAN]      , LINE_SEWING               ,[DES] , 
		target100persen  TARGET100PERSEN  , SIZE
			from v_schedule_produksi_2021_hari_ini where LINE_SEWING = '$line_' and id = '$id_schedule' ";

		$data['schedule'] = $this->db_kis->query($sql)->row_array();

		$sql = "select  distinct jenis from daftar_defect ";
		$data['jenis'] = $this->db->query($sql)->result_array();

		$sql = "select  distinct * from daftar_defect order by jenis asc ";
		$data['daftar_defect'] = $this->db->query($sql)->result_array();

		$data['pagetitle'] = "QC LUAR  LINE $line_ ";
		$data['line'] = $line_;
		$data['id_schedule'] = $id_schedule;

		$group = array('admin');
		if ($this->ion_auth->in_group($group)) {
			// $this->sp_grid_summary_hasil_inspect_bags_defect_list_version2 ($line , $id_schedule    );
			$this->loadViews('Qa_end_line/hasil_inspect_bags_defect_list_version1dev', $data);
			//  $this->loadViews('Qa_end_line/hasil_inspect_bags_defect_list_version1socketio', $data);
			// exit();
		} else {
			// $this->loadViews('Qa_end_line/hasil_inspect_bags_defect_list_version1_', $data);	

			$this->loadViews('Qa_end_line/hasil_inspect_bags_defect_list_version1dev', $data);

			//  $this->loadViews('Qa_end_line/hasil_inspect_bags_defect_list_version1socketio', $data); // 18 januari 2024 trial socket io
		}


		// $this->loadViews('Qa_end_line/hasil_inspect_bags_defect_list_version1dev', $data);
	}




	public function hasil_inspect_bags_defect_list_version2($line_, $id_schedule)
	{
		/* $sql = "select  [ID]      ,[KANAAN_PO]      ,[BUYER]      ,[STYLE_NO]      ,[ITEM]      ,[COLOR]      ,[QTY_ORDER]      ,[FOB]      ,  CONVERT(date, DELIVERY)  GAC          ,[QTY_PLAN]      , LINE_SEWING               ,[DES] , 
		target100persen  TARGET100PERSEN  , SIZE
			from v_schedule_produksi_2021_hari_ini where LINE_SEWING = '$line_' and id = '$id_schedule' "; 

		$data['schedule'] = $this->db_kis->query($sql)->row_array();*/

		$sql = $this->db_kis->from("v_schedule_produksi_2021_hari_ini")
			->select("ID, KANAAN_PO, BUYER, STYLE_NO, ITEM, COLOR, QTY_ORDER, FOB, CONVERT(date, DELIVERY)as GAC, QTY_PLAN,  LINE_SEWING, DES, target100persen as TARGET100PERSEN, SIZE")
			->where("LINE_SEWING", $line_)
			->get()
			->row_array();

		$data['schedule'] = $sql;

		$sql = "select  distinct jenis from daftar_defect ";
		$data['jenis'] = $this->db->query($sql)->result_array();

		$sql = "select  distinct * from daftar_defect order by jenis asc ";
		$data['daftar_defect'] = $this->db->query($sql)->result_array();

		$data['pagetitle'] = "QC DALAM  LINE $line_ ";
		$data['line'] = $line_;
		$data['id_schedule'] = $id_schedule;

		$this->loadViews('Qa_end_line/hasil_inspect_bags_defect_list_version1dev2', $data);
	}




	public function hasil_inspect_bags_defect_list_version3($line_, $id_schedule)
	{
		$sql = "select  [ID]      ,[KANAAN_PO]      ,[BUYER]      ,[STYLE_NO]      ,[ITEM]      ,[COLOR]      ,[QTY_ORDER]      ,[FOB]      ,  CONVERT(date, DELIVERY)  GAC          ,[QTY_PLAN]      , LINE_SEWING               ,[DES] , 
		target100persen  TARGET100PERSEN  , SIZE
			from v_schedule_produksi_2021_hari_ini where LINE_SEWING = '$line_' and id = '$id_schedule' ";

		$data['schedule'] = $this->db_kis->query($sql)->row_array();

		$sql = "select  distinct jenis from daftar_defect ";
		$data['jenis'] = $this->db->query($sql)->result_array();

		$sql = "select  distinct * from daftar_defect order by jenis asc ";
		$data['daftar_defect'] = $this->db->query($sql)->result_array();

		$data['pagetitle'] = "QC IRONING  LINE $line_ ";
		$data['line'] = $line_;
		$data['id_schedule'] = $id_schedule;

		$this->loadViews('Qa_end_line/hasil_inspect_bags_defect_list_version1dev3', $data);
	}



	public function hasil_inspect_bags_defect_list_version4($line_, $id_schedule)
	{
		$sql = "select  [ID]      ,[KANAAN_PO]      ,[BUYER]      ,[STYLE_NO]      ,[ITEM]      ,[COLOR]      ,[QTY_ORDER]      ,[FOB]      ,  CONVERT(date, DELIVERY)  GAC          ,[QTY_PLAN]      , LINE_SEWING               ,[DES] , 
		target100persen  TARGET100PERSEN  , SIZE
			from v_schedule_produksi_2021_hari_ini where LINE_SEWING = '$line_' and id = '$id_schedule' ";

		$data['schedule'] = $this->db_kis->query($sql)->row_array();

		$sql = "select  distinct jenis from daftar_defect ";
		$data['jenis'] = $this->db->query($sql)->result_array();

		$sql = "select  distinct * from daftar_defect order by jenis asc ";
		$data['daftar_defect'] = $this->db->query($sql)->result_array();

		$data['pagetitle'] = "QC PACKING  LINE $line_ ";
		$data['line'] = $line_;
		$data['id_schedule'] = $id_schedule;

		$this->loadViews('Qa_end_line/hasil_inspect_bags_defect_list_version1dev4', $data);
	}





	public function hasil_inspect_bags_defect_list_version1dev($line_, $id_schedule)
	{
		$sql = "select  [ID]      ,[KANAAN_PO]      ,[BUYER]      ,[STYLE_NO]      ,[ITEM]      ,[COLOR]      ,[QTY_ORDER]      ,[FOB]      ,  CONVERT(date, DELIVERY)  GAC          ,[QTY_PLAN]      , LINE_SEWING               ,[DES] , 
			CASE  WHEN FOB > 0 THEN 
				cast(ROUND(71.5/(FOB/10),0) as BIGINT) 
				ELSE 0 END  as TARGET100PERSEN  
			from v_schedule_produksi_2021_hari_ini where LINE_SEWING = '$line_' and id = '$id_schedule' ";

		$data['schedule'] = $this->db_kis->query($sql)->row_array();

		$sql = "select  distinct jenis from daftar_defect ";
		$data['jenis'] = $this->db->query($sql)->result_array();

		$sql = "select  distinct * from daftar_defect order by jenis asc ";
		$data['daftar_defect'] = $this->db->query($sql)->result_array();

		$data['pagetitle'] = "INSPECT BAGS LINE $line_  DEFECT LIST  ";
		$data['line'] = $line_;
		$data['id_schedule'] = $id_schedule;

		$this->loadViews('Qa_end_line/hasil_inspect_bags_defect_list_version1socketio', $data);
	}




	public function hasil_inspect_bags_defect_list_version1_action($line_, $id_schedule)
	{
		$sql = "select * from Schedule_produksi where LINE_SEWING = '$line_' and id = '$id_schedule' ";
		$data['schedule'] = $this->db_kis->query($sql)->row_array();
		$user = $this->ion_auth->user()->row_array();


		if ($data['schedule']) {
			//INSERT HASIL
			$data_hasil = array();
			// $data['TANGGAL_HASIL'] = date('Y-m-d');
			$data_hasil['LINE'] = $line_;
			$dt_schedule = $data['schedule'];
			$data_hasil['KANAAN_PO'] = $dt_schedule['KANAAN_PO'];
			$data_hasil['STYLE_NO'] = $dt_schedule['STYLE_NO'];
			$data_hasil['ITEM'] = $dt_schedule['ITEM'];
			$data_hasil['COLOR'] = $dt_schedule['COLOR'];
			$data_hasil['SIZE'] = $dt_schedule['SIZE'];
			$data_hasil['BUYER'] = $dt_schedule['BUYER'];
			$data_hasil['QTY'] =  1; //$_POST['qty'];
			// $data['JAM_KE'] =  $_POST['jam_ke'];
			$data_hasil['user_input'] = $user['user_id'] . ' ' .  $user['first_name'] . ' ' . $user['last_name'];
			$data_hasil['QTYGLOBAL'] = $dt_schedule['QTY_ORDER'];
			$data_hasil['JAMINPUT'] = date('Y-m-d H:i:s');
			$data_hasil['ID_ORDER'] = $dt_schedule['ID_ORDER'];
			$data_hasil['DES'] = $dt_schedule['DES'];
			$data_hasil['GAC'] = $dt_schedule['DELIVERY'];
			$data_hasil['FOB'] = $dt_schedule['FOB'];
			$data_hasil['CMT'] = $dt_schedule['FOB'] / 10;
			$data_hasil['id_schedule'] = $id_schedule;
			//END INSERT HASIL



			$insert['id_schedule'] = $id_schedule;
			//$insert['id'] = uniqid();

			$insert['kanaan_po'] 		= $data['schedule']['KANAAN_PO'];
			$insert['style']		 	= $data['schedule']['STYLE_NO'];
			$insert['des'] 				= $data['schedule']['DES'];
			$insert['color'] 			= $data['schedule']['COLOR'];
			$insert['qty_order'] 		= $data['schedule']['QTY_ORDER'];
			$insert['buyer'] 		= $data['schedule']['BUYER'];
			$insert['size'] 		= $data['schedule']['SIZE'];
			$insert['line']	 			= $line_;
			$insert['user_id'] 			= $this->session->userdata('user_id');;
			$insert['nama_user'] 		= $user['first_name'] . ' ' . $user['last_name'];
			$data 						= $_POST;
			$insert['kode_defect'] 		= $data['kode_defect'];
			$insert['uuid'] 			= $data['uuid'];
			$insert['status_inspect'] 	= substr($this->session->userdata('email'), -1); // ora sido asale kanggo pembeda user luar dalam



			if ($data['kode_defect'] == 'OK') {

				$this->db->insert('inspect_v2', $insert);
				$this->db->insert('inspect_v2_hari_ini', $insert);

				//INSERT PRODUKSI
				$this->db->insert("sewing_hasil_produksi", $data_hasil);


				$arr = array('status'  => '2');
				echo json_encode($arr);
			} else {
				$kode = $data['kode_defect'];
				$sql = $this->db->query("SELECT kode FROM daftar_defect where kode = '$kode'");
				$cek_kode = $sql->num_rows();

				if ($cek_kode > 0) {
					$this->db->insert('inspect_v2', $insert);
					$this->db->insert('inspect_v2_hari_ini', $insert);
					$arr = array('status'  => '1');
					echo json_encode($arr);
				} else {
					$arr = array('status'  => '0');
					echo json_encode($arr);
				}
			}
		} else {
			$arr = array('status'  => '5');
			echo json_encode($arr);
		}

		// pre($this->db->last_query());
	}

	public function hasil_inspect_bags_defect_list_version1_final_result_action($line_, $id_schedule)
	{
		$sql = "select  * from Schedule_produksi where LINE_SEWING = '$line_' and id = '$id_schedule' ";
		$dt['schedule'] = $this->db_kis->query($sql)->row_array();
		//pre($dt['schedule']); exit();

		$user = $this->ion_auth->user()->row_array();




		if ($dt['schedule']) {
			$data = array();
			// $data['TANGGAL_HASIL'] = date('Y-m-d');
			$data['LINE'] = $line_;
			$dt_schedule = $dt['schedule'];

			$data['KANAAN_PO'] = $dt_schedule['KANAAN_PO'];
			$data['STYLE_NO'] = $dt_schedule['STYLE_NO'];
			$data['ITEM'] = $dt_schedule['ITEM'];
			$data['COLOR'] = $dt_schedule['COLOR'];
			// $data['SIZE'] = $dt_schedule['SIZE'];
			$data['QTY'] =  $_POST['qty'];
			// $data['JAM_KE'] =  $_POST['jam_ke'];
			$data['user_input'] = $user['user_id'] . ' ' .  $user['first_name'] . ' ' . $user['last_name'];
			$data['QTYGLOBAL'] = $dt_schedule['QTY_ORDER'];
			$data['JAMINPUT'] = date('Y-m-d H:i:s');
			$data['ID_ORDER'] = $dt_schedule['ID_ORDER'];
			$data['DES'] = $dt_schedule['DES'];
			$data['GAC'] = $dt_schedule['DELIVERY'];
			$data['FOB'] = $dt_schedule['FOB'];
			$data['CMT'] = $dt_schedule['FOB'] / 10;
			$data['BUYER'] = $dt_schedule['BUYER'];
			$data['id_schedule'] = $id_schedule;

			$this->db->insert("sewing_hasil_ironing", $data);


			$arr = array('status'  => '1');
			echo json_encode($arr);
		} else {
			$arr = array('status'  => '5');
			echo json_encode($arr);
		}
	}

	public function hasil_inspect_bags_defect_list_version1_output_hd_action($line_, $id_schedule)
	{
		$sql = "select  * from Schedule_produksi where LINE_SEWING = '$line_' and id = '$id_schedule' ";
		$dt['schedule'] = $this->db_kis->query($sql)->row_array();
		//pre($dt['schedule']); exit();

		$user = $this->ion_auth->user()->row_array();




		if ($dt['schedule']) {
			$data = array();
			// $data['TANGGAL_HASIL'] = date('Y-m-d');
			$data['LINE'] = $line_;
			$dt_schedule = $dt['schedule'];

			$data['KANAAN_PO'] = $dt_schedule['KANAAN_PO'];
			$data['STYLE_NO'] = $dt_schedule['STYLE_NO'];
			$data['ITEM'] = $dt_schedule['ITEM'];
			$data['COLOR'] = $dt_schedule['COLOR'];
			// $data['SIZE'] = $dt_schedule['SIZE'];
			$data['QTY'] =  $_POST['qty'];
			// $data['JAM_KE'] =  $_POST['jam_ke'];
			$data['user_input'] = $user['user_id'] . ' ' .  $user['first_name'] . ' ' . $user['last_name'];
			$data['QTYGLOBAL'] = $dt_schedule['QTY_ORDER'];
			$data['JAMINPUT'] = date('Y-m-d H:i:s');
			$data['ID_ORDER'] = $dt_schedule['ID_ORDER'];
			$data['DES'] = $dt_schedule['DES'];
			$data['GAC'] = $dt_schedule['DELIVERY'];
			$data['FOB'] = $dt_schedule['FOB'];
			$data['CMT'] = $dt_schedule['FOB'] / 10;
			$data['id_schedule'] = $id_schedule;
			$data['BUYER'] = $dt_schedule['BUYER'];

			$this->db->insert("sewing_hasil_packing", $data);


			$arr = array('status'  => '1');
			echo json_encode($arr);
		} else {
			$arr = array('status'  => '5');
			echo json_encode($arr);
		}
	}



	public function get_uuid()
	{
		$uuid = uniqid();
		echo json_encode(['cekid' => $uuid, 'message' => "BAGS DEFECT , SAVED "]);
	}

	public function hasil_inspect_bags_insert_defect_detail($id_inspect, $id_defect)
	{
		$insert['id_inspect'] = $id_inspect;
		$insert['id_defect'] = $id_defect;


		// unset($insert[]) ;
		$this->db->insert('inspect_detail', $insert);
		echo json_encode(['status' => 1, 'message' => "BAGS DEFECT , SAVED "]);
	}


	//  EXEC sp_count_hasil_inspect_bags_defect_list '6434a21a1f216' 
	public function sp_count_hasil_inspect_bags_defect_list($id_inspect)
	{


		// unset($insert[]) ;
		$data = $this->db->query(" sp_count_hasil_inspect_bags_defect_list  '$id_inspect'  ")->result_array();
		echo json_encode($data);
	}


	//[sp_grid_hasil_inspect_bags_defect_list_version1]
	public function sp_grid_hasil_inspect_bags_defect_list_version1($line, $id_schedule)
	{

		// $data = $this->db->query(" sp_grid_hasil_inspect_bags_defect_list_version1  '$line' , '$id_schedule'  ")->result_array();
		$sql = " sp_grid_hasil_inspect_bags_defect_list_version1  '$line' , '$id_schedule'  ";
		$data = execute_query_resultarray_and_log($sql);
		echo json_encode($data);
	}

	//[[sp_grid_summary_hasil_inspect_bags_defect_list_version1]] asale iki seng version 1 
	// mergo sering di hit diganti ngisore ben dbne ora abot
	public function sp_grid_summary_hasil_inspect_bags_defect_list_version1($line, $id_schedule)
	{
		//	     

		$group = array('admin');
		if ($this->ion_auth->in_group($group)) {
			$this->sp_grid_summary_hasil_inspect_bags_defect_list_version2($line, $id_schedule);
			exit();
		}

		// $data = $this->db->query("[sp_grid_summary_hasil_inspect_bags_defect_list_version1]  '$line' , '$id_schedule' ")->result_array();


		$sql = "[sp_grid_summary_hasil_inspect_bags_defect_list_version1]  '$line' , '$id_schedule' ";
		$data = execute_query_resultarray_and_log($sql);

		echo json_encode($data);
	}

	public function sp_grid_summary_hasil_inspect_bags_defect_list_version2($line, $id_schedule)
	{
		$this->benchmark->mark('code_start');
		//hitung jumlah out 
		//execute_query_and_log return row 
		//execute_query_resultarray_and_log return array 
		//hitung hasil packing hari ini 
		$sql = "SELECT   sum([QTY])  total_output_packing  
				FROM [sewing_hasil_produksi] 
				where line = $line and id_schedule = $id_schedule and 
				CONVERT(VARCHAR(10), TANGGAL_HASIL, 120)   = CONVERT(VARCHAR(10), GETDATE(), 120) ";
		$data['hasil_output_packing']  = execute_query_resultarray_and_log($sql)[0];
		$sql = "SELECT   sum([QTY])  total_output_hd  
				FROM [sewing_hasil_output_hd] 
				where line = $line and id_schedule = $id_schedule and 
				CONVERT(VARCHAR(10), TANGGAL_HASIL, 120)   = CONVERT(VARCHAR(10), GETDATE(), 120) ";
		$data['hasil_output_hd']  = execute_query_resultarray_and_log($sql)[0];


		$data['qtycheck']    = count($this->jumlah_qty_cek($line, $id_schedule));
		$data['qtydefect']    = $this->jumlah_qty_defect($line, $id_schedule)[0]['jumlah'];

		//  if  @qtychecking > 0 
		// begin
		//    set @persendefect = (isnull(@qtydefect,0) / isnull( @qtychecking , 0 )) * 100  ; 
		// end
		$data['persen_defect'] = 0;
		if ($data['qtycheck']  > 0) {
			$data['persen_defect'] = $data['qtydefect'] / $data['qtycheck']  * 100;
		}


		$datafinal[0]['total_qty_hd'] = $data['hasil_output_hd']['total_output_hd'];
		$datafinal[0]['total_qty'] = $data['hasil_output_packing']['total_output_packing'];
		$datafinal[0]['qty_checking'] = 	$data['qtycheck'];
		$datafinal[0]['qty_defect'] = 	$data['qtydefect'];
		$datafinal[0]['persen_defect'] = round($data['persen_defect'], 0);

		// pre($data['hasil_output_hd']);
		// array_push($datafinal, $data['hasil_output_hd'][]);
		$this->benchmark->mark('code_end');
		simpan_log("function sp_grid_summary_hasil_inspect_bags_defect_list_version2 ($line , $id_schedule ) PHP ", $this->benchmark->elapsed_time('code_start', 'code_end'));
		echo json_encode($datafinal);

		// echo "proses time :". $this->benchmark->elapsed_time('code_start', 'code_end');


	}

	public function jumlah_qty_cek($line, $id_schedule)
	{
		// $sql = " SELECT distinct (uuid)  from   [dbo].[inspect_v2] 
		$sql = " SELECT  (uuid)  from   [dbo].[inspect_v2] 
				where line = $line and id_schedule = $id_schedule and 
				CONVERT(VARCHAR(10), time_stamp, 120)   = CONVERT(VARCHAR(10), GETDATE(), 120)  
				and uuid <> '' and kode_defect = 'OK' ";
		$sql = " SELECT   sum(qty) uuid  from   [dbo].sewing_hasil_produksi
				where line = $line and id_schedule = '$id_schedule' and 
				CONVERT(VARCHAR(10), TANGGAL_HASIL, 120)   = CONVERT(VARCHAR(10), GETDATE(), 120)  
				  ";
		return execute_query_resultarray_and_log($sql);
	}

	public function jumlah_qty_defect($line, $id_schedule)
	{
		$sql = "  SELECT count(id) as jumlah from   [dbo].[inspect_v2_hari_ini]  
			where line = $line and id_schedule = $id_schedule and 
	  			CONVERT(VARCHAR(10), time_stamp, 120)   = CONVERT(VARCHAR(10), GETDATE(), 120) 
	  			and kode_defect <> 'OK'  ";
		return execute_query_resultarray_and_log($sql);
	}


	public function json_jumlah_qty_cek($line, $id_schedule)
	{
		// $sql = " SELECT distinct (uuid)  from   [dbo].[inspect_v2_hari_ini] 
		$sql = " SELECT  (uuid)  from   [dbo].[inspect_v2_hari_ini]  
				where line = $line and id_schedule = '$id_schedule' and 
				CONVERT(VARCHAR(10), time_stamp, 120)   = CONVERT(VARCHAR(10), GETDATE(), 120)  
				and uuid <> '' and kode_defect = 'OK'   ";
		$sql = " SELECT   (qty) uuid  from   [dbo].sewing_hasil_produksi
				where line = $line and id_schedule = '$id_schedule' and 
				CONVERT(VARCHAR(10), TANGGAL_HASIL, 120)   = CONVERT(VARCHAR(10), GETDATE(), 120)  
				  ";
		$data['jumlah_qty_cek'] = (count(execute_query_resultarray_and_log($sql)));
		// pre($data);
		echo json_encode($data);
	}

	public function json_jumlah_qty_defect($line, $id_schedule)
	{
		$sql = "  SELECT count(id) as jumlah from   [dbo].[inspect_v2_hari_ini]  
			where line = $line and id_schedule = '$id_schedule' and 
	  			CONVERT(VARCHAR(10), time_stamp, 120)   = CONVERT(VARCHAR(10), GETDATE(), 120) 
	  			and kode_defect <> 'OK'  ";
		echo json_encode(execute_query_and_log($sql));
	}

	public function json_hasil_output_ironing($line, $id_schedule)
	{
		$sql = "SELECT   isnull(sum([QTY]),0)  total_output_packing  
			FROM [dbo].[sewing_hasil_ironing]
			where line = $line  and id_schedule = '$id_schedule' and 
			CONVERT(VARCHAR(10), TANGGAL_HASIL, 120)   = CONVERT(VARCHAR(10), GETDATE(), 120) ";
		echo json_encode(execute_query_and_log($sql));
	}

	public function json_hasil_output_packing($line, $id_schedule)
	{
		// $sql = "SELECT   isnull(sum([QTY]),0)  total_output_packing  
		// 	FROM [SGI_LEAN].[dbo].[sewing_hasil_produksi] 
		// 	where line = '$line' and id_schedule = $id_schedule and 
		// 	CONVERT(VARCHAR(10), TANGGAL_HASIL, 120)   = CONVERT(VARCHAR(10), GETDATE(), 120) ";

		$sql = "SELECT   isnull(sum([QTY]),0)  total_output_packing  
			FROM [dbo].[sewing_hasil_packing]
			where line = $line  and id_schedule = '$id_schedule' and 
			CONVERT(VARCHAR(10), TANGGAL_HASIL, 120)   = CONVERT(VARCHAR(10), GETDATE(), 120) ";
		echo json_encode(execute_query_and_log($sql));
	}


	public function json_hasil_output_hd($line, $id_schedule)
	{
		$sql = "SELECT   isnull(sum([QTY]),0)  total_output_hd  
			FROM [dbo].[sewing_hasil_output_hd]
			where line = $line  and id_schedule = '$id_schedule' and 
			CONVERT(VARCHAR(10), TANGGAL_HASIL, 120)   = CONVERT(VARCHAR(10), GETDATE(), 120) ";
		echo json_encode(execute_query_and_log($sql));
	}


	public function sp_grid_summary_hasil_inspect_bags_defect_list_version1__($line, $id_schedule)
	{
		$data = $this->db->query("[dashboard_Qa_end_line_per_line_hari_ini]  '$line' ")->result_array();
		echo json_encode($data);
	}


	//[[sp_grid_summary_hasil_inspect_bags_defect_list_version1]]
	public function sp_grid_summary_perdefect_hasil_inspect_bags_defect_list_version1($line, $id_schedule)
	{

		// $data = $this->db->query(" sp_grid_summary_perdefect_hasil_inspect_bags_defect_list_version1  '$line' , '$id_schedule'  ")->result_array();

		$sql = "sp_grid_summary_perdefect_hasil_inspect_bags_defect_list_version1  '$line' , '$id_schedule' ";
		$data = execute_query_resultarray_and_log($sql);

		echo json_encode($data);
	}

	//top tree defect 
	public function sp_top_tree_defect($line, $id_schedule)
	{

		$data = $this->db->query(" sp_grid_summary_perdefect_hasil_inspect_bags_defect_list_version1  '$line' , '$id_schedule'  ")->result_array();
		//pre($data); exit();

		usort($data, function ($a, $b) {
			return $b['jumlah_defect'] - $a['jumlah_defect'];
		});
		$topThree = array_slice($data, 0, 3);
		echo json_encode($topThree);
	}

	//  EXEC sp_count_hasil_inspect_bags_defect_list '6434a21a1f216' 
	public function hasil_qa_perjam($line)
	{
		//$data = $this->db->query(" hasil_qa_perjam  '0' ,'$line','jam_normal' ")->result_array();
		//[hasil_qa_perjam_fix] exec [hasil_qa_perjam_fix]  '2023-08-21' ,'64'   ;  
		// $data = $this->db->query(" hasil_qa_perjam_fix  '".date('Y-m-d')."' ,'$line' ")->result_array();

		//exec  [report_compare_output_vs_inspect] '2023-08-22' , '63' ;
		// $q = " report_compare_output_vs_inspect  '".date('Y-m-d')."' ,'$line' ";
		$q = " report_compare_output_per_proses  '" . date('Y-m-d') . "' ,'$line' ";
		$data = $this->db->query($q)->result_array();
		// echo  $this->db->last_query();
		// echo $q;
		echo json_encode($data);
	}

	public function display_inspect($line_)
	{
		//$query = "";

		$sql = "select  v_schedule_produksi_2021_hari_ini.[ID]      ,[KANAAN_PO]      ,[BUYER]      ,[STYLE_NO]      ,[ITEM]      ,v_schedule_produksi_2021_hari_ini.[COLOR]      ,[QTY_ORDER]      ,[FOB]      ,  CONVERT(date, DELIVERY)  GAC          ,[QTY_PLAN]      , LINE_SEWING               ,[DES] 
		
		from
		SGI_LEAN.dbo.v_schedule_produksi_2021_hari_ini 

		
		where LINE_SEWING = '$line_' and v_schedule_produksi_2021_hari_ini.tampilkan_target = 'Y'  ";

		$data['schedule'] = $this->db_kis->query($sql)->row_array();


		$data['pagetitle'] = "INSPECT BAGS LINE $line_  DEFECT LIST";
		$data['line'] = $line_;
		$data['id_schedule'] = $data['schedule']['ID'];
		$id_schedule = $data['schedule']['ID'];

		//$data['defects'] = $this->db->query(" sp_grid_summary_perdefect_hasil_inspect_bags_defect_list_version1  '$line_' , '$id_schedule'  ")->result_array();
		$tanggal = date('Y-m-d');
		$sql = $this->db->query("SELECT id_scedule, img_style, color FROM style_images 
								JOIN schedule_line
								ON style_images.id_scedule = schedule_line.id_schedule
								WHERE  style_images.tanggal_upload = '$tanggal' 
								AND schedule_line.line = '$line_'
								ORDER BY id_scedule ASC");
		$data['data']  = $sql->result_array();
		//pre($data);

		$data_query = $this->db->query("exec dbo.dashboard_Qa_end_line_all_line_detail_defect_per_line '$line_'")->result_array();
		//pre($data); exit();

		usort($data_query, function ($a, $b) {
			return $b['jumlah_defect'] - $a['jumlah_defect'];
		});
		$topThree = array_slice($data_query, 0, 3);
		//echo json_encode($topThree);
		$data['defects'] = $topThree;
		$data['timer'] = 30000;

		//pre($data);
		$this->load->view('Qa_end_line/display_inspect', $data);
	}






	public function display_inspect_dasbord($line_)
	{
		//$query = "";
		$sql = "select  v_schedule_produksi_2021_hari_ini.[ID]      ,[KANAAN_PO]      ,[BUYER]      ,[STYLE_NO]      ,[ITEM]      ,v_schedule_produksi_2021_hari_ini.[COLOR]      ,[QTY_ORDER]      ,[FOB]      ,  CONVERT(date, DELIVERY)  GAC          ,[QTY_PLAN]      , LINE_SEWING               ,[DES] 
		
		from
		SGI_LEAN.dbo.v_schedule_produksi_2021_hari_ini 

		
		where LINE_SEWING = '$line_' and v_schedule_produksi_2021_hari_ini.tampilkan_target = 'Y'  ";

		$data['schedule'] = $this->db_kis->query($sql)->row_array();


		$data['pagetitle'] = "INSPECT BAGS LINE $line_  DEFECT LIST";
		$data['line'] = $line_;
		$data['id_schedule'] = $data['schedule']['ID'];
		$id_schedule = $data['schedule']['ID'];

		//$data['defects'] = $this->db->query(" sp_grid_summary_perdefect_hasil_inspect_bags_defect_list_version1  '$line_' , '$id_schedule'  ")->result_array();
		$tanggal = date('Y-m-d');
		$sql = $this->db->query("SELECT id_scedule, img_style, color FROM style_images 
								JOIN schedule_line
								ON style_images.id_scedule = schedule_line.id_schedule
								WHERE  style_images.tanggal_upload = '$tanggal' 
								AND schedule_line.line = '$line_'
								ORDER BY id_scedule ASC");
		$data['data']  = $sql->result_array();
		//pre($data);

		$data_query = $this->db->query("exec dbo.dashboard_Qa_end_line_all_line_detail_defect_per_line '$line_'")->result_array();
		//pre($data); exit();

		usort($data_query, function ($a, $b) {
			return $b['jumlah_defect'] - $a['jumlah_defect'];
		});
		$topThree = array_slice($data_query, 0, 3);
		//echo json_encode($topThree);
		$data['defects'] = $topThree;
		$data['timer'] = 30000;


		//pre($data);
		$this->load->view('Qa_end_line/display_inspect_dasbord', $data);
	}







	public function upload_style_img()
	{
		//$data['pagetitle'] = "INSPECT BAGS LINE  DEFECT LIST";
		//$data= array();
		$tanggal = date('Y-m-d');
		$id = $this->uri->segment(4);
		$sql = $this->db->query("SELECT id_scedule, img_style, color FROM style_images where id_scedule = '$id' AND tanggal_upload = '$tanggal' ORDER BY id_scedule ASC");
		$data['data']  = $sql->result_array();
		$this->load->view('Qa_end_line/upload_style_img', $data);
	}


	public function AJAX_insert_data_img()
	{
		date_default_timezone_set("Asia/Jakarta");
		$id_scedule = $this->input->post('id_scedule');
		$img_style = $this->input->post('img_style');
		$style = $this->input->post('style');
		$tanggal = $this->input->post('tanggal_upload');
		$color = $this->input->post('color');

		$date_ = date('Y-m-d');
		$time_ = date('H_i_s');
		$file = md5(uniqid()) . '_' . $date_ . '_' . $time_ . '.jpg';
		$uri =  substr($img_style, strpos($img_style, ",") + 1);
		file_put_contents('./uploads/style/' . $file, base64_decode($uri));

		$sql = $this->db->query("SELECT id_scedule, img_style FROM style_images where id_scedule = '$id_scedule' AND tanggal_upload = '$tanggal' AND color = '$color'");
		$cek_id = $sql->num_rows();
		if ($cek_id > 0) {
			$data['data']  = $sql->row_array();
			$gambar = $data['data']['img_style'];
			//pre($gambar);
			unlink(realpath('./uploads/style/' . $gambar));
			$this->db->query("UPDATE style_images SET img_style = '$file' WHERE id_scedule = '$id_scedule' AND tanggal_upload = '$tanggal' AND color = '$color'");
		} else {
			//$data = $this->input->post();
			$data['id_scedule'] = $id_scedule;
			$data['img_style'] = $file;
			$data['tanggal_upload'] = $tanggal;
			$data['color'] = $color;
			$this->db->insert('style_images', $data);
		}
	}


	public function upload_style_img_trial()
	{
		//$data['pagetitle'] = "INSPECT BAGS LINE  DEFECT LIST";
		//$data= array();
		$tanggal = date('Y-m-d');
		$id = $this->uri->segment(4);
		$sql = $this->db->query("SELECT id_scedule, img_style, color FROM style_images where id_scedule = '$id' AND tanggal_upload = '$tanggal' ORDER BY id_scedule ASC");
		$data['data']  = $sql->result_array();

		//pre($data);


		$this->load->view('Qa_end_line/upload_style_img_trial', $data);
	}


	public function AJAX_insert_data_img_trial()
	{
		$id_scedule = $this->input->post('id_scedule');
		$img_style = $this->input->post('img_style');
		$style = $this->input->post('style');
		$tanggal = $this->input->post('tanggal_upload');
		$color = $this->input->post('color');

		$file = md5(uniqid()) . '_' . $style . '.png';
		$uri =  substr($img_style, strpos($img_style, ",") + 1);
		file_put_contents('./uploads/style/' . $file, base64_decode($uri));

		$sql = $this->db->query("SELECT id_scedule, img_style FROM style_images where id_scedule = '$id_scedule' AND tanggal_upload = '$tanggal' AND color = '$color'");
		$cek_id = $sql->num_rows();
		if ($cek_id > 0) {
			$data['data']  = $sql->row_array();
			$gambar = $data['data']['img_style'];
			//pre($gambar);
			unlink(realpath('./uploads/style/' . $gambar));
			$this->db->query("UPDATE style_images SET img_style = '$file' WHERE id_scedule = '$id_scedule' AND tanggal_upload = '$tanggal' AND color = '$color'");
		} else {
			//$data = $this->input->post();
			$data['id_scedule'] = $id_scedule;
			$data['img_style'] = $file;
			$data['tanggal_upload'] = $tanggal;
			$data['color'] = $color;
			$this->db->insert('style_images', $data);
		}
	}






	public function display_inspect_dasbord_test($line_)
	{
		//$query = "";

		$sql = "select  v_schedule_produksi_2021_hari_ini.[ID]      ,[KANAAN_PO]      ,[BUYER]      ,[STYLE_NO]      ,[ITEM]      ,v_schedule_produksi_2021_hari_ini.[COLOR]      ,[QTY_ORDER]      ,[FOB]      ,  CONVERT(date, DELIVERY)  GAC          ,[QTY_PLAN]      , LINE_SEWING               ,[DES] 
		
		from
		SGI_LEAN.dbo.v_schedule_produksi_2021_hari_ini 

		
		where LINE_SEWING = '$line_' and v_schedule_produksi_2021_hari_ini.tampilkan_target = 'Y'  ";

		$data['schedule'] = $this->db_kis->query($sql)->row_array();


		$data['pagetitle'] = "INSPECT BAGS LINE $line_  DEFECT LIST";
		$data['line'] = $line_;
		$data['id_schedule'] = $data['schedule']['ID'];
		$id_schedule = $data['schedule']['ID'];

		//$data['defects'] = $this->db->query(" sp_grid_summary_perdefect_hasil_inspect_bags_defect_list_version1  '$line_' , '$id_schedule'  ")->result_array();
		$tanggal = date('Y-m-d');
		$sql = $this->db->query("SELECT id_scedule, img_style, color FROM style_images where id_scedule = '$id_schedule' AND tanggal_upload = '$tanggal' ORDER BY id_scedule ASC");
		$data['data']  = $sql->result_array();
		//pre($data);

		$data_query = $this->db->query(" sp_grid_summary_perdefect_hasil_inspect_bags_defect_list_version1  '$line_' , '$id_schedule'  ")->result_array();
		//pre($data); exit();

		usort($data_query, function ($a, $b) {
			return $b['jumlah_defect'] - $a['jumlah_defect'];
		});
		$topThree = array_slice($data_query, 0, 3);
		//echo json_encode($topThree);
		$data['defects'] = $topThree;
		$data['timer'] = 30000;

		//pre($data);
		$this->load->view('Qa_end_line/display_inspect_dasbord_test', $data);
	}


	public function hasil_defect_perjam($line)
	{
		//$data = $this->db->query(" hasil_qa_perjam  '0' ,'$line','jam_normal' ")->result_array();
		//[hasil_qa_perjam_fix] exec [hasil_qa_perjam_fix]  '2023-08-21' ,'64'   ;  
		// $data = $this->db->query(" hasil_qa_perjam_fix  '".date('Y-m-d')."' ,'$line' ")->result_array();

		//exec  [report_compare_output_vs_inspect] '2023-08-22' , '63' ;
		$data = $this->db->query(" report_defect_per_jam '" . date('Y-m-d') . "' ,'$line' ")->result_array();


		echo json_encode($data);
	}


	public function hasil_defect_perjam_qco($line)
	{
		//$data = $this->db->query(" hasil_qa_perjam  '0' ,'$line','jam_normal' ")->result_array();
		//[hasil_qa_perjam_fix] exec [hasil_qa_perjam_fix]  '2023-08-21' ,'64'   ;  
		// $data = $this->db->query(" hasil_qa_perjam_fix  '".date('Y-m-d')."' ,'$line' ")->result_array();

		//exec  [report_compare_output_vs_inspect] '2023-08-22' , '63' ;
		$data = $this->db->query(" report_defect_per_jam_qco '" . date('Y-m-d') . "' ,'$line' ")->result_array();


		echo json_encode($data);
	}

	public function hasil_defect_harian_qco()
	{
		// digunakan di : Qa_end_line_dashboard/qcov2 
		$data = $this->db->query(" report_defect_harian_qco '" . date('Y-m-d') . "'  ")->result_array();
		echo json_encode($data);
	}
	// [report_defect_harian_qco] '2024-03-13'


	//  EXEC sp_monitoring_schedule_hari_ini 
	public function sp_monitoring_schedule_hari_ini()
	{
		$data = $this->db->query(" sp_monitoring_schedule_hari_ini   ")->result_array();
		echo json_encode($data);
	}


	//  EXEC sp_monitoring_schedule_hari_ini 
	public function Sp_monitoring_schedule_hari_ini_perline($line)
	{
		$data = $this->db->query(" Sp_monitoring_schedule_hari_ini_perline '$line'  ")->result_array();
		echo json_encode($data);
	}



	public function history()
	{
		$data = array();
		$id = $this->input->post('rowid');
		// $data['filteredHasil'] = $this->db->query(" Sp_monitoring_schedule_hari_ini_perline '$id'  ")->result_array();
		$sql = " Sp_monitoring_schedule_hari_ini_perline '$id'  ";
		$data['filteredHasil'] =  execute_query_resultarray_and_log($sql);
		//pre($data);
		$this->load->view('Qa_end_line/history', $data);
	}


	public function panggil()
	{
		$data = array();
		$id = $this->input->post('rowid');
		// $data['filteredHasil'] = $this->db->query(" Sp_monitoring_schedule_hari_ini_perline '$id'  ")->result_array();
		//$sql = " Sp_monitoring_schedule_hari_ini_perline '$id'  ";
		//$data['filteredHasil'] =  execute_query_resultarray_and_log ($sql);
		//pre($data);
		$this->load->view('Qa_end_line/panggil', $data);
	}



	public function getJam()
	{
		date_default_timezone_set("Asia/Jakarta");
		$data = array();
		$data['jam'] = date("H:i");
		// $data['jam'] = date("H:i") . '  TOLONG DI KLIK REFRESH  ';

		$this->load->view('Qa_end_line/jam', $data);
	}

	public function getJam2()
	{
		date_default_timezone_set("Asia/Jakarta");
		$data = array();
		// $data['jam'] = date("H:i") . ' TOLONG DI KLIK REFRESH  ';
		$data['jam'] = date("H:i");
		$this->load->view('Qa_end_line/jam', $data);
	}
}

/* End of file Log.php */
/* Location: ./application/controllers/Log.php */
