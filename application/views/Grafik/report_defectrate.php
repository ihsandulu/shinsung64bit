<div class="row">
    <form method="post"  enctype="multipart/form-data">
      <div class="col-md-3">
        <div class="form-group">
          <label for="buyer">Buyer </label>
          <select name="buyer" id="buyer" class="form-control">
            <option value="">All Buyer </option>
            <?php foreach ($buyer as $row): ?>
            <option value="<?php echo $row['buyer']; ?>"><?php echo $row['buyer']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      
      <div class="col-md-2">
        <div class="form-group">
          <label for="tanggal_awal">Tanggal Awal</label>
          <input type="date" class="form-control" id="tanggal_awal" name="tanggal_awal" autocomplete="off" value="<?php echo date('Y-m-d'); ?>">
        </div>
      </div>


      <div class="col-md-2">
        <div class="form-group">
          <label for="tanggal_akhir">Tanggal Akhir</label>
          <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" autocomplete="off" value="<?php echo date('Y-m-d'); ?>">
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
let tanggal_awal=$("#tanggal_awal").val();
let tanggal_akhir=$("#tanggal_akhir").val();
let line=$("#line").val();
let buyer=$("#buyer").val();
// alert('<?php echo base_url()?>Grafik/defectrate?buyer='+buyer+'&tanggal_awal='+tanggal_awal+'&tanggal_akhir='+tanggal_akhir+'&line='+line);
/* $('#list_report').load('<?php echo base_url()?>Grafik/defectrate?buyer=&tanggal_awal='+tanggal_awal+'&tanggal_akhir='+tanggal_akhir+'&line='+line,  function(responseTxt, statusTxt, xhr){
		if(statusTxt == "success")
		  $("#loading_gambar").hide();
		  $("#list_report").show();
		  //alert("External content loaded successfully!");
		if(statusTxt == "error")
		 alert("Error: " + xhr.status + ": " + xhr.statusText);
  }) */
  

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



<script language="javascript">
function btn_save() {
    buyer = $('#buyer').val();
    tanggal_awal = $('#tanggal_awal').val();
    tanggal_akhir = $('#tanggal_akhir').val();
	line = $('#line').val();
	var encodedBuyer = encodeURIComponent(buyer);
	$("#loading_gambar").show();
	$("#list_report").hide();
  // alert('<?php echo base_url()?>Grafik/defectrate?buyer='+encodedBuyer+'&tanggal_awal='+tanggal_awal+'&tanggal_akhir='+tanggal_akhir+'&line='+line+'');
	$('#list_report').load('<?php echo base_url()?>Grafik/defectrate?buyer='+encodedBuyer+'&tanggal_awal='+tanggal_awal+'&tanggal_akhir='+tanggal_akhir+'&line='+line+'',  function(responseTxt, statusTxt, xhr){
		if(statusTxt == "success")
		  $("#loading_gambar").hide();
		  $("#list_report").show();
		  //alert("External content loaded successfully!");
		if(statusTxt == "error")
		 alert("Error: " + xhr.status + ": " + xhr.statusText);
  })
  	
}
  
</script>
