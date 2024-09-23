<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Log
 */
class Report_end_line extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->is_logedin();
	}



	public function Report_hasil_produksi()
	{
		$data['pagetitle'] = 'REPORT HASIL PRODUKSI';

		$judul = "REPORT HASIL PRODUKSI MANAGER";

		$q = "Select * from daftar_defect ";
		$data['list_defect'] = $this->db->query($q)->result_array();

		$this->loadViews('Qa_end_line/Report_hasil_produksi', $data);
	}


	public function Report_hasil_produksi_action()
	{

		//    pre($_POST);
		if ($_POST['weekly'] == 'hasil_produksi') {
			$this->Report_hasil_produksi_periode_action();
		} else  if ($_POST['weekly'] == 'reward') {
			$this->Report_reward_based_defect_periode_action();
		}
	}


	public function Production_result()
	{
		$data = $_GET;
		$tanggal_awal =  date("Y-m-d");
		$tanggal_akhir = date("Y-m-d");
		if (isset($_GET["tanggal_awal"])) {
			$tanggal_awal =  $this->input->get("tanggal_awal");
		}
		if (isset($_GET["tanggal_akhir"])) {
			$tanggal_akhir =  $this->input->get("tanggal_akhir");
		}
		$sdate = $tanggal_awal;
		$edate = $tanggal_akhir;
		$pagetitle = 'PRODUCTION RESULTS REPORT PERIOD ' . format_tanggal_indonesia($tanggal_awal) . ' s/d ' . format_tanggal_indonesia($tanggal_akhir);
		$pagetitle1 = 'PRODUCTION RESULTS REPORT <br> PERIOD ' . format_tanggal_indonesia($tanggal_awal) . ' s/d ' . format_tanggal_indonesia($tanggal_akhir);

		$data["tanggal_awal"] = $tanggal_awal;
		$data["tanggal_akhir"] = $tanggal_akhir;
		$data["sdate"] = $sdate;
		$data["edate"] = $edate;
		$data["pagetitle"] = $pagetitle;
		$data["pagetitle1"] = $pagetitle1;
		//   echo $sql;
		$this->loadViews('Qa_end_line/Production_result', $data);
	}

	public function Production_result_sewingstyle()
	{
		$data = $_GET;
		$tanggal_awal =  date("Y-m-d");
		$tanggal_akhir = date("Y-m-d");
		if (isset($_GET["tanggal_awal"])) {
			$tanggal_awal =  $this->input->get("tanggal_awal");
		}
		if (isset($_GET["tanggal_akhir"])) {
			$tanggal_akhir =  $this->input->get("tanggal_akhir");
		}
		$sdate = $tanggal_awal;
		$edate = $tanggal_akhir;
		$pagetitle = '';
		$pagetitle1 = 'PRODUCTION RESULTS REPORT <br> PERIOD :' . date("d M Y", strtotime($tanggal_awal)) . ' ~ ' . date("d M Y", strtotime($tanggal_akhir));

		$data["tanggal_awal"] = $tanggal_awal;
		$data["tanggal_akhir"] = $tanggal_akhir;
		$data["sdate"] = $sdate;
		$data["edate"] = $edate;
		$data["pagetitle"] = $pagetitle;
		$data["pagetitle1"] = $pagetitle1;
		//   echo $sql;
		$this->loadViews('Qa_end_line/Production_result_sewingstyle', $data);
	}

	public function Production_result_sewingtime()
	{
		$data = $_GET;
		if (isset($_GET["tanggal"])) {
			$tanggal = $this->input->get("tanggal");
		} else {
			$tanggal = date("Y-m-d");
		}
		$sdate = $tanggal;
		$edate = $tanggal;
		$pagetitle = '';
		$pagetitle1 = 'PRODUCTION RESULTS REPORT <br> PERIOD :' . date("d M Y", strtotime($sdate)) . ' ~ ' . date("d M Y", strtotime($edate));

		$data["tanggal"] = $tanggal;
		$data["sdate"] = $sdate;
		$data["edate"] = $edate;
		$data["pagetitle"] = $pagetitle;
		$data["pagetitle1"] = $pagetitle1;
		//   echo $sql;
		$this->loadViews('Qa_end_line/Production_result_sewingtime', $data);
	}

	public function Production_result_iron()
	{
		$data = $_GET;
		$tanggal_awal =  date("Y-m-d");
		$tanggal_akhir = date("Y-m-d");
		if (isset($_GET["tanggal_awal"])) {
			$tanggal_awal =  $this->input->get("tanggal_awal");
		}
		if (isset($_GET["tanggal_akhir"])) {
			$tanggal_akhir =  $this->input->get("tanggal_akhir");
		}
		$sdate = $tanggal_awal;
		$edate = $tanggal_akhir;

		$pagetitle = '';
		$pagetitle1 = 'IRONING RESULTS REPORT <br> PERIOD :' . date("d M Y", strtotime($tanggal_awal)) . ' ~ ' . date("d M Y", strtotime($tanggal_akhir));

		$data["tanggal_awal"] = $tanggal_awal;
		$data["tanggal_akhir"] = $tanggal_akhir;
		$data["sdate"] = $sdate;
		$data["edate"] = $edate;
		$data["pagetitle"] = $pagetitle;
		$data["pagetitle1"] = $pagetitle1;
		//   echo $sql;
		$this->loadViews('Qa_end_line/Production_result_iron', $data);
	}

	public function Production_result_hangtag()
	{
		$data = $_GET;
		$tanggal_awal =  date("Y-m-d");
		$tanggal_akhir = date("Y-m-d");
		if (isset($_GET["tanggal_awal"])) {
			$tanggal_awal =  $this->input->get("tanggal_awal");
		}
		if (isset($_GET["tanggal_akhir"])) {
			$tanggal_akhir =  $this->input->get("tanggal_akhir");
		}
		$sdate = $tanggal_awal;
		$edate = $tanggal_akhir;

		$pagetitle = '';
		$pagetitle1 = 'HANGTAG RESULTS REPORT <br> PERIOD :' . date("d M Y", strtotime($tanggal_awal)) . ' ~ ' . date("d M Y", strtotime($tanggal_akhir));

		$data["tanggal_awal"] = $tanggal_awal;
		$data["tanggal_akhir"] = $tanggal_akhir;
		$data["sdate"] = $sdate;
		$data["edate"] = $edate;
		$data["pagetitle"] = $pagetitle;
		$data["pagetitle1"] = $pagetitle1;
		//   echo $sql;
		$this->loadViews('Qa_end_line/Production_result_hangtag', $data);
	}

	public function Production_result_packing()
	{
		$data = $_GET;
		$tanggal_awal =  date("Y-m-d");
		$tanggal_akhir = date("Y-m-d");
		if (isset($_GET["tanggal_awal"])) {
			$tanggal_awal =  $this->input->get("tanggal_awal");
		}
		if (isset($_GET["tanggal_akhir"])) {
			$tanggal_akhir =  $this->input->get("tanggal_akhir");
		}
		$sdate = $tanggal_awal;
		$edate = $tanggal_akhir;

		$pagetitle = '';
		$pagetitle1 = 'PRODUCTION RESULTS REPORT <br> PERIOD :' . date("d M Y", strtotime($tanggal_awal)) . ' ~ ' . date("d M Y", strtotime($tanggal_akhir));

		$data["tanggal_awal"] = $tanggal_awal;
		$data["tanggal_akhir"] = $tanggal_akhir;
		$data["sdate"] = $sdate;
		$data["edate"] = $edate;
		$data["pagetitle"] = $pagetitle;
		$data["pagetitle1"] = $pagetitle1;
		//   echo $sql;
		$this->loadViews('Qa_end_line/Production_result_packing', $data);
	}


	public function Report_hasil_produksi_periode_action()
	{
		$stringLine = " ALL ";
		$whereLine = " and 1=1 ";
		if (isset($_POST['line_sewing_multiple'])) {
			if (in_array('all', $_POST['line_sewing_multiple'])) {
				$line_sewing_multiple = 'all';
				$stringLine = " ALL ";
			} else {
				$line_sewing_multiple = implode(',', $_POST['line_sewing_multiple']);
				$stringLine = $line_sewing_multiple;
				$whereLine .= " and line in (" . $line_sewing_multiple . ")";
			}
		} else {
			$line_sewing_multiple = '';
		}
		$line_sewing = $_POST['line_sewing'];
		// $tanggal = $_POST['tanggal']; tanggal_start tanggal_end 
		$data = $_POST;
		$tanggal_awal =  $_POST['tanggal_start'];
		$tanggal_akhir = $_POST['tanggal_end'];
		$data['sdate'] = $tanggal_awal;
		$data['edate'] = $tanggal_akhir;
		$data['pagetitle'] = 'REPORT HASIL PRODUKSI <br> PERIODE TANGGAL ' . format_tanggal_indonesia($tanggal_awal) . ' s/d ' . format_tanggal_indonesia($tanggal_akhir) . ' <br> LINE ' . $stringLine;

		$sql = "SELECT [LINE], [KANAAN_PO], [STYLE_NO], [ITEM], [COLOR], [QTYGLOBAL], [DES], [GAC], [SIZE], sum([QTY]) AS HASIL
					FROM [dbo].[sewing_hasil_produksi]
					WHERE convert(date, TANGGAL_HASIL) BETWEEN '" . $tanggal_awal . "' AND '" . $tanggal_akhir . "' "
			. $whereLine . "
					GROUP BY [LINE], [KANAAN_PO], [STYLE_NO], [ITEM], [COLOR], [QTYGLOBAL], [DES], [GAC], [SIZE]
					ORDER BY CONVERT(INT, LINE)";
		$data['LineSewing'] = $stringLine;
		$data['Periode'] = ' TANGGAL ' . format_tanggal_indonesia($tanggal_awal) . ' s/d ' . format_tanggal_indonesia($tanggal_akhir);
		$data['report'] = $this->db->query($sql)->result_array();
		//   echo $sql;



		$this->loadViews('Qa_end_line/Report_hasil_produksi_periode_view', $data);

		// }
	}


	public function Report_summary_defect()
	{
		$data['pagetitle'] = 'REPORT SUMMARY DEFECT ';


		$judul = "REPORT SUMMARY DEFECT MANAGER";


		$this->loadViews('Qa_end_line/Report_summary_defect', $data);
	}

	public function Report_summary_defect1()
	{
		$data['pagetitle'] = 'REPORT SUMMARY DEFECT ';
		$judul = "REPORT SUMMARY DEFECT MANAGER";
		$this->loadViews('Qa_end_line/Report_summary_defect1', $data);
	}

	public function Report_summary_defect1b()
	{
		$data['pagetitle'] = 'REPORT SUMMARY DEFECT ';
		$judul = "REPORT SUMMARY DEFECT MANAGER";
		$this->loadViews('Qa_end_line/Report_summary_defect1b', $data);
	}

	public function Report_summary_defect2()
	{
		$data['pagetitle'] = 'MONTHLY REPORT';
		$this->loadViews('Qa_end_line/Report_summary_defect2', $data);
	}

	public function Report_summary_defectb()
	{
		$data['pagetitle'] = 'MONTHLY REPORT';
		$this->loadViews('Qa_end_line/Report_summary_defectb', $data);
	}

	public function Report_end_line_action()
	{
		// pre($_POST);
		if ($_POST['weekly'] == 'weekly') {
			$this->Report_summary_defect_action();
		} elseif ($_POST['weekly'] == 'DAILYDR') {
			$this->Daily_defect_rate_Action();
		} elseif ($_POST['weekly'] == 'SUMMARYDR') {
			$this->Summary_defect_rate_Action();
		} elseif ($_POST['weekly'] == 'weekly_top_5_per_line') {
			$this->Report_weekly_top_5_per_line_action();
		} elseif ($_POST['weekly'] == 'daily') {
			$this->Report_daily_action();
		} elseif ($_POST['weekly'] == 'dailyperkjstyle') {
			$this->Report_dailyperkj_action();
		} elseif ($_POST['weekly'] == 'dailyperkj') {
			$this->Report_dailyperkj_action();
		} //periode_top_5_per_line  
		elseif ($_POST['weekly'] == 'periode_top_5_per_line') {
			$this->Report_defect_top_5_per_line_periode_action();
		} elseif ($_POST['weekly'] == 'compareoutputhd') {
			$this->Report_compareoutputhd_action();
		} else {
			$data['pagetitle'] = 'REPORT SUMMARY DEFECT ';
			$data['heading'] = "ERROR ";
			$data['message'] = "REPORT <b>" . strtoupper(str_replace("_", " ",  $_POST['weekly'])) . "</b> BELUM TERSEDIA ";
			$this->loadViews('errors/cli/error_404', $data);
		}

		//compareoutputhd

	}

	public function Report_compareoutputhd_action()
	{
		// if (isset($_POST['bulan'])) {
		// $bulan  = $_POST['bulan'];
		// $tahun  = $_POST['tahun'];
		// $week  = $_POST['week'];
		// $manager  = $_POST['manager'];
		// $weekly = $_POST['weekly'];
		$line_sewing = $_POST['line_sewing'];
		// $tanggal = $_POST['tanggal']; tanggal_start tanggal_end 
		$data = $_POST;
		$tanggal_awal =  $_POST['tanggal_start'];
		$tanggal_akhir = $_POST['tanggal_end'];
		$data['sdate'] = $tanggal_awal;
		$data['edate'] = $tanggal_akhir;
		$data['pagetitle'] = 'REPORT OUTPUT PACKING & HD  <br> TANGGAL ' . format_tanggal_indonesia($tanggal_awal);


		$sql = "exec [report_compare_output_all_line]     '$tanggal_awal'  ";
		$data['report'] = $this->db->query($sql)->result_array();
		//   echo $sql;



		$this->loadViews('Qa_end_line/Report_compareoutputhd', $data);

		// }
	}

	public function Report_dailyperkj_action()
	{
		$bulan  = $_POST['bulan'];
		$tahun  = $_POST['tahun'];
		$week  = $_POST['week'];
		$manager  = $_POST['manager'];
		$weekly = $_POST['weekly'];
		$line_sewing = $_POST['line_sewing'];
		$tanggal = $_POST['tanggal'];
		$data = $_POST;
		//pre($_POST); echo $_POST['weekly']; 
		$data['pagetitle'] = 'REPORT DAILY  LINE :' . $line_sewing . '  	TANGGAL :' . $tanggal;
		$data['report_array']  = array();
		$data['qtychecking_array'] = array();
		$data['kanaan_po'] = array();
		foreach ($data['datakj'] as $key => $value) {
			$kanaan_po = $value;
			// array_push($data['kanaan_po'] , $kanaan_po);
			if ($weekly === 'dailyperkj') {
				$judul = $kanaan_po;
				array_push($data['kanaan_po'], $kanaan_po);
			} else {
				$judul = "KJ : " . str_replace(" ", "  STYLE NO :", $kanaan_po);
				array_push($data['kanaan_po'], $judul);
			}

			// pre($data['kanaan_po']); exit();
			$sql = "exec report_qa_harian   '$line_sewing' ,  '$tanggal'   ,  '$kanaan_po'    ";
			array_push($data['report_array'], $this->db->query($sql)->result_array());

			$sql = "Select  count(*) as qtychecking  from  	( select distinct (uuid)  from   [dbo].[inspect_v2]  where line = $line_sewing and 	CONVERT(VARCHAR(10), time_stamp, 120)   =  '$tanggal'  and [kanaan_po] + ' ' + [style] like '%'+ '$kanaan_po' + '%'  ) as data ";
			array_push($data['qtychecking_array'],  $this->db->query($sql)->row_array());
		}
		$this->loadViews('Qa_end_line/Report_qa_harian_perkj', $data);
	}


	public function Report_daily_action()
	{
		if (isset($_POST['bulan'])) {
			$bulan  = $_POST['bulan'];
			$tahun  = $_POST['tahun'];
			$week  = $_POST['week'];
			$manager  = $_POST['manager'];
			$weekly = $_POST['weekly'];
			$line_sewing = $_POST['line_sewing'];
			$tanggal = $_POST['tanggal'];
			$data = $_POST;

			$data['pagetitle'] = 'REPORT DAILY  LINE :' . $line_sewing . '  	TANGGAL :' . $tanggal;
			/* $sql = "exec report_qa_harian   $line_sewing ,  '$tanggal'  , ''  " ; 
			// echo $sql;
			$data['report']= $this->db->query($sql)->result_array();  
			//select @qtychecking = count(*) from  	( select distinct (uuid)  from   [dbo].[inspect_v2]  where line = @line and id_schedule = @id_schedule and 	CONVERT(VARCHAR(10), time_stamp, 120)   = CONVERT(VARCHAR(10), GETDATE(), 120)    ) as data 
			//get qty checking 
			$sql = "Select  count(*) as qtychecking  from  	( select distinct (uuid)  from   [dbo].[inspect_v2]  where line = $line_sewing and 	CONVERT(VARCHAR(10), time_stamp, 120)   =  '$tanggal'    ) as data ";
			$sql = "Select  sum(qty) as qtychecking  from  sewing_hasil_produksi where line = $line_sewing and 	CONVERT(VARCHAR(10), TANGGAL_HASIL, 120)   =  '$tanggal'       ";
			$result= $this->db->query($sql)->row_array();  			
			$data['qty_checking']  = $result['qtychecking']; */


			$this->loadViews('Qa_end_line/report_qa_harian', $data);
		}
	}

	public function Report_daily_action1()
	{
		$line_sewing = $_GET['line_sewing'];
		$data["line_sewing"] = $line_sewing;
		$tanggal = $_GET['tanggal'];
		$data["tanggal"] = $tanggal;
		$data = $_GET;
		$data['pagetitle'] = 'REPORT DAILY  LINE :' . $line_sewing . '  	DATE :' . date("d M Y", strtotime($tanggal));
		$this->load->view('Qa_end_line/report_qa_harian3', $data);
	}

	public function Report_daily_action1b()
	{
		$line_sewing = $_GET['line_sewing'];
		$data["line_sewing"] = $line_sewing;
		$tanggal = $_GET['tanggal'];
		$data["tanggal"] = $tanggal;
		$data = $_GET;
		$data['pagetitle'] = 'REPORT DAILY  LINE :' . $line_sewing . '  	DATE :' . date("d M Y", strtotime($tanggal));
		$this->load->view('Qa_end_line/report_qa_harian3b', $data);
	}

	public function Report_end_line_action1()
	{
		$line = $_GET['line'];
		$tanggal = $_GET['tanggal'];
		$data['pagetitle'] = 'REPORT DAILY  LINE :' . $line . '  	TANGGAL :' . $tanggal;
		$this->loadViews('Qa_end_line/report_qa_harian2', $data);
	}

	function cmp($a, $b, $order = 'desc')
	{
		if ($a['jumlah'] == $b['jumlah']) {
			return 0;
		}
		if ($order == 'desc') {
			return ($a['jumlah'] > $b['jumlah']) ? -1 : 1;
		} else {
			return ($a['jumlah'] < $b['jumlah']) ? -1 : 1;
		}
	}

	function sortArray(&$array, $order = 'desc')
	{
		usort($array, function ($a, $b) use ($order) {
			return $this->cmp($a, $b, $order);
		});
	}
	function sortDariTotalTerbesarBerdasarkanKodeDefect($data)
	{
		$totalByKodeDefect = [];

		// Hitung total berdasarkan kode_defect
		foreach ($data as $item) {
			$kodeDefect = $item['kode_defect'];
			$jumlah = $item['jumlah'];

			if (isset($totalByKodeDefect[$kodeDefect])) {
				$totalByKodeDefect[$kodeDefect] += $jumlah;
			} else {
				$totalByKodeDefect[$kodeDefect] = $jumlah;
			}
		}
		arsort($totalByKodeDefect);
		return $totalByKodeDefect;
	}

	function countByDefectAndDescription($array)
	{
		$countArray = array();
		foreach ($array as $item) {
			$key = ($item['keterangan']); // Ubah keterangan menjadi huruf besar
			if (array_key_exists($key, $countArray)) {
				$countArray[$key]['jumlah'] += $item['jumlah'];
			} else {
				$countArray[$key] = array('Keterangan' => $key, 'jumlah' => $item['jumlah'], 'kode_defect' => $item['kode_defect']);
			}
		}
		// Mengurutkan array berdasarkan jumlah dalam urutan menurun
		usort($countArray, function ($a, $b) {
			return $b['jumlah'] - $a['jumlah'];
		});
		return $countArray;
	}



	public function Report_defect_top_5_per_line_periode_action()
	{
		// if (isset($_POST['bulan'])) {
		// $bulan  = $_POST['bulan'];
		// $tahun  = $_POST['tahun'];
		// $week  = $_POST['week'];
		// $manager  = $_POST['manager'];
		// $weekly = $_POST['weekly'];
		$line_sewing = $_POST['line_sewing'];
		// $tanggal = $_POST['tanggal']; tanggal_start tanggal_end 
		$data = $_POST;
		$tanggal_awal =  $_POST['tanggal_start'];
		$tanggal_akhir = $_POST['tanggal_end'];
		$data['sdate'] = $tanggal_awal;
		$data['edate'] = $tanggal_akhir;
		$data['pagetitle'] = 'REPORT TOP 5 DEFECT <br> PERIODE ' . format_tanggal_indonesia($tanggal_awal) . ' s/d ' .  format_tanggal_indonesia($tanggal_akhir) . ' ,   LINE :' . $line_sewing;
		$sql = "exec [report_summary_defect_periode]  $line_sewing ,  '$tanggal_awal',  '$tanggal_akhir'  ";
		// echo $sql;
		$array = $this->db->query($sql)->result_array();
		$result = $this->countByDefectAndDescription($array);
		$data['DataSort'] = $result;
		$this->sortArray($array, 'desc');
		$data['report'] = $array;

		$sql = "exec report_summary_total_produksi_periode  $line_sewing ,  '$tanggal_awal',  '$tanggal_akhir'  ";
		//   echo $sql;
		$data['total_produksi'] = $this->db->query($sql)->result_array();
		// echo $sql;
		//   pre($data);


		$sql = "SELECT   tanggal, COUNT(*) AS jumlah FROM 
			(
			 select distinct uuid , CONVERT(VARCHAR(10), time_stamp, 120) as tanggal   
			 from   [dbo].[inspect_v2]  where  line = $line_sewing AND CONVERT(VARCHAR(10), time_stamp, 120) BETWEEN '$tanggal_awal' AND '$tanggal_akhir'  
			 GROUP BY CONVERT(VARCHAR(10), time_stamp, 120) , uuid ) as datanya group by tanggal  ";

		$sql = "SELECT    CONVERT(VARCHAR(10), tanggal_hasil, 120) tanggal  ,  SUM(QTY) AS jumlah FROM 
			[dbo].[sewing_hasil_produksi] where  line = $line_sewing AND CONVERT(VARCHAR(10), tanggal_hasil, 120) BETWEEN '$tanggal_awal' AND '$tanggal_akhir'  
			GROUP BY CONVERT(VARCHAR(10), tanggal_hasil, 120)   ";
		// echo $sql;
		$data['qtychecking_array'] =  $this->db->query($sql)->result_array();

		$totalJumlah = 0; // Inisialisasi total jumlah

		foreach ($data['qtychecking_array'] as $item) {
			if (isset($item['jumlah'])) {
				$totalJumlah += $item['jumlah'];
			}
		}
		$data['totalJumlah']  = $totalJumlah;
		// pre($data['qtychecking_array']); exit();

		$this->loadViews('Qa_end_line/Report_defect_top_5_per_line_periode_action', $data);

		// }
	}

	public function Report_defect_top_5_per_line_periode_action1()
	{
		$line_sewing = $_POST['line_sewing'];
		// $tanggal = $_POST['tanggal']; tanggal_start tanggal_end 
		$data = $_POST;
		$tanggal_awal =  $_POST['tanggal_start'];
		$tanggal_akhir = $_POST['tanggal_end'];
		$data['sdate'] = $tanggal_awal;
		$data['edate'] = $tanggal_akhir;
		$data['pagetitle'] = 'REPORT TOP 5 DEFECT <br> PERIOD ' . format_tanggal_indonesia($tanggal_awal) . ' s/d ' .  format_tanggal_indonesia($tanggal_akhir) . ' ,   LINE :' . $line_sewing;
		$sql = "exec [report_summary_defect_periode]  $line_sewing ,  '$tanggal_awal',  '$tanggal_akhir'  ";
		// echo $sql;
		$array = $this->db->query($sql)->result_array();
		$result = $this->countByDefectAndDescription($array);
		$data['DataSort'] = $result;
		$this->sortArray($array, 'desc');
		$data['report'] = $array;

		$sql = "exec report_summary_total_produksi_periode  $line_sewing ,  '$tanggal_awal',  '$tanggal_akhir'  ";
		//   echo $sql;
		$data['total_produksi'] = $this->db->query($sql)->result_array();
		// echo $sql;
		//   pre($data);


		$sql = "SELECT   tanggal, COUNT(*) AS jumlah FROM 
			(
			 select distinct uuid , CONVERT(VARCHAR(10), time_stamp, 120) as tanggal   
			 from   [dbo].[inspect_v2]  where  line = $line_sewing AND CONVERT(VARCHAR(10), time_stamp, 120) BETWEEN '$tanggal_awal' AND '$tanggal_akhir'  
			 GROUP BY CONVERT(VARCHAR(10), time_stamp, 120) , uuid ) as datanya group by tanggal  ";

		$sql = "SELECT    CONVERT(VARCHAR(10), tanggal_hasil, 120) tanggal  ,  SUM(QTY) AS jumlah FROM 
			[dbo].[sewing_hasil_produksi] where  line = $line_sewing AND CONVERT(VARCHAR(10), tanggal_hasil, 120) BETWEEN '$tanggal_awal' AND '$tanggal_akhir'  
			GROUP BY CONVERT(VARCHAR(10), tanggal_hasil, 120)   ";
		// echo $sql;
		$data['qtychecking_array'] =  $this->db->query($sql)->result_array();

		$totalJumlah = 0; // Inisialisasi total jumlah

		foreach ($data['qtychecking_array'] as $item) {
			if (isset($item['jumlah'])) {
				$totalJumlah += $item['jumlah'];
			}
		}
		$data['totalJumlah']  = $totalJumlah;
		// pre($data['qtychecking_array']); exit();

		$this->load->view('Qa_end_line/Report_defect_top_5_per_line_periode_action1', $data);

		// }
	}

	public function Report_defect_top_5_per_line_periode_action1b()
	{
		$line_sewing = $_GET['line_sewing'];
		// $tanggal = $_GET['tanggal']; tanggal_start tanggal_end 
		$data = $_GET;
		$tanggal_awal =  $_GET['tanggal_start'];
		$tanggal_akhir = $_GET['tanggal_end'];
		$data['sdate'] = $tanggal_awal;
		$data['edate'] = $tanggal_akhir;
		$data['line'] = $line_sewing;
		$data['pagetitle'] = 'REPORT TOP 5 DEFECT <br> PERIOD ' . format_tanggal_indonesia($tanggal_awal) . ' s/d ' .  format_tanggal_indonesia($tanggal_akhir) . ' ,   LINE :' . $line_sewing;
		$sql = "exec [report_summary_defect_periode]  $line_sewing ,  '$tanggal_awal',  '$tanggal_akhir'  ";
		// echo $sql;
		$array = $this->db->query($sql)->result_array();
		$result = $this->countByDefectAndDescription($array);
		$data['DataSort'] = $result;
		$this->sortArray($array, 'desc');
		$data['report'] = $array;

		$sql = "exec report_summary_total_produksi_periode  $line_sewing ,  '$tanggal_awal',  '$tanggal_akhir'  ";
		//   echo $sql;
		$data['total_produksi'] = $this->db->query($sql)->result_array();
		// echo $sql;
		//   pre($data);


		$sql = "SELECT   tanggal, COUNT(*) AS jumlah FROM 
			(
			 select distinct uuid , CONVERT(VARCHAR(10), time_stamp, 120) as tanggal   
			 from   [dbo].[inspect_v2]  where  line = $line_sewing AND CONVERT(VARCHAR(10), time_stamp, 120) BETWEEN '$tanggal_awal' AND '$tanggal_akhir'  
			 GROUP BY CONVERT(VARCHAR(10), time_stamp, 120) , uuid ) as datanya group by tanggal  ";

		$sql = "SELECT    CONVERT(VARCHAR(10), tanggal_hasil, 120) tanggal  ,  SUM(QTY) AS jumlah FROM 
			[dbo].[sewing_hasil_produksi] where  line = $line_sewing AND CONVERT(VARCHAR(10), tanggal_hasil, 120) BETWEEN '$tanggal_awal' AND '$tanggal_akhir'  
			GROUP BY CONVERT(VARCHAR(10), tanggal_hasil, 120)   ";
		// echo $sql;
		$data['qtychecking_array'] =  $this->db->query($sql)->result_array();

		$totalJumlah = 0; // Inisialisasi total jumlah

		foreach ($data['qtychecking_array'] as $item) {
			if (isset($item['jumlah'])) {
				$totalJumlah += $item['jumlah'];
			}
		}
		$data['totalJumlah']  = $totalJumlah;
		// pre($data['qtychecking_array']); exit();

		$this->load->view('Qa_end_line/Report_defect_top_5_per_line_periode_action1b', $data);

		// }
	}


	public function Report_weekly_top_5_per_line_action()
	{
		if (isset($_POST['bulan'])) {
			$bulan  = $_POST['bulan'];
			$tahun  = $_POST['tahun'];
			$week  = $_POST['week'];
			$manager  = $_POST['manager'];
			$weekly = $_POST['weekly'];
			$line_sewing = $_POST['line_sewing'];
			$tanggal = $_POST['tanggal'];
			$data = $_POST;

			$data['pagetitle'] = 'REPORT TOP 5 WEEKLY LINE ' . angkaKeBulan($bulan) . ' ' . $tahun . ' , Week ' . $week . '  LINE :' . $line_sewing;
			$sql = "exec report_summary_defect_weekly $bulan , $tahun , $week  , '$manager' , 'get_start_end_week'  , '$line_sewing'";
			// echo $sql;
			$data['start_week'] = $this->db->query($sql)->row_array();
			//pre(cetakNamaHari($data['start_week']['startweek'], $data['start_week']['akhirwek']));
			$data['nama_hari'] = cetakNamaHari($data['start_week']['startweek'], $data['start_week']['akhirwek']);
			//echo $sql;

			$sql = "exec report_summary_defect_weekly $bulan , $tahun , $week  , '$manager' , '$weekly' , '$line_sewing' ";
			$data['report'] = $this->db->query($sql)->result_array();
			echo $sql;

			$sql = "exec report_summary_total_produksi_weekly $bulan , $tahun , $week  , '$manager' , '$weekly'  , '$line_sewing'  ";
			$data['total_produksi'] = $this->db->query($sql)->result_array();
			// echo $sql;
			// pre($data['total_produksi']);

			$this->loadViews('Qa_end_line/Report_summary_defect_weekly_top_5_per_line_action', $data);
		}
	}




	public function Report_summary_defect_action()
	{
		if (isset($_POST['bulan'])) {

			$bulan  = $_POST['bulan'];
			$tahun  = $_POST['tahun'];
			$week  = $_POST['week'];
			$manager  = $_POST['manager'];
			$weekly = $_POST['weekly'];

			$data['pagetitle'] = 'REPORT SUMMARY DEFECT ' . angkaKeBulan($bulan) . ' ' . $tahun . ' , Week ' . $week . '  MANAGER :' . $manager;
			$sql = "select  distinct * from daftar_defect ";
			$data['daftar_defect'] = $this->db->query($sql)->result_array();
			$tanggal = 1;
			while (date('N', strtotime("$tahun-$bulan-$tanggal")) != 5) { // 5 untuk Jumat
				$tanggal++;
			}
			if ($weekly == 'weekly') {
				//pre($_POST);
				$sql = "exec report_summary_defect_weekly $bulan , $tahun , $week  , '$manager' , 'get_start_end_week' , '0'";
				echo $sql;
				$data['start_week'] = $this->db->query($sql)->row_array();
				//pre($data['start_week']);

				$sql = "exec report_summary_defect_weekly $bulan , $tahun , $week  , '$manager' , '$weekly' , '0' ";
				$data['report'] = $this->db->query($sql)->result_array();
				echo $sql;
				//exec [report_summary_defect_weekly] 5 , 2023 , 3 , 'lastri' , 'weeklychief' ; 
				$sql = "exec report_summary_defect_weekly $bulan , $tahun , $week  , '$manager' , 'weeklychief' , '0' ";
				$data['chief'] = $this->db->query($sql)->result_array();
				echo $sql;
				$sql = "exec report_summary_total_produksi_weekly $bulan , $tahun , $week  , '$manager' , '$weekly' , '0' ";
				$data['total_produksi'] = $this->db->query($sql)->result_array();
				echo $sql;


				$this->loadViews('Qa_end_line/Report_summary_defect_action', $data);
			} else {

				$data['pagetitle'] = 'REPORT SUMMARY DEFECT ';
				$data['heading'] = "ERROR ";
				$data['message'] = "REPORT BELUM TERSEDIA ";

				$this->loadViews('errors/cli/error_404', $data);
			}
		} else {
			// Variabel POST 'bulan' tidak ada
			// Lakukan tindakan alternatif jika diperlukan
			$data['pagetitle'] = 'REPORT SUMMARY DEFECT ';
			$data['heading'] = "ERROR ";
			$data['message'] = "NO SUBMIT DATA ";

			$this->loadViews('errors/cli/error_404', $data);
		}
	}



	public function Report_summary_defect_action_by_url($bulan, $tahun, $week, $manager, $weekly)
	{
		$data['pagetitle'] = 'REPORT SUMMARY DEFECT ' . angkaKeBulan($bulan) . ' ' . $tahun . ' , Week ' . $week . '  MANAGER :' . $manager;
		$sql = "select  distinct * from daftar_defect ";
		$data['daftar_defect'] = $this->db->query($sql)->result_array();
		$tanggal = 1;
		while (date('N', strtotime("$tahun-$bulan-$tanggal")) != 5) { // 5 untuk Jumat
			$tanggal++;
		}
		$sql = "exec report_summary_defect_weekly $bulan , $tahun , $week  , 'B.LASTRI' , '$weekly'";
		$data['report'] = $this->db->query($sql)->result_array();
		$this->loadViews('Qa_end_line/Report_summary_defect_action', $data);
	}


	public function get_kanaan_po_pertanggal()
	{
		$tanggal  = $_POST['tanggal'];
		$line_sewing  = $_POST['line_sewing'];
		$sql = " select distinct  [kanaan_po]  from   [dbo].[inspect_v2]  where line = $line_sewing   and 
	CONVERT(VARCHAR(10), time_stamp, 120)   = '$tanggal' ";
		$data = $this->db->query($sql)->result_array();
		$uuid = uniqid();
		//echo json_encode(['kanaan_po' => $data   , 'message' => "BAGS DEFECT , SAVED "] );
		echo json_encode($data);
	}

	public function get_kanaan_po_style_pertanggal()
	{
		$tanggal  = $_POST['tanggal'];
		$line_sewing  = $_POST['line_sewing'];
		$sql = " select distinct  [kanaan_po] + ' ' + [style]  as kanaan_po from   [dbo].[inspect_v2]  where line = $line_sewing   and 
	CONVERT(VARCHAR(10), time_stamp, 120)   = '$tanggal' ";
		$data = $this->db->query($sql)->result_array();
		$uuid = uniqid();
		//echo json_encode(['kanaan_po' => $data   , 'message' => "BAGS DEFECT , SAVED "] );
		echo json_encode($data);
	}




	public function Daily_defect_rate_Action()
	{
		// $tanggal_sebelum = '2023-07-25'; $tanggal_sesudah = '2023-07-25';
		$tanggal_sebelum = $_POST['tanggal_start'];
		$tanggal_sesudah = $_POST['tanggal_end'];

		$data['pagetitle'] = 'REPORT QA DAILY DEFECT RATE ACTION ';
		$data['report_array'] = $this->ambil_data_qty_check($tanggal_sebelum, $tanggal_sesudah);
		$data['report_defect'] = $this->ambil_data_qty_per_defect($tanggal_sebelum, $tanggal_sesudah);
		$data['sum_defect'] = $this->ambil_data_total_per_defect($tanggal_sebelum, $tanggal_sesudah);
		$data['daftar_defect'] = Helper_daftar_defect();
		// pre($data['daftar_defect']);
		$this->loadViews('Report_qa_daily/Defect_rate_Action_view', $data);
	}

	public function Daily_defect_rate_Action1()
	{
		// $tanggal_sebelum = '2023-07-25'; $tanggal_sesudah = '2023-07-25';
		$tanggal_sebelum = $_POST['tanggal_start'];
		$tanggal_sesudah = $_POST['tanggal_end'];

		$data['pagetitle'] = 'REPORT QA DAILY DEFECT RATE ACTION ';
		$data['report_array'] = $this->ambil_data_qty_check($tanggal_sebelum, $tanggal_sesudah);
		$data['report_defect'] = $this->ambil_data_qty_per_defect($tanggal_sebelum, $tanggal_sesudah);
		$data['sum_defect'] = $this->ambil_data_total_per_defect($tanggal_sebelum, $tanggal_sesudah);
		$data['daftar_defect'] = Helper_daftar_defect();
		// pre($data['daftar_defect']);
		$this->load->view('Report_qa_daily/Defect_rate_Action_view1', $data);
	}

	public function Daily_defect_rate_Action1b()
	{
		// $tanggal_sebelum = '2023-07-25'; $tanggal_sesudah = '2023-07-25';
		$tanggal_sebelum = $_POST['tanggal_start'];
		$tanggal_sesudah = $_POST['tanggal_end'];

		$data['pagetitle'] = 'REPORT QA DAILY DEFECT RATE ACTION ';
		$data['report_array'] = $this->ambil_data_qty_checkb($tanggal_sebelum, $tanggal_sesudah);
		$data['report_defect'] = $this->ambil_data_qty_per_defectb($tanggal_sebelum, $tanggal_sesudah);
		$data['report_mdefect'] = $this->ambil_data_qty_per_multidefectb($tanggal_sebelum, $tanggal_sesudah);
		// $data['sum_defect'] = $this->ambil_data_total_per_defectb($tanggal_sebelum, $tanggal_sesudah);
		$data['daftar_defect'] = Helper_daftar_defect();
		// pre($data['daftar_defect']);
		$this->load->view('Report_qa_daily/Defect_rate_Action_view1b', $data);
	}

	public function ambil_data_qty_check($tanggal_sebelum, $tanggal_sesudah)
	{
		// $sql = "Select 
		// ins.line , 	CONVERT(VARCHAR(10), ins.tanggal , 120) tanggal  , ins.kanaan_po , ins.style , ins.color 
		// , ins.qty_order  ,  count(*) as qty_check   , des  from 
		// [inspect_v2] ins where
		// CONVERT(VARCHAR(10), ins.tanggal , 120)  between '$tanggal_sebelum' and '$tanggal_sesudah'
		// and kanaan_po <> ''
		// group by 
		// ins.line ,	CONVERT(VARCHAR(10), ins.tanggal , 120) , ins.kanaan_po , ins.style , ins.color 
		// , ins.qty_order , des   order by   ins.line ,	CONVERT(VARCHAR(10), ins.tanggal , 120)  ";
		//    echo $sql;
		$sql = "select SUM(QTY) as qty_check , CONVERT(VARCHAR(10), tanggal_hasil, 120) tanggal , line  , kanaan_po , STYLE_NO as style , color , des , QTYGLOBAL  qty_order , size from [dbo].[sewing_hasil_produksi] where
   CONVERT(VARCHAR(10), tanggal_hasil, 120)   between '$tanggal_sebelum' and '$tanggal_sesudah'  
   	group by CONVERT(VARCHAR(10), tanggal_hasil, 120) , line  , kanaan_po , STYLE_NO , color  , des  , QTYGLOBAL , size
   order by   
   CONVERT(VARCHAR(10), tanggal_hasil, 120) asc
   ";
		//    echo $sql;
		$data = $this->db->query($sql)->result_array();
		// pre($data);
		return $data;
	}

	public function ambil_data_qty_checkb($tanggal_sebelum, $tanggal_sesudah)
	{
		$sql = "select COUNT(QTY) as qty_check, CONVERT(VARCHAR(10), tanggal_hasil, 120) as tanggal , line, kanaan_po, STYLE_NO as style, color, des, QTYGLOBAL as qty_order, size
		from sewing_hasil_produksi 
		where CONVERT(VARCHAR(10), tanggal_hasil, 120) between '$tanggal_sebelum' and '$tanggal_sesudah'  
   		group by CONVERT(VARCHAR(10), tanggal_hasil, 120), line, kanaan_po, STYLE_NO, color, des, QTYGLOBAL, size
   		order by  CONVERT(VARCHAR(10), tanggal_hasil, 120) asc
   		";
		//    echo $sql;
		$data = $this->db->query($sql)->result_array();
		// pre($data);
		return $data;
	}
	public function ambil_data_qty_per_defect($tanggal_sebelum, $tanggal_sesudah)
	{
		$sql = "Select 
		ins.line , 	CONVERT(VARCHAR(10), ins.tanggal , 120) tanggal  , ins.kanaan_po , ins.style , ins.color 
		, ins.qty_order  ,  count(*) as qty_defect ,  replace(kode_defect, '0','x') as kode_defect10 ,  kode_defect  , des , size   from 
		[inspect_v2] ins where
		CONVERT(VARCHAR(10), ins.tanggal , 120) 
		between  '$tanggal_sebelum' and '$tanggal_sesudah'
		and kode_defect <> 'ok'
		and kanaan_po <> ''
		group by 
		ins.line ,	CONVERT(VARCHAR(10), ins.tanggal , 120) , ins.kanaan_po , ins.style , ins.color 
		, ins.qty_order  
		, kode_defect  , des ,size 
		order by   ins.line ,	CONVERT(VARCHAR(10), ins.tanggal , 120) ";
		//   echo $sql;
		$data = $this->db->query($sql)->result_array();
		// pre($data);
		return $data;
	}
	public function ambil_data_qty_per_defectb($tanggal_sebelum, $tanggal_sesudah)
	{
		$sql = "Select 
		ins.line , 	CONVERT(VARCHAR(10), ins.tanggal , 120) tanggal  , ins.kanaan_po , ins.style , ins.color 
		, ins.qty_order  ,  count(*) as qty_defect ,  replace(kode_defect, '0','x') as kode_defect10 ,  kode_defect  , des , size   from 
		[inspect_v2] ins where
		CONVERT(VARCHAR(10), ins.tanggal , 120) 
		between  '$tanggal_sebelum' and '$tanggal_sesudah'
		and kode_defect <> 'ok'
		and kanaan_po <> ''
		group by 
		ins.line ,	CONVERT(VARCHAR(10), ins.tanggal , 120) , ins.kanaan_po , ins.style , ins.color 
		, ins.qty_order  
		, kode_defect  , des ,size 
		order by   ins.line ,	CONVERT(VARCHAR(10), ins.tanggal , 120) ";
		//   echo $sql;
		$data = $this->db->query($sql)->result_array();
		// pre($data);
		return $data;
	}
	public function ambil_data_qty_per_multidefectb($tanggal_sebelum, $tanggal_sesudah)
	{
		$sql = "Select 
		ins.line, 	CONVERT(VARCHAR(10), ins.tanggal , 120) tanggal, ins.kanaan_po, ins.style, ins.color, ins.size,  count(DISTINCT unit_name) as qty_unitname from 
		[inspect_v2] ins where
		CONVERT(VARCHAR(10), ins.tanggal , 120) 
		between  '$tanggal_sebelum' and '$tanggal_sesudah'
		and kode_defect <> 'ok'
		group by 
		ins.line, CONVERT(VARCHAR(10), ins.tanggal , 120), ins.kanaan_po, ins.style, ins.color, ins.size
		order by  ins.line,	CONVERT(VARCHAR(10), ins.tanggal, 120) ";
		//   echo $sql;
		$data = $this->db->query($sql)->result_array();
		// pre($data);
		return $data;
	}
	public function ambil_data_total_per_defect($tanggal_sebelum, $tanggal_sesudah)
	{
		$sql = "Select 
		count(*) as qty_defect , kode_defect, MAX(REPLACE(kode_defect, '0','x')) as kode_defect10   from 
		[inspect_v2] ins where
		CONVERT(VARCHAR(10), ins.tanggal , 120) 
		between  '$tanggal_sebelum' and '$tanggal_sesudah'
		and kode_defect <> 'ok'
		and kanaan_po <> ''
		group by 
		kode_defect 
		 ";
		// echo $sql;
		$data = $this->db->query($sql)->result_array();
		// pre($data);
		return $data;
	}
	public function ambil_data_total_per_defectb($tanggal_sebelum, $tanggal_sesudah)
	{
		$sql = "Select 
		count(*) as qty_defect , kode_defect, MAX(REPLACE(kode_defect, '0','x')) as kode_defect10   from 
		[inspect_v2] ins where
		CONVERT(VARCHAR(10), ins.tanggal , 120) 
		between  '$tanggal_sebelum' and '$tanggal_sesudah'
		and kode_defect <> 'ok'
		and kanaan_po <> ''
		group by 
		kode_defect 
		 ";
		// echo $sql;
		$data = $this->db->query($sql)->result_array();
		// pre($data);
		return $data;
	}




	public function Summary_defect_rate_Action()
	{
		// $tanggal_sebelum = '2023-07-25'; $tanggal_sesudah = '2023-07-31';
		$tanggal_sebelum = $_POST['tanggal_start'];
		$tanggal_sesudah = $_POST['tanggal_end'];
		$data['pagetitle'] = 'REPORT QA SUMMARY DEFECT RATE ACTION ';
		$data['tanggal'] = cetakNamaHari($tanggal_sebelum, $tanggal_sesudah);
		$data['qty_check_harian_line'] = $this->ambil_qty_check_harian_line($tanggal_sebelum, $tanggal_sesudah);
		$data['qty_defect_harian_line'] = $this->ambil_qty_defect_harian_line($tanggal_sebelum, $tanggal_sesudah);
		$data['daftar_line'] = $this->ambil_daftar_line($tanggal_sebelum, $tanggal_sesudah);
		// pre($data['daftar_defect']);
		$this->loadViews('Report_qa_daily/Summary_defect_rate_Action_view', $data);
	}

	public function Summary_defect_rate_Action1()
	{
		// $tanggal_sebelum = '2023-07-25'; $tanggal_sesudah = '2023-07-31';
		$tanggal_sebelum = $_POST['tanggal_start'];
		$tanggal_sesudah = $_POST['tanggal_end'];
		$data['pagetitle'] = 'REPORT QA SUMMARY DEFECT RATE ACTION ';
		$data['tanggal'] = cetakNamaHari($tanggal_sebelum, $tanggal_sesudah);
		$data['qty_check_harian_line'] = $this->ambil_qty_check_harian_line($tanggal_sebelum, $tanggal_sesudah);
		$data['qty_defect_harian_line'] = $this->ambil_qty_defect_harian_line($tanggal_sebelum, $tanggal_sesudah);
		$data['daftar_line'] = $this->ambil_daftar_line($tanggal_sebelum, $tanggal_sesudah);
		// pre($data['daftar_defect']);
		$this->load->view('Report_qa_daily/Summary_defect_rate_Action_view1', $data);
	}

	public function Summary_defect_rate_Action1b()
	{
		// $tanggal_sebelum = '2023-07-25'; $tanggal_sesudah = '2023-07-31';
		$tanggal_sebelum = $_POST['tanggal_start'];
		$tanggal_sesudah = $_POST['tanggal_end'];
		$data['pagetitle'] = 'REPORT QA SUMMARY DEFECT RATE ACTION ';
		$data['tanggal'] = cetakNamaHari($tanggal_sebelum, $tanggal_sesudah);
		$data['qty_check_harian_line'] = $this->ambil_qty_check_harian_line($tanggal_sebelum, $tanggal_sesudah);
		$data['qty_defect_harian_line'] = $this->ambil_qty_defect_harian_line1b($tanggal_sebelum, $tanggal_sesudah);
		$data['daftar_line'] = $this->ambil_daftar_line($tanggal_sebelum, $tanggal_sesudah);
		// pre($data['daftar_defect']);
		$this->load->view('Report_qa_daily/Summary_defect_rate_Action_view1b', $data);
	}

	public function Summary_defect_rate_Action2()
	{
		// $tanggal_sebelum = '2023-07-25'; $tanggal_sesudah = '2023-07-31';
		$tanggal_sebelum = $_POST['tanggal_start'];
		$tanggal_sesudah = $_POST['tanggal_end'];
		$data['pagetitle'] = 'MONTHLY QA DEFECT RATE SUMMARY REPORT ';
		$data['tanggal'] = cetakNamaHari($tanggal_sebelum, $tanggal_sesudah);
		$data['qty_check_harian_line'] = $this->ambil_qty_check_harian_line($tanggal_sebelum, $tanggal_sesudah);
		$data['qty_defect_harian_line'] = $this->ambil_qty_defect_harian_line($tanggal_sebelum, $tanggal_sesudah);
		$data['daftar_line'] = $this->ambil_daftar_line($tanggal_sebelum, $tanggal_sesudah);
		// pre($data['daftar_defect']);
		$this->load->view('Report_qa_daily/Summary_defect_rate_Action_view2', $data);
	}
	public function Summary_defect_rate_Actionb()
	{
		// $tanggal_sebelum = '2023-07-25'; $tanggal_sesudah = '2023-07-31';
		$tanggal_sebelum = $_POST['tanggal_start'];
		$tanggal_sesudah = $_POST['tanggal_end'];
		$data['pagetitle'] = 'MONTHLY QA DEFECT RATE SUMMARY REPORT ';
		$data['tanggal'] = cetakNamaHari($tanggal_sebelum, $tanggal_sesudah);
		$data['qty_check_harian_line'] = $this->ambil_qty_check_harian_line($tanggal_sebelum, $tanggal_sesudah);
		$data['qty_defect_harian_line'] = $this->ambil_qty_defect_harian_lineb($tanggal_sebelum, $tanggal_sesudah);
		$data['daftar_line'] = $this->ambil_daftar_line($tanggal_sebelum, $tanggal_sesudah);
		// pre($data['daftar_defect']);
		$this->load->view('Report_qa_daily/Summary_defect_rate_Action_viewb', $data);
	}

	public function ambil_daftar_line($tanggal_sebelum, $tanggal_sesudah)
	{
		$sql = "Select distinct  ins.line, CAST(ins.line AS INT) AS line_num  from 	[inspect_v2] ins where CONVERT(VARCHAR(10), ins.tanggal , 120)  between '$tanggal_sebelum' and '$tanggal_sesudah' 	  order by  line_num ASC";
		$data = $this->db->query($sql)->result_array();
		return $data;
	}

	public function ambil_qty_check_harian_line($tanggal_sebelum, $tanggal_sesudah)
	{
		$sql = "
		Select count(*) qty_check , tanggal , line   from 
			(
			Select  distinct  (uuid) , 	CONVERT(VARCHAR(10), ins.tanggal , 120) tanggal , line   
			from 
				[inspect_v2] ins 
			where
			 	CONVERT(VARCHAR(10), ins.tanggal , 120)  between '$tanggal_sebelum' and '$tanggal_sesudah' 
			 	and kanaan_po <> ''	
			 ) as data
			group by 
			 	tanggal , line    
			order by   
			   tanggal asc

		  ";

		$sql = "select  SUM(QTY) as qty_check ,    CONVERT(VARCHAR(10), tanggal_hasil, 120) tanggal ,  line   from   [dbo].[sewing_hasil_produksi]  where 
		  CONVERT(VARCHAR(10), tanggal_hasil, 120)   between '$tanggal_sebelum' and '$tanggal_sesudah'  
		  group by  CONVERT(VARCHAR(10), tanggal_hasil, 120) , line 
		  order by   
		  tanggal asc
		  ";
		//   echo $sql ; 
		$data = $this->db->query($sql)->result_array();
		return $data;
	}

	public function ambil_qty_defect_harian_line($tanggal_sebelum, $tanggal_sesudah)
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
				and kanaan_po <> ''
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
		$data = $this->db->query($sql)->result_array();
		return $data;
	}

	public function ambil_qty_defect_harian_line1b($tanggal_sebelum, $tanggal_sesudah)
	{
		$sql = "
		Select count(DISTINCT unit_name) qty_defect , tanggal , line   from 
			(
			Select    	CONVERT(VARCHAR(10), ins.tanggal , 120) tanggal , line, unit_name    
			from 
				[inspect_v2] ins 
			where
			 	CONVERT(VARCHAR(10), ins.tanggal , 120)  between '$tanggal_sebelum' and '$tanggal_sesudah' 	
			 	and 
				kode_defect <> 'ok'
				and kanaan_po <> ''
			 ) as data
			group by 
			 	tanggal ,  line    
			order by   
			    line 

		  ";

		$data = $this->db->query($sql)->result_array();
		return $data;
	}

	public function ambil_qty_defect_harian_lineb($tanggal_sebelum, $tanggal_sesudah)
	{
		$sql = "
				SELECT COUNT(DISTINCT unit_name) AS qty_defect, tanggal, line 
				FROM 
				(
				SELECT CONVERT(VARCHAR(10), ins.tanggal, 120) AS tanggal, line, unit_name  
				FROM 
					[inspect_v2] ins 
				WHERE
					CONVERT(VARCHAR(10), ins.tanggal, 120) BETWEEN '$tanggal_sebelum' AND '$tanggal_sesudah' 
					AND kode_defect <> 'ok'
					AND kanaan_po <> ''
				) AS data
				GROUP BY tanggal, line    
				ORDER BY line;
		  ";

		$data = $this->db->query($sql)->result_array();
		return $data;
	}

	public function Report_fml()
	{
		$data['pagetitle'] = 'DEFECT PICTURE REPORT';
		$this->loadViews('Qa_end_line/Report_fml', $data);
	}


	public function fml()
	{
		$tanggal = $this->input->get('tanggal');
		$tanggal2 = $this->input->get('tanggal2');
		$line = $this->input->get('line');

		$data['info_tanggal'] = $tanggal;
		$data['info_line'] = $line;

		/* $sql = "exec [sp_fml_report] '$tanggal' , '$tanggal2', '$line' ";
		//echo $sql ;

		$data['data'] = $this->db->query($sql)->result_array(); */

		$this->db->select('line, tanggal_upload');
		$this->db->select("MAX(CASE WHEN color = 'red' THEN img_style ELSE '' END) AS f", false);
		$this->db->select("MAX(CASE WHEN color = 'yellow' THEN img_style ELSE '' END) AS m", false);
		$this->db->select("MAX(CASE WHEN color = 'green' THEN img_style ELSE '' END) AS l", false);
		$this->db->from('style_images');
		$this->db->join('schedule_line', 'style_images.id_scedule = schedule_line.id_schedule', 'inner');
		$this->db->where('style_images.tanggal_upload >=', $tanggal);
		$this->db->where('style_images.tanggal_upload <=', $tanggal2);

		if (!empty($line)) {
			$lines = explode(',', $line);
			$this->db->where_in('line', $lines);
		}

		$this->db->group_by(['line', 'tanggal_upload']);
		$this->db->order_by('CAST(line AS INT)', 'ASC');



		$query = $this->db->get();
		// echo $this->db->last_query();
		$data['data'] = $query->result_array();
		// pre($data['data']);
		$data['row_count'] = round(count($data['data']) / 2, 0, PHP_ROUND_HALF_UP);
		$first_table = [];
		$second_table = [];
		for ($i = 0; $i < count($data['data']); $i++) {
			if ($i == 0 || $i <= $data['row_count']) {
				$first_table[] = $data['data'][$i];  // Baris pertama masuk ke tabel pertama
			} else {
				$second_table[] = $data['data'][$i]; // Baris kedua masuk ke tabel kedua
			}
		}

		// Sekarang $first_table dan $second_table siap digunakan dalam view atau di tempat lain
		$data['first_table'] = $first_table;
		$data['second_table'] = $second_table;

		// return $data ; 
		//echo json_encode($data);
		//pre($data);
		$data['pagetitle'] = "FML";
		$this->load->view('Qa_end_line/fml', $data);
	}


	/*
	public function Report_lost_time()
	{
		$data['pagetitle'] = 'REPORT LOST TIME';
		$this->loadViews('Qa_end_line/Report_lost_time', $data);
	}


	public function lost_time()
	{
		$tanggal = $this->input->get('tanggal');

		
		$data['info_tanggal'] = $tanggal;
		
		$sql = "exec sp_loss_time_fix '$tanggal'";
		//echo $sql ;

		$data['data'] = $this->db->query($sql)->result_array();  
		
		// return $data ; 
		//echo json_encode($data);
		//pre($data);
		$data['pagetitle'] = "LOST TIME";
		$this->load->view('Qa_end_line/lost_time', $data);
			
	}
	
	
	*/
}
