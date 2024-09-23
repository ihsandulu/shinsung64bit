<div class="tab-content">
   
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

  <div class="modal fade" id="myModalAdd" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-admin" role="document" style="width:98%;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"> PINDAH HASIL STYLE LAIN </h4>
        </div>
        <div class="modal-body">
          <div class="fetched-data"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    $(document).ready(function(){ 
		$('#myModalAdd').on('show.bs.modal', function (e) {
			var rowid = $(e.relatedTarget).data('id');
            $.ajax({
                type : 'post',
                url : baseUrl + 'Hasil_inputan/pindah_style_ironing',
                data :  'rowid='+ rowid,
                success : function(data){
                	$('.fetched-data').html(data);
                }
            });
         });
    });
</script>



<script>
$(function() {
    table__ = $('#tbl_hasil_output').DataTable({
        "processing": true,
        "serverSide": true,
        "ordering": false,
        "destroy": true,
        "aaSorting": [],
        "ajax": {
            "url": baseUrl + 'Datatables_hasil_inputan/hasil_inputan_output_ironing',
            "type": "POST",
            "data": {},
        },
        initComplete: function() {
            $('.sorting_asc').removeClass('sorting_asc');
        }
    });
});
    


function update_qty(id) {
    $.ajax({
        url: baseUrl + 'Hasil_inputan/update_data_detail_ironing',    
        type: 'POST',
        data: {         
            qty : $('#qty_'+id).val(),
            TANGGAL_HASIL : $('#tanggal_hasil_'+id).val(),
            id : id,
        },
    })
        .done(function(data) {
        alert('Data berhasil di simpan');
        $('#tbl_hasil_output').DataTable().draw();
    });
}
  

</script>
