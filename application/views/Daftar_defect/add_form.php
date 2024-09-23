<div class="row">
     <div class="col-md-5">
    <form action="<?= base_url('Daftar_defect/submit') ?>" method="post"  enctype="multipart/form-data">
      <div class="form-group">
        <label for="jenis">Jenis</label>
        <input  type="text" class="form-control" id="jenis" name="jenis" >
          
      </div>
      <div class="form-group">
        <label for="kode">Kode</label>
        <input type="text" class="form-control" id="kode" name="kode" >
      </div>
      <div class="form-group">
        <label for="keterangan">Keterangan</label>
        <input type="text" class="form-control" id="keterangan" name="keterangan">
      </div>
      <!-- <div class="form-group">
        <label for="keterangan">FILE</label>
      <input type="file" name="lokasi_gambar" id="lokasi_gambar" />
      </div> -->
      <button type="submit" class="btn btn-primary">Submit</button>
      <a href="<?= base_url('Daftar_defect') ?>" class="btn btn-secondary">Cancel</a>
    </form>
  </div>
</div>

 