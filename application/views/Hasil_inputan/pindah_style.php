<?php //echo $id; ?>
<div align="center"><strong> HASIL INPUTAN </strong></div><hr/>
<div id="info-message"></div>
<table id="tbl_hasil_output_hd" style="width: 100%;" class="table table-striped table-condensed nowrap">
    <thead>
      <tr>
        <th width="129">TANGGAL </th>
        <th width="57">LINE</th>
        <th width="128">FILE NO </th>
        <th width="158">STYLE NO </th>
        <th width="225">COLOR </th>
        <th width="176">QTY GLOBAL </th>
        <th width="192">DES </th>
        <th width="112">JAM KE </th>
        <th width="83">QTY </th>
      </tr>
    </thead>
    <tr>
        <td width="129"><?php echo $data_hd['TANGGAL_HASIL']; ?></td>
        <td width="57"><?php echo $data_hd['LINE']; ?></td>
        <td width="128"><?php echo $data_hd['KANAAN_PO']; ?></td>
        <td width="158"><?php echo $data_hd['STYLE_NO']; ?></td>
        <td width="225"><?php echo $data_hd['COLOR']; ?></td>
        <td width="176"><?php echo $data_hd['QTYGLOBAL']; ?></td>
        <td width="192"><?php echo $data_hd['DES']; ?></td>
        <td width="112">-</td>
        <td width="83"><?php echo $data_hd['QTY']; ?></td>
      </tr>
    <tbody>
    </tbody>
  </table>
  
  
<hr/>
<div id="loading_images_"></div>
<table id="pindah" style="width: 100%;" class="table table-striped table-condensed nowrap">
  <tr>
    <th width="8%">ACTION</th>
    <th width="9%">FILE NO</th>
    <th width="11%">STYLE NO</th>
    <th width="17%">ITEM</th>
    <th width="9%">COLOR</th>
    <th width="15%">QTY ORDER</th>
    <th width="6%">FOB</th>
    <th width="5%">GAC</th>
    <th width="7%">QTY PLAN</th>
    <th width="13%">DES</th>
  </tr>
  <?php
  foreach($schedule as $data) {
  ?>
  <tr>
    <td><button type="button" class="btn btn-danger btn-sm" onclick="pindah_hasil_hd('<?php echo $id; ?>_<?php echo $data['ID']; ?>');"> <i class="fa fa-check"> </i> Pindah Hasil ke Style ini</button></td>
    <td><?php echo $data['KANAAN_PO']; ?></td>
    <td><?php echo $data['STYLE_NO']; ?></td>
    <td><?php echo $data['ITEM']; ?></td>
    <td><?php echo $data['COLOR']; ?></td>
    <td><?php echo $data['QTY_ORDER']; ?></td>
    <td><?php echo $data['FOB']; ?></td>
    <td><?php echo $data['GAC']; ?></td>
    <td><?php echo $data['QTY_PLAN']; ?></td>
    <td><?php echo $data['DES']; ?></td>
  </tr>
  <?php }; ?>
  
</table>
<script language="javascript">
function pindah_hasil_hd(id) {
	var result = confirm("Yakin pindah hasil produksi ke style ini ?");
	if (result) {
		$.ajax({
			url: baseUrl + 'Hasil_inputan/confirm_pindah_style',    
			type: 'POST',
			data: {
				id : id
            },
			datatype: "json",
			beforeSend: function(){
     			$('#loading_images_').html('<div id="x_" align="center"><img src="<?php echo base_url() ?>assets/img/ajax-loader.gif" width="100" /></div>');
   			},
   			complete: function(){
     			$("#x_").hide();
   			},
		
		
			success: function(status) {
				var obj = JSON.parse(status);
				if (obj.status ==="ok") {
					$('#tbl_hasil_output_hd').DataTable().draw();
					$('#info-message').html('<div id="message1" class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Success !</h4> Data berhasil dipidah ke Style baru.! </div>');
            	
				
				} else if (obj.status === "no") {
					$('#info-message').html('<div id="message1" class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Alert!</h4> Data gagal disimpan. !</div>');

				}
			}

		});
	}      
}
</script>
