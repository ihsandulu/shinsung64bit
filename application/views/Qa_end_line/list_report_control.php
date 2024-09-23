<div id="page_open"></div>

<script language="javascript">
$('#page_open').load('<?php echo base_url().'Qa_end_line_dashboard/list_report_detail_control'?>');
</script>

<script language="javascript">
$(document).ready(function(){
      setInterval(function(){
        $('#page_open').load('<?php  echo base_url().'Qa_end_line_dashboard/list_report_detail_control'?>');
      },7000); });	  
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
   
          <div class="col-xs-12 col-sm-12 col-md-6">
          <br/>
          <div align="center"><strong>DAFTAR DEFECT</strong></div>
          <hr/>
          <table class="table table-striped table-bordered" id="tabel_summary_defect_list" style="width:100%;"></table>
          </div>
        
          <div class="col-xs-12 col-sm-12 col-md-6">
          <br/>
          <div align="center"><strong>HASIL PRODUKSI</strong> </div>
          <hr/>
          <table class="table table-striped table-bordered" id="tabel_summary_hasil_qa_perjam"></table>
          </div>
        
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
        <hr/>
        <div align="center"><strong>DISPLAY INSPECT</strong></div>
        <hr/>
        <div id="display"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>






<script>
   function openModal(lines) {
  var modal = document.getElementById("myModal");
  modal.style.display = "block";
  document.getElementById("judul_modal").innerHTML = "DAFTAR DEFECT LINE : " + lines;


     $.ajax({
      type: 'POST',
      url: "<?php echo base_url().'Qa_end_line_dashboard/sp_dashboard_Qa_end_line_all_line_detail_defect_per_line/'?>" + lines  ,
      dataType: "JSON",
      data: {
      
      },
      success: function(response) {
   
       renderTable_summary(response , "tabel_summary_defect_list" );
		total_output_perline(lines);
		
		$('#display').load('<?php echo base_url().'/Qa_end_line/display_inspect_dasbord/'?>' + lines);
		
      }
    });



}


function closeModal() {
  var modal = document.getElementById("myModal");
  modal.style.display = "none";
}


function renderTable_summary(data , nama_tabel) {
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






function total_output_perline(lines)
{
    $.ajax({
      type: 'POST',
      url: "<?php echo base_url().'Qa_end_line/hasil_qa_perjam/' ?>"+ lines ,
      dataType: "JSON",
      data: {
      
      },
      success: function(response) { 
       renderTable_total_output_perline(response , "tabel_summary_hasil_qa_perjam" );
      }
    });
}

function renderTable_total_output_perline(data , nama_tabel) {
  var tableBody = document.getElementById(nama_tabel);
  var rows = "<tbody>";
   
  // Looping untuk setiap baris data
  for (var i = 0; i < data.length; i++) {
   rows += "<tr>";
    rows += "<th width='25%'><strong>JAM TARGET</strong> </th>";
    rows += "<th width='25%'><strong>HASIL</strong></th>";
    rows += "<th width='25%'><strong>JAM TARGET</strong> </th>";
    rows += "<th width='25%'><strong>HASIL</strong></th>";
  rows += "</tr>";
  rows += "</tbody>";

  rows += "<tr>";
    rows += "<td width='25%'>JAM 1</td>";
    rows += "<td width='25%'>" + data[i].JAM_1 + "</td>";
    rows += "<td width='25%'>JAM 9</td>";
    rows += "<td width='25%'>" + data[i].JAM_9 + "</td>";
  rows += "</tr>";
  rows += "<tr>";
    rows += "<td>JAM 2</td>";
    rows += "<td>" + data[i].JAM_2 + "</td>";
    rows += "<td>JAM 10</td>";
    rows += "<td>" + data[i].JAM_10 + "</td>";
  rows += "</tr>";
  rows += "<tr>";
    rows += "<td>JAM 3</td>";
    rows += "<td>" + data[i].JAM_3 + "</td>";
    rows += "<td>JAM 11</td>";
    rows += "<td>" + data[i].JAM_11 + "</td>";
  rows += "</tr>";
  rows += "<tr>";
    rows += "<td>JAM 4</td>";
    rows += "<td>" + data[i].JAM_4 + "</td>";
    rows += "<td>JAM 12</td>";
    rows += "<td>" + data[i].JAM_12 + "</td>";
  rows += "</tr>";
  rows += "<tr>";
    rows += "<td>JAM 5</td>";
    rows += "<td>" + data[i].JAM_5 + "</td>";
    rows += "<td>JAM 13</td>";
    rows += "<td>" + data[i].JAM_13 + "</td>";
  rows += "</tr>";
  rows += "<tr>";
    rows += "<td>JAM 6</td>";
    rows += "<td>" + data[i].JAM_6 + "</td>";
    rows += "<td>JAM 14</td>";
    rows += "<td>" + data[i].JAM_14 + "</td>";
  rows += "</tr>";
  rows += "<tr>";
    rows += "<td>JAM 7</td>";
    rows += "<td>" + data[i].JAM_7 + "</td>";
    rows += "<td>JAM 15</td>";
    rows += "<td>" + data[i].JAM_15 + "</td>";
  rows += "</tr>";
  rows += "<tr>";
    rows += "<td>JAM 8</td>";
    rows += "<td>" + data[i].JAM_8 + "</td>";
    rows += "<td>JAM 16</td>";
    rows += "<td>" + data[i].JAM_16 + "</td>";
  rows += "</tr>";
  rows += "<tr>";
    rows += "<td>&nbsp;</td>";
    rows += "<td>TOTAL</td>";
    rows += "<td>&nbsp;</td>";
    rows += "<td>" + data[i].TOTAL_AKHIR + "</td>";
  rows += "</tr>";
  }



  // Menambahkan baris data ke dalam tabel
  tableBody.innerHTML = rows;
}


  </script>
  

  