  <style>
      .border {
          border: black solid 1px;
      }

      .p-1 {
          margin: 20px;
          margin-left: 20px;
          padding-left: 20px;
          padding-right: 40px;
      }

      .p-2 {
          padding-left: 20px;
      }
  </style>
  <div class="row p-2">
      <div class="col-md-12" id="tampil"></div>
  </div>

  <script>
      $(document).ready(function() {
          setTimeout(function() {
              preview();
          }, 100);
          setInterval(function() {
              preview();
          }, 20000);
      });

      function preview() {
          let tanggal_start = '<?= date('Y-m-01'); ?>';
          let tanggal_end = '<?= date('Y-m-t'); ?>';
          $.post("<?= base_url("Report_end_line/Summary_defect_rate_Actionb"); ?>", {
                  tanggal_start: tanggal_start,
                  tanggal_end: tanggal_end
              })
              .done(function(data) {
                  $("#tampil").html(data);
              });
      }
  </script>

