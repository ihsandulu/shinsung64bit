 <div class="row">
     <div class="col-md-12">
      
    <form action="<?= base_url('Daftar_defect/update/'.$defect['kode']) ?>" method="post">
      <div class="form-group">
        <label for="jenis">Jenis</label>
        <input type="text" class="form-control" id="jenis" name="jenis" value="<?= $defect['jenis'] ?>">
      </div>
      <div class="form-group">
        <label for="kode">Kode</label>
        <input type="text" class="form-control" id="kode" name="kode" value="<?= $defect['kode'] ?>" readonly>
      </div>
      <div class="form-group">
        <label for="keterangan">Keterangan</label>
        <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= $defect['keterangan'] ?>">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
      <a href="<?= base_url('Daftar_defect') ?>" class="btn btn-secondary">Cancel</a>
    </form>
  </div>
    </div>
 </div>
 