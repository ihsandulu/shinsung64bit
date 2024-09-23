<div class="row">
	<div class="col-md-6">
		<div class="row">
			<div class="col-md-3">
				<input type="button" name="call_mekanik" class="btn btn-primary" value="PANGGIL MEKANIK" onclick="panggil('MEKANIK')">

			</div>
			<div class="col-md-3">
				<input type="button" name="call_mekanik" class="btn " value="PANGGIL SUPERVISOR" onclick="panggil('SUPERVISOR')" >
				
			</div>
			<div class="col-md-3">
				<input type="button" name="call_mekanik" class="btn btn-primary" value="PANGGIL MANAGER" onclick="panggil('MANAGER')">
				
			</div>
			<div class="col-md-3">
				<input type="button" name="call_mekanik" class="btn btn-primary" value="PANGGIL CHIEF" onclick="panggil('CHIEF')">
				
			</div>

			<div class="col-md-3">
				<input type="button" name="call_aku" class="btn btn-primary" value="PANGGIL aku" onclick="kirim_pesan('TEST COBA PANGGIL')">
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function panggil(JABATAN) {

		var line = <?php echo $line ?>;
		var pesan = JABATAN + ' LINE '+ line + ' dimohon segera ke line';

		$.ajax({
	      url: baseUrl + 'DQMSBOT/KirimPesan/'+ pesan ,  //your server side script
	      data: {},
	      type: 'POST',
	      success: function(data) {
	        alert('Pesan dikirim');
	        
	         // refresh_grid();
	      },
	      error: function() {
	        alert('An error occurred');
	      },
	    	});
	}

	function kirim_pesan(JABATAN) {

		var line = <?php echo $line ?>;
		var pesan =  'dimohon segera ke line '+ line ;

		$.ajax({
	      url: baseUrl + 'DQMSBOT/kirimPesanTelegram/'+ pesan ,  //your server side script
	      data: {},
	      type: 'POST',
	      success: function(data) {
	        alert('Pesan dikirim');
	        
	         // refresh_grid();
	      },
	      error: function() {
	        alert('An error occurred');
	      },
	    	});
	}

</script>