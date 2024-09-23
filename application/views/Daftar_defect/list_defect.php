
 <div class="row">
    <div class="col-md-12">
        <table class="table table-striped table-bordered" id="defect">
            <thead>
              <tr>
                <th>Jenis</th>
                <th>Kode</th>
                <th>Keterangan</th>
              </tr>
            </thead>
        <tbody>
              <?php foreach ($defects as $defect): ?>
                <tr>
                  </td>
                  <td><?= $defect['jenis'] ?></td>
                  <td><?= $defect['kode'] ?></td>
                  <td><?= $defect['keterangan'] ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
    </div>
</div>
<script>
$('#defect').DataTable();
</script>