 <div class="row">
     <div class="col-md-12">
        <a class="btn btn-primary" href="<?= base_url('Daftar_defect/add_new') ?>"> Add New </a>
    </div>
 </div>

 <div class="row">
    <div class="col-md-12">
        <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>ACTION</th>
                <th>Jenis</th>
                <th>Kode</th>
                <th>Keterangan</th>
                <th>Lokasi Gambar</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($defects as $defect): ?>
                <tr>
                  <td><?//= $defect['id'] ?>
                  <div> <a href="<?= base_url('Daftar_defect/edit/'.$defect['kode']) ?>" > EDIT </a></div>
                  </td>
                  <td><?= $defect['jenis'] ?></td>
                  <td><?= $defect['kode'] ?></td>
                  <td><?= $defect['keterangan'] ?></td>
                  <td><?= $defect['lokasi_gambar'] ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
    </div>
</div>
