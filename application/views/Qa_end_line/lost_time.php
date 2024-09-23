<style>
#customers {
	font-family: Arial, Helvetica, sans-serif;
	border-collapse: collapse;
	width: 100%;
}
#customers td, #customers th {
	border: 1px solid #ddd;
	padding: 8px;
}
 #customers tr:nth-child(even) {
background-color: #f2f2f2;
}
}
</style>
<style>
/* SIMPLE DEMO STYLES */
    

.container img {
	width: 100%;
}
.container .pull-left {
	width: 55%;
	float: left;
	margin: 20px 20px 20px -80px;
}
</style>

<hr/>
<div class="row">
  <div class="col-md-8">
    <div style="width:100%;" align="center"><strong>REPORT LOST TIME
      <?php if($info_tanggal == "") { echo ''; } else { echo '<br/> TANGGAL '.tgl($info_tanggal); } ?>
      </strong></div>
    <br/>
  <table class="table table-bordered" width="100%">
    <tr>
      <td width="8%"><div align="center"><strong>LINE</strong></div></td>
      <td width="17%"><div align="center"><strong>QTY CHECK</strong></div></td>
      <td width="18%"><div align="center"><strong>QTY HASIL</strong></div></td>
      <td width="22%"><div align="center"><strong>AVERAGE CHECK (DETIK)</strong></div></td>
      <td width="18%"><div align="center" title=""><strong>LOSS TIME (MENIT)</strong></div></td>
    </tr>
    <?php foreach($data as $row_data){ ?>
    <tr>
      <td align="center"><?php echo $row_data['line']; ?></td>
      <td align="center"><?php echo $row_data['qty_checking']; ?></td>
      <td align="center"><?php echo $row_data['hasil_output']; ?></td>
      <td align="center"><?php echo round($row_data['average_check']); ?></td>
      <td align="center"><?php echo round($row_data['waktu_terbuang'] ,2 ); ?></td>
    </tr>
    <?php } ?>
  </table>
<div align="center" style="color:#F00; font-size:16px;"> REPORT MASIH DIKERJAKAN</div>
  </div>
</div>
<div class="col-md-4"></div>
