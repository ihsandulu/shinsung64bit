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
		$data['pagetitle'] = 'SEWING END LINE LIST';
		$this->loadViews('Qa_end_line/Index', $data);
		//$this->loadViews("Qa_end_line/Index", $this->global, NULL, NULL);
	}

	public function daftar_schedule1($line_)
	{
		$sql = "select  v_schedule_produksi_2021_hari_ini.[ID]  ,   [tampilkan_target] ,[KANAAN_PO]      ,[STYLE_NO]      ,[ITEM]      ,[COLOR]      ,[QTY_ORDER]   , SIZE   ,[FOB]      ,  CONVERT(date, DELIVERY)  GAC          ,[QTY_PLAN]                     ,[DES]
		
		from
		SGI_LEAN.dbo.v_schedule_produksi_2021_hari_ini 
		
		
		where LINE_SEWING = '$line_' order by tampilkan_target desc";

		$data['schedule'] = $this->db_kis->query($sql)->result_array();
		// pre($data);
		$data['line'] = $line_;
		$data['pagetitle'] = "SCHEDULE LINE $line_ LIST ";
		$this->loadViews('Qa_end_line/daftar_schedule1', $data);
	}

	public function daftar_schedule($line_)
	{
		/* $sql = "select  v_schedule_produksi_2021_hari_ini.[ID]  ,   [tampilkan_target] ,[KANAAN_PO]      ,[STYLE_NO]      ,[ITEM]      ,[COLOR]      ,[QTY_ORDER]   , SIZE   ,[FOB]      ,  CONVERT(date, DELIVERY)  GAC          ,[QTY_PLAN]                     ,[DES]
		
		from
		SGI_LEAN.dbo.v_schedule_produksi_2021_hari_ini 
		
		
		where LINE_SEWING = '$line_' order by tampilkan_target desc";

		$data['schedule'] = $this->db_kis->query($sql)->result_array(); */
		// pre($data);
		$data['line'] = $line_;
		$data['pagetitle'] = "SCHEDULE LINE $line_ LIST";
		$this->loadViews('Qa_end_line/daftar_schedule', $data);
	}

	public function daftar_scheduleb($line_)
	{
		$data['line'] = $line_;
		$data['pagetitle'] = "SCHEDULE LINE $line_ LIST";
		$this->loadViews('Qa_end_line/daftar_scheduleb', $data);
	}

	public function hasil_inspect_bags_defect_list_version1($line_, $id_schedule)
	{
		/* $sql = "select  [ID]      ,[KANAAN_PO]      ,[BUYER]      ,[STYLE_NO]      ,[ITEM]      ,[COLOR]      ,[QTY_ORDER]      ,[FOB]      ,  CONVERT(date, DELIVERY)  GAC          ,[QTY_PLAN]      , LINE_SEWING               ,[DES] , 
		target100persen  TARGET100PERSEN  , SIZE
			from v_schedule_produksi_2021_hari_ini where LINE_SEWING = '$line_' and id = '$id_schedule' ";

		$data['schedule'] = $this->db_kis->query($sql)->row_array(); */

		/* $sql = "select  distinct jenis from daftar_defect ";
		$data['jenis'] = $this->db->query($sql)->result_array(); */

		/* $sql = "select  distinct * from daftar_defect order by jenis asc ";
		$data['daftar_defect'] = $this->db->query($sql)->result_array(); */

		$data['pagetitle'] = "QC OUTSIDE  LINE $line_ ";
		$data['line'] = $line_;
		$data['id_schedule'] = $id_schedule;

		$group = array('admin');
		if ($this->ion_auth->in_group($group)) {
			$this->loadViews('Qa_end_line/hasil_inspect_bags_defect_list_version1dev', $data);
		} else {
			$this->loadViews('Qa_end_line/hasil_inspect_bags_defect_list_version1dev', $data);
		}
	}

	public function cekin($line_, $id_schedule)
	{
		$data['pagetitle'] = "QC INSIDE LINE $line_ ";
		$data['line'] = $line_;
		$data['id_schedule'] = $id_schedule;
		$group = array('admin');
		$this->loadViews('Qa_end_line/cekin_v', $data);
	}

	public function cekout($line_, $id_schedule)
	{
		$data['pagetitle'] = "QC OUTSIDE LINE $line_ ";
		$data['line'] = $line_;
		$data['id_schedule'] = $id_schedule;
		$group = array('admin');
		$this->loadViews('Qa_end_line/cekout_v', $data);
	}

	public function cekoutb($line_, $id_schedule)
	{
		$data['pagetitle'] = "QC OUTSIDE LINE $line_ ";
		$data['line'] = $line_;
		$data['id_schedule'] = $id_schedule;
		$group = array('admin');
		$this->loadViews('Qa_end_line/cekoutb_v', $data);
	}

	public function ironing($line_, $id_schedule)
	{
		$data['pagetitle'] = "IRONING LINE $line_ ";
		$data['line'] = $line_;
		$data['id_schedule'] = $id_schedule;
		$group = array('admin');
		$this->loadViews('Qa_end_line/ironing_v', $data);
	}

	public function hangtag($line_, $id_schedule)
	{
		$data['pagetitle'] = "HANGTAG LINE $line_ ";
		$data['line'] = $line_;
		$data['id_schedule'] = $id_schedule;
		$group = array('admin');
		$this->loadViews('Qa_end_line/hangtag_v', $data);
	}

	public function hasil_inspect_bags_defect_list_version11($line_, $id_schedule)
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
			$this->loadViews('Qa_end_line/hasil_inspect_bags_defect_list_version1dev1', $data);
			//  $this->loadViews('Qa_end_line/hasil_inspect_bags_defect_list_version1socketio', $data);
			// exit();
		} else {
			// $this->loadViews('Qa_end_line/hasil_inspect_bags_defect_list_version1_', $data);	

			$this->loadViews('Qa_end_line/hasil_inspect_bags_defect_list_version1dev1', $data);

			//  $this->loadViews('Qa_end_line/hasil_inspect_bags_defect_list_version1socketio', $data); // 18 januari 2024 trial socket io
		}


		// $this->loadViews('Qa_end_line/hasil_inspect_bags_defect_list_version1dev1', $data);
	}




	public function hasil_inspect_bags_defect_list_version2($line_, $id_schedule)
	{
		/* $sql = "select  [ID]      ,[KANAAN_PO]      ,[BUYER]      ,[STYLE_NO]      ,[ITEM]      ,[COLOR]      ,[QTY_ORDER]      ,[FOB]      ,  CONVERT(date, DELIVERY)  GAC          ,[QTY_PLAN]      , LINE_SEWING               ,[DES] , 
		target100persen  TARGET100PERSEN  , SIZE
			from v_schedule_produksi_2021_hari_ini where LINE_SEWING = '$line_' and id = '$id_schedule' ";

		$data['schedule'] = $this->db_kis->query($sql)->row_array(); */

		/* $sql = "select  distinct jenis from daftar_defect ";
		$data['jenis'] = $this->db->query($sql)->result_array(); */

		/* $sql = "select  distinct * from daftar_defect order by jenis asc ";
		$data['daftar_defect'] = $this->db->query($sql)->result_array(); */

		$data['pagetitle'] = "QC INSIDE  LINE $line_ ";
		$data['line'] = $line_;
		$data['id_schedule'] = $id_schedule;

		$this->loadViews('Qa_end_line/hasil_inspect_bags_defect_list_version1dev2', $data);
	}

	public function hasil_inspect_bags_defect_list_version21($line_, $id_schedule)
	{
		$sql = "select  [ID]      ,[KANAAN_PO]      ,[BUYER]      ,[STYLE_NO]      ,[ITEM]      ,[COLOR]      ,[QTY_ORDER]      ,[FOB]      ,  CONVERT(date, DELIVERY)  GAC          ,[QTY_PLAN]      , LINE_SEWING               ,[DES] , 
		target100persen  TARGET100PERSEN  , SIZE
			from v_schedule_produksi_2021_hari_ini where LINE_SEWING = '$line_' and id = '$id_schedule' ";

		$data['schedule'] = $this->db_kis->query($sql)->row_array();

		$sql = "select  distinct jenis from daftar_defect ";
		$data['jenis'] = $this->db->query($sql)->result_array();

		$sql = "select  distinct * from daftar_defect order by jenis asc ";
		$data['daftar_defect'] = $this->db->query($sql)->result_array();

		$data['pagetitle'] = "QC INSIDE  LINE $line_ ";
		$data['line'] = $line_;
		$data['id_schedule'] = $id_schedule;

		$this->loadViews('Qa_end_line/hasil_inspect_bags_defect_list_version1dev21', $data);
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

	public function cekidn($line_)
	{
		$KANAAN_PO = $_POST["KANAAN_PO"];
		$STYLE_NO = $_POST["STYLE_NO"];
		$color = $_POST["color"];
		$size = $_POST["size"];
		// $sql = "select  * from Schedule_produksi where LINE_SEWING = '$line_' and id = '$id_schedule' ";
		$sql = "select  * from Schedule_produksi where LINE_SEWING = '$line_' and KANAAN_PO = '$KANAAN_PO' and  STYLE_NO  = '$STYLE_NO' and color = '$color' and  size  = '$size'";
		$data['schedule'] = $this->db_kis->query($sql)->row_array();
		if ($data['schedule']) {
			$dt_schedule = $data['schedule'];
			$id_schedule = $dt_schedule['ID'];
			$qtyorder = number_format($dt_schedule['QTY_ORDER'], 0, ".", ",");
			$target100 = $dt_schedule['target100persen'];
			$des = $dt_schedule['DES'];
			$arr = array('status'  => '1', 'id_schedule' => $id_schedule, 'qtyorder' => $qtyorder, 'target100' => $target100, 'des' => $des);
			echo json_encode($arr);
		}
	}

	public function weeklydefect()
	{

		$data["pagetitle"] = "WEEKLY DEFECT ANALYSIS ENDLINE QC SEWING";
		$this->loadViews('Qa_end_line/weeklydefect_v', $data);
	}

	public function weeklydefectb()
	{

		$data["pagetitle"] = "WEEKLY DEFECT ANALYSIS ENDLINE QC SEWING";
		$this->loadViews('Qa_end_line/weeklydefectb_v', $data);
	}

	public function hasil_inspect_bags_defect_list_version1_action($line_)
	{
		$KANAAN_PO = $_POST["KANAAN_PO"];
		$STYLE_NO = $_POST["STYLE_NO"];
		$color = $_POST["color"];
		$size = $_POST["size"];
		// $sql = "select  * from Schedule_produksi where LINE_SEWING = '$line_' and id = '$id_schedule' ";
		$sql = "select  * from Schedule_produksi where LINE_SEWING = '$line_' and KANAAN_PO = '$KANAAN_PO' and  STYLE_NO  = '$STYLE_NO' and color = '$color' and  size  = '$size'";

		$data['schedule'] = $this->db_kis->query($sql)->row_array();
		$user = $this->ion_auth->user()->row_array();


		if ($data['schedule']) {
			//INSERT HASIL
			$data_hasil = array();
			// $data['TANGGAL_HASIL'] = date('Y-m-d');
			$data_hasil['LINE'] = $line_;
			$dt_schedule = $data['schedule'];

			$id_schedule = $dt_schedule['ID'];

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


				$arr = array('status'  => '2', 'id_schedule' => $id_schedule);
				echo json_encode($arr);
			} else {
				$kode = $data['kode_defect'];
				$sql = $this->db->query("SELECT kode FROM daftar_defect where kode = '$kode'");
				$cek_kode = $sql->num_rows();

				if ($cek_kode > 0) {
					$this->db->insert('inspect_v2', $insert);
					$this->db->insert('inspect_v2_hari_ini', $insert);
					$arr = array('status'  => '1', 'id_schedule' => $id_schedule);
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


	public function hasil_inspect_bags_defect_list_version1_action1($line_, $id_schedule)
	{
		$sql = "select  * from Schedule_produksi where LINE_SEWING = '$line_' and id = '$id_schedule' ";
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
		$tanggal = date('Y-m-d');
		if (isset($_GET["date1"])) {
			$tanggal = $_GET["date1"];
		}
		$sql = " sp_grid_hasil_inspect_bags_defect_list_version11  '$line' , '$id_schedule', '$tanggal'  ";
		$data = execute_query_resultarray_and_log($sql);
		echo json_encode($data);
	}


	public function sp_grid_summary_hasil_inspect_bags_defect_list_version1($line, $id_schedule)
	{
		$group = array('admin');
		if ($this->ion_auth->in_group($group)) {
			$this->sp_grid_summary_hasil_inspect_bags_defect_list_version2($line, $id_schedule);
			exit();
		}
		$sql = "[sp_grid_summary_hasil_inspect_bags_defect_list_version1]  '$line' , '$id_schedule' ";
		$data = execute_query_resultarray_and_log($sql);
		echo json_encode($data);
	}

	public function qtyperjam()
	{
		$line = $_GET["line"];
		$KANAAN_PO = $_GET["KANAAN_PO"];
		$STYLE_NO = $_GET["STYLE_NO"];
		$COLOR = $_GET["color"];
		$SIZE = $_GET["size"];
		$tanggal = $_GET["tanggal"];
		$hari = date('N', strtotime($tanggal));
		$hari_ket = 'senin - kamis';
		if ($hari == 5) {
			$hari_ket = 'jumat';
		}
		$this->load->database();

		// Mendapatkan id_header yang aktif terlebih dahulu
		$this->db->select('id');
		$this->db->from('jam_narget_header');
		$this->db->where('is_active', 'y');
		$subquery = $this->db->get_compiled_select();

		// Mendapatkan data dari jam_narget_detail berdasarkan kriteria
		$this->db->select('jam_ke, jam_start, jam_end');
		$this->db->from('jam_narget_detail');
		$this->db->where("id_header IN ($subquery)", null, false); // Menggunakan subquery yang sudah dikompilasi
		$this->db->where('hari', $hari_ket);
		$query = $this->db->get();
		$jam_results = $query->result_array(); // Simpan hasil dalam array

		// Siapkan data jam untuk VALUES clause
		$jam_values = [];
		foreach ($jam_results as $row) {
			$jam_values[] = "('" . $row['jam_ke'] . "', '" . $row['jam_start'] . "', '" . $row['jam_end'] . "')";
		}

		// Gabungkan data jam menjadi string untuk VALUES clause
		$jam_values_str = implode(", ", $jam_values);

		// Buat query utama
		$sql = "
    SELECT '$tanggal' AS TANGGAL_PRODUKSI, s.line, 
        ISNULL(SUM(CASE WHEN j.jam_ke = 1 THEN s.QTY ELSE 0 END), 0) AS JAM_1,
        ISNULL(SUM(CASE WHEN j.jam_ke = 2 THEN s.QTY ELSE 0 END), 0) AS JAM_2,
        ISNULL(SUM(CASE WHEN j.jam_ke = 3 THEN s.QTY ELSE 0 END), 0) AS JAM_3,
        ISNULL(SUM(CASE WHEN j.jam_ke = 4 THEN s.QTY ELSE 0 END), 0) AS JAM_4,
        ISNULL(SUM(CASE WHEN j.jam_ke = 5 THEN s.QTY ELSE 0 END), 0) AS JAM_5,
        ISNULL(SUM(CASE WHEN j.jam_ke = 6 THEN s.QTY ELSE 0 END), 0) AS JAM_6,
        ISNULL(SUM(CASE WHEN j.jam_ke = 7 THEN s.QTY ELSE 0 END), 0) AS JAM_7,
        ISNULL(SUM(CASE WHEN j.jam_ke = 8 THEN s.QTY ELSE 0 END), 0) AS JAM_8,
        ISNULL(SUM(CASE WHEN j.jam_ke = 9 THEN s.QTY ELSE 0 END), 0) AS JAM_9,
        ISNULL(SUM(CASE WHEN j.jam_ke = 10 THEN s.QTY ELSE 0 END), 0) AS JAM_10,
        ISNULL(SUM(CASE WHEN j.jam_ke = 11 THEN s.QTY ELSE 0 END), 0) AS JAM_11,
        ISNULL(SUM(CASE WHEN j.jam_ke = 12 THEN s.QTY ELSE 0 END), 0) AS JAM_12,
        ISNULL(SUM(CASE WHEN j.jam_ke = 13 THEN s.QTY ELSE 0 END), 0) AS JAM_13,
        ISNULL(SUM(CASE WHEN j.jam_ke = 14 THEN s.QTY ELSE 0 END), 0) AS JAM_14,
        ISNULL(SUM(CASE WHEN j.jam_ke = 15 THEN s.QTY ELSE 0 END), 0) AS JAM_15,
        ISNULL(SUM(CASE WHEN j.jam_ke = 16 THEN s.QTY ELSE 0 END), 0) AS JAM_16,
        ISNULL(SUM(CASE WHEN j.jam_ke = 17 THEN s.QTY ELSE 0 END), 0) AS JAM_17,
        ISNULL(SUM(CASE WHEN j.jam_ke = 18 THEN s.QTY ELSE 0 END), 0) AS JAM_18,
        ISNULL(SUM(s.QTY), 0) AS TOTAL_AKHIR
    FROM sewing_hasil_produksi s
    LEFT JOIN (
        SELECT * FROM (VALUES $jam_values_str) AS v (jam_ke, jam_start, jam_end)
    ) j ON CONVERT(TIME, s.TANGGAL_HASIL) BETWEEN j.jam_start AND j.jam_end
    WHERE s.TANGGAL_HASIL IS NOT NULL
    AND CONVERT(DATE, s.TANGGAL_HASIL) = '$tanggal'
    AND s.line IS NOT NULL
    AND s.LINE = '$line'
	AND KANAAN_PO = '$KANAAN_PO'
	AND STYLE_NO = '$STYLE_NO'
	AND COLOR = '$COLOR'
	AND SIZE = '$SIZE'
    GROUP BY s.line
    ORDER BY s.line
";

		// Menjalankan query
		$query = $this->db->query($sql);

		// Mendapatkan hasil query
		$result = $query->result();

		// Tampilkan hasilnya
		$rows = "<thead><tr>";
		$rows .= "<td><strong>TIME TARGET</strong></td>";
		$rows .= "<td><strong> RESULT</strong></td>";
		$rows .= "</tr><thead>";
		$rows .= "<tbody>";
		foreach ($result as $row) {
			// echo 'Tanggal Produksi: ' . $row->TANGGAL_PRODUKSI . ', Line: ' . $row->line . '<br>';
			for ($i = 1; $i <= 18; $i++) {
				$rows .= '<tr><td>Time ' . $i . '</td><td>' . $row->{'JAM_' . $i} . '</td></tr>';
			}
			$rows .= '<tr><td>Final:</td><td>' . $row->TOTAL_AKHIR . '</td></tr>';
		}
		$rows .= "</tbody>";
		echo $rows;
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
		$sql = " SELECT   (uuid)  from   [dbo].[inspect_v2]  
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


	public function json_jumlah_qty_cek($line, $id_schedule, $tanggal)
	{
		/* $sql = " SELECT   (uuid)  from   [dbo].[inspect_v2]  
				where line = $line and id_schedule = '$id_schedule' and 
				CONVERT(VARCHAR(10), time_stamp, 120)   = CONVERT(VARCHAR(10), GETDATE(), 120)  
				and uuid <> '' and kode_defect = 'OK'   "; */
		/* $sql = " SELECT   (qty) uuid  from   [dbo].sewing_hasil_produksi
		where line = $line and id_schedule = '$id_schedule' and 
		CONVERT(VARCHAR(10), TANGGAL_HASIL, 120)   = CONVERT(VARCHAR(10), GETDATE(), 120)  
		  "; */
		// $data['jumlah_qty_cek'] = (count(execute_query_resultarray_and_log($sql)));
		// pre($data);
		$tok = 0;
		/* $mjenis = $this->db
			->select("inspect_v2.kode_defect, MAX(inspect_v2.id_schedule)as id_schedule, COUNT(id)as jml")
			->where("line", $line)
			->where("id_schedule", $id_schedule)
			->where("kode_defect", "OK")
			->where("CONVERT(VARCHAR, inspect_v2.time_stamp , 23) = ", $tanggal)
			->group_by(array('inspect_v2.kode_defect'))
			->get("inspect_v2");
		// $data['query'] = $this->db->last_query();
		if ($mjenis->num_rows() > 0) {
			foreach ($mjenis->result() as $rowj) {
				$tok += $rowj->jml;
			}
		} 
		$data['jumlah_qty_cek'] = $tok;
		*/

		$mjenis = $this->db
			->select("COUNT(id) as total_jml")
			->where("line", $line)
			->where("id_schedule", $id_schedule)
			->where("kode_defect", "OK")
			->where("CONVERT(VARCHAR, inspect_v2.time_stamp , 23) = ", $tanggal)
			->get("inspect_v2");

		$data['jumlah_qty_cek'] = ($mjenis->num_rows() > 0) ? $mjenis->row()->total_jml : 0;



		echo json_encode($data);
	}

	public function ironok($line, $id_schedule, $tanggal)
	{
		$tok = 0;
		/*
		$mjenis = $this->db
			->select("SUM(QTY)as jml")
			->where("line", $line)
			->where("id_schedule", $id_schedule)
			->where("CONVERT(VARCHAR, sewing_hasil_ironing.TANGGAL_HASIL , 23) = ", $tanggal)
			->group_by(array('CONVERT(VARCHAR, sewing_hasil_ironing.TANGGAL_HASIL , 23)'))
			->get("sewing_hasil_ironing");
		// $data['query'] = $this->db->last_query();
		if ($mjenis->num_rows() > 0) {
			foreach ($mjenis->result() as $rowj) {
				$tok += $rowj->jml;
			}
		} */

		$mjenis = $this->db
			->select("SUM(QTY) as jml")
			->where("line", $line)
			->where("id_schedule", $id_schedule)
			->where("CONVERT(VARCHAR, sewing_hasil_ironing.TANGGAL_HASIL , 23) = ", $tanggal)
			->get("sewing_hasil_ironing");
		$data['query'] = $this->db->last_query();
		$tok = ($mjenis->num_rows() > 0 && !is_null($mjenis->row()->jml)) ? $mjenis->row()->jml : 0;

		$ttok = 0;
		/*
		$mjenis = $this->db
			->select("SUM(QTY)as jml")
			->where("line", $line)
			->where("id_schedule", $id_schedule)
			->group_by(array('CONVERT(VARCHAR, sewing_hasil_ironing.TANGGAL_HASIL , 23)'))
			->get("sewing_hasil_ironing");
		// $data['query'] = $this->db->last_query();
		if ($mjenis->num_rows() > 0) {
			foreach ($mjenis->result() as $rowj) {
				$ttok += $rowj->jml;
			}
		} */

		$mjenis = $this->db
			->select("SUM(QTY) as jml")
			->where("line", $line)
			->where("id_schedule", $id_schedule)
			->get("sewing_hasil_ironing");

		$ttok = ($mjenis->num_rows() > 0 && !is_null($mjenis->row()->jml)) ? $mjenis->row()->jml : 0;


		$target = 0;
		/* $mjenis = $this->db
			->select("SUM(QTY)as jml")
			->where("line", $line)
			->where("id_schedule", $id_schedule)
			->group_by(array('CONVERT(VARCHAR, sewing_hasil_produksi.TANGGAL_HASIL , 23)'))
			->get("sewing_hasil_produksi");
		// $data['query'] = $this->db->last_query();
		if ($mjenis->num_rows() > 0) {
			foreach ($mjenis->result() as $rowj) {
				$target += $rowj->jml;
			}
		} */

		$mjenis = $this->db
			->select("SUM(QTY) as jml")
			->where("line", $line)
			->where("id_schedule", $id_schedule)
			->get("sewing_hasil_produksi");

		$target = ($mjenis->num_rows() > 0 && !is_null($mjenis->row()->jml)) ? $mjenis->row()->jml : 0;


		$data['target'] = $target;
		$data['jumlah_tqty_cek'] = $ttok;
		$data['jumlah_qty_cek'] = $tok;
		echo json_encode($data);
	}

	public function hangtagok($line, $id_schedule, $tanggal)
	{
		$tok = 0;
		/* $mjenis = $this->db
			->select("SUM(QTY)as jml")
			->where("line", $line)
			->where("id_schedule", $id_schedule)
			->where("CONVERT(VARCHAR, sewing_hasil_hangtag.TANGGAL_HASIL , 23) = ", $tanggal)
			->group_by(array('CONVERT(VARCHAR, sewing_hasil_hangtag.TANGGAL_HASIL , 23)'))
			->get("sewing_hasil_hangtag");
		$data['query'] = $this->db->last_query();
		if ($mjenis->num_rows() > 0) {
			foreach ($mjenis->result() as $rowj) {
				$tok += $rowj->jml;
			}
		} */
		$mjenis = $this->db
			->select("SUM(QTY) as jml")
			->where("line", $line)
			->where("id_schedule", $id_schedule)
			->where("CONVERT(VARCHAR, sewing_hasil_hangtag.TANGGAL_HASIL, 23) =", $tanggal)
			->get("sewing_hasil_hangtag");

		$data['query'] = $this->db->last_query(); // Untuk debugging, menampilkan query yang dijalankan

		$tok = ($mjenis->num_rows() > 0 && !is_null($mjenis->row()->jml)) ? $mjenis->row()->jml : 0;


		$ttok = 0;
		/* $mjenis = $this->db
			->select("SUM(QTY)as jml")
			->where("line", $line)
			->where("id_schedule", $id_schedule)
			->group_by(array('CONVERT(VARCHAR, sewing_hasil_hangtag.TANGGAL_HASIL , 23)'))
			->get("sewing_hasil_hangtag");
		// $data['query'] = $this->db->last_query();
		if ($mjenis->num_rows() > 0) {
			foreach ($mjenis->result() as $rowj) {
				$ttok += $rowj->jml;
			}
		} */
		$mjenis = $this->db
			->select("SUM(QTY) as jml")
			->where("line", $line)
			->where("id_schedule", $id_schedule)
			->get("sewing_hasil_hangtag");

		$ttok = ($mjenis->num_rows() > 0 && !is_null($mjenis->row()->jml)) ? $mjenis->row()->jml : 0;


		$target = 0;
		/* $mjenis = $this->db
			->select("SUM(QTY)as jml")
			->where("line", $line)
			->where("id_schedule", $id_schedule)
			->group_by(array('CONVERT(VARCHAR, sewing_hasil_ironing.TANGGAL_HASIL , 23)'))
			->get("sewing_hasil_ironing");
		// $data['query'] = $this->db->last_query();
		if ($mjenis->num_rows() > 0) {
			foreach ($mjenis->result() as $rowj) {
				$target += $rowj->jml;
			}
		} */
		$mjenis = $this->db
			->select("SUM(QTY) as jml")
			->where("line", $line)
			->where("id_schedule", $id_schedule)
			->get("sewing_hasil_ironing");

		// Mengambil nilai total jml, default ke 0 jika tidak ada hasil
		$target = ($mjenis->num_rows() > 0 && !is_null($mjenis->row()->jml)) ? $mjenis->row()->jml : 0;


		$data['target'] = $target;
		$data['jumlah_tqty_cek'] = $ttok;
		$data['jumlah_qty_cek'] = $tok;
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

	public function json_jumlah_qty_defect1($line, $id_schedule)
	{

		/* $sql = $this->db->select("count(unit_name) as jumlahdefect")
			->where("line", $line)
			->where("id_schedule", $id_schedule)
			->where("CONVERT(VARCHAR(10), time_stamp, 120) =", "CONVERT(VARCHAR(10), GETDATE(), 120)", false)
			->where("kode_defect <> 'OK'")
			->group_by("unit_name")
			->get("inspect_v2_hari_ini");
		$jumlahdefect = 0;
		foreach ($sql->result() as $row) {
			$jumlahdefect += $row->jumlahdefect;
		}
		$data["jumlahdefect"] = $jumlahdefect;
		$data["jumlahdress"] = $sql->num_rows(); */

		// Query untuk menghitung total defect yang bukan 'OK' pada hari ini
		$sql = $this->db->select("COUNT(unit_name) as jumlahdefect, COUNT(DISTINCT unit_name) as jumlahdress")
			->where("line", $line)
			->where("id_schedule", $id_schedule)
			->where("CONVERT(VARCHAR(10), time_stamp, 120) = CONVERT(VARCHAR(10), GETDATE(), 120)", null, false)
			->where("kode_defect <>", 'OK')
			->get("inspect_v2_hari_ini");

		$data["jumlahdefect"] = ($sql->num_rows() > 0 && !is_null($sql->row()->jumlahdefect)) ? $sql->row()->jumlahdefect : 0;
		$data["jumlahdress"] = ($sql->num_rows() > 0 && !is_null($sql->row()->jumlahdress)) ? $sql->row()->jumlahdress : 0;

		echo json_encode($data);
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


	public function sp_grid_summary_hasil_inspect_bags_defect_list_version1__($line)
	{
		$tanggal = date('Y-m-d');
		if (isset($_GET["date1"])) {
			$tanggal = $_GET["date1"];
		}
		$data = $this->qa_end_line_per_line_hari_ini1($line, $tanggal);
		echo json_encode($data);
	}



	public function qa_end_line_per_line_hari_ini1($line, $tanggal)
	{
		// Convert parameters if necessary
		$line = $this->db->escape($line);
		$tanggal = $this->db->escape($tanggal);

		// Define queries
		$queries = [
			"CREATE TABLE #checking (qty_checking FLOAT, line NVARCHAR(50)); 
             INSERT INTO #checking
             SELECT COUNT(*) as qty_checking, line 
             FROM (
                 SELECT DISTINCT uuid, line  
                 FROM inspect_v2_hari_ini  
                 WHERE CONVERT(VARCHAR(10), time_stamp, 120) = CONVERT(VARCHAR(10), $tanggal, 120)
				 AND line = " . $line . " 
             ) as data 
             GROUP BY line",

			"CREATE TABLE #defect (sum_defect FLOAT, line NVARCHAR(50)); 
             INSERT INTO #defect
             SELECT COUNT(*) as sum_defect, line 
             FROM inspect_v2_hari_ini  
             WHERE CONVERT(VARCHAR(10), time_stamp, 120) = CONVERT(VARCHAR(10), $tanggal, 120) 
             AND kode_defect <> 'OK'  
			AND line = " . $line . " 
             GROUP BY line",

			"CREATE TABLE #qty (qty_hasil FLOAT, line NVARCHAR(50)); 
             INSERT INTO #qty
             SELECT SUM(QTY) as qty_hasil, line 
             FROM sewing_hasil_produksi  
             WHERE CONVERT(VARCHAR(10), JAMINPUT, 120) = CONVERT(VARCHAR(10), $tanggal, 120) 
				 AND line = " . $line . " 
             GROUP BY line",

			"SELECT 
                #checking.line, 
                #checking.qty_checking, 
                #defect.sum_defect,
                CAST(ISNULL(#defect.sum_defect, 0) AS FLOAT) / CAST(ISNULL(#qty.qty_hasil+#defect.sum_defect, 0) AS FLOAT) * 100 AS persen_defect,
                ROUND(#qty.qty_hasil, 0) AS qty_hasil
             FROM 
                #checking 
             LEFT JOIN #defect ON #checking.line = #defect.line
             LEFT JOIN #qty ON #checking.line = #qty.line 
             WHERE #checking.line = $line
				 "
		];

		// Execute queries
		foreach ($queries as $query) {
			$this->db->query($query);
		}

		// Fetch the result of the last query
		$result = $this->db->query(end($queries))->result();

		// Drop temporary tables
		// $this->db->query("DROP TABLE IF EXISTS #checking");
		// $this->db->query("DROP TABLE IF EXISTS #defect");
		// $this->db->query("DROP TABLE IF EXISTS #qty");

		// Drop temporary tables if they exist
		$this->db->query("IF OBJECT_ID('tempdb..#checking', 'U') IS NOT NULL DROP TABLE #checking");
		$this->db->query("IF OBJECT_ID('tempdb..#defect', 'U') IS NOT NULL DROP TABLE #defect");
		$this->db->query("IF OBJECT_ID('tempdb..#qty', 'U') IS NOT NULL DROP TABLE #qty");


		// Return or process the result as needed
		return $result;
	}


	public function sp_grid_summary_hasil_inspect_bags_defect_list_versionb($line)
	{
		$tanggal = date('Y-m-d');
		if (isset($_GET["date1"])) {
			$tanggal = $_GET["date1"];
		}
		$KANAAN_PO = $this->input->get("KANAAN_PO");
		$STYLE_NO = $this->input->get("STYLE_NO");
		$data = $this->qa_end_line_per_line_hari_inib($line, $tanggal, $KANAAN_PO, $STYLE_NO);
		echo json_encode($data);
	}

	public function qa_end_line_per_line_hari_inib($line, $tanggal, $KANAAN_PO, $STYLE_NO)
	{
		// Convert parameters if necessary
		$line = $this->db->escape($line);
		$tanggal = $this->db->escape($tanggal);

		// Define queries
		$queries = [
			"CREATE TABLE #checking (qty_checking FLOAT, line NVARCHAR(50)); 
             INSERT INTO #checking
             SELECT COUNT(*) as qty_checking, line 
             FROM (
                 SELECT DISTINCT uuid, line  
                 FROM inspect_v2 
                 WHERE CONVERT(VARCHAR(10), time_stamp, 120) = CONVERT(VARCHAR(10), $tanggal, 120)
				 AND line = " . $line . " 
             ) as data 
             GROUP BY line",

			"CREATE TABLE #defect (sum_defect FLOAT, line NVARCHAR(50)); 
			INSERT INTO #defect
			SELECT COUNT(*) as sum_defect, line 
			FROM (
				SELECT line
				FROM inspect_v2 
				WHERE CONVERT(VARCHAR(10), time_stamp, 120) = CONVERT(VARCHAR(10), $tanggal, 120) 
				AND kanaan_po = '" . $KANAAN_PO . "'
				AND style = '" . $STYLE_NO . "'
				AND kode_defect <> 'OK'  
				AND line = " . $line . " 
				GROUP BY line, unit_name
			) as data1
			GROUP BY line;
			",

			"CREATE TABLE #tdefect (total_defect FLOAT, line NVARCHAR(50)); 
			INSERT INTO #tdefect
			SELECT COUNT(*) as total_defect, line 
			FROM (
				SELECT kode_defect, line
				FROM inspect_v2 
				WHERE CONVERT(VARCHAR(10), time_stamp, 120) = CONVERT(VARCHAR(10), $tanggal, 120) 
				AND kanaan_po = '" . $KANAAN_PO . "'
				AND style = '" . $STYLE_NO . "'
				AND kode_defect <> 'OK'  
				AND line = " . $line . " 
			) as data1
			GROUP BY line;
			",

			"CREATE TABLE #qty (qty_hasil FLOAT, line NVARCHAR(50)); 
             INSERT INTO #qty
             SELECT SUM(QTY) as qty_hasil, line 
             FROM sewing_hasil_produksi  
             WHERE CONVERT(VARCHAR(10), JAMINPUT, 120) = CONVERT(VARCHAR(10), $tanggal, 120) 
				AND KANAAN_PO = '" . $KANAAN_PO . "'
				AND STYLE_NO = '" . $STYLE_NO . "'
				 AND line = " . $line . " 
             GROUP BY line",

			"SELECT 
                #checking.line, 
                #checking.qty_checking, 
                #defect.sum_defect,
                #tdefect.total_defect,
                CAST(ISNULL(#defect.sum_defect, 0) AS FLOAT) / CAST(ISNULL(#qty.qty_hasil, 0) AS FLOAT) * 100 AS persen_defect,
                #qty.qty_hasil AS qty_hasil
             FROM 
                #checking 
             LEFT JOIN #tdefect ON #checking.line = #tdefect.line
             LEFT JOIN #defect ON #checking.line = #defect.line
             LEFT JOIN #qty ON #checking.line = #qty.line 
             WHERE #checking.line = $line
				 "
		];

		// Execute queries
		foreach ($queries as $query) {
			$this->db->query($query);
		}

		// Fetch the result of the last query
		$result = $this->db->query(end($queries))->result();

		// Drop temporary tables if they exist
		$this->db->query("IF OBJECT_ID('tempdb..#checking', 'U') IS NOT NULL DROP TABLE #checking");
		$this->db->query("IF OBJECT_ID('tempdb..#defect', 'U') IS NOT NULL DROP TABLE #defect");
		$this->db->query("IF OBJECT_ID('tempdb..#qty', 'U') IS NOT NULL DROP TABLE #qty");


		// Return or process the result as needed
		return $result;
	}


	public function sp_grid_summary_perdefect_hasil_inspect_bags_defect_list_version1($line, $id_schedule)
	{
		// $data = $this->db->query(" sp_grid_summary_perdefect_hasil_inspect_bags_defect_list_version1  '$line' , '$id_schedule'  ")->result_array();
		$sql = "sp_grid_summary_perdefect_hasil_inspect_bags_defect_list_version1  '$line' , '$id_schedule' ";
		$data = execute_query_resultarray_and_log($sql);
		echo json_encode($data);
	}


	public function ironingtable($line, $id_schedule)
	{
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

	public function hasil_qa_perjam1($line, $id_schedule)
	{
		$q = " report_compare_output_per_proses1  '" . date('Y-m-d') . "' ,'$line' ,'$id_schedule' ";
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
		/* $sql = "select  v_schedule_produksi_2021_hari_ini.[ID]      ,[KANAAN_PO]      ,[BUYER]      ,[STYLE_NO]      ,[ITEM]      ,v_schedule_produksi_2021_hari_ini.[COLOR]      ,[QTY_ORDER]      ,[FOB]      ,  CONVERT(date, DELIVERY)  GAC          ,[QTY_PLAN]      , LINE_SEWING               ,[DES] 
		
		from
		SGI_LEAN.dbo.v_schedule_produksi_2021_hari_ini 

		
		where LINE_SEWING = '$line_' and v_schedule_produksi_2021_hari_ini.tampilkan_target = 'Y'  ";

		$data['schedule'] = $this->db_kis->query($sql)->row_array(); */


		$data['pagetitle'] = "INSPECT BAGS LINE $line_  DEFECT LIST";
		$data['line'] = $line_;
		// $data['id_schedule'] = $data['schedule']['ID'];
		// $id_schedule = $data['schedule']['ID'];

		//$data['defects'] = $this->db->query(" sp_grid_summary_perdefect_hasil_inspect_bags_defect_list_version1  '$line_' , '$id_schedule'  ")->result_array();
		$tanggal = date('Y-m-d');
		if (isset($_GET["date1"])) {
			$tanggal = $_GET["date1"];
		}
		$sql = $this->db->query("SELECT id_scedule, img_style, color FROM style_images 
								JOIN schedule_line
								ON style_images.id_scedule = schedule_line.id_schedule
								WHERE  style_images.tanggal_upload = '$tanggal' 
								AND schedule_line.line = '$line_'
								ORDER BY id_scedule ASC");
		$data['data']  = $sql->result_array();
		//pre($data);

		$data_query = $this->db->query("exec dbo.dashboard_Qa_end_line_all_line_detail_defect_per_line1 '$line_','$tanggal'")->result_array();
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

	public function display_inspect_dasbordb($line_)
	{
		$data['pagetitle'] = "INSPECT BAGS LINE $line_  DEFECT LIST";
		$data['line'] = $line_;
		$tanggal = date('Y-m-d');
		if (isset($_GET["date1"])) {
			$tanggal = $_GET["date1"];
		}
		$sql = $this->db->query("SELECT id_scedule, img_style, color FROM style_images 
								JOIN schedule_line
								ON style_images.id_scedule = schedule_line.id_schedule
								WHERE  style_images.tanggal_upload = '$tanggal' 
								AND schedule_line.line = '$line_'
								ORDER BY id_scedule ASC");
		$data['data']  = $sql->result_array();
		$data_query = $this->db->query("exec dbo.dashboard_Qa_end_line_all_line_detail_defect_per_line1 '$line_','$tanggal'")->result_array();
		usort($data_query, function ($a, $b) {
			return $b['jumlah_defect'] - $a['jumlah_defect'];
		});
		$topThree = array_slice($data_query, 0, 3);
		//echo json_encode($topThree);
		$data['defects'] = $topThree;
		$data['timer'] = 30000;
		//pre($data);
		$this->load->view('Qa_end_line/display_inspect_dasbordb', $data);
	}






	public function upload_style_img()
	{
		//$data['pagetitle'] = "INSPECT BAGS LINE  DEFECT LIST";
		//$data= array();
		$tanggal = date('Y-m-d');
		$id = $this->uri->segment(4);
		$sql = $this->db->query("SELECT id_scedule, img_style, color FROM style_images where id_scedule = '$id' AND tanggal_upload = '$tanggal' ORDER BY id_scedule ASC");
		// pre($this->db->last_query());
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

	public function hasil_defect_perjam1($line)
	{
		//$data = $this->db->query(" hasil_qa_perjam  '0' ,'$line','jam_normal' ")->result_array();
		//[hasil_qa_perjam_fix] exec [hasil_qa_perjam_fix]  '2023-08-21' ,'64'   ;  
		// $data = $this->db->query(" hasil_qa_perjam_fix  '".date('Y-m-d')."' ,'$line' ")->result_array();

		//exec  [report_compare_output_vs_inspect] '2023-08-22' , '63' ;

		$tanggal = date("Y-m-d");
		if (isset($_GET["date1"])) {
			$tanggal = $_GET["date1"];
		}
		$data = $this->db->query(" report_defect_per_jam '" . $tanggal . "' ,'$line' ")->result_array();


		echo json_encode($data);
	}


	public function hasil_defect_perjamb($line)
	{
		$tanggal = date("Y-m-d");
		if (isset($_GET["date1"])) {
			$tanggal = $_GET["date1"];
		}
		$data = $this->db->query(" report_defect_per_jam '" . $tanggal . "' ,'$line' ")->result_array();
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
