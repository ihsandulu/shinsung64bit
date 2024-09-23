
<div class="row">
  <form method="post"  enctype="multipart/form-data">
    <div class="col-md-2">
      <div class="form-group">
        <label for="tanggal">Tanggal</label>
        <input type="date" class="form-control" id="tanggal" name="tanggal" autocomplete="off" value="<?php echo date('Y-m-d'); ?>">
      </div>
    </div>

    <div class="col-md-2" style="margin-top:25px;">
      <button type="button" onclick="btn_save();" class="btn btn-success btn-sm"> <i class="fa fa-search"> </i> Search</button>
    </div>
  </form>
</div>
<div id="loading_gambar" align="center"><img src="<?php echo base_url() ?>assets/img/ajax-loader.gif" width="100" /></div>
<div id="list_report"></div>
<script language="javascript">
$("#loading_gambar").hide();
</script> 
<?php 
$tgl = date('Y-m-d');
?>
<script language="javascript">
$("#list_report").load("<?php echo base_url()?>Report_end_line/lost_time?tanggal=<?php echo $tgl ?>");

function btn_save() {
    tanggal = $('#tanggal').val();
	
	if(tanggal === "") {
		alert('Tanggal tidak boleh kosong! ');
	} else {
		$("#loading_gambar").show();
		$("#list_report").hide();
		$('#list_report').load('<?php echo base_url()?>Report_end_line/lost_time?tanggal='+tanggal+'',  function(responseTxt, statusTxt, xhr){
			if(statusTxt == "success")
			  $("#loading_gambar").hide();
			  $("#list_report").show();
			  //alert("External content loaded successfully!");
			if(statusTxt == "error")
			 alert("Error: " + xhr.status + ": " + xhr.statusText);
		})
  	
	}
}
  
</script> 
