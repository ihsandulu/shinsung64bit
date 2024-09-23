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

      .mt-2 {
          margin-top: 30px;
      }

      .mb-2 {
          margin-bottom: 30px;
          border-bottom: grey dashed 1px;
      }
  </style>
  <div class="row p-1">
      <div class="col-md-12 mb-2">
          <form action="<?php echo base_url() ?>Report_end_line/Report_end_line_action" method="post">
              <div class="form-group row">
                  <div class="form-group col-md-6">
                      <label for="weekly">REPORT TYPE:</label>
                      <select class="form-control" name="weekly" id="weekly" onclick="pilihtype()">
                          <option value="SUMMARYDR" selected>SUMMARY DEFECT RATE % REPORT</option>
                          <option value="DAILYDR">DAILY DEFECT RATE % REPORT</option>
                          <option value="periode_top_5_per_line">TOP 5 PER LINE PERIODE</option>
                          <option value="daily">DAILY</option>
                      </select>
                  </div>
                  <div class="col-md-6 row" id="pilih_periode" name="pilih_periode">
                      <div class="form-group col-md-6">
                          <label for="tanggal">START DATE:</label>
                          <input type="DATE" class="form-control" name="tanggal_start" id="tanggal_start" value="<?php echo date("Y-m-d") ?>">
                      </div>
                      <div class="form-group col-md-6">
                          <label for="tanggal">END DATE:</label>
                          <input type="DATE" class="form-control" name="tanggal_end" id="tanggal_end" value="<?php echo date("Y-m-d") ?>">
                      </div>

                  </div>

                  <div class="form-group col-md-6" id=pilih_line name=pilih_line>
                      <label for="line_sewing">LINE SEWING:</label>
                      <input type="number" class="form-control" name="line_sewing" id="line_sewing" value="1">
                  </div>

                  <div class="form-group col-md-6" id=pilih_tanggal name=pilih_tanggal>
                      <label for="tanggal">DATE :</label>
                      <input type="DATE" class="form-control" name="tanggal" id="tanggal" value="<?php echo date("Y-m-d") ?>">
                  </div>

                  <div id="combo_week" name="combo_week">
                      <div class="form-group">
                          <label for="bulan">MONTH:</label>
                          <select class="form-control" name="bulan" id="bulan">
                              <?php for ($i = 1; $i <= 12; $i++) {
                                    // code...
                                    $sele = ($i == date('m')) ? 'selected' : '';
                                    echo "<option value=$i  $sele  >" . angkaKeBulan($i) . "</option>";
                                }
                                ?>
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="tahun">YEAR:</label>
                          <input type="number" class="form-control" name="tahun" id="tahun" value="<?php echo date("Y") ?>">
                      </div>
                      <div class="form-group">
                          <label for="week">WEEK:</label>
                          <select class="form-control" name="week" id="week">
                              <?php for ($i = 1; $i <= 5; $i++) {
                                    // code...
                                    echo "<option value=$i > ke " . $i . "</option>";
                                }
                                ?>
                          </select>
                      </div>




                  </div>

                  <div class="form-group" id="combo_manager" name="combo_manager">
                      <label for="manager">Manager:</label>
                      <select class="form-control" name="manager" id="manager">
                          <option value="AFI">AFI</option>
                          <option value="LASTRI">LASTRI</option>
                      </select>
                  </div>

                  <div id="checkbox_kj" name="checkbox_kj">
                      <div class="form-group">
                          <input type="button" class="form-control btn-success" onclick="panggil_kanaanpo()" name="btn_call_kj" id="btn_call_kj" value="TAMPILKAN KANAAN PO:">
                      </div>
                      <div class="form-group">
                          <div class="col-md-12">
                              <div id="result"> </div>
                          </div>
                      </div>
                  </div>
                  <br>
                  <div class="form-group col-md-6">
                      <br>
                      <button onclick="preview()" type="button" class="btn btn-primary">PREVIEW</button>
                  </div>
          </form>
      </div>
  </div>
  <div class="row p-2">
      <div class="col-md-12" id="tampil"></div>
  </div>

  <script>
      $(document).ready(function() {
          pilihtype();
          setTimeout(function() {
              preview();
          }, 100);
          setInterval(function() {
              preview();
          }, 120000);
      });

      function preview() {
          let pilih = $("#weekly").val();
          let tanggal_start = $("#tanggal_start").val();
          let tanggal_end = $("#tanggal_end").val();
          let line_sewing = $("#line_sewing").val();
          let tanggal = $("#tanggal").val();
          switch (pilih) {
              case "SUMMARYDR":
                  $.post("<?= base_url("Report_end_line/Summary_defect_rate_Action1b"); ?>", {
                          tanggal_start: tanggal_start,
                          tanggal_end: tanggal_end
                      })
                      .done(function(data) {
                          $("#tampil").html(data);
                      });
                  break;
              case "DAILYDR":
                  $.post("<?= base_url("Report_end_line/Daily_defect_rate_Action1b"); ?>", {
                          tanggal_start: tanggal_start,
                          tanggal_end: tanggal_end
                      })
                      .done(function(data) {
                          $("#tampil").html(data);
                      });
                  break;
              case "periode_top_5_per_line":
                // alert("<?= base_url("Report_end_line/Report_defect_top_5_per_line_periode_action1b"); ?>?tanggal_start="+tanggal_start+"&tanggal_end="+tanggal_end+"&line_sewing="+line_sewing);
                  $.get("<?= base_url("Report_end_line/Report_defect_top_5_per_line_periode_action1b"); ?>", {
                          tanggal_start: tanggal_start,
                          tanggal_end: tanggal_end,
                          line_sewing: line_sewing
                      })
                      .done(function(data) {
                          $("#tampil").html(data);
                      });
                  break;
              case "daily":
                  $.get("<?= base_url("Report_end_line/Report_daily_action1b"); ?>", {
                          line_sewing: line_sewing,
                          tanggal: tanggal
                      })
                      .done(function(data) {
                          $("#tampil").html(data);
                      });
                  break;
              default:

                  break;

          }
      }
  </script>


  <script type="text/javascript">
      function panggil_kanaanpo() {
          var weeklyValue = document.getElementById("weekly").value;
          if (weeklyValue === 'dailyperkj') {
              url_ = '<?php echo base_url() ?>Report_end_line/get_kanaan_po_pertanggal';
          } else {
              url_ = '<?php echo base_url() ?>Report_end_line/get_kanaan_po_style_pertanggal';
          }
          var tanggal = $('#tanggal').val();
          var line_sewing = $('#line_sewing').val();
          $.ajax({
              type: 'POST',
              url: url_,
              data: {
                  tanggal: tanggal,
                  line_sewing: line_sewing
              },
              dataType: 'json',
              success: function(response) {
                  if (response.length === 0) {
                      // No data was returned by the server
                      $('#result').html(' tidak ada kj yang dikerjakan pada tanggal itu');
                  } else {
                      var checkboxes = '<div class="row"> <input type="checkbox" id="select-all"> Select All<br> </div> <div class="row"> ';
                      response.forEach(function(item) {
                          checkboxes += '<div class="col md-2" style="float:left"> <div class="form-check">' +
                              ' <input class="form-check-input" type="checkbox" name="datakj[]" value="' + item.kanaan_po + '" id="' + item.kanaan_po + '"> &nbsp;' +
                              '<label class="form-check-label" for="' + item.kanaan_po + '">' + item.kanaan_po + '      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>' +
                              '</div> </div>';
                      });
                      checkboxes += '</div>';
                      console.log(checkboxes);
                      $('#result').html(checkboxes);
                  }
                  $('#select-all').click(function() {
                      $('input[name="datakj[]"]').prop('checked', this.checked);
                  });
              },
              error: function() {
                  alert('Terjadi kesalahan dalam permintaan Ajax.');
              }
          });
      }
      $("#combo_week").hide();
      $("#pilih_line").hide();
      $("#pilih_tanggal").hide();
      $("#combo_manager").hide();
      $("#checkbox_kj").hide();
      $("#pilih_periode").hide();

      function pilihtype() {
          var weeklyValue = document.getElementById("weekly").value;
          if (weeklyValue === 'periode_per_manager') {
              $("#combo_week").hide();
              $("#pilih_line").hide();
              $("#pilih_tanggal").hide();
              $("#combo_manager").show();
              $("#checkbox_kj").hide();
              $("#pilih_periode").show();
          } else if (weeklyValue === 'daily') {
              $("#combo_week").hide();
              $("#pilih_line").show();
              $("#pilih_tanggal").show();
              $("#combo_manager").hide();
              $("#checkbox_kj").hide();
              $("#pilih_periode").hide();
          } else if (weeklyValue === 'compareoutputhd') {
              $("#combo_week").hide();
              $("#pilih_line").hide();
              $("#pilih_tanggal").show();
              $("#combo_manager").hide();
              $("#checkbox_kj").hide();
              $("#pilih_periode").hide();
          } else if (weeklyValue === 'dailyperkj') {
              $("#combo_week").hide();
              $("#pilih_line").show();
              $("#pilih_tanggal").show();
              $("#combo_manager").hide();
              $("#checkbox_kj").show();
              $("#pilih_periode").hide();
          } else if (weeklyValue === 'dailyperkjstyle') {
              $("#combo_week").hide();
              $("#pilih_line").show();
              $("#pilih_tanggal").show();
              $("#combo_manager").hide();
              $("#checkbox_kj").show();
              $("#pilih_periode").hide();
          } else if (weeklyValue === 'weekly_top_5_per_line') {
              $("#combo_week").show();
              $("#pilih_line").show();
              $("#pilih_tanggal").hide();
              $("#combo_manager").hide();
              $("#checkbox_kj").hide();
              $("#pilih_periode").hide();
          } else if (weeklyValue === 'weekly') {
              $("#combo_week").show();
              $("#pilih_line").hide();
              $("#pilih_tanggal").hide();
              $("#combo_manager").show();
              $("#checkbox_kj").hide();
              $("#pilih_periode").hide();
          } else if (weeklyValue === 'SUMMARYDR') {
              $("#combo_week").hide();
              $("#pilih_line").hide();
              $("#pilih_tanggal").hide();
              $("#combo_manager").hide();
              $("#checkbox_kj").hide();
              $("#pilih_periode").show();
          } else if (weeklyValue === 'DAILYDR') {
              $("#combo_week").hide();
              $("#pilih_line").hide();
              $("#pilih_tanggal").hide();
              $("#combo_manager").hide();
              $("#checkbox_kj").hide();
              $("#pilih_periode").show();
          } else if (weeklyValue === 'periode_top_5_per_line') {
              $("#combo_week").hide();
              $("#pilih_line").show();
              $("#pilih_tanggal").hide();
              $("#combo_manager").hide();
              $("#checkbox_kj").hide();
              $("#pilih_periode").show();
          } else {
              $("#combo_week").hide();
              $("#pilih_line").hide();
              $("#pilih_tanggal").hide();
              $("#combo_manager").hide();
              $("#checkbox_kj").hide();
              $("#pilih_periode").hide();
          }
      }
  </script>