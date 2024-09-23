<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Log
 */
class Grafik extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->is_logedin();
		$this->load->helper('GrafikQuery');
	}


	public function report_defectrate()
	{
		// $sql = "select distinct REPLACE(buyer, ' ','_') as buyer from Schedule_produksi" ; 
		$sql = "select buyer from inspect_v2 GROUP BY buyer ORDER BY BUYER";
		$data['buyer'] = $this->db->query($sql)->result_array();

		$data['pagetitle'] = "GRAFIK DEFECTRATE";
		//pre($data);
		$this->loadViews('Grafik/report_defectrate', $data);
	}

	public function report_defectrateb()
	{
		// $sql = "select distinct REPLACE(buyer, ' ','_') as buyer from Schedule_produksi" ; 
		$sql = "select buyer from inspect_v2 GROUP BY buyer ORDER BY BUYER";
		$data['buyer'] = $this->db->query($sql)->result_array();

		$data['pagetitle'] = "DEFECT RATE CHART";
		//pre($data);
		$this->loadViews('Grafik/report_defectrateb', $data);
	}


	// sp_dashboard_lean 'defectrate';  
	public function defectrate()
	{
		$this->benchmark->mark('code_start');
		$buyer_get = $this->input->get('buyer');
		$buyer =  $buyer_get; // str_replace("_"," ",$buyer_get);
		$tanggal_awal = $this->input->get('tanggal_awal');
		$tanggal_akhir = $this->input->get('tanggal_akhir');
		$line = $this->input->get('line');

		// pre($buyer);

		$data['info_buyer'] = $buyer;
		$data['info_tanggal_awal'] = $tanggal_awal;
		$data['info_tanggal_akhir'] = $tanggal_akhir;
		$data['info_line'] = $line;

		// $sql = "exec [sp_grafik_defect_rate] '$buyer' , '$tanggal_awal' , '$tanggal_akhir' , '$line' ";
		// //echo $sql ;

		// $data['data'] = $this->db->query($sql)->result_array();  

		// $this->load->controller('GrafikQuery');

		// $data['data'] =  Defect_rate($buyer , $tanggal_awal , $tanggal_akhir , $line);

		// return $data ; 
		//echo json_encode($data);
		//  pre($data);
		$data['pagetitle'] = "DEFECT RATE CHART";
		$this->benchmark->mark('code_end');
		simpan_log("function Grafik defectrate ( $buyer , $tanggal_awal , $tanggal_akhir , $line  ) PHP ", $this->benchmark->elapsed_time('code_start', 'code_end'));

		$this->load->view('Grafik/defectrate', $data);
	}

	public function defectrateb()
	{
		$this->benchmark->mark('code_start');
		$buyer_get = $this->input->get('buyer');
		$buyer =  $buyer_get; // str_replace("_"," ",$buyer_get);
		$tanggal_awal = $this->input->get('tanggal_awal');
		$tanggal_akhir = $this->input->get('tanggal_akhir');
		$line = $this->input->get('line');

		$data['info_buyer'] = $buyer;
		$data['info_tanggal_awal'] = $tanggal_awal;
		$data['info_tanggal_akhir'] = $tanggal_akhir;
		$data['info_line'] = $line;

		$data['pagetitle'] = "DEFECT RATE CHART";
		$this->benchmark->mark('code_end');
		// simpan_log("function Grafik defectrate ( $buyer , $tanggal_awal , $tanggal_akhir , $line  ) PHP ", $this->benchmark->elapsed_time('code_start', 'code_end'));

		$this->load->view('Grafik/defectrateb', $data);
	}



	public function report_weekly_top_5_per_line()
	{
		$sql = "select distinct REPLACE(buyer, ' ','_') as buyer from Schedule_produksi";
		$data['buyer'] = $this->db->query($sql)->result_array();

		$data['pagetitle'] = "GRAFIK TOP 5 DEFECT";
		//pre($data);
		$this->loadViews('Grafik/report_weekly_top_5_per_line', $data);
	}

	public function report_weekly_top_5_per_lineb()
	{
		$sql = "select distinct REPLACE(buyer, ' ','_') as buyer from Schedule_produksi";
		$data['buyer'] = $this->db->query($sql)->result_array();

		$data['pagetitle'] = "GRAFIK TOP 5 DEFECT";
		//pre($data);
		$this->loadViews('Grafik/report_weekly_top_5_per_lineb', $data);
	}


	public function weekly_top_5_per_line()
	{

		$buyer_get = $this->input->get('buyer');
		$buyer = str_replace("_", " ", $buyer_get);
		$tanggal_awal = $this->input->get('tanggal_awal');
		$tanggal_akhir = $this->input->get('tanggal_akhir');
		$line = $this->input->get('line');

		$start_date = $tanggal_awal;
		$end_date = $tanggal_akhir;

		$data['info_buyer'] = $buyer;
		$data['info_tanggal_awal'] = $tanggal_awal;
		$data['info_tanggal_akhir'] = $tanggal_akhir;
		$data['info_line'] = $line;


		$sql_daftar_buyer = "
		SELECT DISTINCT ins.kanaan_po, glob.buyer
		INTO #daftar_buyer
		FROM inspect_v2 ins
		LEFT JOIN Schedule_produksi glob ON ins.kanaan_po = glob.kanaan_po
		WHERE ins.kanaan_po IS NOT NULL
		AND CONVERT(VARCHAR(10), ins.tanggal, 120) BETWEEN ? AND ?
		AND glob.buyer LIKE ?
		AND (? = '' OR line IN (SELECT Value FROM dbo.SplitString(?, ',')))
	";

		// Execute the first query
		$this->db->query($sql_daftar_buyer, [$start_date, $end_date, "%$buyer%", $line, $line]);

		// Buat SQL untuk #daftarline
		$sql_daftarline = "
		SELECT DISTINCT ins.line
		INTO #daftarline
		FROM inspect_v2 ins
		WHERE CONVERT(VARCHAR(10), ins.tanggal, 120) BETWEEN ? AND ?
		AND kanaan_po IN (SELECT kanaan_po FROM #daftar_buyer)
		AND (? = '' OR line IN (SELECT Value FROM dbo.SplitString(?, ',')))
		ORDER BY ins.line
	";

		// Execute the second query
		$this->db->query($sql_daftarline, [$start_date, $end_date, $line, $line]);

		// Buat SQL untuk #hasil_inspect_top5
		$sql_hasil_inspect_top5 = "
		SELECT TOP 5 COUNT(*) AS jumlah, kode_defect
		INTO #hasil_inspect_top5
		FROM inspect_v2
		WHERE line IN (SELECT line FROM #daftarline)
		AND kanaan_po IN (SELECT kanaan_po FROM #daftar_buyer)
		AND CONVERT(date, time_stamp) BETWEEN ? AND ?
		AND kode_defect <> 'OK' AND kode_defect <> ''
		AND (? = '' OR line IN (SELECT Value FROM dbo.SplitString(?, ',')))
		GROUP BY kode_defect
		ORDER BY jumlah DESC
	";

		// Execute the third query
		$this->db->query($sql_hasil_inspect_top5, [$start_date, $end_date, $line, $line]);

		// Buat SQL untuk #summary dan menghitung total jumlah dalam satu blok
		$sql_summary = "
		SELECT h.*, d.keterangan, 
			   CONVERT(float, ROUND((jumlah * 100.0) / (SUM(h.jumlah) OVER ()+ jumlah), 2)) AS prosentase
		
		FROM #hasil_inspect_top5 h
		LEFT JOIN daftar_defect d ON d.kode = h.kode_defect
		ORDER BY h.jumlah DESC
	";

		// Execute the summary query
		$query = $this->db->query($sql_summary);




		// Return the results
		$data['data'] = $query->result_array();

		// $sql = "exec [sp_grafik_top_5_defect] '$buyer' , '$tanggal_awal' , '$tanggal_akhir'  , '$line'";
		// $data['data'] = $this->db->query($sql)->result_array();  


		//echo "$sql";
		// return $data ; 
		//echo json_encode($data);
		//pre($data);
		$data['pagetitle'] = "GRAFIK TOP 5 DEFECT";
		$this->load->view('Grafik/weekly_top_5_per_line', $data);
	}


	public function weekly_top_5_per_lineb()
	{

		$buyer_get = $this->input->get('buyer');
		$buyer = str_replace("_", " ", $buyer_get);
		$tanggal_awal = $this->input->get('tanggal_awal');
		$tanggal_akhir = $this->input->get('tanggal_akhir');
		$line = $this->input->get('line');

		$start_date = $tanggal_awal;
		$end_date = $tanggal_akhir;

		$data['info_buyer'] = $buyer;
		$data['info_tanggal_awal'] = $tanggal_awal;
		$data['info_tanggal_akhir'] = $tanggal_akhir;
		$data['info_line'] = $line;


		$sql_daftar_buyer = "
		SELECT DISTINCT ins.kanaan_po, glob.buyer
		INTO #daftar_buyer
		FROM inspect_v2 ins
		LEFT JOIN Schedule_produksi glob ON ins.kanaan_po = glob.kanaan_po
		WHERE ins.kanaan_po IS NOT NULL
		AND CONVERT(VARCHAR(10), ins.tanggal, 120) BETWEEN ? AND ?
		AND glob.buyer LIKE ?
		AND (? = '' OR line IN (SELECT Value FROM dbo.SplitString(?, ',')))
	";

		// Execute the first query
		$this->db->query($sql_daftar_buyer, [$start_date, $end_date, "%$buyer%", $line, $line]);

		// Buat SQL untuk #daftarline
		$sql_daftarline = "
		SELECT DISTINCT ins.line
		INTO #daftarline
		FROM inspect_v2 ins
		WHERE CONVERT(VARCHAR(10), ins.tanggal, 120) BETWEEN ? AND ?
		AND kanaan_po IN (SELECT kanaan_po FROM #daftar_buyer)
		AND (? = '' OR line IN (SELECT Value FROM dbo.SplitString(?, ',')))
		ORDER BY ins.line
	";

		// Execute the second query
		$this->db->query($sql_daftarline, [$start_date, $end_date, $line, $line]);

		// Buat SQL untuk #hasil_inspect_top5
		$sql_hasil_inspect_top5 = "
		SELECT TOP 5 COUNT(DISTINCT unit_name) AS jumlah, kode_defect
		INTO #hasil_inspect_top5
		FROM inspect_v2
		WHERE line IN (SELECT line FROM #daftarline)
		AND kanaan_po IN (SELECT kanaan_po FROM #daftar_buyer)
		AND CONVERT(date, time_stamp) BETWEEN ? AND ?
		AND kode_defect <> 'OK' AND kode_defect <> ''
		AND (? = '' OR line IN (SELECT Value FROM dbo.SplitString(?, ',')))
		GROUP BY kode_defect
		ORDER BY jumlah DESC
	";

		// Execute the third query
		$this->db->query($sql_hasil_inspect_top5, [$start_date, $end_date, $line, $line]);

		// Buat SQL untuk #summary dan menghitung total jumlah dalam satu blok
		$sql_summary = "
		SELECT h.*, d.keterangan, 
			   CONVERT(float, ROUND((jumlah * 100.0) / (SUM(h.jumlah) OVER ()), 2)) AS prosentase
		
		FROM #hasil_inspect_top5 h
		LEFT JOIN daftar_defect d ON d.kode = h.kode_defect
		ORDER BY h.jumlah DESC
	";

		// Execute the summary query
		$query = $this->db->query($sql_summary);


		// Return the results
		$data['data'] = $query->result_array();
		$data['pagetitle'] = "GRAFIK TOP 5 DEFECT";
		$this->load->view('Grafik/weekly_top_5_per_lineb', $data);
	}


	public function report_monthly_top_5_per_line()
	{
		$sql = "SELECT YEAR(time_stamp) AS tahun FROM inspect_v2 GROUP BY YEAR(time_stamp)";
		$data['th'] = $this->db->query($sql)->result_array();

		$data['pagetitle'] = "GRAFIK MONTHLY TOP 5 PER LINE";
		//pre($data);
		$this->loadViews('Grafik/report_monthly_top_5_per_line', $data);
	}

	public function monthly_top_5_per_line()
	{


		$manager  = '';
		$weekly = 'weekly_top_5_per_line';
		$tanggal = '';


		// $bulan  = $_POST['bulan']; 	$tahun  = $_POST['tahun']; 	$week  = $_POST['week'];  $line_sewing = $_POST['line_sewing'];
		// 

		$bulan 			= $this->input->get('bulan');
		$tahun 			= $this->input->get('tahun');
		$line_sewing 	= $this->input->get('line_sewing');

		$data['infobulan'] = $this->input->get('bulan');
		$data['infotahun'] = $this->input->get('tahun');
		$data['infoline_sewing'] = $this->input->get('line_sewing');


		$sql = "exec report_summary_defect_monthly $bulan , $tahun ,  '$line_sewing' ";
		$report =  $this->db->query($sql)->result_array();
		$data['report'] = $report;
		// pre($data['report']);
		$new = array();
		foreach ($report as $r) {
			$new[$r['kode_defect']]['kode_defect'] = $r['kode_defect'];
			$new[$r['kode_defect']]['keterangan'] = $r['keterangan'];
		}
		$data['kode_defect'] = $new;
		// pre($data['keterangan']);

		//pre($data['report']);
		// echo $sql;

		// $sql = "exec report_summary_total_produksi_weekly $bulan , $tahun , $week  , '$manager' , '$weekly'  , '$line_sewing'  " ; 
		// $data['total_produksi']= $this->db->query($sql)->result_array();  
		// echo $sql;
		// pre($data['total_produksi']);

		$this->load->view('Grafik/monthly_top_5_per_line', $data);
	}
}
