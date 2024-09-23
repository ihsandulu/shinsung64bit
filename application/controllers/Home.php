<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->is_logedin();
		$this->load->library(['ion_auth', 'form_validation']);
		$this->db_kis  = $this->load->database('kis', TRUE);
		$this->lang->load('auth');
	}

	public function index()
	{
		$data = array();
		$data['pagetitle'] = 'Dashboard SEWING QA';
		$this->loadViews('home', $data);
	}




	public function list_report_dasbord()
	{
		$this->benchmark->mark('code_start');
		$buyer = '';
		$tanggal_awal = date('Y-m-d');
		$tanggal_akhir = date('Y-m-d');

		$data['info_buyer'] = $buyer;
		$data['info_tanggal_awal'] = $tanggal_awal;
		$data['info_tanggal_akhir'] = $tanggal_akhir;

		$data['data'] =  Defect_rate($buyer, $tanggal_awal, $tanggal_akhir, '');

		$this->benchmark->mark('code_end');
		simpan_log("function Welcome Grafik defectrate ( $buyer , $tanggal_awal , $tanggal_akhir , ''  ) PHP ", $this->benchmark->elapsed_time('code_start', 'code_end'));

		$this->load->view('welcome_grafik', $data);
	}



	public function avg_defect()
	{
		$this->benchmark->mark('code_start');

		$data = array();
		$tanggal = date("Y-m-d");

		$sql = "exec Sp_dashboard_avg_defect '$tanggal' ";

		$data['data'] = $this->db->query($sql)->row_array();
		//pre($data);
		$this->benchmark->mark('code_end');
		simpan_log("function Welcome grafik_os  PHP ", $this->benchmark->elapsed_time('code_start', 'code_end'));
		$data['lineaktif'] = $data['data']['lineaktif'];
		unset($data['data']['lineaktif']);

		//pre($data);

		$this->load->view('welcome_grafik_avg', $data);
	}

	public function avg_defect_weekly()
	{
		/* $this->benchmark->mark('code_start');

		$data = array();	
		$tanggal = date("Y-m-d");
		
		$sql = "exec Sp_dashboard_avg_defect_weekly '$tanggal' "; 
				
		$data['data'] = $this->db->query($sql)->row_array(); 
		//pre($data);
		$this->benchmark->mark('code_end');
		simpan_log( "function Welcome grafik_os  PHP " , $this->benchmark->elapsed_time('code_start', 'code_end') ); 
		$data['lineaktif'] = $data['data'] ['lineaktif'];
		unset($data['data'] ['lineaktif']);

		//pre($data);

		$this->load->view('welcome_grafik_avg_weekly', $data); */
		$this->load->view('welcome_grafik_avg_weekly');
	}


	public function grafik_defect_rate()
	{
		$this->benchmark->mark('code_start');
		$buyer = '';
		$tanggal_awal = date('Y-m-d');
		$tanggal_akhir = date('Y-m-d');

		$data['info_buyer'] = $buyer;
		$data['info_tanggal_awal'] = $tanggal_awal;
		$data['info_tanggal_akhir'] = $tanggal_akhir;

		// $sql = "exec [sp_grafik_defect_rate_dev] '$buyer' , '$tanggal_awal' , '$tanggal_akhir' , ''";
		//$data['data'] = $this->db->query($sql)->result_array(); 

		// $sql = "exec [sp_grafik_defect_rate] '$buyer' , '$tanggal_awal' , '$tanggal_akhir' , ''";
		// $data['data'] = execute_query_resultarray_and_log ($sql);
		// 
		$data['data'] =  Defect_rate($buyer, $tanggal_awal, $tanggal_akhir, '');

		$this->benchmark->mark('code_end');
		simpan_log("function Welcome Grafik defectrate ( $buyer , $tanggal_awal , $tanggal_akhir , ''  ) PHP ", $this->benchmark->elapsed_time('code_start', 'code_end'));

		$this->load->view('welcome_grafik', $data);

		//$this->loadViews("Qa_end_line/Index", $this->global, NULL, NULL);
	}


	public function jumlah_order_perbuyer_bulan($tanggal, $istopfive)
	{
		// echo $istopfive;
		$this->benchmark->mark('code_start');

		$data = array();
		$tanggal = kiri($tanggal, 7);
		$tanggal2 = kiri($tanggal, 4);
		$data['info_bulan'] = substr($tanggal, 5, 2);
		$data['info_tahun'] = $tanggal2;
		$sql = " Select buyer , sum(total)  as total from v_jumlah_order_perbuyer 
		where convert(nvarchar(7) , order_date)  =  '$tanggal'
		group by
		buyer  
		ORDER BY SUM(TOTAL) DESC
		";

		$sql = "Select Brand buyer , sum(Qty)  as total from  [OrderInformation] 
		where 
		'$tanggal' between convert(nvarchar(7) , [PoIssueDate])  and convert(nvarchar(7) , [GacDate])  
		group by
		Brand  
		ORDER BY SUM(Qty) DESC  ; ";

		$sql = "  Select 
		g.buyer , sum(total) as total
					from 
					(
				Select KANAAN_PO  , sum(qty_plan)  as total from  Schedule_produksi 
						where 
						'$tanggal' between convert(nvarchar(7) , TANGGAL_SEWING_START)  and convert(nvarchar(7) , TANGGAL_SEWING_END)  
						group by
						KANAAN_PO  
					) datanya  left join  ( select distinct kanaan_po , buyer from  Schedule_produksi )  g 
					on datanya.KANAAN_PO =  g.kanaan_po 
					group by g.buyer 
		   ORDER BY total DESC  ;  ";


		// echo $sql;
		$data['data'] = $this->db_kis->query($sql)->result_array();
		$data['bulan'] = $tanggal;

		if (strtolower(trim($istopfive)) == 'y') {
			// echo $istopfive;
			$data['data'] = array_slice($data['data'], 0, 5);
		}
		//pre($data);
		$this->benchmark->mark('code_end');
		simpan_log("function Welcome jumlah_order_perbuyer  PHP ", $this->benchmark->elapsed_time('code_start', 'code_end'));

		$this->load->view('welcome_grafik_os_bulan', $data);
	}

	public function defect_rate_buyer_weekly($tanggal, $istopfive)
	{
		// echo $istopfive;
		$this->benchmark->mark('code_start');

		$now = new DateTime();
		$startOfMonth = $now->format('Y-m-01');
		$endOfMonth = $now->format('Y-m-t');

		$data = array();
		$tanggal = kiri($tanggal, 7);
		$tanggal2 = kiri($tanggal, 4);
		$data['info_bulan'] = substr($tanggal, 5, 2);
		$data['info_tahun'] = $tanggal2;
		$sql = " Select buyer , COUNT(id)  as total from inspect_v2 
		where tanggal between '" . $startOfMonth . "' and '" . $endOfMonth . "' 
		group by buyer  
		ORDER BY COUNT(id) DESC
		";


		// echo $sql;
		$data['data'] = $this->db_kis->query($sql)->result_array();
		$data['bulan'] = $tanggal;

		if (strtolower(trim($istopfive)) == 'y') {
			// echo $istopfive;
			$data['data'] = array_slice($data['data'], 0, 5);
		}
		//pre($data);
		$this->benchmark->mark('code_end');
		// simpan_log("function Welcome jumlah_order_perbuyer  PHP ", $this->benchmark->elapsed_time('code_start', 'code_end'));

		$this->load->view('welcome_grafik_os_bulan', $data);
	}

	public function jumlah_order_perbuyer_tahun($tanggal, $istopfive)
	{
		// echo $istopfive;
		$this->benchmark->mark('code_start');

		$data = array();
		// $tanggal = 2023 ;
		$tanggal = kiri($tanggal, 4);
		$data['info_tahun'] = $tanggal;

		// $sql = "Select  buyer , sum(total)  as total from v_jumlah_order_perbuyer 
		// where convert(nvarchar(4) , order_date)  =  '$tanggal'
		// group by
		// buyer  order by sum(total) desc  "; 

		$sql = "Select Brand buyer , sum(Qty)  as total from  [OrderInformation] 
		where 
		'$tanggal' between convert(nvarchar(4) , [PoIssueDate])  and convert(nvarchar(4) , [GacDate])  
		group by
		Brand  
		ORDER BY SUM(Qty) DESC  ; ";


		$sql = "  Select 
		g.buyer , sum(total) as total
					from 
					(
				Select KANAAN_PO  , sum(qty_plan)  as total from  Schedule_produksi 
						where 
						'$tanggal' between convert(nvarchar(4) , TANGGAL_SEWING_START)  and convert(nvarchar(4) , TANGGAL_SEWING_END)  
						group by
						KANAAN_PO  
					) datanya  left join  ( select distinct kanaan_po , buyer from  Schedule_produksi )  g 
					on datanya.KANAAN_PO =  g.kanaan_po 
					group by g.buyer 
		   ORDER BY total DESC  ;  ";


		// echo $sql;
		$data['data'] = $this->db_kis->query($sql)->result_array();
		$data['bulan'] = $tanggal;

		if (strtolower(trim($istopfive)) == 'y') {
			$data['data'] = array_slice($data['data'], 0, 5);
		}
		//pre($data);
		$this->benchmark->mark('code_end');
		simpan_log("function Welcome jumlah_order_perbuyer  PHP ", $this->benchmark->elapsed_time('code_start', 'code_end'));
		// $data['lineaktif'] = $data['data'] ['lineaktif'];
		// unset($data['data'] ['lineaktif']);

		//pre($data);

		$this->load->view('welcome_grafik_os', $data);
	}


	public function monthly_order_status($tanggal, $istopfive)
	{
		// echo $istopfive;
		$this->benchmark->mark('code_start');

		$data = array();
		// $tanggal = 2023 ;
		$tanggal = kiri($tanggal, 7);
		// echo $tanggal;
		$data['info_tahun'] = $tanggal;

		// $sql = "Select  buyer , sum(total)  as total from v_jumlah_order_perbuyer 
		// where convert(nvarchar(4) , order_date)  =  '$tanggal'
		// group by
		// buyer  order by sum(total) desc  "; 

		$sql = "Select Brand buyer , sum(Qty)  as total from  [OrderInformation] 
		where 
		'$tanggal' between convert(nvarchar(4) , [PoIssueDate])  and convert(nvarchar(4) , [GacDate])  
		group by
		Brand  
		ORDER BY SUM(Qty) DESC  ; ";


		$sql = "  Select 
		g.buyer , sum(total) as total
					from 
					(
				Select KANAAN_PO  , sum(qty_plan)  as total from  Schedule_produksi 
						where 
						'$tanggal' between convert(nvarchar(7) , TANGGAL_SEWING_START)  and convert(nvarchar(7) , TANGGAL_SEWING_END)  
						group by
						KANAAN_PO  
					) datanya  left join  ( select distinct kanaan_po , buyer from  Schedule_produksi )  g 
					on datanya.KANAAN_PO =  g.kanaan_po 
					group by g.buyer 
		   ORDER BY total DESC  ;  ";


		// echo $sql;
		$data['data'] = $this->db_kis->query($sql)->result_array();
		$data['bulan'] = $tanggal;

		if (strtolower(trim($istopfive)) == 'y') {
			$data['data'] = array_slice($data['data'], 0, 5);
		}
		//pre($data);
		$this->benchmark->mark('code_end');
		simpan_log("function Welcome jumlah_order_perbuyer  PHP ", $this->benchmark->elapsed_time('code_start', 'code_end'));
		// $data['lineaktif'] = $data['data'] ['lineaktif'];
		// unset($data['data'] ['lineaktif']);

		//pre($data);

		$this->load->view('welcome_grafik_os', $data);
	}



	public function jumlah_order_perbuyer_tahun_new($tanggal, $istopfive)
	{
		// echo $istopfive;
		$this->benchmark->mark('code_start');

		$data = array();
		// $tanggal = 2023 ;
		$tanggal = kiri($tanggal, 4);
		$data['info_tahun'] = $tanggal;

		// $sql = "Select  buyer , sum(total)  as total from v_jumlah_order_perbuyer 
		// where convert(nvarchar(4) , order_date)  =  '$tanggal'
		// group by
		// buyer  order by sum(total) desc  "; 

		$sql = "Select Brand buyer , sum(Qty)  as total from  [OrderInformation] 
		where 
		'$tanggal' between convert(nvarchar(4) , [PoIssueDate])  and convert(nvarchar(4) , [GacDate])  
		group by
		Brand  
		ORDER BY SUM(Qty) DESC  ; ";


		$sql = "  Select 
		g.buyer , sum(total) as total
					from 
					(
				Select KANAAN_PO  , sum(qty_plan)  as total from  Schedule_produksi 
						where 
						'$tanggal' between convert(nvarchar(4) , TANGGAL_SEWING_START)  and convert(nvarchar(4) , TANGGAL_SEWING_END)  
						group by
						KANAAN_PO  
					) datanya  left join  ( select distinct kanaan_po , buyer from  Schedule_produksi )  g 
					on datanya.KANAAN_PO =  g.kanaan_po 
					group by g.buyer 
		   ORDER BY total DESC  ;  ";


		// echo $sql;
		$data['data'] = $this->db_kis->query($sql)->result_array();
		$data['bulan'] = $tanggal;

		if (strtolower(trim($istopfive)) == 'y') {
			$data['data'] = array_slice($data['data'], 0, 5);
		}
		//pre($data);
		$this->benchmark->mark('code_end');
		simpan_log("function Welcome jumlah_order_perbuyer  PHP ", $this->benchmark->elapsed_time('code_start', 'code_end'));
		// $data['lineaktif'] = $data['data'] ['lineaktif'];
		// unset($data['data'] ['lineaktif']);

		//pre($data);

		$this->load->view('welcome_grafik_os_new', $data);
		//$this->loadViews('welcome_grafik_os_new', $data);

	}



	public function jml_pegawai()
	{
		$this->benchmark->mark('code_start');

		$data = array();

		$sql = "select count(sex) AS total, count(case when sex ='1' then 1 end) as pria,
				count(case when sex ='2' then 1 end) as wanita
				FROM KMJ_KEGIATAN.dbo.t_m_karyawan_aktif";

		$data['data'] = $this->db->query($sql)->row_array();
		//pre($data);
		$this->benchmark->mark('code_end');
		simpan_log("function Welcome jml_pegawai  PHP ", $this->benchmark->elapsed_time('code_start', 'code_end'));

		//pre($data);

		$this->load->view('welcome_jml_pegawai', $data);
	}


	public function status_mesin()
	{
		$this->benchmark->mark('code_start');

		$data = array();

		$sql = "select count(id) AS total, 
				count(case when status ='Aktif' then 1 end) as Aktif,
				count(case when status ='Perbaikan' then 1 end) as Perbaikan,
				count(case when status ='Rusak' then 1 end) as Rusak,
				count(case when status ='Standby' then 1 end) as Standby,
				count(case when status ='Non Aktif' then 1 end) as NonAktif
				FROM KMJ1_MESIN_INVENTORY.dbo.mesin";

		$data['data'] = $this->db->query($sql)->row_array();
		$this->benchmark->mark('code_end');
		simpan_log("function Welcome status_mesin  PHP ", $this->benchmark->elapsed_time('code_start', 'code_end'));

		//pre($data);

		$this->load->view('welcome_grafik_mesin', $data);
	}

	public function grafik_detail_pegawai()
	{

		$data = array();
		$sql = "SELECT * FROM KMJ_KEGIATAN.dbo.v_jenis_kelamin ORDER BY dept ASC";

		$data['data'] = $this->db->query($sql)->result_array();
		//pre($data);
		$this->load->view('welcome_grafik_detail_pegawai', $data);
	}
	public function detail_pegawai()
	{

		// $data = array();
		// $sql = "SELECT * FROM KMJ_KEGIATAN.dbo.v_jenis_kelamin ORDER BY jumlah DESC"; 

		// $data['data'] = $this->db->query($sql)->result_array(); 
		// //pre($data);

		// $sql = "SELECT SUM(jumlah) as jumlah FROM KMJ_KEGIATAN.dbo.v_jenis_kelamin"; 

		// $data['data_jumlah'] = $this->db->query($sql)->row_array(); 

		// $this->load->view('welcome_detail_pegawai_', $data);

	}
}
