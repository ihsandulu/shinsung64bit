<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
  <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Hasil Inspect</a></li>
  <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Hasil OK </a></li>
  <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false">Output HD</a></li>
  <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Output Packing</a></li>
</ul>
<div class="tab-content">
  <div class="tab-pane active" id="tab_1">
  
  <table id="tbl_daftar_defect" style="width: 100%;" class="table table-striped table-condensed nowrap">
    <thead>
      <tr>
        <th width="132" style="width: 100px;">Aksi</th>

        <th width="156">KANAAN PO </th>
        <th width="294">STYLE</th>
        <th width="191">COLOR </th>
        <th width="191">LINE </th>
        <th width="191">TANGGAL </th>
        <th width="191">KODE </th>
        <th width="191">KETERANGAN </th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
  
  </div>
  <div class="tab-pane" id="tab_2">
  <table id="tbl_daftar_ok" style="width: 100%;" class="table table-striped table-condensed nowrap">
    <thead>
      <tr>
        <th width="132" style="width: 100px;">Aksi</th>

        <th width="156">KANAAN PO </th>
        <th width="294">STYLE</th>
        <th width="191">COLOR </th>
        <th width="191">LINE </th>
        <th width="191">TANGGAL </th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
  
  </div>
  <div class="tab-pane" id="tab_3">
    <table id="tbl_hasil_output" style="width: 100%;" class="table table-striped table-condensed nowrap">
    <thead>
      <tr>
        <th width="156">TANGGAL </th>
        <th width="294">LINE</th>
        <th width="191">KANAAN PO </th>
        <th width="191">STYLE NO </th>
        <th width="191">COLOR </th>
        <th width="191">QTY GLOBAL </th>
        <th width="191">DES </th>
         <th width="191">JAM KE </th>
        <th width="191">QTY </th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
  </div>


  <div class="tab-pane" id="tab_4">
    <table id="tbl_hasil_output_hd" style="width: 100%;" class="table table-striped table-condensed nowrap">
    <thead>
      <tr>
        <th width="156">TANGGAL <?php echo date('l'); ?></th>
        <th width="294">LINE</th>
        <th width="191">KANAAN PO </th>
        <th width="191">STYLE NO </th>
        <th width="191">COLOR </th>
        <th width="191">QTY GLOBAL </th>
        <th width="191">DES </th>
        <th width="191">JAM KE </th>
        <th width="191">QTY </th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
  </div>


</div>


<div class="box-body">
  
</div>
<script>
    $(function() {
        var table = $('#tbl_daftar_defect').DataTable();
        table.destroy();
        table = $('#tbl_daftar_defect').DataTable({
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "aaSorting": [],
            "ajax": {
                "url": baseUrl + 'Datatables_hasil_inputan/hasil_inputan_listdata',
                "type": "POST",
                "data": {},
            },
            initComplete: function() {
                $('.sorting_asc').removeClass('sorting_asc');
            }
        });
        table.draw();
    });
    

    function hasil_defect_delete(id) {
        var result = confirm("Want to delete?");
        if (result) {
            $.ajax({
                url: baseUrl + 'Hasil_inputan/hasil_defect_delete',
                type: 'POST',
                data: {
                    id : id
                },
            })
            .done(function() {
                $('#tbl_daftar_defect').DataTable().draw();
            });
        }
    }
</script>




<script>
    $(function() {
        var table_ = $('#tbl_daftar_ok').DataTable();
        table_.destroy();
        table_ = $('#tbl_daftar_ok').DataTable({
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "aaSorting": [],
            "ajax": {
                "url": baseUrl + 'Datatables_hasil_inputan/hasil_inputan_listdata_ok',
                "type": "POST",
                "data": {},
            },
            initComplete: function() {
                $('.sorting_asc').removeClass('sorting_asc');
            }
        });
        table_.draw();
    });
    


    function hasil_ok_delete(id) {
        var result = confirm("Want to delete?");
        if (result) {
            $.ajax({
                url: baseUrl + 'Hasil_inputan/hasil_ok_delete',
                type: 'POST',
                data: {
                    id : id
                },
            })
            .done(function() {
                $('#tbl_daftar_ok').DataTable().draw();
            });
        }
    }



</script>


<script>
    $(function() {
        var table__ = $('#tbl_hasil_output').DataTable();
        table__.destroy();
        table__ = $('#tbl_hasil_output').DataTable({
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "aaSorting": [],
            "ajax": {
                "url": baseUrl + 'Datatables_hasil_inputan/hasil_inputan_listdata_output',
                "type": "POST",
                "data": {},
            },
            initComplete: function() {
                $('.sorting_asc').removeClass('sorting_asc');
            }
        });
        table__.draw();
    });
    


function update_qty(id) {
	$.ajax({
	  url: baseUrl + 'Hasil_inputan/update_data_detail',    
      type: 'POST',
      data: {         
        qty : $('#qty_'+id).val(),
        id : id,
      },
    })
    .done(function(data) {
      alert('Data berhasil di simpan');
	  $('#tbl_hasil_output').DataTable().draw();
      
    });
  }
  

</script>





<script>
    $(function() {
        var table___ = $('#tbl_hasil_output_hd').DataTable();
        table___.destroy();
        table___ = $('#tbl_hasil_output_hd').DataTable({
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "aaSorting": [],
            "ajax": {
                "url": baseUrl + 'Datatables_hasil_inputan/hasil_inputan_listdata_output_hd',
                "type": "POST",
                "data": {},
            },
            initComplete: function() {
                $('.sorting_asc').removeClass('sorting_asc');
            }
        });
        table___.draw();
    });
    


function update_qty_hd(id) {
	$.ajax({
	  url: baseUrl + 'Hasil_inputan/update_data_detail_hd',    
      type: 'POST',
      data: {         
        qty : $('#qty_'+id).val(),
        id : id,
      },
    })
    .done(function(data) {
      alert('Data berhasil di simpan');
	  $('#tbl_hasil_output_hd').DataTable().draw();
      
    });
  }
  

</script>


