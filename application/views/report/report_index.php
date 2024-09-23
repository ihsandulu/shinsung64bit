<div class="row">
  <div class="col-md-12">
     <form id="formReport">

        <div class="row">
          <div class="col-md-4 col-xs-12">
              <div class="form-group">
               <label for="periodeAwal">Periode Awal</label>
               <input type="date" class="form-control" name="periodeAwal" id="periodeAwal" value="<?php echo date('Y-m-01') ?>">
             </div> 
          </div>
          <div class="col-md-4 col-xs-12">
            <div class="form-group">
             <label for="periodeAkhir">Periode Akhir</label>
             <input type="date" class="form-control" name="periodeAkhir" id="periodeAkhir" value="<?php echo date('Y-m-t') ?>">
           </div>
          </div>
          <div class="col-md-4 col-xs-12">
            <div class="form-group" style="width: 100%;">
             <label for="kodeDokumen">Kode Kepabean</label>
             <select name="kodeDokumen" id="kodeDokumen" class="form-control select2">
               <option value="">ALL</option>
               <?php foreach ($kodeDokumen as $val): ?>

                <option value="<?php echo $val['KODE_DOKUMEN'] ?>"><?php echo $val['URAIAN_DOKUMEN'] ?></option>
               <?php endforeach ?>
             </select>
           </div>
          </div>
        </div>
     
       

       
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="shipperName">Shipper</label>
              <input type="text" class="form-control" name="shipperName" id="shipperName">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="termQuery">Cari</label>
              <input type="text" class="form-control" name="termQuery" id="termQuery">
            </div>
          </div>
        </div>
        

        

        <button type="submit" class="btn btn-primary">PROSES</button>
     </form>

     
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="responseResult"></div>
  </div>
</div>

<script>
  $(function() {

    $('#formReport').on('submit', function(e) {
      e.preventDefault();

      Swal.fire({
          title: 'Please Wait...',
          allowOutsideClick: false,
          showConfirmButton:false,
          onBeforeOpen: () => {
              Swal.showLoading()
          },
      });

      $.ajax({
        url: baseUrl + 'Report/ajaxReport',
        type: 'POST',
        dataType: 'HTML',
        data: $(this).serializeArray(),
      })
      .done(function(response) {
        swal.close();
        $('.responseResult').html(response);
        // $('#reportTable').dataTable();
         $('#reportTable').DataTable({
            "ordering": false,
            "stateSave": true,
            "iDisplayLength": 10,
            "dom": "<'row'<'col-sm-2'l><'col-sm-6'B><'col-sm-4 pull-right'f>>" +
                            "<'row'<'col-sm-12'tr>>" +
                            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "language": {
              "sLengthMenu": "_MENU_",
              "searchPlaceholder": "Search..."
            },
            buttons: [{
              extend: 'excel',
              className: 'btn btn-default btn-sm',
              text: 'Export to Excel',
              // title: "FG PENERIMAAN DETAIL",
              // messageTop: 'Tanggal ' + $('#f_tanggal_mulai').val() + ' s/d ' + $('#f_tanggal_selesai').val() 
            }]
          });
      });
    });

    $('.select2').select2({
      theme: "bootstrap"
    })
  });
</script>
 
