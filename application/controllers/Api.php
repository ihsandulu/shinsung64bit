<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Api extends MY_Controller
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
    echo "Hayo ngapain!";
    //$this->loadViews("Qa_end_line/Index", $this->global, NULL, NULL);
  }

  public function fivedefectweek()
  {
    $start_of_week = date('Y-m-d', strtotime('last sunday', strtotime('tomorrow')));
    $end_of_week = date('Y-m-d', strtotime('next saturday', strtotime('today')));

    // Query untuk menghitung jumlah kemunculan setiap kode_defect
    $query = $this->db->select('kode_defect, keterangan, COUNT(*) as count')
      ->from('inspect_v2')
      ->join("daftar_defect", "daftar_defect.kode=inspect_v2.kode_defect", "left")
      ->where('time_stamp >=', $start_of_week)
      ->where('time_stamp <=', $end_of_week)
      ->group_by('kode_defect,keterangan')
      ->order_by('count', 'DESC')
      ->get();

    //   echo $this->db->last_query();

    // Memproses hasil query
    $results = $query->result();
    $arrdefect = array();
    if (!empty($results)) {
      foreach ($results as $row) {
        if ($row->kode_defect != "OK") {
          $arrdefect[$row->kode_defect] = $row->keterangan;
        }
      }
    }

    // Mengurutkan array berdasarkan nilai secara menurun
    //   arsort($arrdefect);

    //   print_r($arrdefect);

    // Mengambil 5 kode defect dengan nilai tertinggi
    $top5defects = array_slice($arrdefect, 0, 5, true);

    // Menampilkan hasil
    foreach ($top5defects as $kode_defect => $keterangan) {
      $eng = explode("/", $keterangan);
?>
      <!-- echo "Kode Defect: $kode_defect, Jumlah: $count\n"; -->
      <div class="col-md-3 mb-3">
        <button class="btn btn-block btn-xs btn-danger btn-defect text-wrap" onclick="top5defect('<?= $kode_defect; ?>');"><?= $eng[0]; ?></button>
      </div>
    <?php }
  }

  public function fivedefectweekb()
  {
    /* $start_of_week = date('Y-m-d', strtotime('last sunday', strtotime('tomorrow')));
    $end_of_week = date('Y-m-d', strtotime('next saturday', strtotime('today')));
    $query = $this->db->select('kode_defect, keterangan, COUNT(*) as count')
      ->from('inspect_v2')
      ->join("daftar_defect", "daftar_defect.kode=inspect_v2.kode_defect", "left")
      ->where('time_stamp >=', $start_of_week)
      ->where('time_stamp <=', $end_of_week)
      ->group_by('kode_defect,keterangan')
      ->order_by('count', 'DESC')
      ->get();
    $results = $query->result();
    $arrdefect = array();
    if (!empty($results)) {
      foreach ($results as $row) {
        if ($row->kode_defect != "OK") {
          $arrdefect[$row->kode_defect] = $row->keterangan;
        }
      }
    }
    $top5defects = array_slice($arrdefect, 0, 5, true); */
    $start_of_week = date('Y-m-d', strtotime('last sunday', strtotime('tomorrow')));
    $end_of_week = date('Y-m-d', strtotime('next saturday', strtotime('today')));

    $query = $this->db->select('kode_defect, keterangan, COUNT(*) as count')
      ->from('inspect_v2')
      ->join("daftar_defect", "daftar_defect.kode=inspect_v2.kode_defect", "left")
      ->where('time_stamp >=', $start_of_week)
      ->where('time_stamp <=', $end_of_week)
      ->where('kode_defect !=', 'OK')  // Menghindari OK langsung di query
      ->group_by('kode_defect, keterangan')
      ->order_by('count', 'DESC')
      ->limit(5)  // Batasi hasil hanya 5 tertinggi
      ->get();

    $results = $query->result();
    $top5defects = array();

    if (!empty($results)) {
      foreach ($results as $row) {
        $top5defects[$row->kode_defect] = $row->keterangan;
      }
    }

    ?>
    <div class="col-md-4 mb-3 pd">
      <button class="btn btn-block btn-xs btn-danger btn-defect text-wrap" id="btn_start" onClick="start_check()">REJECT</button>
    </div>
    <?php
    foreach ($top5defects as $kode_defect => $keterangan) {
      $eng = explode("/", $keterangan);
    ?>
      <div class="col-md-4 mb-3 pd">
        <button class="btn btn-block btn-xs btn-danger btn-defect text-wrap" onclick="top5defect('<?= $kode_defect; ?>');"><?= $eng[0]; ?></button>
      </div>
    <?php }
  }

  public function cekid()
  {
    $colornya = $this->input->get("colornya");
    $sizenya = $this->input->get("sizenya");
    $KANAAN_PO = $this->input->get("KANAAN_PO");
    $STYLE_NO = $this->input->get("STYLE_NO");
    $line = $this->input->get("line");

    $sql = $this->db->from("v_schedule_produksi_2021_hari_ini")
      ->select("ID")
      ->where("COLOR", $colornya)
      ->where("SIZE", $sizenya)
      ->where("KANAAN_PO", $KANAAN_PO)
      ->where("STYLE_NO", $STYLE_NO)
      ->where("LINE_SEWING", $line)
      ->order_by("tampilkan_target", "DESC")
      ->get();
    $id = 0;
    foreach ($sql->result() as $row) {
      $id = $row->ID;
    }
    echo $id;
    //  echo  $this->db->last_query();
  }

  public function ambillistgambar()
  {
    $id_scedule = $this->input->get("id_scedule");
    $tanggal_upload = $this->input->get("tanggal_upload");

    $sql = $this->db->from("style_images")
      ->where("id_scedule", $id_scedule)
      ->where("tanggal_upload", $tanggal_upload)
      ->order_by("id_scedule", "ASC")
      ->get();
    $no = 0;
    //  echo  $this->db->last_query();
    foreach ($sql->result() as $row) {
      $no++ ?>
      <td>
        <div align="center"><img id="scream<?php echo $no; ?>" src="<?php echo base_url() ?>uploads/style/<?php echo $row->img_style; ?>" height="64" onClick="uploadImage<?php echo $no; ?>()" />
      </td>

    <?php }
  }

  public function hasillinejam()
  {
    $tanggal = $this->input->get("tanggal");
    $line_sewing = $this->input->get("line_sewing");
    $id_schedule = $this->input->get("id_schedule");
    $kanaan_po = $this->input->get("kanaan_po");
    $style = $this->input->get("style");
    ?>

    <?php
    $harike =  date('N', strtotime($tanggal));
    if ($harike == 5) {
      $hari_ket = "jumat";
    } else if ($harike == 6) {
      // $hari_ket = "sabtu";
      $hari_ket = "senin - kamis";
    } else if ($harike == 7) {
      // $hari_ket = "minggu";
      $hari_ket = "senin - kamis";
    } else {
      $hari_ket = "senin - kamis";
    }
    $tok = 0;

    $subquery = $this->db
      ->select("kode_defect, inspect_v2.id_schedule, id, CAST(time_stamp AS TIME)as jam")
      ->where("line", $line_sewing)
      //lebih rinci per color dan size
      // ->where("id_schedule", $id_schedule)
      // ->where("kanaan_po", $kanaan_po)
      // ->where("style", $style)
      ->where("kode_defect", "OK")
      ->where("CONVERT(VARCHAR, inspect_v2.time_stamp , 23) = ", $tanggal)
      ->get_compiled_select("inspect_v2");

    $jam = $this->db
      ->select("
          CAST(jam_narget_detail.jam_ke AS INT) AS jam_ke_int, 
          MIN(jam_narget_detail.jam_start) AS jam_start, 
          MIN(jam_narget_detail.jam_end) AS jam_end, 
          COUNT(jum.id) AS jml
          ")
      ->from("jam_narget_detail")
      ->join("jam_narget_header", "jam_narget_header.id = jam_narget_detail.id_header", "left")
      ->join("($subquery)as jum", "jum.jam BETWEEN jam_narget_detail.jam_start AND jam_narget_detail.jam_end", "left")
      ->where("jam_narget_header.is_active", "y")
      ->where("jam_narget_detail.hari", $hari_ket)
      ->group_by("jam_ke")
      ->order_by("CONVERT(INT, jam_ke)")
      ->get();
    // echo $this->db->last_query();
    foreach ($jam->result() as $row) {
      $jam_start = $row->jam_start;
      $jam_end = $row->jam_end;
    ?>
      <tr>
        <td style="font-size:15px;" class="">
          <!-- <div class="col-md-6">
                <span class="start" style="margin:0px;margin-bottom:2px;padding0px;"><b>S:</b><?= substr($row->jam_start, 0, 8); ?></span>
                <span class="end" style="margin:0px;padding0px;"><b>E:</b><?= substr($row->jam_end, 0, 8); ?></span>
              </div> -->
          <div class="col-md-12" style="font-size:20px;margin:0px;">TIME : <?= $row->jam_ke_int; ?></div>
        </td>
        <td style="font-size:20px; font-weight:bold;"><?= $row->jml;
                                                      $tok += $row->jml; ?></td>
      </tr>
    <?php
    } ?>
    <tr>
      <th class='' style="font-size:25px; font-weight:bold;">TOTAL</th>
      <td class="tfoot2" style="font-size:20px; font-weight:bold;"><?= $tok; ?></td>
    </tr>
  <?php
  }

  public function hasillinejamironing()
  {
    $tanggal = $this->input->get("tanggal");
    $line_sewing = $this->input->get("line_sewing");
    $id_schedule = $this->input->get("id_schedule");
    $kanaan_po = $this->input->get("kanaan_po");
    $style = $this->input->get("style");
  ?>

    <?php
    $harike =  date('N', strtotime($tanggal));
    if ($harike == 5) {
      $hari_ket = "jumat";
    } else if ($harike == 6) {
      // $hari_ket = "sabtu";
      $hari_ket = "senin - kamis";
    } else if ($harike == 7) {
      // $hari_ket = "minggu";
      $hari_ket = "senin - kamis";
    } else {
      $hari_ket = "senin - kamis";
    }
    $tok = 0;

    $subquery = $this->db
      ->select("sewing_hasil_ironing.id_schedule, id, CAST(TANGGAL_HASIL AS TIME)as jam, QTY")
      ->where("line", $line_sewing)
      //lebih rinci per color dan size
      // ->where("id_schedule", $id_schedule)
      // ->where("kanaan_po", $kanaan_po)
      // ->where("style", $style)
      ->where("CONVERT(VARCHAR, sewing_hasil_ironing.TANGGAL_HASIL , 23) = ", $tanggal)
      ->get_compiled_select("sewing_hasil_ironing");

    $jam = $this->db
      ->select("
          CAST(jam_narget_detail.jam_ke AS INT) AS jam_ke_int, 
          MIN(jam_narget_detail.jam_start) AS jam_start, 
          MIN(jam_narget_detail.jam_end) AS jam_end, 
          SUM(jum.QTY) AS jml
          ")
      ->from("jam_narget_detail")
      ->join("jam_narget_header", "jam_narget_header.id = jam_narget_detail.id_header", "left")
      ->join("($subquery)as jum", "jum.jam BETWEEN jam_narget_detail.jam_start AND jam_narget_detail.jam_end", "left")
      ->where("jam_narget_header.is_active", "y")
      ->where("jam_narget_detail.hari", $hari_ket)
      ->group_by("jam_ke")
      ->order_by("CONVERT(INT, jam_ke)")
      ->get();
    // echo $this->db->last_query();
    foreach ($jam->result() as $row) {
      $jam_start = $row->jam_start;
      $jam_end = $row->jam_end;
    ?>
      <tr>
        <td style="font-size:15px;" class="">
          <!-- <div class="col-md-6">
                <span class="start" style="margin:0px;margin-bottom:2px;padding0px;"><b>S:</b><?= substr($row->jam_start, 0, 8); ?></span>
                <span class="end" style="margin:0px;padding0px;"><b>E:</b><?= substr($row->jam_end, 0, 8); ?></span>
              </div> -->
          <div class="col-md-12" style="font-size:20px;margin:0px;">TIME : <?= $row->jam_ke_int; ?></div>
        </td>
        <td style="font-size:20px; font-weight:bold;"><?= $row->jml;
                                                      $tok += $row->jml; ?></td>
      </tr>
    <?php
    } ?>
    <tr>
      <th class='' style="font-size:25px; font-weight:bold;">TOTAL</th>
      <td class="tfoot2" style="font-size:20px; font-weight:bold;"><?= $tok; ?></td>
    </tr>
  <?php
  }

  public function hasillinejamhangtag()
  {
    $tanggal = $this->input->get("tanggal");
    $line_sewing = $this->input->get("line_sewing");
    $id_schedule = $this->input->get("id_schedule");
    $kanaan_po = $this->input->get("kanaan_po");
    $style = $this->input->get("style");
  ?>

    <?php
    $harike =  date('N', strtotime($tanggal));
    if ($harike == 5) {
      $hari_ket = "jumat";
    } else if ($harike == 6) {
      // $hari_ket = "sabtu";
      $hari_ket = "senin - kamis";
    } else if ($harike == 7) {
      // $hari_ket = "minggu";
      $hari_ket = "senin - kamis";
    } else {
      $hari_ket = "senin - kamis";
    }
    $tok = 0;

    $subquery = $this->db
      ->select("sewing_hasil_hangtag.id_schedule, id, CAST(TANGGAL_HASIL AS TIME)as jam, QTY")
      ->where("line", $line_sewing)
      //lebih rinci per color dan size
      // ->where("id_schedule", $id_schedule)
      // ->where("kanaan_po", $kanaan_po)
      // ->where("style", $style)
      ->where("CONVERT(VARCHAR, sewing_hasil_hangtag.TANGGAL_HASIL , 23) = ", $tanggal)
      ->get_compiled_select("sewing_hasil_hangtag");

    $jam = $this->db
      ->select("
          CAST(jam_narget_detail.jam_ke AS INT) AS jam_ke_int, 
          MIN(jam_narget_detail.jam_start) AS jam_start, 
          MIN(jam_narget_detail.jam_end) AS jam_end, 
          SUM(jum.QTY) AS jml
          ")
      ->from("jam_narget_detail")
      ->join("jam_narget_header", "jam_narget_header.id = jam_narget_detail.id_header", "left")
      ->join("($subquery)as jum", "jum.jam BETWEEN jam_narget_detail.jam_start AND jam_narget_detail.jam_end", "left")
      ->where("jam_narget_header.is_active", "y")
      ->where("jam_narget_detail.hari", $hari_ket)
      ->group_by("jam_ke")
      ->order_by("CONVERT(INT, jam_ke)")
      ->get();
    // echo $this->db->last_query();
    foreach ($jam->result() as $row) {
      $jam_start = $row->jam_start;
      $jam_end = $row->jam_end;
    ?>
      <tr>
        <td style="font-size:15px;" class="">
          <!-- <div class="col-md-6">
                <span class="start" style="margin:0px;margin-bottom:2px;padding0px;"><b>S:</b><?= substr($row->jam_start, 0, 8); ?></span>
                <span class="end" style="margin:0px;padding0px;"><b>E:</b><?= substr($row->jam_end, 0, 8); ?></span>
              </div> -->
          <div class="col-md-12" style="font-size:20px;margin:0px;">TIME : <?= $row->jam_ke_int; ?></div>
        </td>
        <td style="font-size:20px; font-weight:bold;"><?= $row->jml;
                                                      $tok += $row->jml; ?></td>
      </tr>
    <?php
    } ?>
    <tr>
      <th class='' style="font-size:25px; font-weight:bold;">TOTAL</th>
      <td class="tfoot2" style="font-size:20px; font-weight:bold;"><?= $tok; ?></td>
    </tr>
    <?php
  }

  public function tablepo()
  {
    $po = $this->db->where("po_temporary", $this->input->get("po_temporary"))->get("po");
    // echo $this->db->last_query();
    foreach ($po->result() as $po) {
    ?>
      <tr>
        <td class="col-sm-1"><button type="button" onclick="deletepo(<?= $po->po_id; ?>)" class="btn btn-danger fa fa-close"></button></td>
        <td class="col-sm-4"><?= $po->po_date; ?></td>
        <td class="col-sm-4"><?= $po->po_number; ?></td>
        <td class="col-sm-3"><?= $po->po_qty; ?></td>
      </tr>
    <?php }
  }

  public function insertpo()
  {
    foreach ($this->input->get() as $e => $f) {
      $input[$e] = $this->input->get($e);
    }
    $this->db->insert("po", $input);
    echo $this->db->last_query();
  }

  public function deletepo()
  {
    foreach ($this->input->get() as $e => $f) {
      $input[$e] = $this->input->get($e);
    }
    $this->db->delete("po", $input);
    echo $this->db->last_query();
  }

  public function list_schedule()
  {
    ?>
    <table id="tbl_schedule_produksi" style="width: 100%; margin-top:10px;" class="table table-striped table-condensed nowrap" style="font-size:11px;" cellspacing="0">
      <thead>
        <tr>
          <th> ID </th>
          <th> LINE SEWING </th>
          <th> FILE NO </th>
          <th> BUYER </th>
          <th> STYLE NO </th>
          <th> SHOW TARGET </th>
          <th> SHOW KANBAN </th>
          <th> ITEM </th>
          <th> COLOR </th>
          <th> SIZE </th>
          <th> QTY ORDER </th>
          <th> FOB </th>
          <th> DELIVERY </th>
          <!-- <th> TANGGAL_CUTTING_START </th>   
            <th> TANGGAL_CUTTING_END </th>    -->
          <th> START DATE SEWING </th>
          <th> END DATE SEWING</th>
          <th> QTY PLAN </th>
          <th> HOURLY TARGET </th>
          <th> DAILY QTY </th>
          <th> NOTES </th>
          <th> DES </th>
        </tr>
      </thead>
      <tbody>
        <?php
        if (isset($_GET["datanya"]) && $_GET["datanya"] == "today") {
          $this->db->where("CONVERT(date , GETDATE()) 
            BETWEEN TANGGAL_SEWING_START AND TANGGAL_SEWING_END");
        }
        $this->db->order_by("CAST(LINE_SEWING AS INT)", "ASC");
        $q = $this->db->get("Schedule_produksi");
        // echo $this->db->last_query();
        $ip = $_SERVER['HTTP_HOST'];
        $no = 1;
        foreach ($q->result() as $row) { ?>
          <tr class="p-2">
            <td>
              <a href="<?= base_url() . 'Schedule_produksi/entry_data/' . $row->ID; ?>" class="btn btn-block btn-xs btn-warning"> EDIT </a>
              <a target="_blank" href="http://<?= $ip; ?>/sgiv2/lean/Qa_andon/display_sgi/<?= $row->LINE_SEWING; ?>" class="btn btn-block btn-xs btn-primary"> VIEW KANBAN </a>
            </td>
            <td><?= $row->LINE_SEWING; ?></td>
            <td><?= $row->KANAAN_PO; ?></td>
            <td><?= $row->BUYER; ?></td>
            <td><?= $row->STYLE_NO; ?></td>
            <td><?= $row->tampilkan_target; ?></td>
            <td>
              <select id="tkanban<?= $no; ?>" onchange="tampilkanban('<?= $no; ?>','<?= $row->ID; ?>')">
                <option value="Y" <?= ($row->tampilkan_andon == "Y") ? "selected" : ""; ?>>Y</option>
                <option value="N" <?= ($row->tampilkan_andon == "N") ? "selected" : ""; ?>>N</option>
              </select>
            </td>
            <td><?= $row->ITEM; ?></td>
            <td><?= $row->COLOR; ?></td>
            <td><?= $row->SIZE; ?></td>
            <td><?= $row->QTY_ORDER; ?></td>
            <td><?= $row->FOB; ?></td>
            <td><?= kiri($row->DELIVERY, 10); ?></td>

            <td><?= $row->TANGGAL_SEWING_START; ?></td>
            <td><?= $row->TANGGAL_SEWING_END; ?></td>
            <td><?= $row->QTY_PLAN; ?></td>
            <td><?= $row->target100persen; ?></td>
            <td><?= $row->QTY_HARIAN; ?></td>
            <td><?= $row->catatan; ?></td>
            <td><?= $row->DES; ?></td>
          </tr>
        <?php $no++;
        } ?>

      </tbody>
    </table>
    <script>
      function tampilkanban(no, ID) {
        let tkanban = $("#tkanban" + no).val();
        // alert("<?= base_url("api/rubahtampailkanban"); ?>?tampilkan_andon=" + tkanban + "&ID=<?= $row->ID; ?>");
        $.get("<?= base_url("api/rubahtampailkanban"); ?>", {
            tampilkan_andon: tkanban,
            ID: ID
          })
          .done(function(data) {
            toast(data);
          });
      }
    </script>
    <script>
      $(document).ready(function() {
        $('#tbl_schedule_produksi').DataTable({
          dom: 'Bfrtip',
          buttons: [{
              extend: 'print',
              title: 'Production Schedule',
              text: 'Print',
              exportOptions: {
                columns: ':not(:nth-child(1))'
              }
            },
            {
              extend: 'excelHtml5',
              title: 'Production Schedule',
              text: 'Excel',
              exportOptions: {
                columns: ':not(:nth-child(1))'
              }
            }
          ]
        });
      });
    </script>
  <?php
  }

  public function list_scheduleb()
  {
  ?>
    <table id="tbl_schedule_produksi" style="width: 100%; margin-top:10px;" class="table table-striped table-condensed nowrap" style="font-size:11px;" cellspacing="0">
      <thead>
        <tr>
          <th> ID </th>
          <th> LINE SEWING </th>
          <th> FILE NO </th>
          <th> BUYER </th>
          <th> STYLE NO </th>
          <th> SHOW TARGET </th>
          <th> SHOW KANBAN </th>
          <th> ITEM </th>
          <th> COLOR </th>
          <th> SIZE </th>
          <th> QTY ORDER </th>
          <th> FOB </th>
          <th> DELIVERY </th>
          <!-- <th> TANGGAL_CUTTING_START </th>   
            <th> TANGGAL_CUTTING_END </th>    -->
          <th> START DATE SEWING </th>
          <th> END DATE SEWING</th>
          <th> QTY PLAN </th>
          <th> HOURLY TARGET </th>
          <th> DAILY QTY </th>
          <th> NOTES </th>
          <th> DES </th>
        </tr>
      </thead>
      <tbody>
        <?php
        if (isset($_GET["datanya"]) && $_GET["datanya"] == "today") {
          $this->db->where("CONVERT(date , GETDATE()) 
            BETWEEN TANGGAL_SEWING_START AND TANGGAL_SEWING_END");
        }
        if (isset($_GET["fileno"]) && $_GET["fileno"] != "") {
          $this->db->where("KANAAN_PO", $_GET["fileno"]);
        }
        if (isset($_GET["style"]) && $_GET["style"] != "") {
          $this->db->where("STYLE_NO", $_GET["style"]);
        }
        $this->db->order_by("CAST(LINE_SEWING AS INT)", "ASC");
        $q = $this->db->get("Schedule_produksi");
        // echo $this->db->last_query();
        $ip = $_SERVER['HTTP_HOST'];
        $no = 1;
        foreach ($q->result() as $row) { ?>
          <tr class="p-2">
            <td>
              <a href="<?= base_url() . 'Schedule_produksi/entry_data/' . $row->ID; ?>" class="btn btn-block btn-xs btn-warning"> EDIT </a>
              <a target="_blank" href="http://<?= $ip; ?>/sgiv2/lean/Qa_andon/andonb/<?= $row->LINE_SEWING; ?>" class="btn btn-block btn-xs btn-primary"> VIEW KANBAN </a>
            </td>
            <td><?= $row->LINE_SEWING; ?></td>
            <td><?= $row->KANAAN_PO; ?></td>
            <td><?= $row->BUYER; ?></td>
            <td><?= $row->STYLE_NO; ?></td>
            <td><?= $row->tampilkan_target; ?></td>
            <td>
              <select id="tkanban<?= $no; ?>" onchange="tampilkanban('<?= $no; ?>','<?= $row->ID; ?>')">
                <option value="Y" <?= ($row->tampilkan_andon == "Y") ? "selected" : ""; ?>>Y</option>
                <option value="N" <?= ($row->tampilkan_andon == "N") ? "selected" : ""; ?>>N</option>
              </select>
            </td>
            <td><?= $row->ITEM; ?></td>
            <td><?= $row->COLOR; ?></td>
            <td><?= $row->SIZE; ?></td>
            <td><?= $row->QTY_ORDER; ?></td>
            <td><?= $row->FOB; ?></td>
            <td><?= kiri($row->DELIVERY, 10); ?></td>

            <td><?= $row->TANGGAL_SEWING_START; ?></td>
            <td><?= $row->TANGGAL_SEWING_END; ?></td>
            <td><?= $row->QTY_PLAN; ?></td>
            <td><?= $row->target100persen; ?></td>
            <td><?= $row->QTY_HARIAN; ?></td>
            <td><?= $row->catatan; ?></td>
            <td><?= $row->DES; ?></td>
          </tr>
        <?php $no++;
        } ?>

      </tbody>
    </table>
    <script>
      function tampilkanban(no, ID) {
        let tkanban = $("#tkanban" + no).val();
        // alert("<?= base_url("api/rubahtampailkanban"); ?>?tampilkan_andon=" + tkanban + "&ID=<?= $row->ID; ?>");
        $.get("<?= base_url("api/rubahtampailkanban"); ?>", {
            tampilkan_andon: tkanban,
            ID: ID
          })
          .done(function(data) {
            toast(data);
          });
      }
    </script>
    <script>
      $(document).ready(function() {
        $('#tbl_schedule_produksi').DataTable({
          dom: 'Bfrtip',
          buttons: [{
              extend: 'print',
              title: 'Production Schedule',
              text: 'Print',
              exportOptions: {
                columns: ':not(:nth-child(1))'
              }
            },
            {
              extend: 'excelHtml5',
              title: 'Production Schedule',
              text: 'Excel',
              exportOptions: {
                columns: ':not(:nth-child(1))'
              }
            }
          ]
        });
      });
    </script>
    <?php
  }

  public function rubahtampailkanban()
  {
    $where["ID"] = $this->input->get("ID");
    $input["tampilkan_andon"] = $this->input->get("tampilkan_andon");
    $this->db->where($where);
    $this->db->update('Schedule_produksi', $input);
    if ($this->db->affected_rows() > 0) {
      echo "Update Success!";
    } else {
      echo "Update Failed!";
    }
  }

  public function tampildefectsementara()
  {
    $data["defect_code"] = $this->input->get("defect_code");
    $data["unit_name"] = $this->input->get("unit_name");
    $data["id_schedule"] = $this->input->get("id_schedule");

    //cek defect
    $valid = $this->db->where("kode", $data["defect_code"])->get("daftar_defect");
    if ($valid->num_rows() > 0) { ?>
      <div id="isihasilsementara">
        <div style="font-weight: bold; font-size:15px;">LIST DEFECT:</div>
        <?php
        $this->db->insert('unit', $data);

        $tampil = $this->db->from("unit")
          ->join("daftar_defect AS d", "d.kode=unit.defect_code", "left")
          ->where("unit_name", $data["unit_name"])
          ->get();
        function shortenText($text, $maxLength = 22)
        {
          if (strlen($text) > $maxLength) {
            return substr($text, 0, $maxLength - 3) . "..";
          } else {
            return $text;
          }
        }
        foreach ($tampil->result() as $row) {
        ?>
          <div class="col-md-12 p-0"><?= $row->defect_code; ?> - <?= shortenText($row->keterangan); ?></div>
        <?php } ?>
      </div>
<?php } else {
      echo "1";
    }
  }

  public function qtysewing()
  {
    $data["id_schedule"] = $this->input->get("id_schedule");
    $schedule = $this->db
      ->where("id_schedule", $data["id_schedule"])
      ->get("sewing_hasil_produksi");
    echo $schedule->num_rows();
  }

  public function insertironing()
  {
    $user = $this->ion_auth->user()->row_array();
    $data["QTY"] = $this->input->get("QTY");
    $data["id_schedule"] = $this->input->get("id_schedule");
    $data["LINE"] = $this->input->get("LINE");
    $schedule = $this->db->where("ID", $data["id_schedule"])
      ->get("Schedule_produksi");
    foreach ($schedule->result() as $row) {
      $data["KANAAN_PO"] = $row->KANAAN_PO;
      $data["STYLE_NO"] = $row->STYLE_NO;
      $data["ITEM"] = $row->ITEM;
      $data["COLOR"] = $row->COLOR;
      $data["SIZE"] = $row->SIZE;
      $data["QTYGLOBAL"] = $row->QTY_ORDER;
      $data["JAMINPUT"] = date("Y-m-d H:i:s");
      $data["ID_ORDER"] = 0;
      $data["DES"] = $row->DES;
      $data["user_input"] = $user['user_id'] . ' ' .  $user['first_name'] . ' ' . $user['last_name'];

      $data['GAC'] = $row->DELIVERY;
      $data['FOB'] = $row->FOB;
      $data['CMT'] = $row->FOB / 10;
      $data['BUYER'] = $row->BUYER;
    }
    $this->db->insert('sewing_hasil_ironing', $data);
  }

  public function inserthangtag()
  {
    $user = $this->ion_auth->user()->row_array();
    $data["po_id"] = $this->input->get("po_id");
    $data["QTY"] = $this->input->get("QTY");
    $data["id_schedule"] = $this->input->get("id_schedule");
    $data["LINE"] = $this->input->get("LINE");
    $schedule = $this->db->where("ID", $data["id_schedule"])
      ->get("Schedule_produksi");
    foreach ($schedule->result() as $row) {
      $data["KANAAN_PO"] = $row->KANAAN_PO;
      $data["STYLE_NO"] = $row->STYLE_NO;
      $data["ITEM"] = $row->ITEM;
      $data["COLOR"] = $row->COLOR;
      $data["SIZE"] = $row->SIZE;
      $data["QTYGLOBAL"] = $row->QTY_ORDER;
      $data["JAMINPUT"] = date("Y-m-d H:i:s");
      $data["ID_ORDER"] = 0;
      $data["DES"] = $row->DES;
      $data["user_input"] = $user['user_id'] . ' ' .  $user['first_name'] . ' ' . $user['last_name'];

      $data['GAC'] = $row->DELIVERY;
      $data['FOB'] = $row->FOB;
      $data['CMT'] = $row->FOB / 10;
      $data['BUYER'] = $row->BUYER;
    }
    $this->db->insert('sewing_hasil_hangtag', $data);
  }

  public function listinputdefect()
  {
    $unit_name = $this->input->get("unit_name");
    $list = $this->db->where("unit_name", $unit_name)->get("unit");
    $line = $this->input->get("line");
    foreach ($list->result() as $row) {
      $id_schedule = $_GET["id_schedule"];
      $sql = "select  * from Schedule_produksi where LINE_SEWING = '$line' and ID = '$id_schedule'";

      $data['schedule'] = $this->db_kis->query($sql)->row_array();
      $user = $this->ion_auth->user()->row_array();


      if ($data['schedule']) {
        $dt_schedule = $data['schedule'];
        $id_schedule = $dt_schedule['ID'];
        $insert['id_schedule'] = $id_schedule;

        $insert['unit_name']     = $unit_name;
        $insert['kanaan_po']     = $data['schedule']['KANAAN_PO'];
        $insert['style']       = $data['schedule']['STYLE_NO'];
        $insert['des']         = $data['schedule']['DES'];
        $insert['color']       = $data['schedule']['COLOR'];
        $insert['qty_order']     = $data['schedule']['QTY_ORDER'];
        $insert['buyer']     = $data['schedule']['BUYER'];
        $insert['size']     = $data['schedule']['SIZE'];
        $insert['line']         = $line;
        $insert['user_id']       = $this->session->userdata('user_id');;
        $insert['nama_user']     = $user['first_name'] . ' ' . $user['last_name'];
        $data             = $_GET;
        $insert['kode_defect']     = $row->defect_code;
        $insert['uuid']       = $data['uuid'];
        $insert['status_inspect']   = substr($this->session->userdata('email'), -1);

        $kode = $row->defect_code;
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
      } else {
        $arr = array('status'  => '5');
        echo json_encode($arr);
      }
    }
  }

  public function namaunit()
  {
    $line = $this->input->get("line");
    $unit_name = $line . date("ymdHis");
    echo $unit_name;
  }
}



/* End of file Log.php */
/* Location: ./application/controllers/Log.php */
