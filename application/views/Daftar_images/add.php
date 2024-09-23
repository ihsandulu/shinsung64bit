<div class="row">
     <div class="col-md-5">
    <form action="<?php echo base_url('Daftar_images/submit') ?>" method="post"  enctype="multipart/form-data">
      <div class="form-group">
        <label for="style_no">STYLE </label>
        <input type="hidden" class="form-control" id="id_image" name="id_image" value="<?php echo $this->uri->segment(3); ?>" required>
        <input type="text" class="form-control" id="style_no" name="style_no" value="<?php echo $style_no; ?>" required>
      </div>
      
      <div class="form-group">
        <label for="color">COLOR </label>
        <input type="text" class="form-control" id="color" name="color" value="<?php echo $color; ?>" required>
      </div>
      
      
      <div class="form-group">
        <label for="keterangan">FILE</label>
      <input type="hidden" class="form-control" id="lokasi_gambar_asli" name="lokasi_gambar_asli" value="<?php echo $images; ?>">
      <input type="file" name="lokasi_gambar" id="lokasi_gambar"  required />
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
      <a href="<?php echo base_url('Daftar_images/Index') ?>" class="btn btn-secondary">Cancel</a>
    </form>
  </div>
</div>

 