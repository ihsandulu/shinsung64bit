
<script type="text/javascript">
$(document).ready( function () {
    $('#example').DataTable();
});
</script>
  <div class="col-md-6 col-xs-12">
  <div align="center"><strong>DETAIL JUMLAH PEGAWAI AKTIF <?php echo number_format_($data_jumlah['jumlah']); ?></strong></div><hr/>
    <table class="table" id="example" width="100%">
      <thead>
        <tr>
          <th width="3%"><div align="center">No. </div></th>
          <th width="32%"><div align="center">Departement </div></th>
          <th width="23%"><div align="center">Pria</div></th>
          <th width="23%"><div align="center">Wanita</div></th>
          <th width="19%"><div align="center">Total</div></th>
        </tr>
        </thead>
        <tbody>
		<?php $no = 1; ?>
		<?php foreach ($data as $row): ?>
        
        <tr>
          <td> <?php echo $no++; ?></td>
          <td> <?php echo $row['DEPT']; ?></td>
          <td align="center"> <?php echo number_format_($row['SEX1']); ?></td>
          <td align="center"> <?php echo number_format_($row['SEX2']); ?></td>
          <td align="center"> <?php echo number_format_($row['SEX1'] + $row['SEX2']); ?></td>
        </tr>
        <?php endforeach; ?> 
      </tbody>
    </table>
    </div>
    <div class="col-md-6 col-xs-12">&nbsp;</div>
    <div class="col-md-12 col-xs-12">
<button type="button" class="btn btn-danger btn-flat" style="float:left;" onclick="kembali2();">KEMBALI</button>
</div>
