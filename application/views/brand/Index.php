<!--
<a href="#myModalAdd" data-toggle="modal" id="add" data-id="new"><button type="button" class="btn btn-primary"><i class="fa fa-plus-circle"></i>  TAMBAH KATEGORI MESIN </button></a><br/><br/>
-->

<div class="tab-content">
  <table id="tbl_daftar_model" style="width: 100%;" class="table table-striped table-condensed nowrap">
    <thead>
      <tr>
        <th width="113">ID</th>
        <th width="1175">MODEL</th>
        
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>


<!--
<div class="modal fade" id="myModalAdd" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-admin" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> KATEGORI MESIN </h4>
      </div>
      <div class="modal-body">
        <div class="fetched-data"></div>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="refresh_grid()" class="btn btn-danger btn-xs" 
        data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#myModalAdd').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            console.log(rowid);
            $.ajax({
                type : 'post',
                url : baseUrl + 'Mesin/add_kategori_mesin',
                data :  'rowid='+ rowid,
                success : function(data){
                $('.fetched-data').html(data);
                }
            });
         });
    });
</script>



</div>
-->
<script>
    $(function() {
        var table = $('#tbl_daftar_model').DataTable();
        table.destroy();
        table = $('#tbl_daftar_model').DataTable({
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "aaSorting": [],
            "ajax": {
                "url": baseUrl + 'Mesin/list_data_model',
                "type": "POST",
                "data": {},
            },
            initComplete: function() {
                $('.sorting_asc').removeClass('sorting_asc');
            }
        });
        table.draw();
      });


    // refresh_grid();
    

     function refresh_grid() {
         var table = $('#tbl_daftar_model').DataTable();
        table.destroy();
        table = $('#tbl_daftar_model').DataTable({
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "aaSorting": [],
            "ajax": {
                "url": baseUrl + 'Mesin/list_data_model',
                "type": "POST",
                "data": {},
            },
            initComplete: function() {
                $('.sorting_asc').removeClass('sorting_asc');
            }
        });
        table.draw();
             $('#myModalAdd').modal('hide');
     }


    function delete_data(id) {
        var result = confirm("Want to delete?");
        if (result) {
            $.ajax({
                url: baseUrl + 'Mesin/delete_data_kategori_mesin',
                type: 'POST',
                data: {
                    id : id
                },
            })
            .done(function() {
                 $('#tbl_daftar_model').DataTable().draw();
                refresh_grid();
            });
        }
    }
</script>