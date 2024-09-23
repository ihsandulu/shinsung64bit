<div class="row">
    <form method="post"  enctype="multipart/form-data">
      <div class="col-md-3">
        <div class="form-group">
          <label for="bulan">Bulan</label>
          <select name="bulan" id="bulan" class="form-control">
            <option value="">Pilih Bulan </option>
            <option value="1">Januari</option>
            <option value="2">Februari</option>
            <option value="3">Maret</option>
            <option value="4">April</option>
            <option value="5">Mei</option>
            <option value="6">Juni</option>
            <option value="7">Juli</option>
            <option value="8">Agustus</option>
            <option value="9">September</option>
            <option value="10">Oktober</option>
            <option value="11">November</option>
            <option value="12">Desember</option>
            
          </select>
        </div>
      </div>
      
      
      <div class="col-md-2">
        <div class="form-group">
          <label for="kode">Tahun</label>
          <select name="tahun" id="tahun" class="form-control">
            <option value="">Pilih Tahun </option>
            <?php foreach ($th as $row): ?>
            <option value="<?php echo $row['tahun']; ?>"><?php echo $row['tahun']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      
      
      <div class="col-md-2" hidden>
        <div class="form-group">
          <label for="Week">Week</label>
          <select class="form-control" name="week" id="week">
          <option value="">Minggu ke </option>
       		<option value="1"> ke 1</option>
            <option value="2"> ke 2</option>
            <option value="3"> ke 3</option>
            <option value="4"> ke 4</option>
            <option value="5"> ke 5</option>
          </select>
        </div>
      </div>
      
      <div class="col-md-2">
        <div class="form-group">
          <label for="line_sewing">Line</label>
          <input type="text" class="form-control" id="line_sewing" name="line_sewing" autocomplete="off">
        </div>
      </div>
      
      <div class="col-md-3" style="margin-top:25px;">
          <button type="button" onclick="btn_save();" class="btn btn-success btn-sm"> <i class="fa fa-search"> </i> Search</button>
      </div>
    </form>
    
  </div>

<div id="list_report"></div>
<script>

  function btn_save() {
    bulan = $('#bulan').val();
    tahun = $('#tahun').val();
    week = $('#week').val();
    line_sewing = $('#line_sewing').val();
//http://192.168.0.5:1000/sewing/qa/Grafik/weekly_top_5_per_line?bulan=8&tahun=2023&week=2&line_sewing=61
$('#list_report').load('<?php echo base_url()?>Grafik/monthly_top_5_per_line?bulan='+bulan+'&tahun='+tahun+'&line_sewing='+line_sewing+'');
 


  //   $.ajax({
  //     url: '<?php echo base_url().'Grafik/weekly_top_5_per_line' ?>',
  //     type: 'GET',
  //     data: {         
  //       bulan : $('#bulan').val(),
  //       tahun : $('#tahun').val(),
		// week : $('#week').val(),
		// line_sewing : $('#line_sewing').val()
  //     },
  //   })
  //   .done(function(data) {
  //     //alert('Data berhasil di simpan');
	 //  $('#list_report').load('<?php echo base_url().'Grafik/weekly_top_5_per_line' ?>');

  //   });
  }
</script>
