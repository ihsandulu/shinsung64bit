<style>
<body {
 width:100%;
}
.container {
	margin-top: 10px;
}
.colomn_satu {
	border-right: 1px solid #000;
	border-top: 1px solid #000;
	padding: 10px;
}
.colomn_dua {
	border-right: 0px solid #000;
	border-top: 1px solid #000;
	padding: 10px;
}
.colomn_tiga {
	/*border-right: 1px solid #000; */
	border-top: 1px solid #000;
	padding: 10px;
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
	display:         flex;
	flex-wrap: wrap;
}
.row > [class*='col-'] {
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
	height: 50px;
	width: 50px;
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
</style>

<body>
<div class="container-fluid">


<div align="center">
<div class="alert alert-success" id="success-alert-inspect-ok">
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



  <div class="row">
    <div class="col-xs-5 col-sm-5 col-md-5 colomn_satu">
      <p>
      <div id="detail_data">
        <div align="center"><strong>DETAIL</strong></div>
        </p>
        <div align="left"><i>Style / Color </i></div>
        <div align="left" class="isi"><b><?php  echo $schedule['STYLE_NO']; ?> / <?php  echo $schedule['COLOR']; ?></b></div>
        <div align="left"><i>KJ Number </i></div>
        <div align="left" class="isi"><b><?php  echo $schedule['KANAAN_PO']; ?></b></div>
        <div align="left"><i>Des </i></div>
        <div align="left" class="isi"><b><?php  echo $schedule['DES']; ?></b></div>
        <div align="left"><i>Qty Order </i></div>
        <div align="left" class="isi"><b><?php  echo $schedule['QTY_ORDER']; ?></b></div>
      </div>
      
      
      
      
      <div align="center">
        <button class="button btn-block" style="background-color:darkgreen; width: 98%; height: 100px;" id="btn_ok"  onClick="oke_inspect()">INSPECT OK</button>
      </div>
      <div align="center">
        <button class="button btn-block" style="background-color:darkred; width: 98%; height: 50px;" id="btn_start" onClick="start_check()">START CHECK</button>
      </div>
      
      <div align="center">
        <button class="button btn-block" style="background-color:black; width: 98%; height: 50px;" id="btn_output" onClick="start_output()">OUTPUT</button>
      </div>
      
      
      
      <div class="container_form" id="form_defect">
        <button class="button btn-block" style="background-color:darkred; width: 98%; height: 50px;" id="btn_end" onClick="end_check()">END CHECK</button>
        <input type="text" class="textbox"  id="textbox1" name="textbox1" readonly >
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
      <div align="center"><strong>OUTPUT</strong></div>
      <div class="container_form" id="form_output">
        <input type="text" class="textbox" id="textbox2" name="textbox2" readonly>
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
      </div>
      
    </div>
    <div class="col-xs-7 col-sm-7 col-md-7 colomn_dua">
      <table class="table table-striped table-bordered" id="Table_summary" style="width:100%;" >
        <tbody>
          <tr>
            <td style="text-align:center;"> QTY CHECK : <font size="+4"><strong><div id="jml_ceck"></div></strong></font></td>
            <td style="text-align:center;"> SUM DEFECT : <font size="+4"><strong><div id="jml_defect"></div> </strong></font></td>
            <td style="text-align:center;"> % DEFECT : <font size="+4"><strong><div id="jml_persen"></div> </strong></font></td>
          </tr>
        </tbody>
      </table>
      <div style="overflow-y:auto; height:250px;">
        <table class="table table-striped table-bordered" id="tabel_summary_defect_list" style="width:100%;">
        </table>
      </div>
    </div>

  </div>
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 footer">
      <table class="table table-striped table-bordered" id="tabel_summary_hasil_qa_perjam" style="width:100%;">
      </table>
     </div>
  </div>
</div>
</body>
<script language="javascript">

$("#form_defect").hide();
$("#form_output").hide();

$("#success-alert-inspect-ok").hide();
$("#success-alert-defect-ok").hide();
$("#success-alert-final-ok").hide();


/*
function start_check() {
	$("#btn_start").hide();
	$("#btn_ok").hide();
	$("#form_defect").show();
	$("#detail_data").hide();
  //getuuid();
}


function end_check() {
	$("#btn_start").show();
	$("#btn_ok").show();
	$("#form_defect").hide();
	$("#detail_data").show();
  //getuuid();
}

*/

</script>



<script>
 // $('#defect__item').on('click', function() {
 //      var inspectId = $(this).data('inspectid');
 //      var defectId = $(this).data('defectid');
 //      // Lakukan sesuatu ketika tombol di-klik
     

 //    });

window.onload = list_data_defect; 
document.addEventListener("DOMContentLoaded", list_data_defect);
$(document).on('click', '.defect__item', function() {
 
   $.ajax({
      url: baseURL + "Qa_end_line/hasil_inspect_bags_insert_defect_detail/"  + $(this).data('inspectid') + "/" +  $(this).data('defectid'),
        type: 'POST',
        dataType: 'JSON',
      })
      .done(function(response) {
        if (response.status == 1) {
          alert("Sukses");
          list_data_defect();
        }
      });
  
});


var cekid = "";
function getuuid()
{
   $.ajax({
      url: "<?php echo base_url()?>" + "Qa_end_line/get_uuid",
        type: 'POST',
        dataType: 'JSON',
      })
      .done(function(response) {
          // alert(response[0].uuid);
          // uuid = response[0].uuid ;
        console.log(response);
        cekid = response.cekid ;
        console.log(cekid);
      });
}

function start_check()
{
  
    $("#btn_start").hide();
	$("#btn_ok").hide();
	$("#form_defect").show();
	$("#detail_data").hide();
	
  //document.getElementById("btn_end").style.display = "block";
  //document.getElementById("btn_start").style.display = "none";
    getuuid();

}

//document.getElementById("btn_end").style.display = "none" ;
function end_check()
{
  $("#btn_start").show();
  $("#btn_ok").show();
  $("#form_defect").hide();
  $("#detail_data").show();
  cekid = "";
  getuuid();

 //document.getElementById("btn_end").style.display = "none" ;
  //document.getElementById("btn_start").style.display = "block" ;
  
}


function start_output()
{
  $("#btn_start").hide();
  $("#btn_output").hide();
  $("#btn_ok").hide();
  $("#form_defect").hide();
  $("#detail_data").hide();

 //document.getElementById("btn_end").style.display = "none" ;
  //document.getElementById("btn_start").style.display = "block" ;
  
}



function  list_data_defect()
{
   
       $.ajax({
      type: 'POST',
      url: "<?php echo base_url().'Qa_end_line/sp_grid_hasil_inspect_bags_defect_list_version1/' . $line .'/'.$id_schedule   ?>",
      dataType: "JSON",
      data: {
      
      },
      success: function(response) {
       //alert(response);
       //renderTable(response , "tabel_defect_list" );
       call_sp_grid_summary_hasil_inspect_bags_defect_list_version1();

      }
    });
}
 

function  call_sp_grid_summary_hasil_inspect_bags_defect_list_version1()
{
  var table = document.getElementById("Table_summary"); 
       $.ajax({
      type: 'POST',
      url: "<?php echo base_url().'Qa_end_line/sp_grid_summary_hasil_inspect_bags_defect_list_version1/' . $line .'/'.$id_schedule   ?>",
      dataType: "JSON",
      data: {
      
      },
      success: function(response) {
 //var cell = table.rows[1].cells[1];
   //table.rows[0].cells[0].innerHTML = response[0].qty_checking;
   document.getElementById("jml_ceck").innerHTML = response[0].qty_checking;
   document.getElementById("jml_defect").innerHTML = response[0].qty_defect;
   document.getElementById("jml_persen").innerHTML = response[0].persen_defect + ' % ';
  // table.rows[0].cells[1].innerHTML = response[0].qty_defect;
   //table.rows[0].cells[2].innerHTML = response[0].persen_defect + ' % ';


       //alert(response);
     //  renderTable(response , "tabel_defect_list" );

      }
    });


     $.ajax({
      type: 'POST',
      url: "<?php echo base_url().'Qa_end_line/sp_grid_summary_perdefect_hasil_inspect_bags_defect_list_version1/' . $line .'/'.$id_schedule   ?>",
      dataType: "JSON",
      data: {
      
      },
      success: function(response) {
   
       renderTable_summary(response , "tabel_summary_defect_list" );

      }
    });


}


 

function renderTable(data , nama_tabel) {
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

total_output_perline();

function total_output_perline()
{
    $.ajax({
      type: 'POST',
      url: "<?php echo base_url().'Qa_end_line/hasil_qa_perjam/' . $line  ?>",
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
  var rows = "<thead>";
   
  // Looping untuk setiap baris data
  for (var i = 0; i < data.length; i++) {
    rows += "<tr>";
    rows += "<td><strong>JAM 1</strong></td>";
	rows += "<td>" + data[i].JAM_1 + "</td>";
	rows += "</tr>";
	rows += "<tr>";
	rows += "<td><strong>JAM 2</strong></td>"
    rows += "<td>" + data[i].JAM_2 + "</td>";
	rows += "</tr>";
	rows += "<tr>";
	rows += "<td><strong>JAM 3</strong></td>"
    rows += "<td>" + data[i].JAM_3 + "</td>";
	rows += "</tr>";
	rows += "<tr>";
	rows += "<td><strong>JAM 4</strong></td>"
    rows += "<td>" + data[i].JAM_4 + "</td>";
	rows += "</tr>";
	rows += "<tr>";
	rows += "<td><strong>JAM 5</strong></td>"
    rows += "<td>" + data[i].JAM_5 + "</td>";
	rows += "</tr>";
	rows += "<tr>";
	rows += "<td><strong>JAM 6</strong></td>"
    rows += "<td>" + data[i].JAM_6 + "</td>";
	rows += "</tr>";
	rows += "<tr>";
	rows += "<td><strong>JAM 7</strong></td>"
    rows += "<td>" + data[i].JAM_7 + "</td>";
	rows += "</tr>";
	rows += "<tr>";
	rows += "<td><strong>JAM 8</strong></td>"
    rows += "<td>" + data[i].JAM_8 + "</td>";
	rows += "</tr>";
	rows += "<tr>";
	rows += "<td><strong>JAM 9</strong></td>"
    rows += "<td>" + data[i].JAM_9 + "</td>";
	rows += "</tr>";
	rows += "<tr>";
	rows += "<td><strong>JAM 10</strong></td>"
    rows += "<td>" + data[i].JAM_10 + "</td>";
	rows += "</tr>";
	rows += "<tr>";
	rows += "<td><strong>JAM 11</strong></td>"
    rows += "<td>" + data[i].JAM_11 + "</td>";
	rows += "</tr>";;
	rows += "<tr>"
	rows += "<td><strong>JAM 12</strong></td>"
    rows += "<td>" + data[i].JAM_12 + "</td>";
	rows += "</tr>";
	rows += "<tr>";
	rows += "<td><strong>JAM 13</strong></td>"
    rows += "<td>" + data[i].JAM_13 + "</td>";
	rows += "</tr>";
	rows += "<tr>";
	rows += "<td><strong>JAM 14</strong></td>"
    rows += "<td>" + data[i].JAM_14 + "</td>";
	rows += "</tr>";
	rows += "<tr>";
	rows += "<td><strong>JAM 15</strong></td>"
    rows += "<td>" + data[i].JAM_15 + "</td>";
	rows += "</tr>";
	rows += "<tr>";
	rows += "<td><strong>JAM 16</strong></td>"
    rows += "<td>" + data[i].JAM_16 + "</td>";
	rows += "</tr>";
	rows += "<tr>";
	rows += "<td><strong>TOTAL</strong></td>"
    rows += "<td>" + data[i].TOTAL_AKHIR + "</td>";
	rows += "</tr>";
	rows += "</thead>";
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

                  function ok_final()
                  {
                    var qty = $("#textbox2").val(); 

                     $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url().'Qa_end_line/hasil_inspect_bags_defect_list_version1_final_result_action/' . $line .'/'.$id_schedule  ?>",
                        dataType: "JSON",
                        data: {
                          qty : qty,
                        },
                        success: function(response) {
                         //alert(response);
						 document.getElementById('textbox2').value = "";
                         list_data_defect();
                         total_output_perline();
						 
						 $("#success-alert-final-ok").fadeTo(1000, 300).slideUp(300, function() {
    						$("#success-alert-final-ok").slideUp(300);
    					 });
						 

                        }
                      });
                  }
                  function ok_defect(){
                    if (cekid != "")
                    {


                    var kodeDefect = $("#textbox1").val(); 

                     $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url().'Qa_end_line/hasil_inspect_bags_defect_list_version1_action/' . $line .'/'.$id_schedule  ?>",
                        dataType: "JSON",
                        data: {
                          kode_defect : kodeDefect,
                          uuid : cekid ,
                        },
                        success: function(response) {
                         //alert(response);
                         list_data_defect();
						 document.getElementById('textbox1').value = "";
						 $("#success-alert-defect-ok").fadeTo(1000, 300).slideUp(300, function() {
    						$("#success-alert-defect-ok").slideUp(300);
    					 });
						 
                         

                        }
                      });

                   }else
                   {
                    alert(' start chek dulu') ; 

                   }
                  }

                  
                  function oke_inspect(){
                   
                      getuuid();
                    	var kodeDefect = $("#textbox1").val(); 
                     $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url().'Qa_end_line/hasil_inspect_bags_defect_list_version1_action/' . $line .'/'.$id_schedule  ?>",
                        dataType: "JSON",
                        data: {
                          kode_defect : "OK",
                          uuid : cekid ,
                        },
                        success: function(response) {
                         //alert(response);
						 $("#success-alert-inspect-ok").fadeTo(1000, 300).slideUp(300, function() {
    						$("#success-alert-inspect-ok").slideUp(300);
    					 });
	
                         list_data_defect();
                         

                        }
                      });
                      
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