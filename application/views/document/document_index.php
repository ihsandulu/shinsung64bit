<div class="row">
  <div class="col-md-4">
      <div class="form-group">
        <label for="">Pilih Kode Dokumen</label>
        <select class="form-control input-sm" name="documentKode" id="documentKode">
        <option value="">Semua</option>
        <?php foreach($kodeDokumen as $item) { ?> 
          <option value="<?php echo $item['KODE_DOKUMEN'] ?>"><?php echo $item['URAIAN_DOKUMEN'] ?></option> 
          <?php } ?> 
      </select>
      </div>
  </div>
</div>
<div class="row">
    <div class="col-md-12" style="overflow: scroll;">
      <table id="example" class="table table table-bordered table-condensed nowrap" style="width:100%">
        <thead>
         <tr class="bg-primary">
            <TH>#</TH>
            <TH>NOMOR AJU</TH>
            <TH>NOMOR</TH>
            <TH>TANGGAL</TH>
            <TH>KODE</TH>

            <?php foreach ($entitasHeader as $item): ?>
              <th><?php echo $item['uraian_entitas'] ?></th>
            <?php endforeach ?>
            <TH>UPLOAD OLEH</TH>
            <TH>WAKTU UPLOAD</TH>
         </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
</div>

<?php echo modal_start('showDetail', 'Detail'); ?>

<div class="d" style="overflow: auto;">
<table id="detailPage" class="table table table-bordered table-condensed compact nowrap" style="width:100%">
  <thead>
   <tr class="bg-primary text-nowrap">
      <th>Nomor Aju</th>
      <th>Seri Barang</th>
      <th>Hs</th>
      <th>Kode Barang</th>
      <th>Uraian</th>
      <th>Merek</th>
      <th>Tipe</th>
      <th>Ukuran</th>
      <th>Spesifikasi Lain</th>
      <th>Kode Satuan</th>
      <th>Jumlah Satuan</th>
      <th>Kode Kemasan</th>
      <th>Jumlah Kemasan</th>
      <th>Kode Dokumen Asal</th>
      <th>Kode Kantor Asal</th>
      <th>Nomor Daftar Asal</th>
      <th>Tanggal Daftar Asal</th>
      <th>Nomor Aju Asal</th>
      <th>Seri Barang Asal</th>
      <th>Netto</th>
      <th>Bruto</th>
      <th>Volume</th>
      <th>Saldo Awal</th>
      <th>Saldo Akhir</th>
      <th>Jumlah Realisasi</th>
      <th>Cif</th>
      <th>Cif Rupiah</th>
      <th>Ndpbm</th>
      <th>Fob</th>
      <th>Asuransi</th>
      <th>Freight</th>
      <th>Nilai Tambah</th>
      <th>Diskon</th>
      <th>Harga Penyerahan</th>
      <th>Harga Perolehan</th>
      <th>Harga Satuan</th>
      <th>Harga Ekspor</th>
      <th>Harga Patokan</th>
      <th>Nilai Barang</th>
      <th>Nilai Jasa</th>
      <th>Nilai Dana Sawit</th>
      <th>Nilai Devisa</th>
      <th>Persentase Impor</th>
      <th>Kode Asal Barang</th>
      <th>Kode Daerah Asal</th>
      <th>Kode Guna Barang</th>
      <th>Kode Jenis Nilai</th>
      <th>Jatuh Tempo Royalti</th>
      <th>Kode Kategori Barang</th>
      <th>Kode Kondisi Barang</th>
      <th>Kode Negara Asal</th>
      <th>Kode Perhitungan</th>
      <th>Pernyataan Lartas</th>
      <th>Flag 4 Tahun</th>
      <th>Seri Izin</th>
      <th>Tahun Pembuatan</th>
      <th>Kapasitas Silinder</th>
      <th>Kode Bkc</th>
      <th>Kode Komoditi Bkc</th>
      <th>Kode Sub Komoditi Bkc</th>
      <th>Flag Tis</th>
      <th>Isi Per Kemasan</th>
      <th>Jumlah Dilekatkan</th>
      <th>Jumlah Pita Cukai</th>
      <th>Hje Cukai</th>
      <th>Tarif Cukai</th>
   </tr>
  </thead>
  <tbody>
  </tbody>
</table>
</div>
<div style="clear: both;margin-bottom: 10px;"></div>


</div><!-- /.modal-content -->

   <div class="modal-footer">
    <div id="sumDetail"></div>
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
    
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>
  function showDetail(nomor_aju) {
    $('#detailPage').DataTable({
        "processing": true,
        "serverSide": true,
        "ordering": false,
        "destroy": true,
        "stateSave": true,
        "iDisplayLength": 50,
        "ajax": {
            "url": baseUrl + 'document/detail',
            "type": "POST", 
            "data" :  {
              aju : nomor_aju
            }
        },
        "dom": "<'row'<'col-xs-8'l<'toolbar'>><'col-md-4'f>>" +
            "<'row'<'col-md-12'tr>>" +
            "<'row'<'col-md-5'i><'col-md-7'p>>",
        "language": {
            "sLengthMenu": "_MENU_",
            "searchPlaceholder": "Search..."
        }
    }); 

    $.ajax({
      url: baseUrl + 'document/sumDetail',
      type: 'POST',
      dataType: 'HTML',
      data: {
        aju : nomor_aju
      },
    })
    .done(function(response) {
      $('#sumDetail').html(response);
      $('#showDetail').modal("show");
    })
  }

  function deleteData(id) {
    let confirmdata = confirm("Are you sure to delete ?");
    if (confirmdata) {
      $.ajax({
        url: baseUrl + 'document/documentDestroy',
        type: 'POST',
        data: {
          nomor_aju : id
        },
      })
      .done(function() {
        listdata();
      });
    }
  }

  function listdata(kodeDokumen) {
    var table = $('#example').DataTable({
        "processing": true,
        "serverSide": true,
        "ordering": false,
        "destroy": true,
        "stateSave": true,
        "iDisplayLength": 50,
        "ajax": {
            "url": baseUrl + 'document/listdata',
            "type": "POST", 
            "data" :  {
              dokumen : kodeDokumen
            }
        },
        "dom": "<'row'<'col-xs-8'l<'toolbar'>><'col-md-4'f>>" +
            "<'row'<'col-md-12'tr>>" +
            "<'row'<'col-md-5'i><'col-md-7'p>>",
        "language": {
            "sLengthMenu": "_MENU_",
            "searchPlaceholder": "Search..."
        }
    });
  }

  $(function() {
    listdata();
    $('#documentKode').change(function() {
      listdata($(this).val());
    });
  });
</script>
