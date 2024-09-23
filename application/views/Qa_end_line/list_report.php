<?php
$tanggal = date("Y-m-d");
if (isset($_GET["date1"])) {
  $tanggal = $_GET["date1"];
}
?>
<div class="col-xs-12 col-sm-12 col-md-12">
  <div style="float:right; margin-top:-45px; margin-right:-15px;">
    <a href="#info" data-toggle="modal" id="edit"><button type="button" class="btn btn-block btn-info"> <i class="fa fa-exclamation-circle"></i> Info</button></a>
  </div>
</div>

<div class="modal fade" id="info" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-admin" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> INFO </h4>
      </div>
      <div class="modal-body">
        <div class="fetched-data">

          <!-- Background Hijau : Defect Rate lebih kecil dari 31%.<br />
          Background Kuning : Defect Rate lebih besar dari 30% s/d 49%. <br />
          Background Merah : Defect Rate lebih besar dari atau sama dengan 50%.<br />
          Kotak Warna Hitam dengan tulisan berkedip menandakan Qty check kurang. <br /> -->


          Background Hijau : Defect Rate lebih kecil dari 5%.<br />
          Background Kuning : Defect Rate lebih besar dari 5% s/d 7%. <br />
          Background Merah : Defect Rate lebih besar dari atau sama dengan 8%.<br />
          Kotak Warna Hitam dengan tulisan berkedip menandakan Qty check kurang. <br />
        </div>
        <hr />

        Gambar Hand Detector : Qty Packing lebih besar dari pada Qty HD <br />
        Gambar Kardus : Qty Packing kurang dari Qty HD (dengan toleran 10 pcs) <br />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
      </div>
    </div>
  </div>
</div>



<div id="page_open"></div>

<script language="javascript">
  $('#page_open').load('<?php echo base_url() . 'Qa_end_line_dashboard/list_report_detail?date1=' . $tanggal; ?>');
</script>

<script language="javascript">
  $(document).ready(function() {
    setInterval(function() {
      $('#page_open').load('<?php echo base_url() . 'Qa_end_line_dashboard/list_report_detail?date1=' . $tanggal; ?>');
    }, 10000);
  });
</script>

<!-- Modal -->
<div class="modal fade" id="myModal">

  <div class="modal-dialog" style="width:98%;">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="judul_modal">DAFTAR DEFECT </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-bodyc">

        <div class="col-xs-12 col-sm-12 col-md-5">
          <br />
          <div align="center"><strong>DEFECT LIST</strong></div>
          <hr />
          <table class="table table-striped table-bordered" id="tabel_summary_defect_list" style="width:100%;"></table>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-7">
          <br />
          <div align="center"><strong>PRODUCTION RESULT</strong> </div>
          <hr />
          <table class="table table-striped table-bordered" id="tabel_summary_hasil_qa_perjam"></table>
        </div>

      </div>

      <div class="col-xs-12 col-sm-12 col-md-12">
        <button type="button" class="btn btn-success btn-sm" id="show_buttom" onclick="btn_show()"> <i class="fa fa-plus"> </i> SHOW DETAIL DEFECT PER JAM </button>
        <button type="button" class="btn btn-danger btn-sm" id="hide_buttom" onclick="btn_hide()"> <i class="fa fa-minus"> </i> HIDE DETAIL DEFECT PER JAM </button>
      </div>

      <div class="col-xs-12 col-sm-12 col-md-12" id="list_defect_perjam">
        <br />
        <div style="overflow-x:auto;">
          <table class="table table-striped table-bordered" id="tabel_summary_defect_perjam"></table>
        </div>
      </div>



      <div class="col-xs-12 col-sm-12 col-md-12">
        <hr />

        <div id="display"></div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>






<script>
  $("#hide_buttom").hide();
  $("#list_defect_perjam").hide();

  function btn_show() {
    $("#hide_buttom").show();
    $("#show_buttom").hide();
    $("#list_defect_perjam").show();
  }


  function btn_hide() {
    $("#hide_buttom").hide();
    $("#show_buttom").show();
    $("#list_defect_perjam").hide();
  }





  function openModal(lines) {
    // alert("<?php echo base_url() . 'Qa_end_line_dashboard/sp_dashboard_Qa_end_line_all_line_detail_defect_per_line/' ?>" + lines  +"?date1=<?= $tanggal; ?>");
    var modal = document.getElementById("myModal");
    modal.style.display = "block";
    document.getElementById("judul_modal").innerHTML = "DAFTAR DEFECT LINE : " + lines;
    $.ajax({
      type: 'POST',
      url: "<?php echo base_url() . 'Qa_end_line_dashboard/sp_dashboard_Qa_end_line_all_line_detail_defect_per_line/' ?>" + lines + "?date1=<?= $tanggal; ?>",
      dataType: "JSON",
      data: {},
      success: function(response) {
        renderTable_summary(response, "tabel_summary_defect_list");
        total_output_perline(lines);
        defect_perjam(lines);
        // alert('<?php echo base_url() . '/Qa_end_line/display_inspect_dasbord/' ?>' + lines + '?date1=<?= $tanggal; ?>');
        $('#display').load('<?php echo base_url() . '/Qa_end_line/display_inspect_dasbord/' ?>' + lines + '?date1=<?= $tanggal; ?>');
      }
    });



  }


  function closeModal() {
    var modal = document.getElementById("myModal");
    modal.style.display = "none";
  }


  function renderTable_summary(data, nama_tabel) {
    var tableBody = document.getElementById(nama_tabel);
    //var rows = "<thead style='position: sticky; top: 0; background-color: #fff; z-index: 1; '> <tr> <th>KODE DEFECT</th> <th>KETERANGAN</th> <th>JUMLAH DEFECT</th> <th> PERSENTASE </th> </tr></thead>";
    var rows = '<tbody><tr><td width="7%" style="text-align:center;"><strong>CODE</strong></td><td width="54%"><strong>INFORMATION</strong></td><td width="22%"><strong>AMOUNT</strong></td><td width="17%"><strong>PERCENTAGE</strong></td></tr></tbody>';

    // alert(data.length);
    // Looping untuk setiap baris data
    for (var key in data) {
      if (data.hasOwnProperty(key)) {
        rows += "<tr>";
        rows += "<td>" + data[key].kode_defect + "</td>";
        rows += "<td>" + data[key].keterangan + "</td>";
        rows += "<td>" + data[key].jumlah_defect + "</td>";
        rows += "<td>" + data[key].persen_defect.toFixed(1) + " %</td>";
        rows += "</tr>";
      }
    }

    // Menambahkan baris data ke dalam tabel
    tableBody.innerHTML = rows;
  }






  function total_output_perline(lines) {
    $.ajax({
      type: 'POST',
      url: "<?php echo base_url() . 'Qa_end_line_dashboard/hasil_output_perjam/' ?>" + lines + "?date1=<?= $tanggal; ?>",
      dataType: "JSON",
      data: {

      },
      success: function(response) {
        renderTable_total_output_perline(response, "tabel_summary_hasil_qa_perjam");
      }
    });
  }

  function renderTable_total_output_perline(data, nama_tabel) {
    console.log(data);
    console.log(data[0]);
    var tableBody = document.getElementById(nama_tabel);
    var rows = "<tbody>";

    // Looping untuk setiap baris data

    rows += "<tr>";
    rows += "<th width='10%'><strong>TIME</strong> </th>";
    rows += "<th width='12%'><strong>OUTPUT <BR> QA</strong></th>";
    rows += "<th width='12%'><strong>OUTPUT <BR> IRONING</strong></th>";
    rows += "<th width='12%'><strong>OUTPUT <BR>  PACKING</strong></th>";
    rows += "<th width='10%'><strong>TIME</strong> </th>";
    rows += "<th width='12%'><strong>OUTPUT <BR> QA</strong></th>";
    rows += "<th width='12%'><strong>OUTPUT <BR> IRONING</strong></th>";
    rows += "<th width='12%'><strong>OUTPUT <BR>  PACKING</strong></th>";
    rows += "</tr>";
    var totalQa = 0;
    var totalIroning = 0;
    var totalPacking = 0;
    for (var i = 0; i < 9; i++) {

      rows += "<tr>";
      rows += "<td><strong>TIME " + (i + 1) + "</strong> </td>";
      totalQa = data[0]['JAM_' + (i + 1).toString()] + data[0]['JAM_' + (i + 9).toString()];
      rows += "<td><strong>" + data[0]['JAM_' + (i + 1).toString()] + " </strong> </td>";
      rows += "<td><strong>" + data[0]['JAM_IRON_' + (i + 1)] + " </strong> </td>";
      rows += "<td><strong>" + data[0]['JAM_PACK_' + (i + 1)] + " </strong> </td>";
      rows += "<td><strong>TIME " + (i + 9) + "</strong> </td>";
      rows += "<td><strong>" + data[0]['JAM_' + (i + 9)] + " </strong> </td>";
      rows += "<td><strong>" + data[0]['JAM_IRON_' + (i + 9)] + " </strong> </td>";
      rows += "<td><strong>" + data[0]['JAM_PACK_' + (i + 9)] + " </strong> </td>";
      rows += "</tr>";
    }
    rows += "<tr>";
    rows += "<td colspan=5><strong>TOTAL </strong> </td>";
    rows += "<td ><strong> " + data[0]['TOTAL_AKHIR'] + " </strong> </td>";
    rows += "<td ><strong> " + data[0]['TOTAL_AKHIR_IRON'] + " </strong> </td>";
    rows += "<td ><strong> " + data[0]['TOTAL_AKHIR_PACKING'] + " </strong> </td>";
    rows += "</tr>";




    // Menambahkan baris data ke dalam tabel
    tableBody.innerHTML = rows;
  }




  function defect_perjam(lines) {
    $.ajax({
      type: 'POST',
      url: "<?php echo base_url() . 'Qa_end_line/hasil_defect_perjam1/' ?>" + lines + "?date1=<?= $tanggal; ?>",
      dataType: "JSON",
      data: {

      },
      success: function(response) {
        renderTable_total_defect_perjam(response, "tabel_summary_defect_perjam");
      }
    });
  }

  function renderTable_total_defect_perjam(data, nama_tabel) {
    var tableBody = document.getElementById(nama_tabel);
    var rows = "";
    rows += '<tr>';
    rows += '<td align="center" width="3%"><b>No</b></td>';
    rows += '<td align="center" width="13%"><b>Type</b></td>';
    rows += '<td align="center" width="6%"><b>Code</b></td>';
    rows += '<td align="center" width="25%"><b>Information</b></td>';
    rows += '<td align="center" width="3%"><b>TIME 1</b></td>';
    rows += '<td align="center" width="3%"><b>TIME 2</b></td>';
    rows += '<td align="center" width="3%"><b>TIME 3</b></td>';
    rows += '<td align="center" width="3%"><b>TIME 4</b></td>';
    rows += '<td align="center" width="3%"><b>TIME 5</b></td>';
    rows += '<td align="center" width="3%"><b>TIME 6</b></td>';
    rows += '<td align="center" width="3%"><b>TIME 7</b></td>';
    rows += '<td align="center" width="3%"><b>TIME 8</b></td>';
    rows += '<td align="center" width="3%"><b>TIME 9</b></td>';
    rows += '<td align="center" width="3%"><b>TIME 10</b></td>';
    rows += '<td align="center" width="3%"><b>TIME 11</b></td>';
    rows += '<td align="center" width="3%"><b>TIME 12</b></td>';
    rows += '<td align="center" width="3%"><b>TIME 13</b></td>';
    rows += '<td align="center" width="3%"><b>TIME 14</b></td>';
    rows += '<td align="center" width="3%"><b>TIME 15</b></td>';
    rows += '<td align="center" width="3%"><b>TIME 16</b></td>';
    rows += '<td align="center" width="5%"><b>TOTAL</b></td>';
    rows += '</tr>';

    var no = 0;
    for (var i = 0; i < data.length; i++) {
      no++;
      rows += '<tr>';
      rows += '<td>' + no + '</td>';
      rows += '<td>' + data[i].jenis + '</td>';
      rows += '<td>' + data[i].kode + '</td>';
      rows += '<td>' + data[i].keterangan + '</td>';
      rows += '<td>' + data[i].JAM_1 + '</td>';
      rows += '<td>' + data[i].JAM_2 + '</td>';
      rows += '<td>' + data[i].JAM_3 + '</td>';
      rows += '<td>' + data[i].JAM_4 + '</td>';
      rows += '<td>' + data[i].JAM_5 + '</td>';
      rows += '<td>' + data[i].JAM_6 + '</td>';
      rows += '<td>' + data[i].JAM_7 + '</td>';
      rows += '<td>' + data[i].JAM_8 + '</td>';
      rows += '<td>' + data[i].JAM_9 + '</td>';
      rows += '<td>' + data[i].JAM_10 + '</td>';
      rows += '<td>' + data[i].JAM_11 + '</td>';
      rows += '<td>' + data[i].JAM_12 + '</td>';
      rows += '<td>' + data[i].JAM_13 + '</td>';
      rows += '<td>' + data[i].JAM_14 + '</td>';
      rows += '<td>' + data[i].JAM_15 + '</td>';
      rows += '<td>' + data[i].JAM_16 + '</td>';
      rows += '<td>' + data[i].TOTAL_AKHIR + '</td>';
      rows += '</tr>';
    }

    tableBody.innerHTML = rows;
  }
</script>