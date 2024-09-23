<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends MY_Controller
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
		$data['pagetitle'] = 'DASHBOARD';
		$id = $this->session->userdata('user_id');
		//echo $id;
		$currentGroups = $this->ion_auth->get_users_groups($id)->result_array();

		$found = false;
		foreach ($currentGroups as $item) {
			if ($item["name"] === "OPERATOR") {
				$found = true; // Jika ditemukan, ubah nilai penanda menjadi true
				break; // Hentikan perulangan karena sudah ditemukan
			}
		}

		$this->db->where('id', $id);
		$query = $this->db->get('users');
		$user = $query->row_array();

		$data['tanggal'] = date("Y-m-d");
		$tanggal = $data['tanggal'];
		$this->db->query("DELETE FROM inspect_v2_panggilan WHERE convert(date , jam) <>  ?", array($tanggal));
		// echo $this->db->affected_rows();
		$this->db->query("DELETE FROM inspect_v2_hari_ini WHERE convert(date , tanggal) <>  ?", array($tanggal));
		// echo $this->db->affected_rows();
		//pre($data['data_loss_time']);

		if ($found) {
			// e// echo base_url().'Qa_end_line/daftar_schedule/'.$user['company'];
			$email = $this->session->userdata('email');
			if ($email >= '1' and $email <= '50') {
				if ($this->session->userdata("baru") == "OK") {
					redirect(base_url() . 'Qa_end_line/daftar_scheduleb/' . $user['company']);
				} else {
					redirect(base_url() . 'Qa_end_line/daftar_schedule/' . $user['company']);
				}
			} else {
				$this->loadViews('welcome_message', $data);
			}
		} else {
			$this->loadViews('welcome_message', $data);
			//pre($data);
		}





		//pre($currentGroups);


		//pre($this->ion_auth->in_group($group));
		// pre($this->session);
		//  [userdata] => Array
		// (
		//     [__ci_last_regenerate] => 1687319165
		//     [identity] => 1
		//     [email] => 1
		//     [user_id] => 7
		//     [old_last_login] => 1687317253
		//     [last_check] => 1687317265
		//     [ion_auth_session_hash] => 6583d6c4f205998ecacc9f51b68a2a2e44ea0006
		// )


		// // latest upload
		// $this->db->select('nomor_aju , nomor_daftar , tanggal_daftar , users.first_name ,  users.last_name, jam_upload');
		// $this->db->limit(20);
		// $this->db->order_by('jam_upload', 'desc');
		// $this->db->join('users', 'users.id = header.user_upload');
		// $data['lastest_uploads'] = $this->db->get('header', 20)->result_array();


		// // statistik dokumen
		// $this->db->where('bulan_daftar', date('m'));
		// $this->db->where('tanggal_daftar', date('Y'));
		// $this->db->select('jumlah_dokumen,kode_dokumen,bulan_daftar,tanggal_daftar,URAIAN_DOKUMEN');
		// $data['stat'] = $this->db->get('v_jumlah_dokumen_group_by_jenis_bulan_tahun')->result_array();


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

		// $sql = "exec [sp_grafik_defect_rate_dev] '$buyer' , '$tanggal_awal' , '$tanggal_akhir' , ''";
		//$data['data'] = $this->db->query($sql)->result_array(); 

		// $sql = "exec [sp_grafik_defect_rate] '$buyer' , '$tanggal_awal' , '$tanggal_akhir' , ''";
		// $data['data'] = execute_query_resultarray_and_log ($sql);
		// 
		$data['data'] =  Defect_rate($buyer, $tanggal_awal, $tanggal_akhir, '');
		// pre($data['data'] );
		$this->benchmark->mark('code_end');
		simpan_log("function Welcome Grafik defectrate ( $buyer , $tanggal_awal , $tanggal_akhir , ''  ) PHP ", $this->benchmark->elapsed_time('code_start', 'code_end'));

		$this->load->view('welcome_grafik', $data);

		//$this->loadViews("Qa_end_line/Index", $this->global, NULL, NULL);
	}

	public function list_report_dasbord_top5()
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
		error_reporting(0);
		$data['data'] =  Defect_rate($buyer, $tanggal_awal, $tanggal_akhir, '');
		//   pre($data['data'] ); 
		$datasort = $data['data'];
		usort($datasort, function ($a, $b) {
			return $b['defect_percentage'] - $a['defect_percentage'];
		});
		$top_5 = array_slice($datasort, 0, 5);
		// pre($top_5);
		$data['data'] = $top_5;
		$this->benchmark->mark('code_end');
		simpan_log("function Welcome Grafik defectrate ( $buyer , $tanggal_awal , $tanggal_akhir , ''  ) PHP ", $this->benchmark->elapsed_time('code_start', 'code_end'));
		error_reporting(E_ALL);
		$this->load->view('welcome_grafik_top_5', $data);

		//$this->loadViews("Qa_end_line/Index", $this->global, NULL, NULL);
	}

	public function list_report_dasbord_top5w()
	{
		$this->benchmark->mark('code_start');
		$buyer = '';
		$tanggal_hari_ini = date('Y-m-d');
		$tanggal_senin = date('Y-m-d', strtotime('monday this week', strtotime($tanggal_hari_ini)));
		$tanggal_jumat = date('Y-m-d', strtotime('friday this week', strtotime($tanggal_hari_ini)));

		$tanggal_awal = $tanggal_senin;
		$tanggal_akhir = $tanggal_jumat;

		$data['info_buyer'] = $buyer;
		$data['info_tanggal_awal'] = $tanggal_awal;
		$data['info_tanggal_akhir'] = $tanggal_akhir;

		// $sql = "exec [sp_grafik_defect_rate_dev] '$buyer' , '$tanggal_awal' , '$tanggal_akhir' , ''";
		//$data['data'] = $this->db->query($sql)->result_array(); 

		// $sql = "exec [sp_grafik_defect_rate] '$buyer' , '$tanggal_awal' , '$tanggal_akhir' , ''";
		// $data['data'] = execute_query_resultarray_and_log ($sql);
		// 
		error_reporting(0);
		$data['data'] =  Defect_ratew($buyer, $tanggal_awal, $tanggal_akhir, '');
		//   pre($data['data'] ); 
		$datasort = $data['data'];
		usort($datasort, function ($a, $b) {
			return $b['defect_percentage'] - $a['defect_percentage'];
		});
		$top_5 = array_slice($datasort, 0, 5);
		// pre($top_5);
		$data['data'] = $top_5;
		$this->benchmark->mark('code_end');
		simpan_log("function Welcome Grafik defectrate ( $buyer , $tanggal_awal , $tanggal_akhir , ''  ) PHP ", $this->benchmark->elapsed_time('code_start', 'code_end'));
		error_reporting(E_ALL);
		$this->load->view('welcome_grafik_top_5w', $data);

		//$this->loadViews("Qa_end_line/Index", $this->global, NULL, NULL);
	}





	public function grafik_os()
	{
		$data = array();

		$sql = "SELECT TOP (5) SUBSTRING(KANAAN_PO,3,2) AS tahun, SUBSTRING(KANAAN_PO,5,2) AS kode, SUM(QTY_ORDER) AS jumlah
				FROM v_schedule_produksi 
				WHERE SUBSTRING(KANAAN_PO,3,2) = '23'
				GROUP BY SUBSTRING(KANAAN_PO,3,2), SUBSTRING(KANAAN_PO,5,2) ORDER BY jumlah DESC";

		$data['data'] = $this->db_kis->query($sql)->result_array();
		//pre($data);
		$this->load->view('welcome_grafik_os', $data);
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

	public function jumlah_order_perbuyer_bulan($tanggal, $istopfive)
	{
		// echo $istopfive;
		$this->benchmark->mark('code_start');

		$data = array();
		$tanggal = kiri($tanggal, 7);

		// $sql = "Select buyer , sum(total)  as total from v_jumlah_order_perbuyer 
		// where convert(nvarchar(7) , order_date)  =  '$tanggal'
		// group by
		// buyer  
		// ORDER BY SUM(TOTAL) DESC
		// "; 
		$sql = "Select Brand buyer , sum(Qty)  as total from [KMJ1_KIS_2019_PREPARE].[dbo].[OrderInformation] 
		where 
		'$tanggal' between convert(nvarchar(7) , [PoIssueDate])  and convert(nvarchar(7) , [GacDate])  
		group by
		Brand  
		ORDER BY SUM(Qty) DESC  ;  ";
		// echo $sql;
		$data['data'] = $this->db_kis->query($sql)->result_array();
		$data['bulan'] = $tanggal;

		if (strtolower(trim($istopfive)) == 'y') {
			// echo $istopfive;
			$data['data'] = array_slice($data['data'], 0, 5);
		}
		pre($data);
		$this->benchmark->mark('code_end');
		simpan_log("function Welcome jumlah_order_perbuyer  PHP ", $this->benchmark->elapsed_time('code_start', 'code_end'));
	}

	public function jumlah_order_perbuyer_tahun($tanggal, $istopfive)
	{
		// echo $istopfive;
		$this->benchmark->mark('code_start');

		$data = array();
		$tanggal = kiri($tanggal, 4);

		$sql = "Select  buyer , sum(total)  as total from v_jumlah_order_perbuyer 
		where convert(nvarchar(4) , order_date)  =  '$tanggal'
		group by
		buyer  order by sum(total) desc  ";
		// echo $sql;
		$data['data'] = $this->db_kis->query($sql)->result_array();
		$data['bulan'] = $tanggal;

		if (strtolower(trim($istopfive)) == 'y') {
			$data['data'] = array_slice($data['data'], 0, 5);
		}
		pre($data);
		$this->benchmark->mark('code_end');
		simpan_log("function Welcome jumlah_order_perbuyer  PHP ", $this->benchmark->elapsed_time('code_start', 'code_end'));
		// $data['lineaktif'] = $data['data'] ['lineaktif'];
		// unset($data['data'] ['lineaktif']);

		//pre($data);

		// $this->load->view('welcome_grafik_os', $data);

	}



	public function weekly_top_5_per_line()
	{

		$sekarang = date('Y-m-d');
		$start_date = $sekarang;
		$end_date = $sekarang;
		$buyer = "";
		$line = "";

		// Create #daftar_buyer table structure
		$this->db->query("CREATE TABLE #daftar_buyer (
    kanaan_po NVARCHAR(255),
    buyer NVARCHAR(255)
)");

		$this->db->query(
			"INSERT INTO #daftar_buyer (kanaan_po, buyer)
    SELECT DISTINCT ins.kanaan_po, ins.buyer 
    FROM inspect_v2_hari_ini ins 
    WHERE ins.kanaan_po IS NOT NULL 
    AND CONVERT(VARCHAR(10), ins.tanggal, 120) BETWEEN ? AND ? 
    AND ins.buyer LIKE ? 
    AND (? = '' OR ins.line IN (SELECT Value FROM SplitString(?, ',')))",
			[$start_date, $end_date, '%' . $buyer . '%', $line, $line]
		);

		// Create #daftarline table structure
		$this->db->query("CREATE TABLE #daftarline (
    line NVARCHAR(255)
)");

		$this->db->query(
			"INSERT INTO #daftarline (line)
    SELECT DISTINCT ins.line 
    FROM inspect_v2_hari_ini ins 
    WHERE CONVERT(VARCHAR(10), ins.tanggal, 120) BETWEEN ? AND ? 
    AND ins.kanaan_po IN (SELECT kanaan_po FROM #daftar_buyer) 
    AND (? = '' OR ins.line IN (SELECT Value FROM SplitString(?, ','))) 
    ORDER BY ins.line",
			[$start_date, $end_date, $line, $line]
		);

		// Create #hasil_inspect_top5 table structure
		$this->db->query("CREATE TABLE #hasil_inspect_top5 (
    jumlah INT,
    kode_defect NVARCHAR(255)
)");

		$this->db->query(
			"INSERT INTO #hasil_inspect_top5 (jumlah, kode_defect)
    SELECT TOP 5 COUNT(*) AS jumlah, kode_defect  
    FROM inspect_v2_hari_ini 
    WHERE line IN (SELECT line FROM #daftarline) 
    AND kanaan_po IN (SELECT kanaan_po FROM #daftar_buyer) 
    AND CONVERT(DATE, time_stamp) BETWEEN ? AND ? 
    AND kode_defect <> 'OK' 
    AND kode_defect <> '' 
    AND (? = '' OR line IN (SELECT Value FROM SplitString(?, ','))) 
    GROUP BY kode_defect 
    ORDER BY jumlah DESC",
			[$start_date, $end_date, $line, $line]
		);

		// Create #summary table structure
		$this->db->query("CREATE TABLE #summary (
    jumlah INT,
    kode_defect NVARCHAR(255),
    keterangan NVARCHAR(255)
)");

		$this->db->query(
			"INSERT INTO #summary (jumlah, kode_defect, keterangan)
    SELECT h.jumlah, h.kode_defect, d.keterangan 
    FROM #hasil_inspect_top5 h 
    LEFT JOIN daftar_defect d 
    ON d.kode = h.kode_defect 
    ORDER BY h.jumlah DESC"
		);

		$query = $this->db->query("SELECT *, 
    CAST(ROUND((jumlah * 100.0) / (SELECT SUM(jumlah) FROM #summary), 2) AS FLOAT) AS prosentase 
    FROM #summary");

		// Clean up temporary tables
		$this->db->query("DROP TABLE IF EXISTS #daftarline, #daftar_buyer, #summary, #hasil_inspect_top5");

		$data['data'] = $query->result_array();


		// pre($data['data']);

		/* $sekarang = date('Y-m-d');
		$sql = "exec [sp_grafik_top_5_defect_hari_ini] '' , '$sekarang' , '$sekarang'  , ''";
		$data['data'] = $this->db->query($sql)->result_array();
		pre($data['data']); */
		//echo "$sql";
		// return $data ; 
		//echo json_encode($data);
		//pre($data);
		$data['pagetitle'] = "GRAFIK TOP 5 DEFECT";
		$this->load->view('welcome_grafik_top_5_defect', $data);
	}

	public function weekly_top_5_per_linew()
	{
		$sekarang = date('Y-m-d');
		$tanggal_hari_ini = date('Y-m-d');
		$tanggal_senin = date('Y-m-d', strtotime('monday this week', strtotime($tanggal_hari_ini)));
		$tanggal_jumat = date('Y-m-d', strtotime('friday this week', strtotime($tanggal_hari_ini)));

		$start_date = $tanggal_senin;
		$end_date = $tanggal_jumat;
		$buyer = "";
		$line = "";

		// Create #daftar_buyer table structure
		$this->db->query("CREATE TABLE #daftar_buyer (
			kanaan_po NVARCHAR(255),
			buyer NVARCHAR(255)
		)");

		$this->db->query(
			"INSERT INTO #daftar_buyer (kanaan_po, buyer)
			SELECT DISTINCT ins.kanaan_po, ins.buyer 
			FROM inspect_v2 ins 
			WHERE ins.kanaan_po IS NOT NULL 
			AND CONVERT(VARCHAR(10), ins.tanggal, 120) BETWEEN ? AND ? 
			AND ins.buyer LIKE ? 
			AND (? = '' OR ins.line IN (SELECT Value FROM SplitString(?, ',')))",
			[$start_date, $end_date, '%' . $buyer . '%', $line, $line]
		);

		// Create #daftarline table structure
		$this->db->query("CREATE TABLE #daftarline (
			line NVARCHAR(255)
		)");

		$this->db->query(
			"INSERT INTO #daftarline (line)
			SELECT DISTINCT ins.line 
			FROM inspect_v2 ins 
			WHERE CONVERT(VARCHAR(10), ins.tanggal, 120) BETWEEN ? AND ? 
			AND ins.kanaan_po IN (SELECT kanaan_po FROM #daftar_buyer) 
			AND (? = '' OR ins.line IN (SELECT Value FROM SplitString(?, ','))) 
			ORDER BY ins.line",
			[$start_date, $end_date, $line, $line]
		);

		// Create #hasil_inspect_top5 table structure
		$this->db->query("CREATE TABLE #hasil_inspect_top5 (jumlah INT, kode_defect NVARCHAR(255))");
		$this->db->query(
			"INSERT INTO #hasil_inspect_top5 (jumlah, kode_defect)
			SELECT TOP 5 COUNT(*) AS jumlah, kode_defect  
			FROM inspect_v2 
			WHERE line IN (SELECT line FROM #daftarline) 
			AND kanaan_po IN (SELECT kanaan_po FROM #daftar_buyer) 
			AND CONVERT(DATE, time_stamp) BETWEEN ? AND ? 
			AND kode_defect <> 'OK' 
			AND kode_defect <> '' 
			AND (? = '' OR line IN (SELECT Value FROM SplitString(?, ','))) 
			GROUP BY kode_defect 
			ORDER BY jumlah DESC",
			[$start_date, $end_date, $line, $line]
		);

		// Create #summary table structure
		$this->db->query("CREATE TABLE #summary (
			jumlah INT,
			kode_defect NVARCHAR(255),
			keterangan NVARCHAR(255)
		)");
		$this->db->query(
			"INSERT INTO #summary (jumlah, kode_defect, keterangan)
			SELECT h.jumlah, h.kode_defect, d.keterangan 
			FROM #hasil_inspect_top5 h 
			LEFT JOIN daftar_defect d 
			ON d.kode = h.kode_defect 
			ORDER BY h.jumlah DESC"
		);
		$query = $this->db->query("SELECT *, 
		CAST(ROUND((jumlah * 100.0) / (SELECT SUM(jumlah) FROM #summary), 2) AS FLOAT) AS prosentase 
		FROM #summary");
		// Clean up temporary tables
		$this->db->query("DROP TABLE IF EXISTS #daftarline, #daftar_buyer, #summary, #hasil_inspect_top5");
		$data['data'] = $query->result_array();
		$data['pagetitle'] = "GRAFIK TOP 5 DEFECT";
		// pre ($data['data']);
		$this->load->view('welcome_grafik_top_5_defectw', $data);
	}

	/*
	public function lost_time()
	{
		$tanggal = date('Y-m-d');
		$sql_loss_time = "exec sp_loss_time_fix '$tanggal'";
		$data['data_loss_time'] = $this->db->query($sql_loss_time)->result_array();
		
		$this->load->view('welcome_lost_time', $data);
		//$this->loadViews("Qa_end_line/Index", $this->global, NULL, NULL);
	}
	*/

	public function getServerTime()
	{
		date_default_timezone_set('Asia/Jakarta');
		// Mendapatkan waktu server
		$serverTime = date('Y-m-d H:i:s');

		// Menyiapkan data untuk respons JSON
		$response = array(
			'status' => 'success',
			'message' => 'Server time retrieved successfully',
			'data' => array(
				'serverTime' => $serverTime,
				'jam' => date('H:i:s'),
				'tanggal' => date('Y-m-d')
			)
		);

		// Mengatur jenis konten respons sebagai JSON
		header('Content-Type: application/json');

		// Mengirimkan respons JSON
		echo json_encode($response);
	}

	public function test()
	{
		$this->db->select('consignee_name');
		$query = $this->db->get('consignee');
		foreach ($query->result() as $row) {
			pre($row->consignee_name);
			pre(cleanConsignee($row->consignee_name));
		}
	}




	// public function index()
	// {
	// 	$this->db->select(
	// 		'
	// 		po,
	// 		style,
	// 		material,
	// 		color,
	// 		kanaan_po,
	// 		mcq as pcs_ctn,  
	// 		(isnull(quantity,0) - isnull(last_karton,0)) as qty_pcs, 
	// 		(isnull(quantity,0) - isnull(last_karton,0)) / isnull(mcq,0) as total_ctn, 
	// 		net_weight as nwt_pcs,
	// 		((isnull(quantity,0) - isnull(last_karton,0)) * isnull(net_weight,0)) as nwt_kgs,
	// 		((isnull(quantity,0) - isnull(last_karton,0)) / isnull(mcq,0) * isnull(berat_karton,0)) + ((isnull(quantity,0) - isnull(last_karton,0)) * isnull(net_weight,0)) as gwt_kgs,
	// 		ROUND((isnull(panjang,0) * isnull(lebar,0) * isnull(tinggi,0) * ((isnull(quantity,0) - isnull(last_karton,0)) / isnull(mcq,0))) / 1000000, 2) as dim_cbm,
	// 		quantity, 
	// 		description, 
	// 		berat_karton,
	// 		panjang, 
	// 		lebar,
	// 		tinggi,
	// 		last_karton');
	// 	$query = $this->db->get('master_dpl');

	// 	$dd = [];
	// 	foreach ($query->result_array() as $row) {
	// 		$dd[$row['description']][] = $row;
	// 	}

	// 	foreach($query->result_array() as $row) {
	// 		if ($row['last_karton'] <= 0)  continue;
	// 		$row['pcs_ctn'] = $row['last_karton'];
	// 		$row['qty_pcs'] = $row['last_karton'];

	// 		$total_ctn = sprintf('%0.2f', ($row['last_karton'] / $row['last_karton']), 2);
	// 		$nwt_kgs = $row['last_karton'] * $row['nwt_pcs'];
	// 		$row['total_ctn'] = $total_ctn;
	// 		$row['nwt_kgs'] = sprintf('%0.2f',$nwt_kgs,2);
	// 		$row['gwt_kgs'] = ($total_ctn * $row['berat_karton'])  + $nwt_kgs;
	// 		$row['dim_cbm'] = round(($row['panjang'] * $row['lebar'] * $row['tinggi'] * $total_ctn) / 1000000, 2);
	// 		$ll[$row['description']][] = $row;
	// 	}

	// 	// pre($ll);

	// 	$dpl = array_merge_recursive($dd, $ll);
	// 	pre($dpl);

	// 	pre('**********************************END**********************************');
	// }
}
