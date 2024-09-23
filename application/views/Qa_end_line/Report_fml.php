<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/zoom.css') ?>">
<script type="text/javascript" src="<?php echo base_url('assets/js/zoom.js') ?>"></script>
<div class="row">
  <form method="post"  enctype="multipart/form-data">
    <div class="col-md-2">
      <div class="form-group">
        <label for="tanggal">Start Date</label>
        <input type="date" class="form-control" id="tanggal" name="tanggal" autocomplete="off" value="<?php echo date('Y-m-d'); ?>">
      </div>
    </div>
    
    <div class="col-md-2">
      <div class="form-group">
        <label for="tanggal">End Date</label>
        <input type="date" class="form-control" id="tanggal2" name="tanggal2" autocomplete="off" value="<?php echo date('Y-m-d'); ?>">
      </div>
    </div>
    
    <div class="col-md-3">
      <div class="form-group">
        <label for="line">Line</label>
        <select class="multiple_line form-control" name="line[]" id="line" multiple="multiple">
          <?php for ($no = 1; $no <= 100; $no++) : ?>
          <option value="<?php echo $no ?>"><?php echo $no ?></option>
          <?php endfor; ?>
          <option value="1000">1000</option>
        </select>
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


   $(function(){
    $('.multiple_line').select2();
    $('select').each(function (i, e) {
        var element = $(e);
        var options = { };
        var control = element.select2(options);
        
        if (control.first().prop("multiple"))
        control.next().keyup(function (e) {
            if (e.keyCode === 13)
                control.select2("open");
        });
      });
  });
  
  
</script> 
<?php 
$tgl = date('Y-m-d');
?>
<script language="javascript">
  // alert("<?php echo base_url()?>Report_end_line/fml?tanggal=<?php echo $tgl ?>&tanggal2=<?php echo $tgl; ?>&line=");
$("#list_report").load("<?php echo base_url()?>Report_end_line/fml?tanggal=<?php echo $tgl ?>&tanggal2=<?php echo $tgl; ?>&line=");

function btn_save() {
    tanggal = $('#tanggal').val();
	tanggal2 = $('#tanggal2').val();
	line = $('#line').val();
	
	if(tanggal === "" || tanggal2 === "") {
		alert('Start Date, End Date cannot be empty! ');
	} else {
		$("#loading_gambar").show();
		$("#list_report").hide();
		$('#list_report').load('<?php echo base_url()?>Report_end_line/fml?tanggal='+tanggal+'&tanggal2='+tanggal2+'&line='+line+'',  function(responseTxt, statusTxt, xhr){
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
