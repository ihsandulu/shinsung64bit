<div align="center"><strong>LOSS TIME AVERAGE</strong> </div>
<hr/>
<div style="overflow-y:auto; height:300px;">
  <table class="table table-bordered" width="100%">
    <tr>
      <td width="8%"><div align="center"><strong>LINE</strong></div></td>
      <td width="17%"><div align="center"><strong>QTY CHECK</strong></div></td>
      <td width="18%"><div align="center"><strong>QTY HASIL</strong></div></td>
      <td width="22%"><div align="center"><strong>AVERAGE CHECK (DETIK)</strong></div></td>
      <td width="18%"><div align="center" title="((( qty_checking/2) - qty_hasil) * selisih_detik / (qty_checking/2)) / 60"><strong>LOSS TIME (MENIT)</strong></div></td>
    </tr>
    <?php foreach($data_loss_time as $row_data){ ?>
    <tr>
      <td align="center"><?php echo $row_data['line']; ?></td>
      <td align="center"><?php echo $row_data['qty_checking']; ?></td>
      <td align="center"><?php echo $row_data['hasil_output']; ?></td>
      <td align="center"><?php echo round($row_data['average_check']); ?></td>
      <td align="center"><?php echo round($row_data['waktu_terbuang']); ?></td>
    </tr>
    <?php } ?>
  </table>
</div>
