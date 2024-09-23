<div id="form_entry">
  <form class="md-form" id="submitForm" method="post" enctype="multipart/form-data">
    <div class="form-group"   >
      <label> id </label>
      <input type="text" name="id" id="id" readonly class="form-control" value="<?php echo @$kategori_mesin['id']; ?>" autocomplete="off">
    </div>
    <div class="form-group">
      <label> KATEGORI </label>
      <input type="text" name="kategori" id="kategori" class="form-control" value="<?php echo @$kategori_mesin['kategori']; ?>" autocomplete="off">
    </div>
    <div class="form-group">
      <label> keterangan / catatan </label>
      <input type="text"  name="catatan" id="catatan" class="form-control" value="<?php echo @$kategori_mesin['catatan']; ?>" autocomplete="off">
    </div>
     
    <div class="form-group">
      <label> </label>
      <button type="button" id="saveItemUpdate" class="btn btn-info"> <i class="fa fa-save"> </i> Simpan </button>
    </div>
  </form>
</div>
 
<script>
$(document).ready(function(){

  $("#saveItemUpdate").click(function(){
    var id = $("#id").val();
    var kategori = $("#kategori").val();
    var catatan = $("#catatan").val();

    $.ajax({
      url: 'exec_add_kategori_mesin',  //your server side script
      data: {id: id, kategori: kategori, catatan: catatan},
      type: 'POST',
      success: function(data) {
        alert('Data submitted successfully');
        $('#tbl_kategori_mesin').DataTable().draw();
         refresh_grid();
      },
      error: function() {
        alert('An error occurred');
      },
    });
  });
});
</script>
