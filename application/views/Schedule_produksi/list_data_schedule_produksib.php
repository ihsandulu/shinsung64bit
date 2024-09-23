<?php
// pre($header) 
?>
<style>
  td {
    padding-top: 10px !important;
    padding-bottom: 10px !important;
    text-align: center;
  }
</style>
<div class="body-body">
  <div class="col-md-12">
    <div style="overflow-x: scroll;">
      <!-- <small> <b>FOR A MORE SPECIFIC SEARCH USE THE ";" (SEMICOLON) SIGN WITH THE FORMAT: LINE SEWING; FILE NO; BUYER; STYLE NO; ITEM <br> Add the keyword "today" to see today's schedule </b> </small> -->

      <form class="form-inline" action="" style="margin-bottom:20px;">
        <div class="form-group">
          <label for="email">Data:</label>
          <select onchange="cekpilihan()" class="form-control" id="data">
            <option value="today">Today</option>
            <option value="all">All</option>
            <option value="current">Current</option>
          </select>
        </div>
        <div class="form-group daten">
          <label for="fileno">File No.:</label>
          <input type="text" class="form-control" id="fileno"/>
        </div>
        <div class="form-group daten">
          <label for="style">Style:</label>
          <input type="text" class="form-control" id="style"/>
        </div>
        <button type="button" class="btn btn-default" onclick="listschedule()">View</button>
      </form>
      <script>
       function cekpilihan(){
          let pilihan = $("#data").val();
          if(pilihan=="current"){$(".daten").show();}else{$(".daten").hide();}
        }
        cekpilihan();
        </script>
      <div id="listschedule"></div>
    </div>
  </div>
</div>

<script>
  function listschedule() {
    let datanya = $("#data").val();
    let fileno = $("#fileno").val();
    let style = $("#style").val();
    // alert('<?= base_url("api/list_scheduleb"); ?>?datanya='+datanya);
    $.get("<?= base_url("api/list_scheduleb"); ?>", {
        datanya: datanya,
        fileno: fileno,
        style : style
      })
      .done(function(data) {
        $("#listschedule").html(data);
      });
  }

  $(document).ready(function() {
    listschedule();
  });
</script>



<!-- <script type="text/javascript">
  $(function() {

    table = $('#tbl_schedule_produksi').DataTable({
      "destroy": true,
      "processing": true,
      "serverSide": true,
      "ordering": false,
      "aaSorting": [],
      "ajax": {
        "url": baseUrl + 'Schedule_produksi/gridSchedule',
        "type": "POST",
        "data": {},
      },
      initComplete: function() {
        $('.sorting_asc').removeClass('sorting_asc');
      }
    });
  });
</script> -->