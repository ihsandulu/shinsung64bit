
</div>
<div class="box-body">
  <table id="tbl_daftar_images" style="width: 100%;" class="table table-striped table-condensed nowrap">
    <thead>
      <tr>
        <th width="132" style="width: 100px;">Aksi</th>

        <th width="156">STYLE </th>
        <th width="294">COLOR</th>
        <th width="191">IMAGES </th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
</div>
<script>
    $(function() {
        var table = $('#tbl_daftar_images').DataTable();
        table.destroy();
        table = $('#tbl_daftar_images').DataTable({
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "aaSorting": [],
            "ajax": {
                "url": baseUrl + 'Datatables_daftar_images/daftar_images_listdata',
                "type": "POST",
                "data": {},
            },
            initComplete: function() {
                $('.sorting_asc').removeClass('sorting_asc');
            }
        });
        table.draw();
    });
    

    function daftar_images_delete(id) {
        var result = confirm("Want to delete?");
        if (result) {
            $.ajax({
                url: baseUrl + 'daftar_images/delete_daftar_images',
                type: 'POST',
                data: {
                    id : id
                },
            })
            .done(function() {
                $('#tbl_daftar_images').DataTable().draw();
            });
        }
    }
</script>