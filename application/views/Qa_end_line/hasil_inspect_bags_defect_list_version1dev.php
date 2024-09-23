<style>
  body {
    width: 100%;
  }

  .container {
    margin-top: 10px;
  }

  .colomn_satu {
    border-right: 1px solid #000;
    border-top: 0px solid #000;
    padding: 10px;
    padding-top: 0px;
  }

  .colomn_dua {
    border-right: 0px solid #000;
    border-top: 0px solid #000;
    padding: 10px;
    padding-top: 0px;
  }

  .colomn_tiga {
    /*border-right: 1px solid #000; */
    border-top: 0px solid #000;
    padding: 10px;
    padding-top: 0px;
  }

  .isi {
    border-bottom: 1px solid #DFDFDF;
    padding-bottom: 3px;
  }

  .footer {
    border-top: 1px solid #000;
    padding: 10px;
  }

  .row {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    flex-wrap: wrap;
  }

  .row>[class*='col-'] {
    display: flex;
    flex-direction: column;
  }
</style>
<style>
  .container_form {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    min-height: 300px;
    width: 100%;
    background-color: #f2f2f2;
    padding: 10px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  }

  .textbox {
    font-size: 24px;
    width: 100%;
    margin-bottom: 10px;
    text-align: right;
    padding-right: 5px;
  }

  .button {
    height: 80px;
    width: 90px;
    margin: 5px;
    font-size: 24px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: all 0.3s ease;
  }

  .button:hover {
    background-color: #3e8e41;
  }



  /* styling untuk tab */
  .tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
  }

  /* styling untuk tombol tab */
  .tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
  }

  /* styling untuk tombol tab ketika diaktifkan */
  .tab button.active {
    background-color: #ccc;
  }

  /* styling untuk konten tab */
  0 {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
  }

  .font-besar {
    font-size: 17px;
  }

  .mb-3 {
    margin-bottom: 10px;
  }

  .text-wrap {
    display: inline-block;
    padding: 10px 20px;
    font-size: 12px;
    text-align: center;
    text-decoration: none;
    color: white;
    background-color: brown;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    word-wrap: break-word;
    /* Membungkus kata yang panjang */
    white-space: normal;
    /* Mengizinkan pembungkusan baris */
  }

  .p-2 {
    padding: 5px;
    font-size: 15px;
  }

  .text-15 {
    font-size: 30px;
    height: 50px;
  }

  .btn-defect {
    height: 100px;
    font-size: 20px;
  }

  .overflow {
    overflow-x: hidden;
    overflow-y: auto;
    height: 630px;
    margin: 0px;
  }

  .btninfo {
    height: 50px !important;
    font-size: 15px;
  }

  .f30 {
    font-size: 20px;
  }
</style>

<body>
  <div class="container-fluid">

    <div id="getJam" style="font-size:12px; color:#000;  font-size:25px; margin-top:-46px;" align="right"></div>

    <script language="javascript">
      $('#getJam').load('<?php echo base_url() . 'Qa_end_line/getJam' ?>');
    </script>
    <script language="javascript">
      $(document).ready(function() {
        setInterval(function() {
          $('#getJam').load('<?php echo base_url() . 'Qa_end_line/getJam' ?>');
        }, 10000);
        /* setInterval(function() {
          refresh_qty_cek();
          total_output_perline();
        }, 12000); */
      });
    </script>



    <div align="center">
      <div class="alert alert-success" id="success-alert-inspect-ok_">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong> </strong> INSPECT OK
      </div>
    </div>


    <div align="center">
      <div class="alert alert-info" id="success-alert-defect-ok">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong> </strong> DEFECT DITAMBAHKAN
      </div>
    </div>


    <div align="center">
      <div class="alert alert-warning" id="success-alert-final-ok">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong> </strong> OUTPUT DITAMBAHKAN
      </div>
    </div>

    <div align="center">
      <div class="alert alert-warning" id="success-alert-final-hd-ok">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong> </strong> OUTPUT HD DITAMBAHKAN
      </div>
    </div>


    <div class="row">
      <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 colomn_satu">

        <div class="overflow">
          <div id="detail_data">
            <div align="left"><strong>
                <a id="href1" href="<?php echo base_url(); ?>Qa_end_line/display_inspect/<?php echo $line; ?>/<?php echo $id_schedule; ?>" target="_blank">

                </a>
              </strong></div>
            <div id='test1'></div>
            <div align="left" class="font-besar"><i>FILE # / Style # / Qty Order / Target 100% / Des</i></div>
            <div align="left" class="isi font-besar">
              <b>
                #<?=$this->input->get('KANAAN_PO'); ?> /
                <?=$this->input->get('STYLE_NO'); ?> /
                <i id="qtyorder"></i> /
                <i id="target100"></i> /
                <i id="des"></i>
              </b>
            </div>
          </div>

          <br />
          <input type="hidden" id="id_schedule" value="0" />
          <input type="hidden" id="target" value="0" />
          <form class="form-horizontal">
            <div class="form-group col-md-6">
              <div class="col-sm-12">
                <select onchange="cekidn()" id="color" class="form-control text-15">
                  <option value="">Color</option>
                  <?php
                  $kanaan_po = $this->input->get('KANAAN_PO');
                  $style_no = $this->input->get('STYLE_NO');
                  $color_query = $this->db->from("v_schedule_produksi_2021_hari_ini")
                    ->select("COLOR")
                    ->where("KANAAN_PO", $kanaan_po)
                    ->where("STYLE_NO", $style_no)
                    ->group_by("COLOR")
                    ->get();
                  foreach ($color_query->result() as $color_query) { ?>
                    <option value="<?= $color_query->COLOR; ?>"><?= $color_query->COLOR; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group col-md-6">
              <div class="col-sm-12">
                <select onchange="cekidn()" id="size" class="form-control text-15">
                  <option value="">Size</option>
                  <?php
                  $kanaan_po = $this->input->get('KANAAN_PO');
                  $style_no = $this->input->get('STYLE_NO');
                  $size_query = $this->db->from("v_schedule_produksi_2021_hari_ini")
                    ->select("SIZE")
                    ->where("KANAAN_PO", $kanaan_po)
                    ->where("STYLE_NO", $style_no)
                    ->group_by("SIZE")
                    ->get();
                  foreach ($size_query->result() as $size_query) { ?>
                    <option value="<?= $size_query->SIZE; ?>"><?= $size_query->SIZE; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </form>
          <table width="100%" border="0">
            <tr>
              <td width="50%"><button class="button" style="background-color:darkgreen; width: 96%; height: 185px;" id="btn_ok" onClick="oke_inspect()">GOOD </button></td>
              <td width="50%"><button class="button " style="background-color:darkred; width: 96%; height: 185px;" id="btn_start" onClick="start_check()">REJECT</button></td>
            </tr>

            <!--  
          <tr>
            <td colspan="2" width="50%"><button class="button" style="background-color:black; width: 98%; height: 50px;" id="btn_output" onClick="start_output()">OUTPUT PACKING </button></td>
            </tr>
        -->

          </table>


          <div class="container_form" id="form_defect">
            <div align="center" style="width:98%;">
              <div class="alert alert-danger" id="danger-alert-inspect-no">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong> </strong> KODE TIDAK TERDAFTAR
              </div>
            </div>

            <button class="button btn-block" style="background-color:darkred; width: 98%; height: 50px;" id="btn_end" onClick="end_check()">END CHECK</button>
            <input type="text" class="textbox" id="textbox1" name="textbox1" readonly>
            <button class="button" style="background-color:blue;" onClick="insert1('0')">0</button>
            <button class="button" style="background-color:blue;" onClick="insert1('1')">1</button>
            <button class="button" style="background-color:blue;" onClick="insert1('2')">2</button>

            <button class="button" style="background-color:blue;" onClick="insert1('3')">3</button>
            <button class="button" style="background-color:blue;" onClick="insert1('4')">4</button>
            <button class="button" style="background-color:blue;" onClick="insert1('5')">5</button>

            <button class="button" style="background-color:blue;" onClick="insert1('6')">6</button>
            <button class="button" style="background-color:blue;" onClick="insert1('7')">7</button>
            <button class="button" style="background-color:blue;" onClick="insert1('8')">8</button>

            <button class="button" style="background-color:blue;" onClick="insert1('9')">9</button>
            <button class="button" style="background-color:darkgreen;" onClick="ok_defect()">OK</button>
            <button class="button" style="background-color:red" onClick="kosongkan1()">DEL</button>

          </div>


          <div class="container_form" id="form_output">
            <button class="button btn-block" style="background-color:black; width: 98%; height: 50px;" id="btn_back" onClick="start_back()">BACK </button>
            <input type="text" class="textbox" id="textbox2" name="textbox2" style="width:97%;" readonly>
            <button class="button" style="background-color:blue;" onClick="insert2('0')">0</button>
            <button class="button" style="background-color:blue;" onClick="insert2('1')">1</button>
            <button class="button" style="background-color:blue;" onClick="insert2('2')">2</button>

            <button class="button" style="background-color:blue;" onClick="insert2('3')">3</button>
            <button class="button" style="background-color:blue;" onClick="insert2('4')">4</button>
            <button class="button" style="background-color:blue;" onClick="insert2('5')">5</button>

            <button class="button" style="background-color:blue;" onClick="insert2('6')">6</button>
            <button class="button" style="background-color:blue;" onClick="insert2('7')">7</button>
            <button class="button" style="background-color:blue;" onClick="insert2('8')">8</button>

            <button class="button" style="background-color:blue;" onClick="insert2('9')">9</button>
            <button class="button" style="background-color:darkgreen;" onClick="ok_final()">OK</button>
            <button class="button" style="background-color:red" onClick="kosongkan2()">DEL</button>
          </div>



          <div class="container_form" id="form_output_hd">


            <button class="button btn-block" style="background-color:blue; width: 98%; height: 50px;" id="btn_back" onClick="start_back()">BACK</button>
            <input type="text" class="textbox" id="textbox3" name="textbox2" readonly>
            <button class="button" style="background-color:blue;" onClick="insert3('0')">0</button>
            <button class="button" style="background-color:blue;" onClick="insert3('1')">1</button>
            <button class="button" style="background-color:blue;" onClick="insert3('2')">2</button>

            <button class="button" style="background-color:blue;" onClick="insert3('3')">3</button>
            <button class="button" style="background-color:blue;" onClick="insert3('4')">4</button>
            <button class="button" style="background-color:blue;" onClick="insert3('5')">5</button>

            <button class="button" style="background-color:blue;" onClick="insert3('6')">6</button>
            <button class="button" style="background-color:blue;" onClick="insert3('7')">7</button>
            <button class="button" style="background-color:blue;" onClick="insert3('8')">8</button>

            <button class="button" style="background-color:blue;" onClick="insert3('9')">9</button>
            <button class="button" style="background-color:darkgreen;" onClick="ok_final_hd()">OK</button>
            <button class="button" style="background-color:red" onClick="kosongkan3()">DEL</button>
          </div>


          <div class="row">
            <div class="col-md-12 mb-3"><span class="label label-danger p-2 col-md-12">Top 5 Defect This Week</span></div>
            <div id="5defect" class="" style="width: 100%;">


            </div>
            <script>
              function rubah5defect() {
                $.get("<?= base_url("api/fivedefectweek"); ?>")
                  .done(function(data) {
                    $("#5defect").html(data);
                  });
              }
              rubah5defect();
            </script>
          </div>


        </div>

      </div>
      <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 colomn_dua">
        <table class="table table-striped table-bordered" id="Table_summary" style="width:100%;">
          <tbody>
            <tr>
              <td onClick="refresh_qty_cek();total_output_perline();" width="34%" style="text-align:center; cursor:pointer;"> OUTPUT QC : <font size="+4"><strong>
                    <div id="jml_ceck">0</div>
                  </strong></font>
              </td>
              <td width="37%" style="text-align:center;"> SUM DEFECT : <font size="+4"><strong>
                    <div id="jml_defect">0</div>
                  </strong></font>
              </td>
              <td onClick="list_data_defect()" width="29%" id="button_status" style="text-align:center; color:#FFF;background-color: green;"> % DEFECT : <font size="+4"><strong>
                    <div id="jml_persen">0 %</div>
                  </strong></font>
              </td>
            </tr>
          </tbody>
        </table>

        <div align="right">
          <font size="+1" hidden>OUTPUT QC : </font><b> <span id="jml_qty" style="text-align:left; font-weight: bold; margin-right:10px; font-size:18px;" hidden></span></b>

          <button class="btn btn-sm btn-danger btninfo col-sm-3" style="background-color:darkred;" id="r" onClick="btn_reload()">REFRESH</button>
          <button class="btn btn-sm btn-danger btninfo col-sm-3" style="background-color:darkblue;" id="l" onClick="btn_style()">STYLE</button>
          <button class="btn btn-sm btn-danger btninfo col-sm-3" style="background-color:darkgreen;" id="btn_data_hasil" onClick="start_btn_hasil()">OUTPUT</button>
          <button class="btn btn-sm btn-danger btninfo col-sm-3" style="background-color:purple;" id="btn_data_defect" onClick="start_btn_defect()">DEFECT</button>
          <a href="#info" data-toggle="modal" id="detail" data-id="<?php echo $line; ?>">
            <button class="btn btn-sm btn-danger btninfo col-sm-3" style="background-color:black;" id="btn_history">HISTORY</button>
          </a>
        </div>




        <div style="overflow-y:auto; height:250px;">

          <div id="tabel_data_defect">
            <table class="table table-striped table-bordered" id="tabel_summary_defect_list" style="width:100%;">
            </table>
          </div>

          <div id="tabel_data_hasil">
            <table class="table table-striped table-bordered" style="width:100%;">
              <thead>
                <tr>
                  <th class='norotate' style="font-size:20px;">TARGET TIME</th>
                  <th class='rotate_text_green' style="font-size:20px;">RESULT</th>
                </tr>
              </thead>
              <tbody id="tabel_summary_hasil_qa_perjam">
              </tbody>
            </table>
          </div>

        </div>

      </div>

    </div>
  </div>




  <div class="modal fade" id="info" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-admin" role="document" style="width:98%;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"> HISTORY PEKERJAAN </h4>
        </div>
        <div class="modal-body">
          <div class="fetched-data">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    $(document).ready(function() {

      // cekidn();

      $('#info').on('show.bs.modal', function(e) {
        var rowid = $(e.relatedTarget).data('id');
        $.ajax({
          type: 'post',
          url: baseUrl + 'Qa_end_line/history',
          data: {
            rowid: rowid,
            url: '<?php echo $this->uri->segment(2); ?>',
          },
          success: function(data) {
            $('.fetched-data').html(data);
          }
        });
      });
    });
  </script>

</body>

<script language="javascript">
  $("#form_defect").hide();
  $("#form_output").hide();
  $("#form_output_hd").hide();

  $("#tabel_data_hasil").show();
  $("#tabel_data_defect").hide();

  $("#btn_data_defect").show();
  $("#btn_data_hasil").hide();

  $("#success-alert-defect-ok").hide();
  $("#success-alert-final-ok").hide();
  $("#success-alert-final-hd-ok").hide();
  $("#danger-alert-inspect-no").hide();
  $("#success-alert-inspect-ok_").hide();




  function btn_reload() {
    location.reload();
  }

  function btn_style() {
    location.href = "<?php echo base_url(); ?>Qa_end_line/daftar_schedule/<?php echo $line; ?>";
  }




  function start_btn_hasil() {


    $("#btn_data_hasil").hide();
    $("#btn_data_defect").show();

    $("#tabel_data_defect").hide();
    $("#tabel_data_hasil").show();
    $("#r").show();
    $("#l").show();
  }


  function start_btn_defect() {
    refresh_defect_table();
    $("#btn_data_hasil").show();
    $("#btn_data_defect").hide();

    $("#tabel_data_defect").show();
    $("#tabel_data_hasil").hide();
    $("#r").show();
    $("#l").show();
  }
</script>



<script>
  // window.onload = call_refresh_all;
  // document.addEventListener("DOMContentLoaded", call_refresh_all);

  var cekid = "";
  getuuid();

  function getuuid() {
    $.ajax({
        url: "<?php echo base_url() ?>" + "Qa_end_line/get_uuid",
        type: 'POST',
        dataType: 'JSON',
      })
      .done(function(response) {
        cekid = response.cekid;
      });
  }

  function start_check() {

    $("#btn_start").hide();
    $("#btn_ok").hide();
    $("#form_defect").show();
    $("#form_defect_hd").hide();
    $("#detail_data").hide();
    $("#btn_output").hide();
    $("#btn_output_hd").hide();

    getuuid();

  }


  function end_check() {
    call_refresh_all();
    $("#btn_start").show();
    $("#btn_ok").show();
    $("#btn_output").show();
    $("#btn_output_hd").show();
    $("#form_defect").hide();
    $("#form_output").hide();
    $("#form_output_hd").hide();
    $("#detail_data").show();
    cekid = "";
    getuuid();

  }


  function start_output() {
    $("#btn_start").hide();
    $("#btn_output").hide();
    $("#btn_output_hd").hide();
    $("#btn_ok").hide();
    $("#form_defect").hide();
    $("#form_output").show();
    $("#form_output_hd").hide();
    $("#detail_data").hide();
    start_btn_hasil();

  }


  function start_output_hd() {
    $("#btn_start").hide();
    $("#btn_output").hide();
    $("#btn_output_hd").hide();
    $("#btn_ok").hide();
    $("#form_defect").hide();
    $("#form_output").hide();
    $("#form_output_hd").show();
    $("#detail_data").hide();
    start_btn_hasil();

  }


  function start_back() {
    $("#btn_start").show();
    $("#btn_output").show();
    $("#btn_output_hd").show();
    $("#btn_ok").show();
    $("#form_defect").hide();
    $("#form_output").hide();
    $("#form_output_hd").hide();
    $("#detail_data").show();
    start_btn_defect();

  }

  var qty_checking = 0;
  var qty_defect = 0;




  function refresh_qty_cek() {
    // alert(1);
    var id_schedule = $("#id_schedule").val();
    $.ajax({
      type: 'POST',
      url: "<?php echo base_url() . 'Qa_end_line/json_jumlah_qty_cek/' . $line . '/'; ?>" + id_schedule + "/<?= date("Y-m-d"); ?>",
      dataType: "JSON",
      data: {},
      success: function(response) {
        qty_checking = response.jumlah_qty_cek;
        document.getElementById("jml_ceck").innerHTML = qty_checking;
        hitung_persen_defect();
      }
    });


  }

  function refresh_sum_defect() {
    var id_schedule = $("#id_schedule").val();
    $.ajax({
      type: 'POST',
      url: "<?php echo base_url() . 'Qa_end_line/json_jumlah_qty_defect/' . $line . '/'; ?>" + id_schedule,
      dataType: "JSON",
      data: {},
      success: function(response) {
        //alert(response);
        document.getElementById("jml_defect").innerHTML = response.jumlah;
        qty_defect = response.jumlah;
        hitung_persen_defect();
      }
    });
    // hitung_persen_defect();
  }

  function refresh_hasil_output_packing() {
    var id_schedule = $("#id_schedule").val();
    $.ajax({
      type: 'POST',
      url: "<?php echo base_url() . 'Qa_end_line/json_hasil_output_packing/' . $line . '/'; ?>" + id_schedule,
      dataType: "JSON",
      data: {},
      success: function(response) {
        //alert(response);
        document.getElementById("jml_qty").innerHTML = response.total_output_packing;


      }
    });
  }

  function refresh_hasil_output_hd() {
    var id_schedule = $("#id_schedule").val();

    $.ajax({
      type: 'POST',
      url: "<?php echo base_url() . 'Qa_end_line/json_hasil_output_hd/' . $line . '/'; ?>" + id_schedule,
      dataType: "JSON",
      data: {},
      success: function(response) {
        //alert(response);
        document.getElementById("jml_qty_hd").innerHTML = response.total_output_hd;

      }
    });
  }

  async function call_refresh_all() {
    await refresh_hasil_output_packing();
    // await refresh_hasil_output_hd();
    await refresh_qty_cek();
    await refresh_sum_defect();

    // await hitung_persen_defect();
    // await total_output_perline();

  }


  function hitung_persen_defect() {
    var persen_defect = 0;
    if (qty_checking > 0) {
      persen_defect = qty_defect / (qty_checking+qty_defect) * 100;
      // persen_defect = Math.round(persen_defect * 100) / 100;
      // persen_defect = Math.floor(persen_defect);
    }
    document.getElementById("jml_persen").innerHTML = persen_defect.toFixed(1) + ' %';
    if (persen_defect >= 50) {
      document.getElementById("button_status").style.backgroundColor = "red";
    } else if (persen_defect >= 31) {
      document.getElementById("button_status").style.backgroundColor = "#FC0";
    } else if (persen_defect < 31) {
      document.getElementById("button_status").style.backgroundColor = "green";
    } else {
      document.getElementById("button_status").style.backgroundColor = "#CCC";
    }
  }



  function list_data_defect() {
    call_sp_grid_summary_hasil_inspect_bags_defect_list_version1();

  }




  function call_sp_grid_summary_hasil_inspect_bags_defect_list_version1() {
    // alert(2);
    var table = document.getElementById("Table_summary");
    var id_schedule = $("#id_schedule").val();
    $.ajax({
      type: 'POST',
      url: "<?php echo base_url() . 'Qa_end_line/sp_grid_summary_hasil_inspect_bags_defect_list_version1/' . $line . '/'; ?>" + id_schedule,
      dataType: "JSON",
      data: {

      },
      success: function(response) {
        //var cell = table.rows[1].cells[1];
        //table.rows[0].cells[0].innerHTML = response[0].qty_checking;
        document.getElementById("jml_ceck").innerHTML = response[0].qty_checking;
        document.getElementById("jml_defect").innerHTML = response[0].qty_defect;
        document.getElementById("jml_persen").innerHTML = response[0].persen_defect.toFixed(1) + ' % ';

        //


        document.getElementById("jml_qty").innerHTML = response[0].total_qty;
        document.getElementById("jml_qty_hd").innerHTML = response[0].total_qty_hd;
        if (response[0].persen_defect >= 50) {
          document.getElementById("button_status").style.backgroundColor = "red";
        } else if (response[0].persen_defect >= 31) {
          document.getElementById("button_status").style.backgroundColor = "#FC0";
        } else if (response[0].persen_defect < 31) {
          document.getElementById("button_status").style.backgroundColor = "green";
        } else {
          document.getElementById("button_status").style.backgroundColor = "#CCC";
        }

      }
    });


    /*
   $.ajax({
      type: 'POST',
      url: "<?php echo base_url() . 'Qa_end_line/sp_grid_summary_perdefect_hasil_inspect_bags_defect_list_version1/' . $line . '/' . $id_schedule   ?>",
      dataType: "JSON",
      data: {
      
      },
      success: function(response) {
   
       renderTable_summary(response , "tabel_summary_defect_list" );

      }
    });
*/

  }



  function refresh_defect_table() {
    var id_schedule = $("#id_schedule").val();
    $.ajax({
      type: 'POST',
      url: "<?php echo base_url() . 'Qa_end_line/sp_grid_summary_perdefect_hasil_inspect_bags_defect_list_version1/' . $line . '/'; ?>" + id_schedule,
      dataType: "JSON",
      data: {

      },
      success: function(response) {

        renderTable_summary(response, "tabel_summary_defect_list");

      }
    });
  }

  /* function renderTable(data, nama_tabel) {
    var tableBody = document.getElementById(nama_tabel);
    var rows = "<thead style='position: sticky; top: 0; background-color: #fff; z-index: 1; '> <tr> <th>Jenis</th> <th>Kode</th> <th>Keterangan</th> <th>Time Stamp</th></tr></thead>";

    // Looping untuk setiap baris data
    for (var i = 0; i < data.length; i++) {
      rows += "<tr>";
      rows += "<td>" + data[i].jenis + "</td>";
      rows += "<td>" + data[i].kode + "</td>";
      rows += "<td>" + data[i].keterangan + "</td>";
      rows += "<td>" + data[i].time_stamp + "</td>";
      rows += "</tr>";
    }

    // Menambahkan baris data ke dalam tabel
    tableBody.innerHTML = rows;
  } */



  function renderTable_summary(data, nama_tabel) {
    // alert();
    var tableBody = document.getElementById(nama_tabel);
    //var rows = "<thead style='position: sticky; top: 0; background-color: #fff; z-index: 1; '> <tr> <th>KODE DEFECT</th> <th>KETERANGAN</th> <th>JUMLAH DEFECT</th> <th> PERSENTASE </th> </tr></thead>";
    var rows = '<tbody><tr><td width="7%" style="text-align:center;"><strong>KODE</strong></td><td width="54%"><strong>KETERANGAN</strong></td><td width="22%"><strong>JUMLAH</strong></td><td width="17%"><strong>PRESENTASE</strong></td></tr></tbody>';


    // Looping untuk setiap baris data
    for (var i = 0; i < data.length; i++) {
      rows += "<tr>";
      rows += "<td>" + data[i].kode_defect + "</td>";
      rows += "<td>" + data[i].keterangan + "</td>";
      rows += "<td>" + data[i].jumlah_defect + "</td>";
      rows += "<td>" + data[i].persen_defect + " %</td>";
      rows += "</tr>";
    }

    // Menambahkan baris data ke dalam tabel
    tableBody.innerHTML = rows;
  }

  function total_output_perline() {
    /* $.ajax({
      type: 'POST',
      url: "<?php echo base_url() . 'Qa_end_line/hasil_qa_perjam/' . $line  ?>",
      dataType: "JSON",
      data: {

      },
      success: function(response) {
        renderTable_total_output_perline(response, "tabel_summary_hasil_qa_perjam");
      }
    }); */
    // alert("<?php echo base_url() . 'api/hasillinejam'; ?>?tanggal=<?= date("Y-m-d"); ?>&line_sewing=<?= $line; ?>&id_schedule=<?= $id_schedule; ?>");
    var id_schedule = $("#id_schedule").val();
    $.get("<?php echo base_url() . 'api/hasillinejam'; ?>", {
        tanggal: '<?= date("Y-m-d"); ?>',
        line_sewing: '<?= $line; ?>',
        id_schedule: id_schedule,
        kanaan_po: '<?= $kanaan_po; ?>',
        style: '<?= $style_no; ?>'
      })
      .done(function(data) {
        $("#tabel_summary_hasil_qa_perjam").html(data);
      });
  }

  /* function total_output_perline() {
    let color = $("#color").val();
    let size = $("#size").val();
    let KANAAN_PO = '<?= $_GET["KANAAN_PO"]; ?>';
    let STYLE_NO = '<?= $_GET["STYLE_NO"]; ?>';
    let tanggal = '<?= date("Y-m-d"); ?>';
    // alert(STYLE_NO);
    $.get("<?php echo base_url() . 'Qa_end_line/qtyperjam'  ?>", {
        line: '<?= $line; ?>',
        color: color,
        size: size,
        KANAAN_PO: KANAAN_PO,
        STYLE_NO: STYLE_NO,
        tanggal:tanggal
      })
      .done(function(response) {
        // alert(response);
        // renderTable_total_output_perline(response, "tabel_summary_hasil_qa_perjam");
        $("#tabel_summary_hasil_qa_perjam").html(response);
      });
  } */
  function generateRandomNumber(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
  }

  function renderTable_total_output_perline(data, nama_tabel) {
    // var randomNumber = generateRandomNumber(1, 100); 
    // $('#test1').text(randomNumber);
    var tableBody = document.getElementById(nama_tabel);
    var rows = "<thead>";

    // Looping untuk setiap baris data
    for (var i = 0; i < data.length; i++) {
      rows += "<thead><tr>";
      rows += "<td class='f30'><strong>TARGET TIME</strong></td>";

      rows += "<td class='f30'><strong> RESULT</strong></td>";
      rows += "</tr><thead>";
      rows += "<tr>";
      rows += "<td class='f30'><strong>TIME 1</strong></td>";

      rows += "<td class='f30'>" + data[i].JAM_1 + "</td>";
      rows += "</tr>";
      rows += "<tr>";
      rows += "<td class='f30'><strong>TIME 2</strong></td>"

      rows += "<td class='f30'>" + data[i].JAM_2 + "</td>";
      rows += "</tr>";
      rows += "<tr>";
      rows += "<td class='f30'><strong>TIME 3</strong></td>"

      rows += "<td class='f30'>" + data[i].JAM_3 + "</td>";
      rows += "</tr>";
      rows += "<tr>";
      rows += "<td class='f30'><strong>TIME 4</strong></td>"

      rows += "<td class='f30'>" + data[i].JAM_4 + "</td>";
      rows += "</tr>";
      rows += "<tr>";
      rows += "<td class='f30'><strong>TIME 5</strong></td>"

      rows += "<td class='f30'>" + data[i].JAM_5 + "</td>";
      rows += "</tr>";
      rows += "<tr>";
      rows += "<td class='f30'><strong>TIME 6</strong></td>"

      rows += "<td class='f30'>" + data[i].JAM_6 + "</td>";
      rows += "</tr>";
      rows += "<tr>";
      rows += "<td class='f30'><strong>TIME 7</strong></td>"

      rows += "<td class='f30'>" + data[i].JAM_7 + "</td>";
      rows += "</tr>";
      rows += "<tr>";
      rows += "<td class='f30'><strong>TIME 8</strong></td>"

      rows += "<td class='f30'>" + data[i].JAM_8 + "</td>";
      rows += "</tr>";
      rows += "<tr>";
      rows += "<td class='f30'><strong>TIME 9</strong></td>"

      rows += "<td class='f30'>" + data[i].JAM_9 + "</td>";
      rows += "</tr>";
      rows += "<tr>";
      rows += "<td class='f30'><strong>TIME 10</strong></td>"

      rows += "<td class='f30'>" + data[i].JAM_10 + "</td>";
      rows += "</tr>";
      rows += "<tr>";
      rows += "<td class='f30'><strong>TIME 11</strong></td>"

      rows += "<td class='f30'>" + data[i].JAM_11 + "</td>";
      rows += "</tr>";;
      rows += "<tr>"
      rows += "<td class='f30'><strong>TIME 12</strong></td>"
      rows += "<td class='f30'>" + data[i].JAM_12 + "</td>";
      rows += "</tr>";
      rows += "<tr>";
      rows += "<td class='f30'><strong>TIME 13</strong></td>"
      rows += "<td class='f30'>" + data[i].JAM_13 + "</td>";
      rows += "</tr>";
      rows += "<tr>";
      rows += "<td class='f30'><strong>TIME 14</strong></td>"

      rows += "<td class='f30'>" + data[i].JAM_14 + "</td>";
      rows += "</tr>";
      rows += "<tr>";
      rows += "<td class='f30'><strong>TIME 15</strong></td>"

      rows += "<td class='f30'>" + data[i].JAM_15 + "</td>";
      rows += "</tr>";
      rows += "<tr>";
      rows += "<td class='f30'><strong>TIME 16</strong></td>"

      rows += "<td class='f30'>" + data[i].JAM_16 + "</td>";
      rows += "</tr>";
      rows += "<tr>";
      rows += "<td class='f30'><strong>TOTAL</strong></td>"

      rows += "<td class='f30'>" + data[i].TOTAL_AKHIR + "</td>";
      rows += "</tr>";
    }

    // Menambahkan baris data ke dalam tabel
    tableBody.innerHTML = rows;
  }
</script>

<script>
  // let textbox = document.querySelector('.textbox');
  var textbox1 = document.getElementById("textbox1");

  function insert1(char) {
    textbox1.value += char;
  }

  function calculate1() {
    try {
      textbox1.value = eval(textbox1.value);
    } catch (err) {
      textbox1.value = 'Error';
    }
  }

  function kosongkan1() {
    try {
      textbox1.value = "";
    } catch (err) {
      textbox1.value = 'Error';
    }
  }


  var textbox2 = document.getElementById("textbox2");

  function insert2(char) {
    textbox2.value += char;
  }

  function calculate2() {
    try {
      textbox2.value = eval(textbox2.value);
    } catch (err) {
      textbox2.value = 'Error';
    }
  }

  function kosongkan2() {
    try {
      textbox2.value = "";
    } catch (err) {
      textbox2.value = 'Error';
    }
  }


  var textbox3 = document.getElementById("textbox3");

  function insert3(char) {
    textbox3.value += char;
  }

  function calculate3() {
    try {
      textbox3.value = eval(textbox3.value);
    } catch (err) {
      textbox3.value = 'Error';
    }
  }

  function kosongkan3() {
    try {
      textbox3.value = "";
    } catch (err) {
      textbox3.value = 'Error';
    }
  }


  function ok_final() {
    var qty = $("#textbox2").val();
    var target = $("#target").val();
    target = target*2;
    var id_schedule = $("#id_schedule").val();

    if (qty > target) {
      alert('Gagal disimpan. Cek kembali Qty Output. ');
    } else {
      $.ajax({
        type: 'POST',
        url: "<?php echo base_url() . 'Qa_end_line/hasil_inspect_bags_defect_list_version1_final_result_action/' . $line . '/'; ?>" + id_schedule,
        dataType: "JSON",
        data: {
          qty: qty,
        },
        success: function(response) {
          document.getElementById('textbox2').value = "";
          // list_data_defect();
          refresh_hasil_output_packing();
          total_output_perline();


          if (response.status === "1") {
            $("#success-alert-final-ok").fadeTo(1000, 300).slideUp(300, function() {
              $("#success-alert-final-ok").slideUp(300);
            });
          } else if (response.status === "5") {
            alert('Cek Kembali Schedule Produksi');
          } else {
            alert('Cek Kembali Schedule Produksi');
          }





        }
      });
    }
  }





  function ok_final_hd() {
    var qty = $("#textbox3").val();

    var target = $("#target").val();
    target = target*2;
    var id_schedule = $("#id_schedule").val();

    if (qty_checking === 0) {
      alert('Gagal disimpan. Checking belum di lakukan.! ');
    } else if (qty > target) {
      alert('Gagal disimpan. Cek kembali Qty Output. ');
    } else {
      $.ajax({
        type: 'POST',
        url: "<?php echo base_url() . 'Qa_end_line/hasil_inspect_bags_defect_list_version1_output_hd_action/' . $line . '/'; ?>" + id_schedule,
        dataType: "JSON",
        data: {
          qty: qty,
        },
        success: function(response) {
          document.getElementById('textbox3').value = "";
          // list_data_defect();
          refresh_hasil_output_hd();
          total_output_perline();


          if (response.status === "1") {
            $("#success-alert-final-hd-ok").fadeTo(1000, 300).slideUp(300, function() {
              $("#success-alert-final-hd-ok").slideUp(300);
            });
          } else if (response.status === "5") {
            alert('Cek Kembali Schedule Produksi');
          } else {
            alert('Cek Kembali Schedule Produksi');
          }





        }
      });
    }
  }

  function top5defect(kodenya) {
    $("#textbox1").val(kodenya);
    ok_defect();
    $("#textbox1").val("");
  }

  function cekcolorsize() {
    var color = $("#color").val();
    var size = $("#size").val();
    if (color == "") {
      alert("Silahkan isi color!");
    } else if (size == "") {
      alert("Silahkan isi size!");
    } else {
      cekidn();
    }
  }

  function cekidn() {
    var color = $("#color").val();
    var size = $("#size").val();
    $.ajax({
      type: 'POST',
      url: "<?php echo base_url() . 'Qa_end_line/cekidn/' . $line . '/'; ?>",
      dataType: "JSON",
      data: {
        color: color,
        size: size,
        KANAAN_PO: '<?= $_GET["KANAAN_PO"]; ?>',
        STYLE_NO: '<?= $_GET["STYLE_NO"]; ?>'
      },
      success: function(response) {
        $("#qtyorder").html(response.qtyorder);
        $("#target100").html(response.target100);
        $("#target").val(response.target100);
        $("#des").html(response.des);
        rubah_id_schedule(response.id_schedule);
        total_output_perline();
      }
    });
  }

  function ok_defect() {
    if (cekid != "") {


      var kodeDefect = $("#textbox1").val();
      var id_schedule = $("#id_schedule").val();
      var color = $("#color").val();
      var size = $("#size").val();
      if (kodeDefect == "") {
        alert("Kode belum diisi!");
      } else if (color == "") {
        alert("Color belum diisi!");
      } else if (size == "") {
        alert("Size belum diisi!");
      } else {
        $.ajax({
          type: 'POST',
          url: "<?php echo base_url() . 'Qa_end_line/hasil_inspect_bags_defect_list_version1_action/' . $line . '/'; ?>" + id_schedule,
          dataType: "JSON",
          data: {
            kode_defect: kodeDefect,
            uuid: cekid,
            color: color,
            size: size,
            KANAAN_PO: '<?= $_GET["KANAAN_PO"]; ?>',
            STYLE_NO: '<?= $_GET["STYLE_NO"]; ?>'
          },
          success: function(response) {
            //alert(response);
            // alert(response.id_schedule);
            rubah_id_schedule(response.id_schedule);
            total_output_perline();
            // list_data_defect();
            // refresh_sum_defect();
            rubah5defect();



            if (response.status === "1") {
              $("#success-alert-defect-ok").fadeTo(1000, 300).slideUp(300, function() {
                $("#success-alert-defect-ok").slideUp(300);
              });
            } else if (response.status === "0") {
              $("#danger-alert-inspect-no").fadeTo(1000, 300).slideUp(300, function() {
                $("#danger-alert-inspect-no").slideUp(300);
              });
            } else if (response.status === "5") {
              alert('Cek Kembali Schedule Produksi.');
            } else {
              alert('Cek Kembali Schedule Produksi.');
            }
            document.getElementById('textbox1').value = "";




          }
        });
      }
    } else {
      alert(' start chek dulu');

    }
  }


  function oke_inspect() {

    getuuid();
    var kodeDefect = $("#textbox1").val();
    var color = $("#color").val();
    var size = $("#size").val();
    // alert('<?php echo base_url() . 'Qa_end_line/hasil_inspect_bags_defect_list_version1_action/' . $line; ?>');
    if (color == "") {
      alert("Color belum diisi!");
    } else if (size == "") {
      alert("Size belum diisi!");
    } else {
      // alert('<?php echo base_url() . 'Qa_end_line/hasil_inspect_bags_defect_list_version1_action/' . $line; ?>?kode_defect=OK&uuid='+cekid+'&qty=1&color='+color+'&size='+size+'&KANAAN_PO=<?= $_GET["KANAAN_PO"]; ?>&STYLE_NO=<?= $_GET["STYLE_NO"]; ?>');
       /* url: "<?php echo base_url() . 'Qa_end_line/hasil_inspect_bags_defect_list_version1_action/' . $line . '/' . $id_schedule  ?>", */
      $.ajax({
        type: 'POST',
       
        url: "<?php echo base_url() . 'Qa_end_line/hasil_inspect_bags_defect_list_version1_action/' . $line; ?>",
        dataType: "JSON",
        data: {
          kode_defect: "OK",
          uuid: cekid,
          qty: 1,
          color: color,
          size: size,
          KANAAN_PO: '<?= $_GET["KANAAN_PO"]; ?>',
          STYLE_NO: '<?= $_GET["STYLE_NO"]; ?>'
        },
        success: function(response) {
          // alert(response.id_schedule);
          rubah_id_schedule(response.id_schedule);
          total_output_perline();
          //list_data_defect();
          // refresh_qty_cek();

          // refresh_hasil_output_packing();



          if (response.status == "2") {
            $("#success-alert-inspect-ok_").fadeTo(1000, 300).slideUp(300, function() {
              $("#success-alert-inspect-ok_").slideUp(300);
            });
          } else if (response.status == "0") {
            $("#danger-alert-inspect-no").fadeTo(1000, 300).slideUp(300, function() {
              $("#danger-alert-inspect-no").slideUp(300);
            });
          } else if (response.status === "5") {
            alert('Cek Kembali Schedule Produksi');
          } else {
            alert('Cek Kembali Schedule Produksi');
          }


        }


      });
    }

  }
</script>

<script>
  // fungsi untuk membuka konten tab saat tombol tab diklik
  function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
  }
</script>

<script>
  function rubah_id_schedule(id_schedule) {
    $("#id_schedule").val(id_schedule);
    $("#href1").attr("href", "<?php echo base_url(); ?>Qa_end_line/display_inspect/<?php echo $line; ?>/" + id_schedule);
    call_refresh_all();
  }
</script>