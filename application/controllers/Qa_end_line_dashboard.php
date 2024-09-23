<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Qa_end_line_dashboard extends MY_Controller
{
	private $db_kis = "";
	function __construct()
	{
		parent::__construct();
		$this->is_logedin();
		$this->load->helper(array('form', 'url'));
		$this->db_kis  = $this->load->database('kis', TRUE);
		$this->load->helper('url');
		$this->load->library(['ion_auth', 'form_validation']);
	}



	public function index()
	{
		$tanggal = date('Y-m-d');
		if (isset($_GET["date1"])) {
			$tanggal = $_GET["date1"];
		}
		$pagetitle = 'DASHBOARD % DEFECT ALL LINE | DATE ' . $tanggal;
		$pagetitle .= '<form class="form-inline" action="">
    <div class="form-group">
      <label for="date1">Date:</label>
      <input type="date" class="form-control" id="date1" placeholder="Enter Date" name="date1" value="' . $tanggal . '">
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>';
		$data['pagetitle'] = $pagetitle;

		$query = $this->db->query("exec [dashboard_Qa_end_line_all_line_hari_ini1] ?", array($tanggal));
		$data['persen_defect'] = $query->result_array();

		$this->loadViews('Qa_end_line/list_report', $data);
	}


	public function qco()
	{
		$tanggal = date('Y-m-d');
		$data['pagetitle'] = 'DASHBOARD % DEFECT ALL LINE QCO | DATE ' . $tanggal;

		//query persent defect dashboard_Qa_end_line_all_line
		$sql = "dashboard_Qa_end_line_all_line_hari_ini";
		$data['persen_defect'] = $this->db->query($sql)->result_array();

		//get chief 

		$sql = " SELECT * FROM dbo.tampilan_hasil_produksi_daftar_manager_supervisor WHERE tanggal = '$tanggal'  ";
		$data['chief'] = $this->db_kis->query($sql)->result_array();


		$this->loadViews('Qa_end_line/list_report_qco', $data);
		//$this->loadViews("Qa_end_line/Index", $this->global, NULL, NULL);
	}

	public function qcov2()
	{
		$tanggal = date('Y-m-d');
		$data['pagetitle'] = 'DASHBOARD % DEFECT ALL LINE QCO | DATE ' . $tanggal;

		//query persent defect dashboard_Qa_end_line_all_line
		$sql = "dashboard_Qa_end_line_all_line_hari_ini";
		$data['persen_defect'] = $this->db->query($sql)->result_array();

		//get chief 

		$sql = " SELECT * FROM dbo.tampilan_hasil_produksi_daftar_manager_supervisor WHERE tanggal = '$tanggal'  ";
		$data['chief'] = $this->db_kis->query($sql)->result_array();


		$this->loadViews('Qa_end_line/dashboard_qcov2.php', $data);
		//$this->loadViews("Qa_end_line/Index", $this->global, NULL, NULL);
	}



	public function qco_grafik()
	{
		$data['pagetitle'] = 'DASHBOARD GRAFIK QCO';
		$buyer = '';
		$tanggal_awal = date('Y-m-d');
		$tanggal_akhir = date('Y-m-d');

		$data['info_buyer'] = $buyer;
		$data['info_tanggal_awal'] = $tanggal_awal;
		$data['info_tanggal_akhir'] = $tanggal_akhir;

		// $sql = "exec [sp_grafik_defect_rate_dev] '$buyer' , '$tanggal_awal' , '$tanggal_akhir' , ''";
		//$data['data'] = $this->db->query($sql)->result_array(); 

		$sql = "exec [sp_grafik_defect_rate_per_jenis] '' , '2024-03-15' , '2024-03-15' , '' , 'Construction'";
		$data['data'] = execute_query_resultarray_and_log($sql);
		// 
		//pre($data);

		$this->benchmark->mark('code_end');
		simpan_log("function Welcome Grafik defectrate ( $buyer , $tanggal_awal , $tanggal_akhir , ''  ) PHP ", $this->benchmark->elapsed_time('code_start', 'code_end'));

		$this->loadViews('qco/qco_grafik', $data);

		//$this->loadViews("Qa_end_line/Index", $this->global, NULL, NULL);
	}


	public function detail_defect_per_line($line)
	{
		$data['pagetitle'] = 'DEFECT DETAIL ALL LINE <B>' . $line . '</B>   DATE : ' . date('Y-m-d');
		$data['data']  = $this->db->query(" [dashboard_Qa_end_line_all_line_detail_defect_per_line]  '$line'    ")->result_array();


		$this->loadViews('Qa_end_line/Qa_end_line_dashboard_detail_defect', $data);
	}

	//  EXEC sp_count_hasil_inspect_bags_defect_list '6434a21a1f216' 
	public function sp_dashboard_Qa_end_line_all_line_detail_defect_per_line($line)
	{
		$date1 = $_GET["date1"];

		// unset($insert[]) ;
		// $data = $this->db->query(" dashboard_Qa_end_line_all_line_detail_defect_per_line1  '$line' , '$date1' ")->result_array();

		$ok = $this->db
            ->from("inspect_v2")
            ->select("COUNT(kode_defect)AS jmlok")
            ->where("line", $line)
            ->where("kode_defect", "OK")
            ->where("CONVERT(VARCHAR(10), time_stamp, 120)=", $date1)
            ->group_by("kode_defect")
            ->order_by("kode_defect ASC")
            ->get();
        $nok = $ok->num_rows();
        $jok = 0;
        if ($nok > 0) {
            $jok = $ok->row()->jmlok;
        }

        // echo $jok;

        $def = $this->db
            ->from("inspect_v2")
            ->select("kode_defect, count(kode_defect)AS jmlun, MAX(keterangan)AS keterangan ")
            ->join("daftar_defect", "daftar_defect.kode=inspect_v2.kode_defect", "left")
            ->where("line", $line)
            ->where("kode_defect !=", "OK")
            ->where("CONVERT(VARCHAR(10), time_stamp, 120)=", $date1)
            ->group_by("kode_defect")
            ->order_by("kode_defect ASC")
            ->get();
        // echo $this->db->last_query();
        $data = array();
        foreach ($def->result() as $row) {
            $data[$row->kode_defect]['kode_defect'] = $row->kode_defect;
            $data[$row->kode_defect]["keterangan"] = $row->keterangan;
            $data[$row->kode_defect]['jumlah_defect'] = $row->jmlun;
            $data[$row->kode_defect]['persen_defect'] = $data[$row->kode_defect]['jumlah_defect'] / ($jok+$data[$row->kode_defect]['jumlah_defect']) * 100;
        }

		echo json_encode($data);
	}


	public function sp_dashboard_Qa_end_line_all_line_detail_defect_per_line_qco($line)
	{


		// unset($insert[]) ;
		$data = $this->db->query(" dashboard_Qa_end_line_all_line_detail_defect_per_line  '$line'  ")->result_array();
		echo json_encode($data);
	}

	public function sp_dashboard_loss_time()
	{


		// unset($insert[]) ; exec sp_dashboard_loss_time 
		$data = $this->db->query(" sp_dashboard_loss_time")->result_array();
		echo json_encode($data);
	}



	public function list_report_detail()
	{

		// $tanggal = date('Y-m-d');
		// $data['pagetitle'] = 'DASHBOARD % DEFECT ALL LINE | DATE ' . $tanggal;

		$tanggal = date('Y-m-d');
		if (isset($_GET["date1"])) {
			$tanggal = $_GET["date1"];
		}
		$pagetitle = 'DASHBOARD % DEFECT ALL LINE | DATE ' . $tanggal;
		$pagetitle .= '<form class="form-inline" action="">
    <div class="form-group">
      <label for="date1">Date:</label>
      <input type="date" class="form-control" id="date1" placeholder="Enter Date" name="date1" value="' . $tanggal . '">
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>';
		$data['pagetitle'] = $pagetitle;

		//query persent defect dashboard_Qa_end_line_all_line
		// $sql = "dashboard_Qa_end_line_all_line_hari_ini";
		// $data['persen_defect'] = $this->db->query($sql)->result_array();
		// pre($tanggal);
		$query = $this->db->query("exec [dashboard_Qa_end_line_all_line_hari_ini1] ?", array($tanggal));
		$data['persen_defect'] = $query->result_array();
		// pre($data['persen_defect']);
		//get chief 

		//$sql = " SELECT * FROM dbo.tampilan_hasil_produksi_daftar_manager_supervisor WHERE tanggal = '$tanggal'  " ; 
		//$data['chief']= $this->db_kis->query($sql)->result_array();  
		//pre($data);
		$this->load->view('Qa_end_line/list_report_detail', $data);
		//$this->loadViews("Qa_end_line/Index", $this->global, NULL, NULL);
	}


	public function list_report_detail_qco()
	{

		$tanggal = date('Y-m-d');
		$data['pagetitle'] = 'DASHBOARD % DEFECT ALL LINE | DATE ' . $tanggal;

		//query persent defect dashboard_Qa_end_line_all_line
		$sql = "dashboard_Qa_end_line_all_line_hari_ini";
		$data['persen_defect'] = $this->db->query($sql)->result_array();

		//get chief 

		$sql = " SELECT * FROM dbo.tampilan_hasil_produksi_daftar_manager_supervisor WHERE tanggal = '$tanggal'  ";
		$data['chief'] = $this->db_kis->query($sql)->result_array();

		$this->load->view('Qa_end_line/list_report_detail_qco', $data);
		//$this->loadViews("Qa_end_line/Index", $this->global, NULL, NULL);
	}

	public function list_report_detail_qcov2()
	{

		$tanggal = date('Y-m-d');
		$data['pagetitle'] = 'DASHBOARD % DEFECT ALL LINE | DATE ' . $tanggal;

		//query persent defect dashboard_Qa_end_line_all_line
		$sql = "dashboard_Qa_end_line_all_line_hari_ini";
		$data['persen_defect'] = $this->db->query($sql)->result_array();

		//get chief 

		$sql = " SELECT * FROM dbo.tampilan_hasil_produksi_daftar_manager_supervisor WHERE tanggal = '$tanggal'  ";
		$data['chief'] = $this->db_kis->query($sql)->result_array();

		$this->load->view('Qa_end_line/list_report_detail_qcov2', $data);
		//$this->loadViews("Qa_end_line/Index", $this->global, NULL, NULL);
	}



	public function it()
	{
		$tanggal = date('Y-m-d');
		$data['pagetitle'] = 'DASHBOARD - DATE ' . $tanggal;

		//query persent defect dashboard_Qa_end_line_all_line
		$sql = "dashboard_Qa_end_line_all_line_hari_ini";
		$data['persen_defect'] = $this->db->query($sql)->result_array();

		//get chief 

		$sql = " SELECT * FROM dbo.tampilan_hasil_produksi_daftar_manager_supervisor WHERE tanggal = '$tanggal'  ";
		$data['chief'] = $this->db_kis->query($sql)->result_array();


		$this->loadViews('Qa_end_line/list_report_control', $data);
		//$this->loadViews("Qa_end_line/Index", $this->global, NULL, NULL);
	}

	public function list_report_detail_control()
	{

		$tanggal = date('Y-m-d');
		$data['pagetitle'] = 'DASHBOARD  DATE ' . $tanggal;

		//query persent defect dashboard_Qa_end_line_all_line
		$sql = "dashboard_Qa_end_line_all_line_hari_ini";
		$data['persen_defect'] = $this->db->query($sql)->result_array();

		//get chief 

		$sql = " SELECT * FROM dbo.tampilan_hasil_produksi_daftar_manager_supervisor WHERE tanggal = '$tanggal'  ";
		$data['chief'] = $this->db_kis->query($sql)->result_array();

		$this->load->view('Qa_end_line/list_report_detail_control', $data);
		//$this->loadViews("Qa_end_line/Index", $this->global, NULL, NULL);
	}


	public function list_report_dasbord()
	{

		$tanggal = date('Y-m-d');
		$data['pagetitle'] = 'DASHBOARD % DEFECT ALL LINE | DATE ' . $tanggal;

		//query persent defect dashboard_Qa_end_line_all_line
		$sql = "dashboard_Qa_end_line_all_line_hari_ini";
		$data['persen_defect'] = $this->db->query($sql)->result_array();

		//get chief 

		$sql = " SELECT * FROM dbo.tampilan_hasil_produksi_daftar_manager_supervisor WHERE tanggal = '$tanggal'  ";
		$data['chief'] = $this->db_kis->query($sql)->result_array();

		$this->load->view('Qa_end_line/list_report_dasbord', $data);
		//$this->loadViews("Qa_end_line/Index", $this->global, NULL, NULL);
	}

	public function list_report_dasbord_all()
	{

		$tanggal = date('Y-m-d');
		$data['pagetitle'] = 'DASHBOARD % DEFECT ALL LINE | DATE ' . $tanggal;

		//query persent defect dashboard_Qa_end_line_all_line
		$sql = "dashboard_Qa_end_line_all_line_hari_ini";
		$data['persen_defect'] = $this->db->query($sql)->result_array();

		//get chief 

		$sql = " SELECT * FROM dbo.tampilan_hasil_produksi_daftar_manager_supervisor WHERE tanggal = '$tanggal'  ";
		$data['chief'] = $this->db_kis->query($sql)->result_array();

		$this->load->view('Qa_end_line/list_report_dasbord_all', $data);
		//$this->loadViews("Qa_end_line/Index", $this->global, NULL, NULL);
	}



	public function hasil_output_perjam($line)
	{
		$tanggal = date("Y-m-d");
		if (isset($_GET["date1"])) {
			$tanggal = $_GET["date1"];
		}
		$data = $this->db->query(" [report_compare_output_per_proses]  '" . $tanggal . "' ,'$line' ")->result_array();
		// echo  $this->db->last_query();
		echo json_encode($data);
	}
}
