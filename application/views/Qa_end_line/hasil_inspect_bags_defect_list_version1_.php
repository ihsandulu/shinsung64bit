<style>
<body {
 width:100%;
}
.container {
	margin-top: 10px;
}
.colomn_satu {
	border-right: 1px solid #000;
	border-top: 0px solid #000;
	padding: 10px;
	padding-top:0px;
}
.colomn_dua {
	border-right: 0px solid #000;
	border-top: 0px solid #000;
	padding: 10px;
	padding-top:0px;
}
.colomn_tiga {
	/*border-right: 1px solid #000; */
	border-top: 0px solid #000;
	padding: 10px;
	padding-top:0px;
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
</style>

<body>
<div class="container-fluid">

<div id="getJam" style="font-size:12px; color:#000;  font-size:25px; margin-top:-46px;" align="right"></div>

<script language="javascript">
$('#getJam').load('<?php echo base_url().'Qa_end_line/getJam'?>');
</script>
<script language="javascript">
$(document).ready(function(){
      setInterval(function(){
       $('#getJam').load('<?php  echo base_url().'Qa_end_line/getJam'?>');
      },5000); });	
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
    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 colomn_satu">
      <p>
      <div id="detail_data">
        <div align="left"><strong>
        <a href="<?php echo base_url(); ?>Qa_end_line/display_inspect/<?php echo $line; ?>/<?php echo $id_schedule; ?>" target="_blank">
        DETAIL
        </a>
        </strong></div>
        
        <?php 

          $group = array('admin');
          if ($this->ion_auth->in_group($group)) :
        ?>
        <div align="right" style="margin-top:-25px;">
        
        <a href="#modal_panggil" data-toggle="modal" id="detail" data-id="<?php echo $line; ?>">
        <button class="button" style="background-color:black; width: 100px; height: 30px; font-size:11px;" id="panggil"> <i class="fa fa-bell-o"></i> PANGGIL</button>
        </a>
        
        
        <!--
        <button class="button" style="background-color:#09F; width: 35px; height: 30px; font-size:11px; margin-left:-3px;" id="panggil"> QA</button>
        <button class="button" style="background-color:#F39; width: 35px; height: 30px; font-size:11px; margin-left:-3px;" id="panggil"> QC</button>
        <button class="button" style="background-color:#099; width: 35px; height: 30px; font-size:11px; margin-left:-3px;" id="panggil"> QCO</button>
        <button class="button" style="background-color:#03F; width: 35px; height: 30px; font-size:11px; margin-left:-3px;" id="panggil"> IT</button>
        <button class="button" style="background-color:#F00; width: 35px; height: 30px; font-size:11px; margin-left:-3px;" id="panggil"> PC</button>
        <button class="button" style="background-color:#000; width: 35px; height: 30px; font-size:11px; margin-left:-3px;" id="panggil"> MK</button>
        -->
        </div>
        <?php endif; ?>
        <!-- 
        <div align="right" style="margin-bottom:-50px;">
        <a href="<?php// echo base_url(); ?>Qa_end_line/display_inspect/<?php// echo $line; ?>/<?php// echo $id_schedule; ?>" target="_blank">
        <button class="button" id="button_status" style="border-radius: 50%; background-color:#FFF;"></button> 
        </a>
        </div>
        
        -->
        
        </p>
        
        <div align="left"><i>#KJ / Style / Color </i></div>
        <div align="left" class="isi"><b>#<?php  echo $schedule['KANAAN_PO']; ?> / <?php  echo $schedule['STYLE_NO']; ?> / <?php  echo $schedule['COLOR']; ?></b></div>
        <div align="left"><i>Des </i></div>
        <div align="left" class="isi"><b><?php  echo $schedule['DES']; ?></b></div>
        <div align="left"><i>Qty Order / Target 100%</i></div>
        <div align="left" class="isi"><b><?php  echo $schedule['QTY_ORDER']; ?> / <?php  echo $schedule['TARGET100PERSEN']; ?></b></div>
      </div>

      
      <?php  if($line == "1") { ?>
      <?php 
	  $tugas = substr($this->session->userdata('email'),-1);
	  //echo '<br/>'.$tugas;
	  ?>
        <table width="100%" border="0">
          <tr>
            <td width="50%" ><button class="button" style="background-color:darkgreen; width: 96%; height: 185px;" id="btn_ok"  onClick="oke_inspect()">INSPECT OK  </button></td>
            <td width="50%"><button class="button " style="background-color:darkred; width: 96%; height: 185px;" id="btn_start" onClick="start_check()">REJECT</button></td>
          </tr>
          <tr>
            <td colspan="2" width="50%"><button class="button" style="background-color:black; width: 98%; height: 50px;" id="btn_output" onClick="start_output()">OUTPUT PACKING</button></td>
            </tr>
          <tr>
             <td colspan="2" width="50%"><button class="button" style="background-color:blue; width: 98%; height: 50px;" id="btn_output_hd" onClick="start_output_hd()">OUTPUT HD</button></td>
          </tr>
        </table>
   
      
      
      <?php  } else { ?>
      <table width="100%" border="0">
          <tr>
            <td width="50%" ><button class="button" style="background-color:darkgreen; width: 96%; height: 185px;" id="btn_ok"  onClick="oke_inspect()">INSPECT OK </button></td>
            <td width="50%"><button class="button " style="background-color:darkred; width: 96%; height: 185px;" id="btn_start" onClick="start_check()">REJECT</button></td>
          </tr>
          <tr>
            <td colspan="2" width="50%"><button class="button" style="background-color:black; width: 98%; height: 50px;" id="btn_output" onClick="start_output()">OUTPUT PACKING</button></td>
            </tr>
          <tr>
             <td colspan="2" width="50%"><button class="button" style="background-color:blue; width: 98%; height: 50px;" id="btn_output_hd" onClick="start_output_hd()">OUTPUT HD</button></td>
          </tr>
        </table>
		
      <?php   };  ?>
      
      
      <div class="container_form" id="form_defect">
      <div align="center" style="width:98%;">
        <div class="alert alert-danger" id="danger-alert-inspect-no">
          <button type="button" class="close" data-dismiss="alert">x</button>
          <strong> </strong> KODE TIDAK TERDAFTAR
        </div>
        </div>

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
      
      
      <button class="button btn-block" style="background-color:black; width: 65%; height: 50px;" id="btn_back" onClick="start_back()">BACK </button>
      <?php 

          $group = array('admin');
          if ($this->ion_auth->in_group($group)) :
        ?>
        <div align="right" style="margin-top:-27px; margin-bottom:-8px;  float:right;">
        <a href="#modal_uncomplete" data-toggle="modal" id="detail" data-id="<?php echo $line; ?>">
        <button class="button btn-block" style="background-color:red;  height: 30px; font-size:10px;" id="uncomplete"> <i class="fa fa-bell-o"></i> UNCOMPLETE</button>
        </a>
        </div>
        <?php endif; ?>
        
        
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
      
      
      
    </div>
    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 colomn_dua">
      <table class="table table-striped table-bordered" id="Table_summary" style="width:100%;">
        <tbody>
          <tr>
            <td width="34%" style="text-align:center;"> QTY CHECK : <font size="+4"><strong><div id="jml_ceck"></div></strong></font></td>
            <td width="37%" style="text-align:center;"> SUM DEFECT : <font size="+4"><strong><div id="jml_defect"></div> </strong></font></td>
            <td onclick="list_data_defect()" width="29%" id="button_status" style="text-align:center; color:#FFF;"> % DEFECT : <font size="+4"><strong><div id="jml_persen"></div> </strong></font></td>
          </tr>
        </tbody>
      </table>
  
      <div align="right">
      <font size="+1">HD : </font><span id="jml_qty_hd" style="text-align:left; font-weight: bold; margin-right:10px; font-size:18px;"></span></b>
      <font size="+1">PACKING : </font><b> <span id="jml_qty" style="text-align:left; font-weight: bold; margin-right:10px; font-size:18px;"></span></b>
      
      <button class="button" style="background-color:darkred; width: 70px; height: 30px; font-size:11px;" id="r" onClick="btn_reload()">REFRESH</button>
      <button class="button" style="background-color:darkblue; width: 70px; height: 30px; font-size:11px;" id="l" onClick="btn_style()">STYLE</button>
      <button class="button" style="background-color:darkgreen; width: 70px; height: 30px; font-size:11px;" id="btn_data_hasil" onClick="start_btn_hasil()">OUTPUT</button>
      <button class="button" style="background-color:purple; width: 70px; height: 30px; font-size:11px;" id="btn_data_defect" onClick="start_btn_defect()">DEFECT</button>
      <a href="#info" data-toggle="modal" id="detail" data-id="<?php echo $line; ?>">
      <button class="button" style="background-color:black; width: 70px; height: 30px; font-size:11px;" id="btn_history">HISTORY</button>
      </a>
      </div>
      

      

      <div style="overflow-y:auto; height:250px;">
        
        <div id="tabel_data_defect">
        <table class="table table-striped table-bordered" id="tabel_summary_defect_list" style="width:100%;">
        </table>
        </div>
        
        <div id="tabel_data_hasil">
        <table class="table table-striped table-bordered" id="tabel_summary_hasil_qa_perjam" style="width:100%;">
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
    $(document).ready(function(){
        $('#info').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            $.ajax({
                type : 'post',
                url : baseUrl + 'Qa_end_line/history',
                data :  'rowid='+ rowid,
                success : function(data){
                $('.fetched-data').html(data);
                }
            });
         });
    });
</script>




<div class="modal fade" id="modal_panggil" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-admin" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> PANGGIL </h4>
      </div>
      <div class="modal-body">
        <div class="fetched-data-panggil">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#modal_panggil').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            $.ajax({
                type : 'post',
                url : baseUrl + 'panggilan/Inspect/<?php echo $line.'/'.$id_schedule ?>',
                data :  'rowid='+ rowid,
                success : function(data){
                $('.fetched-data-panggil').html(data);
                }
            });
         });
    });
</script>





<div class="modal fade" id="modal_uncomplete" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-admin" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> UNCOMPLETE </h4>
      </div>
      <div class="modal-body">
        <div class="fetched-data-uncomplete">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#modal_uncomplete').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            $.ajax({
                type : 'post',
                url : baseUrl + 'Uncomplete/Inspect/<?php echo $line.'/'.$id_schedule ?>',
                data :  'rowid='+ rowid,
                success : function(data){
                $('.fetched-data-uncomplete').html(data);
                }
            });
         });
    });
</script>

<!--
<div id="toast-container" class="toast-top-right">
  <div id="toast-type" class="toast" aria-live="assertive" style="">
    <div id="snackbar">message</div>
  </div>
</div>
-->

</body>



<!--
<script language="javascript">
let animating = false;
function Toast(message, messagetype) {
  var cont = document.getElementById("toast-container");
  cont.classList.add("show"); // correct manipulation
  var type = document.getElementById("toast-type");
  type.className += " " + messagetype;
  var x = document.getElementById("snackbar");
  x.innerHTML = message;
  setTimeout(function() {
    cont.classList.remove("show"); // access it again here
    animating = false;
  }, 3000);
};
</script>
-->

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
getuuid();
function getuuid()
{
   $.ajax({
      url: "<?php echo base_url()?>" + "Qa_end_line/get_uuid",
        type: 'POST',
        dataType: 'JSON',
      })
      .done(function(response) {
           
        cekid = response.cekid ;
        
      });
}

function start_check()
{
  
    $("#btn_start").hide();
	$("#btn_ok").hide();
	$("#form_defect").show();
	$("#form_defect_hd").hide();
	$("#detail_data").hide();
	$("#btn_output").hide();
	$("#btn_output_hd").hide();
	
  //document.getElementById("btn_end").style.display = "block";
  //document.getElementById("btn_start").style.display = "none";
    getuuid();

}

//document.getElementById("btn_end").style.display = "none" ;
function end_check()
{
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

 //document.getElementById("btn_end").style.display = "none" ;
  //document.getElementById("btn_start").style.display = "block" ;
  
}


function start_output()
{
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


function start_output_hd()
{
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


function start_back()
{
  $("#btn_start").show();
  $("#btn_output").show();
  $("#btn_output_hd").show();
  $("#btn_ok").show();
  $("#form_defect").hide();
  $("#form_output").hide();
  $("#form_output_hd").hide();
  $("#detail_data").show();
  start_btn_defect();
  

 //document.getElementById("btn_end").style.display = "none" ;
  //document.getElementById("btn_start").style.display = "block" ;
  
}



function  list_data_defect()
{
   call_sp_grid_summary_hasil_inspect_bags_defect_list_version1();
      
    //    $.ajax({
    //   type: 'POST',
    //   url: "<?php echo base_url().'Qa_end_line/sp_grid_hasil_inspect_bags_defect_list_version1/' . $line .'/'.$id_schedule   ?>",
    //   dataType: "JSON",
    //   data: {
      
    //   },
    //   success: function(response) {
    //    //alert(response);
    //    //renderTable(response , "tabel_defect_list" );
       

    //   }
    // });
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
   
   
   document.getElementById("jml_qty").innerHTML = response[0].total_qty;
    document.getElementById("jml_qty_hd").innerHTML = response[0].total_qty_hd;
   if(response[0].persen_defect >= 50) {
	   document.getElementById("button_status").style.backgroundColor = "red";
   } else if(response[0].persen_defect >= 31 ) {
	   document.getElementById("button_status").style.backgroundColor = "#FC0";
   } else if(response[0].persen_defect < 31) {
	   document.getElementById("button_status").style.backgroundColor = "green";
   } else {
	   document.getElementById("button_status").style.backgroundColor = "#CCC";
   }


  // table.rows[0].cells[1].innerHTML = response[0].qty_defect;
   //table.rows[0].cells[2].innerHTML = response[0].persen_defect + ' % ';


       //alert(response);
     //  renderTable(response , "tabel_defect_list" );

      }
    });


     /*
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
*/

}


 
 function refresh_defect_table () {
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
    rows += "<thead><tr>";
    rows += "<td><strong>JAM TARGET </strong></td>";
	rows += "<td><strong>JUMLAH HASIL</strong></td>";
	rows += "</tr><thead>";
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
					var target = <?php echo $schedule['TARGET100PERSEN'] *2; ?>;
									
					if(qty > target) {
						alert('Gagal disimpan. Cek kembali Qty Output. ');
					} else {
						$.ajax({
							type: 'POST',
							url: "<?php echo base_url().'Qa_end_line/hasil_inspect_bags_defect_list_version1_final_result_action/' . $line .'/'.$id_schedule  ?>",
							dataType: "JSON",
							data: {
								qty : qty,
							},
							success: function(response) {
								document.getElementById('textbox2').value = "";
								list_data_defect();
								total_output_perline();
								
								
								if (response.status ==="1") {
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
					var target = <?php echo $schedule['TARGET100PERSEN'] *2; ?>;
									
					if(qty > target) {
						alert('Gagal disimpan. Cek kembali Qty Output. ');
					} else {
						$.ajax({
							type: 'POST',
							url: "<?php echo base_url().'Qa_end_line/hasil_inspect_bags_defect_list_version1_output_hd_action/' . $line .'/'.$id_schedule  ?>",
							dataType: "JSON",
							data: {
								qty : qty,
							},
							success: function(response) {
								document.getElementById('textbox3').value = "";
								list_data_defect();
								total_output_perline();
								
								
								if (response.status ==="1") {
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
						 
	
						 if (response.status ==="1") {
							 $("#success-alert-defect-ok").fadeTo(1000, 300).slideUp(300, function() {
    						 	$("#success-alert-defect-ok").slideUp(300);
    					 	 });
						 } else if (response.status === "0") {
							 $("#danger-alert-inspect-no").fadeTo(1000, 300).slideUp(300, function() {
    						 	$("#danger-alert-inspect-no").slideUp(300);
    					 	 });
						 } else if (response.status === "5") {
							 alert('Cek Kembali Schedule Produksi');
						 } else {
							alert('Cek Kembali Schedule Produksi');
						 }
						 document.getElementById('textbox1').value = "";
						 
						 
                         

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
                         list_data_defect();
						 
	
						 if (response.status =="2") {
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
	
                        //if (animating) {
						//	return;
						 // }
						 // animating = true;
						 // Toast("hi there", "toast-success"); 
												 

                       
                      });
                     // list_data_defect();
                      
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