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
        
        Background Hijau : Defect Rate lebih kecil dari 31%.<br/>
        Background Kuning : Defect Rate lebih besar dari 30% s/d 49%. <br/>
        Background Merah : Defect Rate lebih besar dari atau sama dengan 50%.<br/>
        Kotak Warna Hitam dengan tulisan berkedip menandakan Qty check kurang. <br/>
        </div>
        <hr/>
        
        Gambar Hand Detector : Qty Packing lebih besar dari pada Qty HD <br/>
        Gambar Kardus : Qty Packing kurang dari Qty HD (dengan toleran 10 pcs) <br/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
      </div>
    </div>
  </div>
</div>



<div id="page_open"></div>

<script language="javascript">
$('#page_open').load('<?php echo base_url().'Qa_end_line_dashboard/list_report_detail_qco'?>');
</script>

<script language="javascript">
$(document).ready(function(){
      setInterval(function(){
        $('#page_open').load('<?php  echo base_url().'Qa_end_line_dashboard/list_report_detail_qco'?>');
      },10000); });	  
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
   			
          <div class="col-xs-12 col-sm-12 col-md-5" hidden>
          <br/>
          <div align="center"><strong>DAFTAR DEFECT</strong></div>
          <hr/>
          <table class="table table-striped table-bordered" id="tabel_summary_defect_list" style="width:100%;"></table>
          </div>
         
          <div class="col-xs-12 col-sm-12 col-md-12" hidden>
          <br/>
          <div align="center"><strong>HASIL PRODUKSI</strong> </div>
          <hr/>
          <table class="table table-striped table-bordered" id="tabel_summary_hasil_qa_perjam"></table>
          </div>
        
        </div>
        
        <!--
        <div class="col-xs-12 col-sm-12 col-md-12">
        <button type="button"  class="btn btn-success btn-sm" id="show_buttom" onclick="btn_show()"> <i class="fa fa-plus"> </i> SHOW DETAIL DEFECT PER JAM </button>
        <button type="button"  class="btn btn-danger btn-sm" id="hide_buttom" onclick="btn_hide()"> <i class="fa fa-minus"> </i> HIDE DETAIL DEFECT PER JAM </button>
        </div>
        -->
        
        <div class="col-xs-12 col-sm-12 col-md-12" id="list_defect_perjam">
        <br/>
        
        <table class="table table-striped table-bordered" id="tabel_summary_defect_perjam"></table>
        
        </div>
        
        
        
        <div class="col-xs-12 col-sm-12 col-md-12">
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
$("#hide_buttom").hide();
$("#list_defect_perjam").show();
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
  var modal = document.getElementById("myModal");
  modal.style.display = "block";
  document.getElementById("judul_modal").innerHTML = "DAFTAR DEFECT LINE : " + lines;


     $.ajax({
      type: 'POST',
      url: "<?php echo base_url().'Qa_end_line_dashboard/sp_dashboard_Qa_end_line_all_line_detail_defect_per_line_qco/'?>" + lines  ,
      dataType: "JSON",
      data: {
      
      },
      success: function(response) {
   
       renderTable_summary(response , "tabel_summary_defect_list" );
		total_output_perline(lines);
		defect_perjam(lines);
		
		//$('#display').load('<?php echo base_url().'/Qa_end_line/display_inspect_dasbord/'?>' + lines);
		
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
    rows += "<th width='10%'><strong>JAM</strong> </th>";
	rows += "<th width='12%'><strong>COUNT INSPECT</strong></th>";
    rows += "<th width='12%'><strong>PASS HD</strong></th>";
	rows += "<th width='12%'><strong>HASIL</strong></th>";
    
    rows += "<th width='10%'><strong>JAM</strong> </th>";
    rows += "<th width='12%'><strong>COUNT INSPECT</strong></th>";
	rows += "<th width='12%'><strong>PASS HD</strong></th>";
    rows += "<th width='12%'><strong>HASIL </strong></th>";
  rows += "</tr>";
  rows += "</tbody>";

  rows += "<tr>";
    rows += "<td width='10%'>JAM 1</td>";
    rows += "<td width='12%'>" + data[i].INSPECT_1 + "</td>";
	rows += "<td width='12%'>" + data[i].JAM_HD_1 + "</td>";
	rows += "<td width='12%'>" + data[i].JAM_1 + "</td>";
    rows += "<td width='10%'>JAM 9</td>";
    rows += "<td width='12%'>" + data[i].INSPECT_9 + "</td>";
	rows += "<td width='12%'>" + data[i].JAM_HD_9 + "</td>";
	rows += "<td width='12%'>" + data[i].JAM_9 + "</td>";
    
  rows += "</tr>";
  rows += "<tr>";
    rows += "<td>JAM 2</td>";
    rows += "<td>" + data[i].INSPECT_2 + "</td>";
	rows += "<td>" + data[i].JAM_HD_2 + "</td>";
	rows += "<td>" + data[i].JAM_2 + "</td>";
    
    rows += "<td>JAM 10</td>";
    rows += "<td>" + data[i].INSPECT_10 + "</td>";
	rows += "<td>" + data[i].JAM_HD_10 + "</td>";
	rows += "<td>" + data[i].JAM_10 + "</td>";
    
  rows += "</tr>";
  rows += "<tr>";
    rows += "<td>JAM 3</td>";
    rows += "<td>" + data[i].INSPECT_3 + "</td>";
	rows += "<td>" + data[i].JAM_HD_3 + "</td>";
	rows += "<td>" + data[i].JAM_3 + "</td>";
    
    rows += "<td>JAM 11</td>";
    rows += "<td>" + data[i].INSPECT_11 + "</td>";
	rows += "<td>" + data[i].JAM_HD_11 + "</td>";
	rows += "<td>" + data[i].JAM_11 + "</td>";
    
  rows += "</tr>";
  rows += "<tr>";
    rows += "<td>JAM 4</td>";
    rows += "<td>" + data[i].INSPECT_4 + "</td>";
	rows += "<td>" + data[i].JAM_HD_4 + "</td>";
	rows += "<td>" + data[i].JAM_4 + "</td>";
    
    rows += "<td>JAM 12</td>";
    rows += "<td>" + data[i].INSPECT_12 + "</td>";
	rows += "<td>" + data[i].JAM_HD_12 + "</td>";
	rows += "<td>" + data[i].JAM_12 + "</td>";
    
  rows += "</tr>";
  rows += "<tr>";
    rows += "<td>JAM 5</td>";
    rows += "<td>" + data[i].INSPECT_5 + "</td>";
	rows += "<td>" + data[i].JAM_HD_5 + "</td>";
	rows += "<td>" + data[i].JAM_5 + "</td>";
    
    rows += "<td>JAM 13</td>";
    rows += "<td>" + data[i].INSPECT_13 + "</td>";
	rows += "<td>" + data[i].JAM_HD_13 + "</td>";
	rows += "<td>" + data[i].JAM_13 + "</td>";
    
  rows += "</tr>";
  rows += "<tr>";
    rows += "<td>JAM 6</td>";
    rows += "<td>" + data[i].INSPECT_6 + "</td>";
	rows += "<td>" + data[i].JAM_HD_6 + "</td>";
	rows += "<td>" + data[i].JAM_6 + "</td>";
    
    rows += "<td>JAM 14</td>";
    rows += "<td>" + data[i].INSPECT_14 + "</td>";
	rows += "<td>" + data[i].JAM_HD_14 + "</td>";
	rows += "<td>" + data[i].JAM_14 + "</td>";
    
  rows += "</tr>";
  rows += "<tr>";
    rows += "<td>JAM 7</td>";
    rows += "<td>" + data[i].INSPECT_7 + "</td>";
	rows += "<td>" + data[i].JAM_HD_7 + "</td>";
	rows += "<td>" + data[i].JAM_7 + "</td>";
    
    rows += "<td>JAM 15</td>";
    rows += "<td>" + data[i].INSPECT_15 + "</td>";
	rows += "<td>" + data[i].JAM_HD_15 + "</td>";
	rows += "<td>" + data[i].JAM_15 + "</td>";
    
  rows += "</tr>";
  rows += "<tr>";
    rows += "<td>JAM 8</td>";
    rows += "<td>" + data[i].INSPECT_8 + "</td>";
	rows += "<td>" + data[i].JAM_HD_8 + "</td>";
	rows += "<td>" + data[i].JAM_8 + "</td>";
    
    rows += "<td>JAM 16</td>";
    rows += "<td>" + data[i].INSPECT_16 + "</td>";
	rows += "<td>" + data[i].JAM_HD_16 + "</td>";
	rows += "<td>" + data[i].JAM_16 + "</td>";
    
  rows += "</tr>";
  rows += "<tr>";
    rows += "<td>&nbsp;</td>";
    rows += "<td>TOTAL</td>";
    rows += "<td>&nbsp;</td>";
	rows += "<td>&nbsp;</td>";
	rows += "<td>&nbsp;</td>";
    rows += "<td>" + data[i].TOTAL_INSPECT + "</td>";
	rows += "<td>" + data[i].TOTAL_AKHIR_HD + "</td>";
	rows += "<td>" + data[i].TOTAL_AKHIR + "</td>";
    
	
  rows += "</tr>";
  }



  // Menambahkan baris data ke dalam tabel
  tableBody.innerHTML = rows;
}




function defect_perjam(lines)
{
    $.ajax({
      type: 'POST',
      url: "<?php echo base_url().'Qa_end_line/hasil_defect_perjam_qco/' ?>"+ lines ,
      dataType: "JSON",
      data: {
      
      },
      success: function(response) { 
       renderTable_total_defect_perjam(response , "tabel_summary_defect_perjam" );
      }
    });
}

function renderTable_total_defect_perjam(data , nama_tabel) {
  var tableBody = document.getElementById(nama_tabel);
  var rows = "";
   rows += '<tr>';
    rows += '<td align="center" width="3%"><b>No</b></td>';
    rows += '<td align="center" width="13%"><b>Jenis</b></td>';
    rows += '<td align="center" width="6%"><b>Kode</b></td>';
    rows += '<td align="center" width="25%"><b>Keterangan</b></td>';
    rows += '<td align="center" width="3%"><b>JAM 1</b></td>';
    rows += '<td align="center" width="3%"><b>JAM 2</b></td>';
    rows += '<td align="center" width="3%"><b>JAM 3</b></td>';
    rows += '<td align="center" width="3%"><b>JAM 4</b></td>';
    rows += '<td align="center" width="3%"><b>JAM 5</b></td>';
    rows += '<td align="center" width="3%"><b>JAM 6</b></td>';
    rows += '<td align="center" width="3%"><b>JAM 7</b></td>';
    rows += '<td align="center" width="3%"><b>JAM 8</b></td>';
    rows += '<td align="center" width="3%"><b>JAM 9</b></td>';
    rows += '<td align="center" width="3%"><b>JAM 10</b></td>';
    rows += '<td align="center" width="3%"><b>JAM 11</b></td>';
    rows += '<td align="center" width="3%"><b>JAM 12</b></td>';
    rows += '<td align="center" width="3%"><b>JAM 13</b></td>';
    rows += '<td align="center" width="3%"><b>JAM 14</b></td>';
    rows += '<td align="center" width="3%"><b>JAM 15</b></td>';
    rows += '<td align="center" width="3%"><b>JAM 16</b></td>';
    rows += '<td align="center" width="5%"><b>TOTAL</b></td>';
  rows += '</tr>';

  var no = 0;
  for (var i = 0; i < data.length; i++) {
  no++;
   rows += '<tr>';
    rows += '<td>'+no+'</td>';
    rows += '<td>'+data[i].jenis+'</td>';
    rows += '<td>'+data[i].kode+'</td>';
    rows += '<td>'+data[i].keterangan+'</td>';
    rows += '<td>'+data[i].JAM_1+'</td>';
    rows += '<td>'+data[i].JAM_2+'</td>';
    rows += '<td>'+data[i].JAM_3+'</td>';
    rows += '<td>'+data[i].JAM_4+'</td>';
    rows += '<td>'+data[i].JAM_5+'</td>';
    rows += '<td>'+data[i].JAM_6+'</td>';
    rows += '<td>'+data[i].JAM_7+'</td>';
    rows += '<td>'+data[i].JAM_8+'</td>';
    rows += '<td>'+data[i].JAM_9+'</td>';
    rows += '<td>'+data[i].JAM_10+'</td>';
    rows += '<td>'+data[i].JAM_11+'</td>';
    rows += '<td>'+data[i].JAM_12+'</td>';
    rows += '<td>'+data[i].JAM_13+'</td>';
    rows += '<td>'+data[i].JAM_14+'</td>';
    rows += '<td>'+data[i].JAM_15+'</td>';
    rows += '<td>'+data[i].JAM_16+'</td>';
    rows += '<td>'+data[i].TOTAL_AKHIR+'</td>';
  rows += '</tr>';
  }

  tableBody.innerHTML = rows;
}

</script>
  

  